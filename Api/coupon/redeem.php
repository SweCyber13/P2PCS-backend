<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 31/05/2019
 * Time: 21:15
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/coupon.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$coupon = new Coupon($db);

$coupon->id= $_GET['ID'];
$user= $_GET['USERNAME'];

$res=$coupon->redeem($user);

if($res){
    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
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