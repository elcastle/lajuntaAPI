<?php
require_once '../conexion/ConexionPDO.php';
require_once '../models/Habitacion.php';

session_start();

// para tomar parametros que viajan por put usaremos el metodo file_get_contents()


$result = "";
// si el action viene por post, tomara el valor de post, caso contrario tomara el valor por get
$action = isset($_POST["action"]) ? $_POST["action"] : $_GET["action"];

switch ($action) {

case"getallhabitaciones":
    $reg = new Habitacion();
    $habitacionlist = $reg->getAllhabitacion();
    header("Content-Type: application/json; charset=UTF8");
    // convierte la respuesta en un json y la envia
    $json=json_encode($habitacionlist, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
        break;

case "deletehabitacion":
    $reg = new Habitacion();
    $id = $_POST['id'];
    if($reg->deleteHabitacionbyID($id)){
        echo("habitacion eliminada.");
        break;
    }else{
        echo("Error, el habitacion no pudo ser eliminado.");
        break;
    };

case "gethabitacion":
    $reg = new Habitacion();
    $respuesta = $reg->getHabitacionbyID($_GET["id"]);
    header("Content-Type: application/json; charset=UTF8");
    $json=json_encode($respuesta, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
    break;
}

?>