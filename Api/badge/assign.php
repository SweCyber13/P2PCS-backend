<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 31/05/2019
 * Time: 21:29
 */
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/badge.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$badge = new badge($db);

$badge->nome= $_GET['NOME'];
$user=$_GET['USERNAME'];

$res=$badge->assign($user);

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