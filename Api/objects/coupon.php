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
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE Id_coupon=?";

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
        $query = "DELETE FROM $this->table_name WHERE Id_coupon=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("i",$this->id);

        // execute query

        $result=$stmt->execute();

        return $result;

    }

    function create(){
        // select all query
        $query = "INSERT INTO $this->table_name(Soglia_punti, Nome_azienda, Titolo, Descrizione)  VALUES(?, ?, ?, ?)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("isss",$this->soglia_punti,$this->azienda,$this->titolo,$this->descrizione);

        // execute query and save success or error
        $result=$stmt->execute();

        return $result;

    }

    function update(){
        //TODO

    }

    function redeem($user) {
        //vede se l'utente puà riscattare il coupon e lo riscatta in caso aggiornando i punti buoni
        $newuser= new User($this->conn);
        $newuser->username=$user;
        //chiamo la funzione subtract che ritornerà vero e toglierà i punti se il coupon è stato riscattato altrimenti falso
        $redento=$newuser->subtractpoints(1,$this->soglia_punti);
        return $redento;
    }


}