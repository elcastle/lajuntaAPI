<?php
require_once '../conexion/ConexionPDO.php';


class Insumo{


    public $id;
    public $nombre;
    public $cantidad;
    public $medida;
    
    function createInsumo($nombre, $cantidad, $medida){
        $conexion = new ConexionPDO();
        $sql = "INSERT INTO insumo (nombre, cantidad, medida) VALUES (:nombre, :cantidad, :medida)";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":cantidad", $cantidad);
        $sentencia->bindParam(":medida", $medida);
        return $sentencia->execute();
    }

    function getAllInsumos(){
        $conexion = new ConexionPDO();
        return $conexion->mysql->query("SELECT * FROM insumo");
    }
    function getInsumobyID($id){
        $conexion = new ConexionPDO();
        $sql = $conexion->mysql->prepare("SELECT * FROM insumo WHERE id = :id ");
        
        $sql->bindParam(":id", $id);
        if($sql->execute()){
            $res = $sql->fetch();
            $h = new Insumo();
            $h->id = $res[0];
            $h->nombre = $res[1];
            $h->cantidad = $res[2];
            $h->medida = $res[3];
            return $h;
        }
    }

    function updateInsumo($id, $nombre, $cantidad, $medida){
        $conexion = new ConexionPDO();
        $sql = "UPDATE insumo SET nombre = :nombre, cantidad = :cantidad, medida = :medida WHERE id = :id;";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":cantidad", $cantidad);
        $sentencia->bindParam(":medida", $medida);
        $sentencia->bindParam(":id", $id);
        return $sentencia->execute();
    }

    function deleteInsumobyID($id){
        $conexion = new ConexionPDO();
        $sql = "DELETE FROM insumo WHERE 'id'= :id";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":id", $id);
        return $sentencia->execute();
        }
    }