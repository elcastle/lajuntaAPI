<?php
require_once '../conexion/ConexionPDO.php';


class usuario {

    public $id;
    public $username;
    public $password;
    public $id_cargo;


    function createUsuario($username, $password, $id_cargo){
        $conexion = new ConexionPDO();
        
        $sql = "INSERT INTO usuario (username, password, id_cargo) VALUES (:username, :password, :id_cargo)";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":username", $username);
        $sentencia->bindParam(":password", $password);
        $sentencia->bindParam(":id_cargo", $id_cargo);
        return $sentencia->execute();
    }

    function getUsuariobyID($id){
        $conexion = new ConexionPDO();
        $sql = "SELECT FROM usuario WHERE 'id' IS :id";
         $sentencia = $conexion->mysql->prepare($sql);
         $sentencia->bindParam(":id", $r->$id);
         $sentencia->execute();
         return $sentencia->fetch();
         
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
            $usuario->username=$r[0];
            $usuario->password=$r[1];
            $usuario->id_cargo=$r[2];
            $lista[] = $usuario;
        }
        // Devuelve la lista (arreglo de usuarios)
                return $lista;
            }

    function updateUsuario($id, $username, $password, $id_cargo){
        $conexion = new ConexionPDO();
        $sql = "UPDATE usuario SET username = :username, password = :password, id_cargo = :id_cargo WHERE id = :id;";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":username", $username);
        $sentencia->bindParam(":password", $password);
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