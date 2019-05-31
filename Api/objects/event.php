<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 28/05/2019
 * Time: 23:10
 */

class event
{
    // database connection and table name
    private $conn;
    private $table_name = "COUPONS";

    public $id; //PK
    public $soglia_punti;
    public $titolo;
    public $azienda;
    public $descrizione;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read() {

    }

    function readall() {

    }

    function delete(){

    }

    function create(){

    }

    function update(){

    }
}