<?php 
class Conexion{	  
    public static function Conectar() {        
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');			
        try{
            $conexion = new PDO("mysql:host=".'localhost'."; dbname=".'pef _db', 'pef', 'Op#{khnQGj^L]VU', $opciones);			
            return $conexion;
        }catch (Exception $e){
            die("El error de Conexión es: ". $e->getMessage());
        }
    }
}