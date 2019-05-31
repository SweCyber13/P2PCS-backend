<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 30/05/2019
 * Time: 13:44
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

$res=$car->getreviews();

$num = $res->num_rows;

if($num>0){

    // products array
    $arr=array();
    $arr["recensioni"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = mysqli_fetch_assoc($res)){
        // extract row
        extract($row);

        array_push($arr["recensioni"], $row);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($arr,JSON_PRETTY_PRINT);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "Reviews not found")
    );
}