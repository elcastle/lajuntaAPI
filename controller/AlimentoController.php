<?php
require_once '../conexion/ConexionPDO.php';
require_once '../models/Alimento.php';


session_start();

// para tomar parametros que viajan por put usaremos el metodo file_get_contents()


$result = "";
// si el action viene por post, tomara el valor de post, caso contrario tomara el valor por get
$action = isset($_POST["action"]) ? $_POST["action"] : $_GET["action"];

switch ($action) {

case "createalimento":
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $medida = $_POST['medida'];
    $reg = new Alimento();
    if($reg->createAlimento($nombre, $cantidad, $medida)){
        echo("Alimento creado exitosamente.");
    }else{
        echo("Hubo un error al crear el Alimento.");
    };
;
    
    break;

case "getalimento":
        $reg = new Alimento();
        $respuesta = $reg->getAlimentobyID($_GET["id"]);
        header("Content-Type: application/json; charset=UTF8");
        $json=json_encode($respuesta, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
        echo($json);
        break;

case "getallalimentos":
    $reg = new Alimento();
    $alimentolist = $reg->getAllAlimentos();
    header("Content-Type: application/json; charset=UTF8");
    // convierte la respuesta en un json y la envia
    $json=json_encode($alimentolist, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
        break;

case "updatealimento":
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $medida = $_POST['medida'];
    $reg = new Alimento();
    $reg->updateAlimento($id, $nombre, $cantidad, $medida);
    header("Location: ../view/listarAlimentos.php");
    break;

case "deletealimento":
    $reg = new Alimento();
    $id = $_POST['id'];
    if($reg->deleteAlimentobyID($id)){
        echo("alimento eliminado.");
        break;
    }else{
        echo("Error, el alimento no pudo ser eliminado.");
        break;
    };


}