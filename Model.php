<?php

    abstract class Model
    {
        public $connection;
        
        public function __construct()
        {
            $this->connection = new PDO("mysql:host=localhost;dbname=test", 'root', '');
        }

        abstract public function get_data();
        abstract public function put_data($data);
    }

?>