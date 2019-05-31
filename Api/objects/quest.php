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

    }

    function delete(){

    }

    function create(){

    }

    function update(){

    }

    function readall($user) {
        //mostra tutte le quest disponibili ad un determinato utente incluso lo stato di avanazamento
    }

    function assign($user) {
        //assegna la quest ad un determinato utente
    }

    function updateprogress($user, $progress) {
        //aggiorna l'avanzamento della missione per l'utente di una quantita pari a $progress, chiama complete($user) se avanzamneto=soglia.
        //forse completa lo devo lasciare a un pulsante sulla ui.
    }

    function complete($user) {
        //assegna i premi all'user e segna la missione come completata per quell'utente
    }
}