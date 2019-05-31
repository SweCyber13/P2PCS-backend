<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 28/05/2019
 * Time: 23:09
 */

include_once '../objects/user.php'; //dipendenza: aggiornare i punti in seguito al riscatto coupon

class coupon
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

    function redeem($user) {
        //vede se l'utente puà riscattare il coupon e lo riscatta in caso aggiornando i punti buoni
    }


}