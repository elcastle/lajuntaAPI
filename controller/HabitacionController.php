<?php
require_once '../conexion/ConexionPDO.php';
require_once '../models/Habitacion.php';

session_start();

// para tomar parametros que viajan por put usaremos el metodo file_get_contents()


$result = "";
// si el action viene por post, tomara el valor de post, caso contrario tomara el valor por get
$action = isset($_POST["action"]) ? $_POST["action"] : $_GET["action"];

switch ($action) {
case "createHabitacion":
    $nombre = $_POST['nombre'];
    $num_personas = $_POST['num_personas'];
    $costo_persona = $_POST['costo_persona'];
    $reg = new Habitacion();
    if($reg->createHabitacion($nombre, $num_personas, $costo_persona)){
    echo("Habitaciún creada exitosamente.");
    }else{
    echo("Hubo un error al crear el Habitación.");
    };
    
    break;
case"getAllHabitaciones":
    $reg = new Habitacion();
    $habitacionlist = $reg->getAllHabitaciones();
    header("Content-Type: application/json; charset=UTF8");
    // convierte la respuesta en un json y la envia
    $json=json_encode($habitacionlist, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
        break;
case "updateHabitacion":
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $num_personas = $_POST['num_personas'];
            $costo_persona = $_POST['costo_persona'];
            $reg = new Habitacion();
            $reg->updateHabitacion($id, $nombre, $num_personas, $costo_persona);

            break;        
case "deleteHabitacion":
    $reg = new Habitacion();
    $id = $_POST['id'];
    if($reg->deleteHabitacionbyID($id)){
        echo("habitacion eliminada.");
        break;
    }else{
        echo("Error, el habitacion no pudo ser eliminado.");
        break;
    };

case "getHabitacion":
    $reg = new Habitacion();
    $respuesta = $reg->getHabitacionbyID($_GET["id"]);
    header("Content-Type: application/json; charset=UTF8");
    $json=json_encode($respuesta, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
    break;
}

?>