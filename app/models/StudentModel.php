<?php
    class StudentModel{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getUsers(){
            $this->db->query('SELECT * FROM Student');
            return $this->db->resultSet();
        }

    }