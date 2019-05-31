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
    public $ora_inizio;
    public $ora_fine;
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
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE Richiedente=? AND Stato!='T'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s",$this->richiedente);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;
    }

    function readusertravels(){
        //ritorna tutte le prenotazioni effettuate dal richiedente con stato T (termitate)
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE Richiedente=? AND Stato='T'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s",$this->richiedente);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;
    }

    function readbookings(){
        //ritorna tutte le prenotazioni ricevute dal proprietario NON ANCORA TERMINATE
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE Richiedente=? AND Stato!='T'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s",$this->proprietario);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;

    }

    function readtravels(){
        //ritorna tutte le prenotazioni ricevute dal proprietario con stato T (termitate)
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE Richiedente=? AND Stato='T'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s",$this->proprietario);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;
    }

    function delete(){
        //cancella una prenotazione con uno specifico id (puo essere stata rifiutata dal proprietario o eliminata dal richiedente)
        // select all query
        $query = "DELETE FROM $this->table_name WHERE Id_prenotazioni=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("i",$this->id);

        // execute query

        $result=$stmt->execute();

        return $result;
    }

    function create(){
        //crea una nuova richiesta di prenotazione
        $query = "INSERT INTO $this->table_name(Proprietario, Richiedente, Targa, Data_inizio, Ora_inizio, Data_fine,
        Ora_fine, Stato, Costo, Indirizzo_partenza, Indirizzo_arrivo, Latitudine_partenza,Longitudine_partenza,
        Latitudine_arrivo, Longitudine_arrivo)  
        VALUES(?, ?, ?, ?, ?, ?, ?, 'P', ?, ?, ?, ?, ?, ?, ?)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params s string i int d double

        $stmt->bind_param("ssssisidssdddd",$this->proprietario,$this->richiedente,$this->targa,$this->data_inizio,
            $this->ora_inizio, $this->ora_fine, $this->costo, $this->indirizzo_partenza,$this->indirizzo_arrivo,
            $this->latitudine_partenza,$this->longitude_partenza,$this->latitudine_partenza,$this->latitudine_arrivo);

        // execute query and save success or error
        $result=$stmt->execute();

        return $result;
    }

    function updatestatus() {
        //aggiorna lo stato della prenotazione P (pendente)-> A (accettata) -> C (viaggio in corso) -> T (terminata)
        //quando lo stato passa ad A devo invocare il metodo book sull auto con targa indicata nella prenotazione
        //DA USARE METODO DECREASEAVAIABILITY AL MOMENTO
        //l'aggiormaneto dello stato viene fatto in automatico senza indicare a che stato passare

    }









}