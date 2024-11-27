<?php

Trait Model{

    use Database;
    protected $limit = 10;
    protected $offset = '0';
    protected $order_type = "desc";
    public $errors = [];

    public function setLimit($limit) {
        $this->limit = $limit;
    }

    public function first($data,$data_not = []){

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query="SELECT * FROM $this->table WHERE ";

        foreach($keys as $key){
            $query .= $key . "=:" .$key . " && ";
        }

        foreach($keys_not as $key){
            $query .= $key . "!=:" .$key . " && ";
        }

        $query =trim($query," && ");

        $query .=" limit $this->limit offset $this->offset" ;

        $data = array_merge($data,$data_not);

        $result = $this->query($query,$data);

        if($result)
            return $result[0];

        return false;

    }
    
    public function where($data,$data_not = []){

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query="SELECT * FROM $this->table WHERE ";

        foreach($keys as $key){
            $query .= $key . "=:" .$key . " && ";
        }

        foreach($keys_not as $key){
            $query .= $key . "!=:" .$key . " && ";
        }

        $query =trim($query," && "). " ";

        $query .="order by $this->order_column $this->order_type limit $this->limit offset $this->offset" ;

        $data = array_merge($data,$data_not);

        return $this->query($query,$data);

    }
    public function insert($data){

        if(!empty($this->allowedColumns)){
            foreach($data as $key => $value){
                if(!in_array($key,$this->allowedColumns)){
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query="INSERT INTO $this->table (".implode(",",$keys).") VALUES (:".implode(",:",$keys).") ";

        $this->query($query,$data);

        return true;
    }

    public function update($id,$data,$id_column = 'id'){
        
        if(!empty($this->allowedColumns)){
            foreach($data as $key => $value){
                if(!in_array($key,$this->allowedColumns)){
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $query="UPDATE $this->table SET ";

        foreach($keys as $key){
            $query .= $key . "= :" .$key . " , ";
        }  

        $query =trim($query," , ");

        $query .=" WHERE $id_column = :$id_column" ;

        $data[$id_column] = $id;

        if ($this->query($query, $data)) {
            return true; // Return true if query execution succeeds
        }
    
        return false;
    }

    public function delete($id,$id_column = 'id'){
       
        $data[$id_column] = $id;
        $query="DELETE FROM $this->table WHERE $id_column = :$id_column ";

        $this->query($query,$data);
        
    }  
    
    public function findAll() {
        if (!isset($this->order_column)) {
            throw new Exception('Order column not defined in the model.');
        }
    
        $query = "SELECT * FROM $this->table ";
        $query .= "ORDER BY $this->order_column $this->order_type LIMIT $this->limit OFFSET $this->offset";
    
        return $this->query($query);
    }
    
}