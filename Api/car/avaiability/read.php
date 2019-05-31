<?php
/**
 * Created by IntelliJ IDEA.
 * User: squer
 * Date: 30/05/2019
 * Time: 13:46
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here

// include database and object files
include_once '../../config/database.php';
include_once '../../objects/car.php';
include_once '../../utils/Timestring.php';
include_once '../../utils/timesegment.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$car = new Car($db);

$car->targa= $_GET['TARGA'];
$day= $_GET['GIORNO']; //aaaa-mm-gg

$res=$car->getavaiability($day);

$num = $res->num_rows;

if($num>0){

    // prendo la riga con la disponibilità nel giorno scelto
    $row = mysqli_fetch_assoc($res);

    //converto la riga in un array che rappresenta minuto inizio e minuto fine

    $timestring= new Timestring($row["Stringa_disponibilita"]);
    $arr=$timestring->decode();
    //ho ottenuto un array con sui pari il minuto di inizio e sui dispari il minuto di fine disponibilità
    if($arr[1]) { //ci deve essere almeno una coppia di valori se il giorno non è pieno, il primo puo valere 0 quindi controllo il secondo
        //se non è completamente occupato
        //creo l'array di json objects da stampare
        $time_arr=array();
        $time_arr["disponibilita"]=array();

        for($i=1;$i<=sizeof($arr, 1);$i=$i+2) {
            $timeobj=new Timesegment($arr[$i-1],$arr[$i]);
            array_push($time_arr["disponibilita"], $timeobj);
        }

        // set response code - 200 OK
        http_response_code(200);

        // show products data in json format
        echo json_encode($time_arr,JSON_PRETTY_PRINT);
    }
    else {
        // set response code - 404 Not found
        http_response_code(404);

        // tell the user that all the day is booked
        echo json_encode(
            array("message" => "Day is full")
        );
    }
}
else{

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "Car not found")
    );
}