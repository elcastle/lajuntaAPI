<?php
require_once '../conexion/ConexionPDO.php';


class Habitacion{


    public $id;
    public $nombre;
    public $num_personas;
    public $costo_persona;
    
    function createHabitacion($nombre, $num_personas, $costo_persona){
        $conexion = new ConexionPDO();
        $sql = "INSERT INTO habitacion (nombre, num_personas, costo_persona) VALUES (:nombre, :num_personas, :costo_persona)";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":num_personas", $num_personas);
        $sentencia->bindParam(":costo_persona", $costo_persona);
        return $sentencia->execute();
        }
    function getAllHabitaciones(){
        $conexion = new ConexionPDO();
        $sentencia = $conexion->mysql->query("SELECT * FROM habitacion");
        $sentencia->execute();
        $respuesta=$sentencia->fetchAll();
        // recorre el array traido que devuelve sql para convertirlo en una lista de objetos habitacion, el cual posteriormente sera convertido en json
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
        $sql = "SELECT * FROM habitacion WHERE id = :id";
        $sentencia = $conexion->mysql->prepare($sql);
        $myid = (int)$id;
        $sentencia->bindParam(":id", $myid);
        $sentencia->execute();
        $res = array();
        $res = $sentencia->fetch();
        // recorre el array que entrega sql en un objeto habitacion para luego ser convertido en json 
        $h = new Habitacion();
        $h->id = $res[0];
        $h->nombre = $res[1];
        $h->num_personas = $res[2];
        $h->costo_persona = $res[3];
        return $h;
    
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
// elimina una habitacion de la base de datos
    function deleteHabitacionbyID($id){
        $conexion = new ConexionPDO(); 
        $sql = "DELETE FROM habitacion WHERE id = :id";
         $sentencia = $conexion->mysql->prepare($sql);
         $myid = (int)$id;
         $sentencia->bindParam(":id", $myid);
        if($sentencia->execute()){
            return true;
         }else{
            return false;
         };
            }
// actualiza una habitacion de la base de datos
    function updateHabitacion($id, $nombre, $num_personas, $costo_persona){
            $conexion = new ConexionPDO();
            $sql = "UPDATE habitacion SET nombre = :nombre, num_personas = :num_personas, costo_persona = :costo_persona WHERE id = :id;";
            $sentencia = $conexion->mysql->prepare($sql);
            $sentencia->bindParam(":nombre", $nombre);
            $sentencia->bindParam(":num_personas", $num_personas);
            $sentencia->bindParam(":costo_persona", $costo_persona);
            $sentencia->bindParam(":id", $id);
            return $sentencia->execute();
            }
}