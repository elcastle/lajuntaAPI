<?php
require_once '../conexion/ConexionPDO.php';
require_once '../models/Insumo.php';


session_start();

// para tomar parametros que viajan por put usaremos el metodo file_get_contents()


$result = "";
// si el action viene por post, tomara el valor de post, caso contrario tomara el valor por get
$action = isset($_POST["action"]) ? $_POST["action"] : $_GET["action"];

switch ($action) {

case "createInsumo":
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $medida = $_POST['medida'];
    $reg = new Insumo();
    if($reg->createInsumo($nombre, $cantidad, $medida)){
    echo("Insumo creado exitosamente.");
}else{
    echo("Hubo un error al crear el Insumo.");
};
    break;

case "getInsumo":
        $reg = new Insumo();
        $respuesta = $reg->getInsumobyID($_GET["id"]);
        header("Content-Type: application/json; charset=UTF8");
        $json=json_encode($respuesta, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
        echo($json);
        break;

case "getAllInsumos":
    $reg = new Insumo();
    $insumolist = $reg->getAllInsumos();
    header("Content-Type: application/json; charset=UTF8");
    // convierte la respuesta en un json y la envia
    $json=json_encode($insumolist, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
        break;

case "updateInsumo":
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $medida = $_POST['medida'];
    $reg = new Insumo();
    if($reg->updateInsumo($id, $nombre, $cantidad, $medida)){
    echo("Insumo actualizado.");
    break;
}else{
    echo("Error, el insumo no pudo ser actualizado.");
    break;
};

    break;

case "deleteInsumo":
    $reg = new Insumo();
    $id = $_POST['id'];
    if($reg->deleteInsumobyID($id)){
        echo("insumo eliminado.");
        break;
    }else{
        echo("Error, el insumo no pudo ser eliminado.");
        break;
    };


}