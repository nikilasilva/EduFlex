<?php

Trait Database{

    protected function connect(){
        $string = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
        $conn = new PDO($string,DB_USER,DB_PASSWORD);        
        return $conn;
    }

    public function query($query,$data = []){

        $conn = $this->connect();
        $stm=$conn->prepare($query);
        $check = $stm->execute($data);
        
        // For SELECT queries
        if (stripos(trim($query), 'select') === 0) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($result) && count($result)) {
                return $result;
            }
            return [];
        }

        // For UPDATE/INSERT/DELETE
        return $check; // true or false
    }

    public function getRow($query,$data = []){
        
        $conn = $this->connect();
        $stm=$conn->prepare($query);

        $check = $stm->execute($data);
        if($check){
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result)){
                return $result[0];
            }
        }

        return false;
    }


}



// $string = "mysql:hostname=localhost;dbname=my_db";
// $con = new PDO($string,'root','');

// show($conn);