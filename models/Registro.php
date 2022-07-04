<?php
require_once '../conexion/ConexionPDO.php';


class Registro {

    public $id;
    public $nombre;
    public $apellido;
    public $habitacion;
    public $fecha_inicio;
    public $fecha_termino;
    public $correo;
    public $fono1;
    public $fono2;
    public $costodiario;
    public $costoTotal;


    // constructor: cuando implementar y por que?
    // function __construct($nombre, $apellido, $habitacion, $fecha_inicio, $fecha_termino, $correo, $fono1, $fono2, $costo_diario, $costo_total) {
    //     $this->nombre = $nombre;
    //     $this->apellido = $apellido;
    //     $this->habitacion = $habitacion;
    //     $this->fecha_inicio = $fecha_inicio;
    //     $this->nfecha_termino = $fecha_termino;
    //     $this->correo = $correo;
    //     $this->fono1 = $fono1;
    //     $this->fono2 = $fono2;
    //     $this->costodiario = $costodiario;
    //     $this->costoTotal = $costoTotal;

    //   }

    function createRegistro($nombre, $apellido, $habitacion, $fecha_inicio, $fecha_termino, $correo, $fono1, $fono2, $costo_diario, $costo_total){
        $conexion = new ConexionPDO();
        
        $sql = "INSERT INTO registro (nombre, apellido, id_habitacion, fecha_inicio, fecha_termino, correo, telefono, telefono_2, costo_diario, costo_total) VALUES (:nombre, :apellido, :id_habitacion, :fecha_inicio, :fecha_termino, :correo, :fono1, :fono2, :costo_diario, :costo_total)";
        $sentencia = $conexion->mysql->prepare($sql);
        $sentencia->bindParam(":nombre", $nombre);
        $sentencia->bindParam(":apellido", $apellido);
        $sentencia->bindParam(":id_habitacion", $habitacion);
        $sentencia->bindParam(":fecha_inicio", $fecha_inicio);
        $sentencia->bindParam(":fecha_termino", $fecha_termino);
        $sentencia->bindParam(":correo", $correo);
        $sentencia->bindParam(":fono1", $fono1);
        $sentencia->bindParam(":fono2", $fono2);
        $sentencia->bindParam(":costo_diario", $costo_diario);
        $sentencia->bindParam(":costo_total", $costo_total);
        return $sentencia->execute();
    }

    function getRegistrobyID($id){
        $conexion = new ConexionPDO();
        $sql = "SELECT FROM registro WHERE 'id' IS :id";
         $sentencia = $conexion->mysql->prepare($sql);
         $sentencia->bindParam(":id", $id);
         $sentencia->execute();
         return $sentencia->fetch();
         
    }
    function getAllRegistro(){
        $conexion = new ConexionPDO();       
        $sentencia = $conexion->mysql->query("SELECT * FROM registro");
        $sentencia->execute();
        // fetchall responde con dos arreglos, uno de key=value y keyposition=value
        $respuesta=$sentencia->fetchAll();
        // convierte la respuesta sql en un arreglo de registros
        foreach($respuesta as $r){
            $registro = new Registro();
            $registro->id=$r[0];
            $registro->nombre=$r[1];
            $registro->apellido=$r[2];
            $registro->habitacion=$r[3];
            $registro->fecha_inicio=$r[4];
            $registro->fecha_termino=$r[5];
            $registro->correo=$r[6];
            $registro->fono1=$r[7];
            $registro->fono2=$r[8];
            $registro->costodiario=$r[9];
            $registro->costoTotal=$r[10];
            $lista[] = $registro;
        }
        // Devuelve la lista (arreglo de registros)
                return $lista;
            }

    // function updateRegistrobyID($id){
    //     $conexion = new ConexionPDO();
    //   //  $sql = "UPDATE Registro SET Column1=Value1, Column2=Value2,… WHERE 'id' IS :id";
    //      $sentencia = $conexion->mysql->prepare($sql);
    //      $sentencia->bindParam(":id", $id);
    //      return $sentencia->execute();
    // }
    

    function deleteRegistrobyID($id){
        $conexion = new ConexionPDO(); 
        $sql = "DELETE FROM registro WHERE id = :id";
         $sentencia = $conexion->mysql->prepare($sql);
         $myid = (int)$id;
         $sentencia->bindParam(":id", $myid);
         return $sentencia->execute();
    }
  
 
    
    
}