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
$user = new User($db);

$user->username= $_GET['USERNAME'];
$user->nome= $_GET['NAME'];
$user->cognome= $_GET['SURNAME'];
$user->mail= $_GET['MAIL'];
$user->eta= $_GET['ETA'];
$user->sesso= $_GET['SESSO'];
$user->citta= $_GET['CITTA'];
$user->data_rilascio_p= $_GET['DATARILASCIOPATENTE'];
$user->numero_patente= $_GET['NUMEROPATENTE'];
$user->occupazione= $_GET['OCCUPAZIONE'];

//leggo i punti

if($_GET['RANK'] || $_GET['BUONI']) {

    $points = $user->getcurrent();
    $num = $points->num_rows;

    if ($num > 0) {

        while ($row = mysqli_fetch_assoc($points)){
            // extract row
        extract($row);
        $rank=$row['Punti_rank'];
        $buoni=$row['Punti_buoni'];

        }

        if($_GET['RANK'])
            $user->punti_rank=$rank+$_GET['RANK'];
        if($_GET['BUONI'])
            $user->punti_buoni=$buoni+$_GET['BUONI'];

    } else {

        // set response code - 404 Not found
        http_response_code(404);

        // tell the user no products found
        echo json_encode(
            array("message" => "User not found")
        );
    }

}

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