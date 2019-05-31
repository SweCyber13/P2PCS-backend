<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 30/05/2019
 * Time: 13:43
 */
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/car.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$car = new Car($db);

$car->targa= $_GET['TARGA'];
$car->proprietario= $_GET['PROPRIETARIO'];
$car->marca= $_GET['MARCA'];
$car->modello= $_GET['MODELLO'];
$car->annoproduzione= $_GET['ANNOPRODUZIONE'];
$car->cavalli= $_GET['CAVALLI'];
$car->cilindrata= $_GET['CILINDRATA'];
$car->raggio= $_GET['RAGGIO'];//percorrenza massima dalla posizione in km
$car->chilometraggio= $_GET['CHILOMETRAGGIO'];
$car->tariffaoraria= $_GET['TARIFFAORARIA'];
$car->latitudine= $_GET['LATITUDINE'];
$car->longitude= $_GET['LONGITUDINE'];
$car->indirizzo= $_GET['INDIRIZZO'];

$res=$car->create();

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
        array("message" => "Error")
    );
}