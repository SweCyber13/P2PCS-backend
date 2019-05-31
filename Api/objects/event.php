<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 28/05/2019
 * Time: 23:10
 */

class Event
{
    // database connection and table name
    private $conn;
    private $table_name = "EVENTI";

    public $id; //PK
    public $nome_azienda;
    public $titolo_offerta;
    public $descrizione;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read() {
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE Id_eventi=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params
        $stmt->bind_param("i",$this->id);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;
    }

    function readall() {
        // select all query
        $query = "SELECT * FROM $this->table_name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;
    }

    function delete(){
        // select all query
        $query = "DELETE FROM $this->table_name WHERE Id_eventi=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params
        $stmt->bind_param("i",$this->username);

        // execute query
        $result=$stmt->execute();

        return $result;
    }

    function create(){
        // select all query
        $query = "INSERT INTO $this->table_name(Id_eventi, Nome_azienda, Titolo_offerta, Descrizione)  VALUES(?, ?, ?, ?)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params
        $stmt->bind_param("isss",$this->id,$this->nome_azienda,$this->titolo_offerta,$this->descrizione);

        // execute query and save success or error
        $result=$stmt->execute();

        return $result;
    }

    function update(){
        //check what params need to be updated
        //$fields="";
        $errors=0;
        if($this->nome_azienda) {
            $query="UPDATE $this->table_name SET Nome_azienda=? WHERE Id_eventi=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("si",$this->nome_azienda,$this->id);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }

        }
        if ($this->titolo_offerta){
            $query="UPDATE $this->table_name SET Titolo_offerta=? WHERE Id_eventi=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("si",$this->titolo_offerta,$this->id);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->descrizione){
            $query="UPDATE $this->table_name SET Descrizione=? WHERE Id_eventi=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("si",$this->descrizione,$this->id);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }

        //return false if there was an error
        if($errors>0) return false;
        else
            return true;

    }
}