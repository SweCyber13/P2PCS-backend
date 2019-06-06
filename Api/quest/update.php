<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/quest.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$quest = new quest($db);

$quest->titolo = $_GET['TITLE'];
$quest->descrizione = $_GET['DESCRIPTION'];
$quest->soglia_completamento = $_GET['LIMIT'];
$quest->premio_rank = $_GET['RANKPRIZE'];
$quest->premio_buono = $_GET['GIFTPRIZE'];
$quest->premio_medaglia = $_GET['BADGEPRIZE'];

$res=$user->update();

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