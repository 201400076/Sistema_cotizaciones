<?php
    class Conectar{
        public static function conexion(){
            try{
                $opciones= [PDO::ATTR_CASE=> PDO::CASE_LOWER,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_ORACLE_NULLS=>PDO::NULL_EMPTY_STRING, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];
                $conexion=new PDO('mysql:host=localhost;dbname=sistema_de_cotizaciones',"root","",$opciones);
                $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $conexion->exec("SET CHARACTER SET UTF8");
            }catch(Exception $e){
                die("error") . $e->getMessage();
                echo "error !!" . $e->geLine();
            }
            return $conexion;
        }
    }
?>