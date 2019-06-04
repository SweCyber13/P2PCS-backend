<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 28/05/2019
 * Time: 23:10
 */

include_once '../objects/user.php'; //dipendenza: aumentare punti utente
include_once '../objects/badge.php'; //dipendenza: assegnare badge a utente
class quest
{
    // database connection and table name
    private $conn;
    private $table_name = "MISSIONI";
    private $table_progress = "AVANZAMENTO_MISSIONI";
    private $table_users = "UTENTI_REGISTRATI";

    public $titolo; //PK
    public $descrizione;
    public $soglia_completamento;
    public $premio_rank;
    public $premio_buono;
    public $premio_medaglia; //può essere vuoto o con il nome di un badge

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read() {
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE Titolo=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params
        $stmt->bind_param("s",$this->titolo);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;
    }

    function delete(){
        // select all query
        $query = "DELETE FROM $this->table_name WHERE Titolo=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params
        $stmt->bind_param("s",$this->titolo);

        // execute query
        $result=$stmt->execute();

        return $result;
    }

    function create(){
        // select all query
        $query = "INSERT INTO $this->table_name(Titolo, Descrizione, Premio_rank, Premio_buono, Premio_medaglia, Soglia_completamento) VALUES(?, ?, ?, ?, ?, ?)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params
        $stmt->bind_param("siisd",$this->titolo,$this->descrizione,$this->premio_rank,$this->premio_buono,$this->premio_medaglia,$this->soglia_completamento);

        // execute query and save success or error
        $result=$stmt->execute();

        return $result;
    }

    function update(){
        //check what params need to be updated
        $errors=0;
        if($this->descrizione) {
            $query="UPDATE $this->table_name SET Descrizione=? WHERE Titolo=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("ss",$this->descrizionen,$this->titolo);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }

        }
        if ($this->premio_rank){
            $query="UPDATE $this->table_name SET Premio_rank=? WHERE Titolo=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("is",$this->premio_rank,$this->titolo);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if ($this->premio_buono){
            $query="UPDATE $this->table_name SET Premio_buono=? WHERE Titolo=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("is",$this->premio_buono,$this->titolo);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if ($this->premio_medaglia){
            $query="UPDATE $this->table_name SET Premio_medaglia=? WHERE Titolo=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("ss",$this->premio_medaglia,$this->titolo);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->soglia_completamento){
            $query="UPDATE $this->table_name SET Soglia_completamento=? WHERE Titolo=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params
            $stmt->bind_param("ds",$this->soglia_completamento,$this->titolo);

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

    function readall($user) {
        //mostra tutte le quest disponibili ad un determinato utente incluso lo stato di avanazamento
        // select all query
        $query = "SELECT * FROM $this->table_progress WHERE Utente=?";

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

    function assign($user,$progress) {
        //assegna la quest ad un determinato utente
        // select all query
        $query = "INSERT INTO $this->table_progress(Utente, Missione, Avanzamento) VALUES(?, ?, ?, ?)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params
        $stmt->bind_param("ssid",$user,$this->titolo,$progress);

        // execute query and save success or error
        $result=$stmt->execute();

        return $result;
    }

    function updateprogress($user, $progress) {
        //aggiorna l'avanzamento della missione per l'utente di una quantita pari a $progress, chiama complete($user) se avanzamneto=soglia.
        //forse completa lo devo lasciare a un pulsante sulla ui

        $errors = 0;
        $query="UPDATE $this->table_progress SET Avanzamento=? WHERE Utente=? AND Missione=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("dss",$progress,$user,$this->titolo);
        if(!$stmt->execute()) {
            $errors=$errors+1;
        }

        //return false if there was an error
        if($errors>0) return false;

        if($progress == $this->soglia_completamento) $this->complete($user);

        return true;
    }

    function complete($user) {
        //assegna i premi all'user e segna la missione come completata per quell'utente
        $errors = 0;

        $query="UPDATE $this->table_progress SET Completata=? WHERE Utente=? AND Missione=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iss",1,$user,$this->titolo);
        if(!$stmt->execute()) {
            $errors=$errors+1;
        }

        if($this->premio_rank != 0){
            //come creare un oggetto user cui fare riferimento per invocare la funzione addpoints su di esso
            $user_obj = new User(this->conn);
            $user_obj->username = $user;
            $user_obj->addpoints(0,$this->premio_rank);
        }

        if($this->premio_buono != 0){
            //come creare un oggetto user cui fare riferimento per invocare la funzione addpoints su di esso
            $user_obj = new User(this->conn);
            $user_obj->username = $user;
            $user_obj->addpoints(1,$this->premio_buono);
        }

        if($this->premio_medaglia != null){

        }

        //return false if there was an error
        if($errors>0) return false;
        else return true;
    }
}