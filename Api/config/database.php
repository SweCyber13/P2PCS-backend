<?php
class Database{

    // specify your own database credentials
    private $host = "database-2.c8uvrduzqndl.us-east-1.rds.amazonaws.com";
    private $db_name = "P2PCS";
    private $username = "admin";
    private $password = "adminadmin";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;
            //$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            //$this->conn->exec("set names utf8");
        $this->conn = new mysqli($this->host,$this->username,$this->password,$this->db_name);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $this->conn;
    }
}

?>
