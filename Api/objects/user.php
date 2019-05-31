<?php
class User
{

    //fornisce i metodi necessari per la modifica e aggiornamento dei dati utenti e per recuperare informazioni sullo stesso

    // database connection and table name
    private $conn;
    private $table_name = "UTENTI_REGISTRATI";
    private $table_reviews="RECENSIONI";
    private $table_travels="PRENOTAZIONI"; //per recensioni

    // object properties
    public $username;
    public $nome;
    public $cognome;
    public $mail;
    public $punti_rank;
    public $punti_buoni;
    public $eta;
    public $sesso;
    public $citta;
    public $data_rilascio_p;
    public $numero_patente;
    public $occupazione;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    //return table with all users
    public function getall(){

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


    //return user with object properties
    function getcurrent(){
        // select all query
        $query = "SELECT * FROM $this->table_name WHERE Username=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->username);

        // execute query
        $stmt->execute();

        //get select results
        $result=$stmt->get_result();

        return $result;

    }

    //return user with object properties
    function create(){
        // select all query
        $query = "INSERT INTO $this->table_name(Username, Nome, Cognome, Mail)  VALUES(?, ?, ?, ?)";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("ssss",$this->username,$this->nome,$this->cognome,$this->mail);

        // execute query and save success or error
        $result=$stmt->execute();

        return $result;

    }

    function update(){

        //check what params need to be updated
        //$fields="";
        $errors=0;
        if($this->nome) {
            //$fields=$fields."Nome=?,";
            $query="UPDATE $this->table_name SET Nome=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->nome,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }

        }
        if ($this->cognome){
            //$fields=$fields."Cognome=?,";
            $query="UPDATE $this->table_name SET Cognome=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->cognome,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->mail){
            //$fields=$fields."Mail=?,";
            $query="UPDATE $this->table_name SET Mail=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->mail,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->punti_buoni){
            //$fields=$fields."Punti_buoni=?,";
            $query="UPDATE $this->table_name SET Punti_buoni=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("is",$this->punti_buoni,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->punti_rank){
            //$fields=$fields."Punti_rank=?,";
            $query="UPDATE $this->table_name SET Punti_rank=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("is",$this->punti_rank,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->eta){
            //$fields=$fields."Eta=?,";
            $query="UPDATE $this->table_name SET Eta=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("is",$this->eta,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->sesso){
            //$fields=$fields."Sesso=?,";
            $query="UPDATE $this->table_name SET Sesso=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->sesso,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->citta){
            //$fields=$fields."Citta=?,";
            $query="UPDATE $this->table_name SET Citta=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->citta,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->data_rilascio_p){
            //$fields=$fields."Data_rilascio_p=?,";
            $query="UPDATE $this->table_name SET Data_rilascio_p=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->data_rilascio_p,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->numero_patente){
            //$fields=$fields."Numero_patente=?,";
            $query="UPDATE $this->table_name SET Numero_patente=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->numero_patente,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }
        if($this->occupazione){
            //$fields=$fields."occupazione=?,";
            $query="UPDATE $this->table_name SET Occupazione=? WHERE Username=?";
            // prepare query statement
            $stmt = $this->conn->prepare($query);

            //bind params

            $stmt->bind_param("ss",$this->occupazione,$this->username);

            // execute query and save success or error
            if(!$stmt->execute()) {
                $errors=$errors+1;
            }
        }

        //return 0 if there was an error
        if($errors>0) return false;
            else
                return true;

    }

    //delete a specific user
    function delete() {
        // select all query
        $query = "DELETE FROM $this->table_name WHERE Username=?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->username);

        // execute query

        $result=$stmt->execute();

        return $result;
    }

    function getreviews() {
        //ritorna la tabella contenente le recensioni per questo utente sia come prestatore auto che come autista

        //JOIN PRENOTAZIONI E RECENSIONI DOVE RECENSITO E' LO USERNAME
        $query = "SELECT Recensore, Voto, Testo FROM $this->table_travels JOIN $this->table_reviews 
                  ON Id_viaggio = Id_prenotazioni WHERE $this->table_reviews.Recensito = ? ";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        //bind params

        $stmt->bind_param("s",$this->username);

        // execute query

        $stmt->execute();

        //get results

        $result=$stmt->get_result();

        return $result;
    }

    function leaderboard() {
        //ritorna una lista globale di utenti ordinata secondo punti rank
        //TODO
    }

    function addpoints($type,$value) {
        //AGGIUNGE PUNTI BUONI O RANK DELLA QUANTITA $VALUE
        //$type= rank (0) o buoni (1)
        if($type==0){
            //rank
            $res=$this->getcurrent();
            $row = mysqli_fetch_assoc($res);
            $currentpoints=$row["Punti_rank"];
            $this->punti_rank=$currentpoints+$value;
        }
        if($type==1){
            //buoni
            $res=$this->getcurrent();
            $row = mysqli_fetch_assoc($res);
            $currentpoints=$row["Punti_buoni"];
            $this->punti_buoni=$currentpoints+$value;

        }

        //faccio l'update
        return $this->update();
    }

    function subtractpoints($type,$value){
        //RIMUOVE PUNTI BUONI O RANK DELLA QUANTITA $VALUE
        //$type= rank (0) o buoni (1)
        if($type==0){
            //rank
            $res=$this->getcurrent();
            $row = mysqli_fetch_assoc($res);
            $currentpoints=$row["Punti_rank"];
            //il valore di punti non può andare sotto zero
            if($currentpoints-$value < 0) return false;
            $this->punti_rank=$currentpoints-$value;
        }
        if($type==1){
            //buoni
            $res=$this->getcurrent();
            $row = mysqli_fetch_assoc($res);
            $currentpoints=$row["Punti_buoni"];
            //il valore di punti non può andare sotto zero
            if($currentpoints-$value < 0) return false;
            $this->punti_buoni=$currentpoints-$value;

        }

        //faccio l'update
        return $this->update();

    }



}
