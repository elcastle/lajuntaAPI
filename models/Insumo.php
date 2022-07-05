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
        $sentencia = $conexion->mysql->query("SELECT * FROM insumo");
        $sentencia->execute();
        // fetchall responde con dos arreglos, uno de key=value y keyposition=value
        $respuesta=$sentencia->fetchAll();
        // convierte la respuesta sql en un arreglo de usuarios
        foreach($respuesta as $r){
            $insumo = new Insumo();
            $insumo->id=$r[0];
            $insumo->nombre=$r[1];
            $insumo->cantidad=$r[2];
            $insumo->medida=$r[3];
            $lista[] = $insumo;
        }
        // Devuelve la lista (arreglo de usuarios)
                return $lista;
    }
    function getInsumobyID($id){
        $conexion = new ConexionPDO();
        $sql = "SELECT * FROM insumo WHERE id = :id";
        $sentencia = $conexion->mysql->prepare($sql);
        $myid = (int)$id;
        $sentencia->bindParam(":id", $myid);
        $sentencia->execute();
        $res = array();
        $res = $sentencia->fetch();
        $h = new Insumo();
        $h->id = $res[0];
        $h->nombre = $res[1];
        $h->cantidad = $res[2];
        $h->medida = $res[3];
        return $h;
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
        $sql = "DELETE FROM insumo WHERE id = :id";
         $sentencia = $conexion->mysql->prepare($sql);
         $myid = (int)$id;
         $sentencia->bindParam(":id", $myid);
         return $sentencia->execute();
        }
    }