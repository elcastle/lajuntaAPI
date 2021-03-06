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

case "createUsuario":
        $username = $_POST['username'];
        $password = $_POST['password'];
        $correo = $_POST['correo'];
        $id_cargo = $_POST['id_cargo'];
        $reg = new Usuario();
        if($reg->createUsuario($username, $password, $correo, $id_cargo)){
            echo("Usuario creado exitosamente.");
        }else{
            echo("Hubo un error al crear el usuario.");
        };
        break;
case"getAllUsuarios":
    $reg = new Usuario();
    $usuariolist = $reg->getAllUsuarios();
    header("Content-Type: application/json; charset=UTF8");
    // convierte la respuesta en un json y la envia
    $json=json_encode($usuariolist, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
        break;

case "deleteUsuario":
    $reg = new Usuario();
    $id = $_POST['id'];
    if($reg->deleteUsuariobyID($id)){
        echo("usuario eliminado.");
        break;
    }else{
        echo("Error, el usuario no pudo ser eliminado.");
        break;
    };

case "updateUsuario":
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $correo = $_POST['correo'];
        $id_cargo = $_POST['id_cargo'];
        $reg = new Usuario();
        if($reg->updateUsuario($id, $username, $password, $correo, $id_cargo)){
            echo("usuario actualizado."); 
            break;
        }else{
            echo("Error, el usuario no pudo ser actualizado.");
            break;
        }
        
        break;

case "getUsuario":
    $reg = new Usuario();
    $respuesta = $reg->getUsuariobyID($_GET["id"]);
    header("Content-Type: application/json; charset=UTF8");
    $json=json_encode($respuesta, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    echo($json);
    break;
}