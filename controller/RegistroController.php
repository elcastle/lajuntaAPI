<?php
require_once '../conexion/ConexionPDO.php';
require_once '../models/Registro.php';
require_once '../models/Habitacion.php';

session_start();

// para tomar parametros que viajan por put usaremos el metodo file_get_contents()


$result = "";
// si el action viene por post, tomara el valor de post, caso contrario tomara el valor por get
$action = isset($_POST["action"]) ? $_POST["action"] : $_GET["action"];

switch ($action) {
// devuelve una lista con todos los objetos registro de la tabla registro
case"getAllRegistros":
    $reg = new Registro();
    $registrolist = $reg->getAllRegistro();
    header("Content-Type: application/json; charset=UTF8");
    // convierte la respuesta en un json y la envia
    $json=json_encode($registrolist, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
        break;
// elimina un registro recibiendo el id por post
case "deleteRegistro":
    $reg = new Registro();
    $id = $_POST['id'];
    if($reg->deleteRegistrobyID($id)){
        echo("Registro eliminado.");
        break;
    }else{
        echo("Error, el registro no pudo ser eliminado.");
        break;
    };
// devuelve un registro recibiendo el id por get
case "getRegistro":
    $reg = new Registro();
    $respuesta = $reg->getRegistrobyID($_GET["id"]);
    header("Content-Type: application/json; charset=UTF8");
    $json=json_encode($respuesta, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
    break;


    // recibe las fechas de inicio y termino por post
case "checkhabitaciones":
    $fecha_inicio=$_POST['fechaI'];
    $fecha_termino=$_POST['fechaT'];
    $reg = new Registro();
    $hab = new Habitacion();
    // devuelve un array con todas las habitaciones ocupadas
    $arrayocupadas=$reg->getHabitacionesOcupadas($fecha_inicio, $fecha_termino);
    // devuelve una lista con todas las habitaciones
    $arraytodas=$hab->getAllHabitacionesbeta();
    // devuelve una lista con el id de las habitaciones libres
    $arraylibres= array_diff($arraytodas, $arrayocupadas);
    $lista = array();
    // genera una lista con los objetos de habitacion en base al id de habitaciones libres
    foreach($arraylibres as $r){ 
    $h = $hab->getHabitacionbyID($r);
    $lista[] = $h;
    }
    header("Content-Type: application/json; charset=UTF8");
    // devuelve un json con un array de las habitaciones libres
    $json=json_encode($lista, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
    break;
}
