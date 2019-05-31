<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 28/05/2019
 * Time: 23:11
 */

class badge
{
    // database connection and table name
    private $conn;
    private $table_name = "MEDAGLIE";
    private $table_assegnati = "MEDAGLIE_OTTENUTE";

    public $nome; //PK

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function readall($user){
        //fa vedere tutte le medaglie ottenute dall'utente
        $query = "SELECT Medaglia FROM $this->table_assegnati WHERE Utente=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$user);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;
    }

    function assign($user){
        //assegna un badge all'utente con username indicato
        // select all query
        $query = "INSERT INTO $this->table_assegnati(Utente,Medaglia)  VALUES(?,?)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("ss",$user,$this->nome);

        // execute query and save success or error
        $result=$stmt->execute();

        return $result;
    }

    function delete(){
        // select all query
        $query = "DELETE FROM $this->table_name WHERE Nome=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->nome);

        // execute query

        $result=$stmt->execute();

        return $result;
    }

    function create(){
        // select all query
        $query = "INSERT INTO $this->table_name(Nome)  VALUES(?)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->nome);

        // execute query and save success or error
        $result=$stmt->execute();

        return $result;
    }


}