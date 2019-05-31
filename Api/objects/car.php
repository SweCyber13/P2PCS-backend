<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 28/05/2019
 * Time: 14:56
 */
include_once '../utils/Timestring.php';

class Car
{

    //tratta la tabella calendario di disponibilità come un attributo del veicolo

    // database connection and table name
    private $conn;
    private $table_name = "MACCHINE_UTENTI";
    private $table_avaiability= "CALENDARIO_DISPONIBILITA";
    private $table_reviews="RECENSIONI";
    private $table_travels="PRENOTAZIONI"; //per recensioni

    // object properties
    public $targa; //PK
    public $proprietario;
    public $marca;
    public $modello;
    public $annoproduzione;
    public $cavalli;
    public $cilindrata;
    public $raggio; //percorrenza massima dalla posizione in km
    public $chilometraggio;
    public $tariffaoraria;
    public $latitudine;
    public $longitude;
    public $indirizzo;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function readall(){
        //get all cars from a proprietario
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE Proprietario=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->proprietario);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        //TODO RITORNARE IMMAGINI

        return $result;
    }

    function read(){
        //get a car
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE  Targa=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->targa);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        //TODO RITORNARE IMMAGINI

        return $result;
    }

    function create() {
        // select all query
        $query = "INSERT INTO $this->table_name(Targa, Proprietario, Marca, Modello, Anno_produzione,Cavalli, Cilindrata,
        Raggio_percorrenza,Kilometraggio, Tariffa_oraria, Latitudine, Longitudine, Indirizzo)  
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params s string i int d double

        $stmt->bind_param("sssssiiiiddds",$this->targa,$this->proprietario,$this->marca,$this->modello,
            $this->annoproduzione, $this->cavalli, $this->cilindrata, $this->raggio,$this->chilometraggio,
            $this->tariffaoraria,$this->latitudine,$this->longitude,$this->indirizzo);

        // execute query and save success or error
        $result=$stmt->execute();

        return $result;
    }

    function update(){

        //check what params need to be updated
        $errors=0;
        if($this->proprietario) {

            $query="UPDATE $this->table_name SET Proprietario=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->proprietario,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }

        }
        if ($this->marca){

            $query="UPDATE $this->table_name SET Marca=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->marca,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if ($this->modello){

            $query="UPDATE $this->table_name SET Modello=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->modello,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->annoproduzione){

            $query="UPDATE $this->table_name SET Anno_produzione=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->annoproduzione,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->cavalli){

            $query="UPDATE $this->table_name SET Cavalli=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("is",$this->cavalli,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->cilindrata){

            $query="UPDATE $this->table_name SET Cilindrata=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("is",$this->cilindrata,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->raggio){

            $query="UPDATE $this->table_name SET Raggio_percorrenza=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("is",$this->raggio,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->chilometraggio){

            $query="UPDATE $this->table_name SET Kilometraggio=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("is",$this->chilometraggio,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->tariffaoraria){

            $query="UPDATE $this->table_name SET Tariffa_oraria=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ds",$this->tariffaoraria,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->latitudine){

            $query="UPDATE $this->table_name SET Latitudine=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ds",$this->latitudine,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->longitude){

            $query="UPDATE $this->table_name SET Longitudine=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ds",$this->longitude,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->indirizzo){

            $query="UPDATE $this->table_name SET Indirizzo=? WHERE Targa=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->indirizzo,$this->targa);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }

        //return false if there was at least an error
        if($errors>0) return false;
        else
            return true; //if no query was sent returns true

    }


    function deleteall(){
        // select all query
        $query = "DELETE FROM $this->table_name WHERE Proprietario=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->proprietario);

        // execute query

        $result=$stmt->execute();

        return $result;
    }

    function delete(){
        // select all query
        $query = "DELETE FROM $this->table_name WHERE Targa=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->targa);

        // execute query

        $result=$stmt->execute();

        return $result;
    }

    function getreviews(){
        //ritorna la tabella contenente le recensioni per questa auto

        //JOIN PRENOTAZIONI E RECENSIONI DOVE TARGA DI PRENOTAZIONI E' QUELLA DELL'AUTO
        $query = "SELECT Voto, Testo FROM $this->table_travels JOIN $this->table_reviews 
                  ON Id_viaggio = Id_prenotazioni WHERE $this->table_travels.Targa = ? ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->targa);

        // execute query

        $stmt->execute();

        //get query results
        $result=$stmt->get_result();

        return $result;

    }

    function getavaiability($day=null){

        if(!$day) {
            //ritorna le date in cui l'auto è stata segnata come disponibile e quelle in cui è prenotata se $day è vuoto

            $query = "SELECT * FROM $this->table_avaiability WHERE  Macchina=?";

            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("s",$this->targa);
        }
        else {

            //altrimenti ritorna solo quella del giorno specificato

            $query = "SELECT * FROM $this->table_avaiability WHERE  Macchina=? AND Giorno=?";

            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->targa,$day);
        }

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;
    }

    function updateavaiability($day,$start_time,$end_time){
        //aggiunge un record se non presente per quel giorno o modifica la stringa di disponibilità per il giorno specificato
        $res=$this->getavaiability($day);
        $num = $res->num_rows;
        if($num==1){
            //c'è già la disponibilità, ovvero era già stata inserita una stringa per quel giorno aggiorna UPDATE

            //ci sara sempre e solo una riga
            $row = mysqli_fetch_assoc($res);
            $currentstring=new Timestring($row["Stringa_disponibilita"]);
            $updatestring=new Timestring();
            $updatestring->make($start_time,$end_time);
            $currentstring->update_string($updatestring);

            //currentstring ora contiene i valori di disponibilita aggiornati
            //prendo la stringa da aggiornare
            $updatevalue=$currentstring->string;

            $query="UPDATE $this->table_avaiability SET Stringa_disponibilita=? WHERE Macchina=? AND Giorno=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("sss",$updatevalue,$this->targa,$day);

            // execute query and return true if success
            return $stmt->execute();

        }
        else{
            //aggiungo una nuova istanza di disponibilità nella tabella INSERT
            $updatestring=new Timestring();
            $updatestring->make($start_time,$end_time);

            //updatestring contiene la nuova stringa di disponibilita per quel giorno

            $updatevalue=$updatestring->string;

            $query="INSERT INTO $this->table_avaiability (Macchina,Giorno,Stringa_disponibilita) VALUES (?,?,?)";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("sss",$this->targa,$day,$updatevalue);

            // execute query and return true if success
            return $stmt->execute();


        }

    }

    function decreaseavaiability($day,$start_time,$end_time){
        //se è presente un record in quel giorno controlla che l'auto sia disponibile nell'intervallo indicato
        //e toglie la disponibilità in tale intervallo
        //TODO
    }

    function getcloser($latitude, $longitude, $limit=100) {
        //ritorna le $limit macchine più vicine alla posizione desiderata
        //TODO
    }

    function search(){
        //ritorna la tabella con le auto risultanti dalla ricerca, con tutti i dettagli per il viaggio
        //TODO
    }



}