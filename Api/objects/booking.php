<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 28/05/2019
 * Time: 23:12
 */

include_once '../objects/car.php'; //dipendenza: aggiornare la disponibilità al momento di una prenotazione accettata

class booking
{
    //tratta la tabella prenotazioni

    // database connection and table name
    private $conn;
    private $table_name = "PRENOTAZIONI";
    private $table_cars="MACCHINE_UTENTI";

    // object properties
    public $id; //PK
    public $proprietario;
    public $richiedente;
    public $targa;
    public $data_inizio;
    public $data_fine; //al momento sempre uguale a data_inizio
    public $time_inizio;
    public $time_fine;
    public $costo; //calcolato
    public $indirizzo_partenza;
    public $indirizzo_arrivo;
    public $latitudine_partenza;
    public $longitude_partenza;
    public $latitudine_arrivo;
    public $longitude_arrivo;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function readuserbookings(){
        //ritorna tutte le prenotazioni effettuate dal richiedente NON ANCORA TERMINATE
    }

    function readusertravels(){
        //ritorna tutte le prenotazioni effettuate dal richiedente con stato T (termitate)
    }

    function readbookings(){
        //ritorna tutte le prenotazioni ricevute dal proprietario NON ANCORA TERMINATE
    }

    function readtravels(){
        //ritorna tutte le prenotazioni ricevute dal proprietario con stato T (termitate)
    }

    function delete(){
        //cancella una prenotazione con uno specifico id (puo essere stata rifiutata dal proprietario o eliminata dal richiedente)
    }

    function create(){
        //crea una nuova richiesta di prenotazione
    }

    function updatestatus() {
        //aggiorna lo stato della prenotazione P (pendente)-> A (accettata) -> C (viaggio in corso) -> T (terminata)
        //quando lo stato passa ad A devo invocare il metodo book sull auto con targa indicata nella prenotazione
        //DA USARE METODO DECREASEAVAIABILITY AL MOMENTO
        //l'aggiormaneto dello stato viene fatto in automatico senza indicare a che stato passare

    }









}