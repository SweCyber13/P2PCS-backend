<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 04/06/2019
 * Time: 14:43
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// database connection will be here

// include database and object files
include_once '../config/database.php';
include_once '../objects/car.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$car = new Car($db);

$startlat= $_GET['STARTLAT'];
$startlon= $_GET['STARTLON'];
$endlat= $_GET['ENDLAT'];
$endlon= $_GET['ENDLON'];
$day= $_GET['DAY'];
$start_time= $_GET['STARTTIME'];
$end_time= $_GET['ENDTIME'];

$res=$car->search($startlat,$startlon,$endlat,$endlon,$day,$start_time,$end_time);
//ritorna un array
$num=count($res);

if($num>0){

    // products array
    $arr=array();
    $arr["macchine"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop

    for($i=0;$i<count($res);$i++) {
        array_push($arr["macchine"], $res[$i]);

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
        array("message" => "No Car Found")
    );
}