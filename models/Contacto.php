<?php
require_once '../conexion/ConexionPDO.php';


class Contacto{


    public $id;
    public $nombre;
    public $correo;
    public $fono;
    public $comentario;
    
    function createContacto($nombre, $correo, $fono, $comentario){
        $conexion = new ConexionPDO();
        $sql = "INSERT INTO contacto (nombre, correo, fono, comentario) VALUES (:nombre, :correo, :fono, :comentario)";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":fono", $fono);
        $sentencia->bindParam(":comentario", $comentario);
        return $sentencia->execute();
    }

    function getAllContactos(){
        $conexion = new ConexionPDO();
        return $conexion->mysql->query("SELECT * FROM contacto");
    }
    function getContactobyID($id){
        $conexion = new ConexionPDO();
        $sql = $conexion->mysql->prepare("SELECT * FROM contacto WHERE id = :id ");
        $sql->bindParam(":id", $id);
        if($sql->execute()){
            $res = $sql->fetch();
            $h = new Contacto();
            $h->id = $res[0];
            $h->nombre = $res[1];
            $h->correo = $res[2];
            $h->fono = $res[3];
            $h->comentario = $res[4];
            return $h;
        }
    }

    function updateContacto($id, $nombre, $correo, $fono, $comentario){
        $conexion = new ConexionPDO();
        $sql = "UPDATE contacto SET nombre = :nombre, correo = :correo, fono = :fono, comentario = :comentario WHERE id = :id;";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":fono", $fono);
        $sentencia->bindParam(":id", $id);
        $sentencia->bindParam(":comentario", $comentario);
        return $sentencia->execute();
    }

    function deleteContactobyID($id){
        $conexion = new ConexionPDO();
        $sql = "DELETE FROM contacto WHERE 'id'= :id";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":id", $id);
        return $sentencia->execute();
        }
    }