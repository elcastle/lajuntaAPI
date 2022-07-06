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
        $sentencia = $conexion->mysql->query("SELECT * FROM alimento");
        $sentencia->execute();
        // fetchall responde con dos arreglos, uno de key=value y keyposition=value
        $respuesta=$sentencia->fetchAll();
        // convierte la respuesta sql en un arreglo de usuarios
        foreach($respuesta as $r){
            $alimento = new Alimento();
            $alimento->id=$r[0];
            $alimento->nombre=$r[1];
            $alimento->cantidad=$r[2];
            $alimento->medida=$r[3];
            $lista[] = $alimento;
        }
        // Devuelve la lista (arreglo de usuarios)
                return $lista;
        
    }
    function getAlimentobyID($id){
        $conexion = new ConexionPDO();
        $sql = "SELECT * FROM alimento WHERE id = :id";
        $sentencia = $conexion->mysql->prepare($sql);
        $myid = (int)$id;
        $sentencia->bindParam(":id", $myid);
        $sentencia->execute();
        $res = array();
        $res = $sentencia->fetch();
        $h = new Alimento();
        $h->id = $res[0];
        $h->nombre = $res[1];
        $h->cantidad = $res[2];
        $h->medida = $res[3];
        return $h;
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
        $sql = "DELETE FROM alimento WHERE id = :id";
         $sentencia = $conexion->mysql->prepare($sql);
         $myid = (int)$id;
         $sentencia->bindParam(":id", $myid);
         return $sentencia->execute();
        }
    }