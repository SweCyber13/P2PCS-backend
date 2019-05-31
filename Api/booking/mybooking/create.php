<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 31/05/2019
 * Time: 17:30
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/booking.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$booking= new booking($db);

$booking->proprietario= $_GET['PROPRIETARIO'];
$booking->richiedente= $_GET['RICHIEDENTE'];
$booking->targa= $_GET['TARGA'];
$booking->data_inizio= $_GET['DATAINIZIO'];
$booking->data_fine= $_GET['DATAFINE']; //al momento sempre uguale a data_inizio
$booking->ora_inizio= $_GET['ORAINIZIO']; //IN MINUTI
$booking->ora_fine= $_GET['ORAFINE']; //IN MINUTI
$booking->costo= $_GET['COSTO']; //calcolato
$booking->indirizzo_partenza= $_GET['INDIRIZZOPARTENZA'];
$booking->indirizzo_arrivo= $_GET['INDIRIZZOARRIVO'];
$booking->latitudine_partenza= $_GET['LATITUDINEPARTENZA'];
$booking->longitude_partenza= $_GET['LONGITUDINEPARTENZA'];
$booking->latitudine_arrivo= $_GET['LATITUDINEARRIVO'];
$booking->longitude_arrivo= $_GET['LONGITUDINEARRIVO'];


$res=$booking->create();

if($res){
    // set response code - 200 OK
    http_response_code(200);

    echo json_encode(
        array("message" => "Success")
    );
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "Error") //targa non disponibile nell'orario selezionato errore principale
    );
}