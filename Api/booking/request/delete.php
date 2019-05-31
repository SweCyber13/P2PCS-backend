<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 31/05/2019
 * Time: 17:33
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

$booking->id= $_GET['ID'];


$res=$booking->delete();

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
        array("message" => "Error") //prenotazione non esistente
    );
}