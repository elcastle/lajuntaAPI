<?php
require_once '../conexion/ConexionPDO.php';


class Habitacion{


    public $id;
    public $nombre;
    public $num_personas;
    public $costo_persona;
    

    function getAllHabitaciones(){
        $conexion = new ConexionPDO();
        $sentencia = $conexion->mysql->query("SELECT * FROM habitacion");
        $sentencia->execute();
        $respuesta=$sentencia->fetchAll();
        foreach($respuesta as $r){
            $habitacion = new Habitacion();
            $habitacion->id=$r[0];
            $habitacion->nombre=$r[1];
            $habitacion->num_personas=$r[2];
            $habitacion->costo_persona=$r[3];
            $lista[] = $habitacion;
    }
    return $lista;
}

    
    function getHabitacionbyID($id){
        $conexion = new ConexionPDO();
        $sql = $conexion->mysql->prepare("SELECT * FROM habitacion WHERE id = :id ");
        
        $sql->bindParam(":id", $id);
        if($sql->execute()){
            $res = $sql->fetch();
            $h = new Habitacion();
            $h->id = $res[0];
            $h->nombre = $res[1];
            $h->num_personas = $res[2];
            $h->costo_persona = $res[3];
            
            return $h;
        }
    }
    

    function getAllHabitacionesbeta(){
        $conexion = new ConexionPDO();       
        $sentencia = $conexion->mysql->query("SELECT * FROM habitacion");
        $sentencia->execute();
        // fetchall responde con dos arreglos, uno de key=value y keyposition=value
        $respuesta=$sentencia->fetchAll();
        // convierte la respuesta sql en un arreglo de habitaciones

        foreach($respuesta as $r){
            $lista[] = $r[0];
        }
        // Devuelve la lista con el id de todas las habitaciones
                return $lista;
    }

    function deleteHabitacionbyID($id){
        $conexion = new ConexionPDO(); 
        $sql = "DELETE FROM habitacion WHERE id = :id";
         $sentencia = $conexion->mysql->prepare($sql);
         $myid = (int)$id;
         $sentencia->bindParam(":id", $myid);
         return $sentencia->execute();
    }
}