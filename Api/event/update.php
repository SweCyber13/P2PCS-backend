<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$event = new Event($db);

$event->id= $_GET['ID'];
$event->nome_azienda= $_GET['NOME_AZIENDA'];
$event->titolo_offerta= $_GET['TITOLO_OFFERTA'];
$event->descrizione= $_GET['DESCRIZIONE'];

$res=$event->update();

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
        array("message" => "Error in updating a field")
    );
}

?>