<?php

class Ornek{

    // database connection and table name
    private $conn;
    private $table_name = "ornek";

    public function __construct($db){
        $this->conn = $db;
    }

    function readAll(){

        $query = "SELECT
                *
            FROM
                " . $this->table_name . "
            ORDER BY
                id ASC
            ";

        $stmt = $this->conn->prepare( $query );
        $stmt->execute();

        return $stmt;
    }
}
