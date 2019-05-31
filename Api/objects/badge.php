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
    }

    function assign($user){
        //assegna un badge all'utente con username indicato
    }

    function delete(){

    }

    function create(){

    }

    function update(){

    }


}