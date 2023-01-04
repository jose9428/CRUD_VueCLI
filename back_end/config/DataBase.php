<?php

class Database {

    protected $dbh;
    protected $servidor = "localhost";
    protected $database = "bdEmpleado";
    protected $usuario = "root";
    protected $contrasenia = "";

    public function getConnection() {
        try {
            $conn = $this->dbh = new PDO("mysql:local=" . $this->servidor . ";"
                    . "dbname=" . $this->database, $this->usuario, $this->contrasenia);
            return $conn;
        } catch (Exception $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names() {
        return $this->dbh->query("SET NAMES 'utf8'");
    }

}

?>