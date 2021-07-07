<!-- <?php


 require('../controladores/solicitudesController.php');
//require_once("../vista/vista_tablasComparativas.php"); 

$id_solicit=$_GET['id_solicitud'];


 $solicitud =new Solicitud();

$dato = $solicitud->mostrar('cotizacion_items ci, items i,empresas e ','ci.id_items=i.id_items 
                                                                        AND e.id_empresa=ci.id_empresa
                                                                        AND id_solicitudes='.$id_solicit.''); 


require_once("../modelo/tablaComparativa.php");

class ControladorTablaComparativa
{
    private $model;
    function __construct()
    {
        $this->model = new TablaComparativa();
    }
    // MOSTRAR
    static function mostrar()
    {
        $id_solicit = $_GET['id_solicitud'];
        $solicitud = new TablaComparativa();

        $datito = $solicitud->mostrar("cotizacion_items ci, items i,empresas e", "ci.id_items=i.id_items 
                                                                                    AND e.id_empresa=ci.id_empresa
                                                                                    AND id_solicitudes=" . $id_solicit . "");
       // $active = "active";

        // echo json_encode($dato);
        require_once("../vista/vista_tablasComparativas.php");
    }
}
?> -->

<?php
    include_once '../modelo/conexionPablo.php';
    $id_solicitud=$_GET['id_solicitud'];
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $consulta="SELECT i.id_items,i.cantidad, i.unidad,i.detalle,i.archivo,i.ruta 
                FROM solicitudes s, pedido p, items i 
                WHERE (s.id_pedido=p.id_pedido && p.id_pedido=i.id_pedido) && s.id_solicitudes=$id_solicitud";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    //var_dump($data);

    $consulta="SELECT * 
               FROM `cotizacion_items` 
               WHERE id_solicitudes=$id_solicitud";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($data1);

    $consulta="SELECT distinct ci.id_empresa,e.nombre_empresa
    FROM cotizacion_items ci,empresas e 
    WHERE ci.id_empresa=e.id_empresa 
          AND id_solicitudes=$id_solicitud"; 
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    
   
?>
