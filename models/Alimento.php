<?php
require_once '../conexion/ConexionPDO.php';


class Alimento{


    public $id;
    public $nombre;
    public $cantidad;
    public $medida;
    
    function createAlimento($nombre, $cantidad, $medida){
        $conexion = new ConexionPDO();
        $sql = "INSERT INTO alimento (nombre, cantidad, medida) VALUES (:nombre, :cantidad, :medida)";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":cantidad", $cantidad);
        $sentencia->bindParam(":medida", $medida);
        return $sentencia->execute();
    }

    function getAllAlimentos(){
        $conexion = new ConexionPDO();
        return $conexion->mysql->query("SELECT * FROM alimento");
    }
    function getAlimentobyID($id){
        $conexion = new ConexionPDO();
        $sql = $conexion->mysql->prepare("SELECT * FROM alimento WHERE id = :id ");
        
        $sql->bindParam(":id", $id);
        if($sql->execute()){
            $res = $sql->fetch();
            $h = new Alimento();
            $h->id = $res[0];
            $h->nombre = $res[1];
            $h->cantidad = $res[2];
            $h->medida = $res[3];
            return $h;
        }
    }

    function updateAlimento($id, $nombre, $cantidad, $medida){
        $conexion = new ConexionPDO();
        $sql = "UPDATE alimento SET nombre = :nombre, cantidad = :cantidad, medida = :medida WHERE id = :id;";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":cantidad", $cantidad);
        $sentencia->bindParam(":medida", $medida);
        $sentencia->bindParam(":id", $id);
        return $sentencia->execute();
    }

    function deleteAlimentobyID($id){
        $conexion = new ConexionPDO();
        $sql = "DELETE FROM alimento WHERE 'id'= :id";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":id", $id);
        return $sentencia->execute();
        }
    }