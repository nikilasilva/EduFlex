<?php

// Trait Model{

//     use Database;
//     protected $limit = 10;
//     protected $offset = '0';
//     protected $order_type = "desc";
//     public $errors = [];

//     public function setLimit($limit) {
//         $this->limit = $limit;
//     }

//     public function first($data,$data_not = []){

//         $keys = array_keys($data);
//         $keys_not = array_keys($data_not);
//         $query="SELECT * FROM $this->table WHERE ";

//         foreach($keys as $key){
//             $query .= $key . "=:" .$key . " && ";
//         }

//         foreach($keys_not as $key){
//             $query .= $key . "!=:" .$key . " && ";
//         }

//         $query =trim($query," && ");

//         $query .=" limit $this->limit offset $this->offset" ;

//         $data = array_merge($data,$data_not);

//         $result = $this->query($query,$data);

//         if($result)
//             return $result[0];

//         return false;

//     }
    
//     public function where($data,$data_not = []){

//         $keys = array_keys($data);
//         $keys_not = array_keys($data_not);
//         $query="SELECT * FROM $this->table WHERE ";

//         foreach($keys as $key){
//             $query .= $key . "=:" .$key . " && ";
//         }

//         foreach($keys_not as $key){
//             $query .= $key . "!=:" .$key . " && ";
//         }

//         $query =trim($query," && "). " ";

//         $query .="order by $this->order_column $this->order_type limit $this->limit offset $this->offset" ;

//         $data = array_merge($data,$data_not);

//         return $this->query($query,$data);

//     }
//     public function insert($data){

//         if(!empty($this->allowedColumns)){
//             foreach($data as $key => $value){
//                 if(!in_array($key,$this->allowedColumns)){
//                     unset($data[$key]);
//                 }
//             }
//         }

//         $keys = array_keys($data);
//         $query="INSERT INTO $this->table (".implode(",",$keys).") VALUES (:".implode(",:",$keys).") ";

//         $this->query($query,$data);

//         return true;
//     }

//     public function update($id,$data,$id_column = 'id'){
        
//         if(!empty($this->allowedColumns)){
//             foreach($data as $key => $value){
//                 if(!in_array($key,$this->allowedColumns)){
//                     unset($data[$key]);
//                 }
//             }
//         }

//         $keys = array_keys($data);
//         $query="UPDATE $this->table SET ";

//         foreach($keys as $key){
//             $query .= $key . "= :" .$key . " , ";
//         }  

//         $query =trim($query," , ");

//         $query .=" WHERE $id_column = :$id_column" ;

//         $data[$id_column] = $id;

//         if ($this->query($query, $data)) {
//             return true; // Return true if query execution succeeds
//         }
//         return false;
//     }

//     public function delete($id,$id_column = 'id'){
       
//         $data[$id_column] = $id;
//         $query="DELETE FROM $this->table WHERE $id_column = :$id_column ";

//         $this->query($query,$data);
        
//     }  
    
//     public function findAll() {
//         if (!isset($this->order_column)) {
//             throw new Exception('Order column not defined in the model.');
//         }
    
//         $query = "SELECT * FROM $this->table ";
//         $query .= "ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
    
//         return $this->query($query);
//     }
    
// }


trait Model {

    use Database;
    protected $limit = 20;
    protected $offset = '0';
    protected $order_type = "desc";
    protected $order_column = "id"; // Default order column
    public $errors = [];

    // Set the limit for queries
    public function setLimit($limit) {
        $this->limit = $limit;
    }

    // Set the offset for queries
    public function setOffset($offset) {
        $this->offset = $offset;
    }

    // Set the order column and type for queries
    public function setOrder($column, $type = "desc") {
        $this->order_column = $column;
        $this->order_type = $type;
    }

    // Fetch the first row matching conditions
    public function first($data, $data_not = []) {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }

        $query = trim($query, " AND ");
        $query .= " LIMIT 1";

        $data = array_merge($data, $data_not);

        $result = $this->query($query, $data);

        return $result ? $result[0] : false;
    }


    // Fetch multiple rows matching conditions
    public function where($data, $data_not = []) {

        $keys = array_keys($data);

       $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }

        $query = trim($query, " AND ");
        $query .= " ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";

        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    // Insert a new record
    public function insert($data) {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (" . implode(",", $keys) . ") VALUES (:" . implode(",:", $keys) . ")";

        return $this->query($query, $data);
    }

    // Update an existing record
    public function update($id, $data, $id_column = 'id') {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }

        $query = trim($query, ", ");
        $query .= " WHERE $id_column = :$id_column";

        $data[$id_column] = $id;

        return $this->query($query, $data);
    }

    // Delete a record
    public function delete($id, $id_column = 'id') {
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
        return $this->query($query, [$id_column => $id]);
    }

    // Fetch all rows from the table
    // public function findAll() {
    //     $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
    //     return $this->query($query);
    // }

//     public function findAll()
// {
//     $orderColumn = property_exists($this, 'custom_order_column') ? $this->custom_order_column : 'id';
//     return $this->query("SELECT * FROM $this->table ORDER BY $orderColumn DESC");
// }
    public function findAll() {
        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
        return $this->query($query);
    }
public function findSimilar($column, $value) {
        $query = "SELECT * FROM $this->table WHERE $column LIKE :value ";
    
        // Prepare the parameter with the value surrounded by wildcards
        $params = ['value' => '%' . $value . '%'];
    
        // Add ordering and limit/offset if defined
        if (isset($this->order_column)) {
            $query .= "ORDER BY $this->order_column $this->order_type ";
        }
    
        $query .= "LIMIT $this->limit OFFSET $this->offset";
    
        // Execute the query and return the result
        return $this->query($query, $params);
    }
}
