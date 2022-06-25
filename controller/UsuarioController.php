<?php
require_once '../conexion/ConexionPDO.php';
require_once '../models/usuario.php';
require_once '../models/Habitacion.php';

session_start();

// para tomar parametros que viajan por put usaremos el metodo file_get_contents()


$result = "";
// si el action viene por post, tomara el valor de post, caso contrario tomara el valor por get
$action = isset($_POST["action"]) ? $_POST["action"] : $_GET["action"];

switch ($action) {

case"getallusuarios":
    $reg = new Usuario();
    $usuariolist = $reg->getAllUsuario();
    header("Content-Type: application/json; charset=UTF8");
    // convierte la respuesta en un json y la envia
    $json=json_encode($usuariolist, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
        break;

case "deleteusuario":
    $reg = new Usuario();
    $id = $_POST['id'];
    if($reg->deleteUsuariobyID($id)){
        echo("usuario eliminado.");
        break;
    }else{
        echo("Error, el usuario no pudo ser eliminado.");
        break;
    };

case "getusuario":
    $reg = new Usuario();
    $respuesta = $reg->getUsuariobyID($_GET["id"]);
    header("Content-Type: application/json; charset=UTF8");
    $json=json_encode($respuesta, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
    break;
}