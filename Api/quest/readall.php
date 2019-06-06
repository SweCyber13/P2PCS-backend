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

// read users will be here
// query products
$res = $quest->getall();

// check if more than 0 record found
$num = $res->num_rows;

if($num>0){

    // products array
    $quests_arr=array();
    $quests_arr["quest"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = mysqli_fetch_assoc($res)){
        // extract row
        extract($row);

        array_push($quests_arr["quest"], $row);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($quests_arr,JSON_PRETTY_PRINT);
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    echo json_encode(
        array("message" => "No quests found")
    );
}

?>