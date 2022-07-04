<?php
require_once '../conexion/ConexionPDO.php';


class usuario {

    public $id;
    public $username;
    public $password;
    public $id_cargo;


    function createUsuario($username, $password, $correo, $id_cargo){
        $conexion = new ConexionPDO();
        
        $sql = "INSERT INTO usuario (username, password, id_cargo, correo) VALUES (:username, :password, :correo, :id_cargo)";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":username", $username);
        $sentencia->bindParam(":password", $password);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":id_cargo", $id_cargo);
        return $sentencia->execute();
    }

    function getUsuariobyID($id){
        $conexion = new ConexionPDO();
        $sql = "SELECT * FROM usuario WHERE id = :id";
        $sentencia = $conexion->mysql->prepare($sql);
        $myid = (int)$id;
        $sentencia->bindParam(":id", $myid);
        $sentencia->execute();
        $res = array();
        $res = $sentencia->fetch();
        $h = new Usuario();
        $h->id = $res[0];
        $h->username = $res[1];
        $h->password = $res[2];
        $h->correo = $res[3];
        $h->id_cargo = $res[4];
        return $h;
         
    }
    function getAllUsuarios(){
        $conexion = new ConexionPDO();       
        $sentencia = $conexion->mysql->query("SELECT * FROM usuario");
        $sentencia->execute();
        // fetchall responde con dos arreglos, uno de key=value y keyposition=value
        $respuesta=$sentencia->fetchAll();
        // convierte la respuesta sql en un arreglo de usuarios
        foreach($respuesta as $r){
            $usuario = new Usuario();
            $usuario->id=$r[0];
            $usuario->username=$r[1];
            $usuario->password=$r[2];
            $usuario->correo=$r[3];
            $usuario->id_cargo=$r[4];
            $lista[] = $usuario;
        }
        // Devuelve la lista (arreglo de usuarios)
                return $lista;
            }

    function updateUsuario($id, $username, $password, $correo, $id_cargo){
        $conexion = new ConexionPDO();
        $sql = "UPDATE usuario SET username = :username, password = :password, correo = :correo, id_cargo = :id_cargo WHERE id = :id;";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":username", $username);
        $sentencia->bindParam(":password", $password);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":id_cargo", $id_cargo);
        $sentencia->bindParam(":id", $id);
        return $sentencia->execute();
    }
    

    function deleteUsuariobyID($id){
        $conexion = new ConexionPDO(); 
        $sql = "DELETE FROM usuario WHERE id = :id";
         $sentencia = $conexion->mysql->prepare($sql);
         $myid = (int)$id;
         $sentencia->bindParam(":id", $myid);
         return $sentencia->execute();
    }
  
 
    
    
}