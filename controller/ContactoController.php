<?php
require_once '../conexion/ConexionPDO.php';
require_once '../models/Contacto.php';


session_start();

// para tomar parametros que viajan por put usaremos el metodo file_get_contents()


$result = "";
// si el action viene por post, tomara el valor de post, caso contrario tomara el valor por get
$action = isset($_POST["action"]) ? $_POST["action"] : $_GET["action"];

switch ($action) {

case "createcontacto":
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $fono = $_POST['fono'];
    $comentario = $_POST['comentario'];
    $reg = new Contacto();
    $reg->createContacto($nombre, $correo, $fono, $comentario);
    header("Location: ../view/listarContactos.php");
    break;
case "getcontacto":
        $reg = new Contacto();
        $respuesta = $reg->getContactobyID($_GET["id"]);
        header("Content-Type: application/json; charset=UTF8");
        $json=json_encode($respuesta, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
        echo($json);
        break;

case "getallcontactos":
    $reg = new Contacto();
    $contactolist = $reg->getAllContactos();
    header("Content-Type: application/json; charset=UTF8");
    // convierte la respuesta en un json y la envia
    $json=json_encode($contactolist, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
        break;

case "updatecontacto":
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $fono = $_POST['fono'];
    $comentario = $_POST['comentario'];
    $reg = new Contacto();
    $reg->updateContacto($id, $nombre, $correo, $fono, $comentario);
    header("Location: ../view/listarContactos.php");
    break;

case "deletecontacto":
    $reg = new Contacto();
    $id = $_POST['id'];
    if($reg->deleteContactobyID($id)){
        echo("contacto eliminado.");
        break;
    }else{
        echo("Error, el contacto no pudo ser eliminado.");
        break;
    };


}