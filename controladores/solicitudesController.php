<?php

require_once("../modelo/solicitud.php");

class SolicitudesController{
	private $model;
	function __construct(){
        $this->model=new Solicitud();
    }
    // MOSTRAR
     static function mostrar(){

        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("solicitud","1");
       $active="active";

        require_once("../vista/vista_solicitudes_nuevas.php");
    }
    static function mostrar_nueva($condicion){
        session_start();
        $id_unidadAdmin=$_SESSION['unidad'];
        //$id_pendientes=$_SESSION['usuario'];
        //var_dump($id_unidadAdmin);
        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("solicitudes s, pedido p, unidad_gasto g,unidad_administrativa ua, usuarioconrol ur, usuarios us ","s.estado='pendiente' 
                                        AND s.id_pedido=p.id_pedido AND g.id_gasto=p.id_gasto 
                                        AND ur.id_gasto=g.id_gasto AND us.id_usuarios=ur.id_usuarios
                                       
                                        AND ua.id_unidad=g.id_unidad 
                                        AND p.id_unidad=".$id_unidadAdmin." order by s.fecha_evaluacion desc");



                                                
       $active="active";
        require_once("../vista/vista_solicitudes_nuevas.php");
    }
    static function mostrar_aceptada($condicion){
        session_start();
        $id_unidadAdmin=$_SESSION['unidad'];
        $solicitud =new Solicitud();
        $dato = $solicitud->mostrar("solicitudes s, pedido p, unidad_gasto g,unidad_administrativa ua, usuarioconrol ur, usuarios us ","s.estado='aceptada' 
                                        AND s.id_pedido=p.id_pedido AND g.id_gasto=p.id_gasto 
                                        AND ur.id_gasto=g.id_gasto AND us.id_usuarios=ur.id_usuarios
                                        AND ur.id_gasto=g.id_gasto 
                                        AND ua.id_unidad=g.id_unidad 
                                        AND p.id_unidad=".$id_unidadAdmin." order by s.fecha_evaluacion desc");
       $active="active";
        require_once("../vista/vista_solicitudes_aceptadas.php");

    }
    static function mostrar_rechazada($condicion){
        session_start();
        $id_unidadAdmin=$_SESSION['unidad'];
        $solicitud =new Solicitud();
        $dato = $solicitud->mostrar("solicitudes s, pedido p, unidad_gasto g,unidad_administrativa ua, usuarioconrol ur, usuarios us ","s.estado='rechazada' 
                                        AND s.id_pedido=p.id_pedido AND g.id_gasto=p.id_gasto 
                                        AND ur.id_gasto=g.id_gasto AND us.id_usuarios=ur.id_usuarios
                                        AND ur.id_gasto=g.id_gasto 
                                        AND ua.id_unidad=g.id_unidad 
                                        AND p.id_unidad=".$id_unidadAdmin." order by s.fecha_evaluacion desc");
       $active="active";
        require_once("../vista/vista_solicitudes_rechazadas.php");
    }

    static function mostrar_cotizando($condicion){
        session_start();
        $id_unidadAdmin=$_SESSION['unidad'];

        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("solicitudes s, pedido p, unidad_gasto g,unidad_administrativa ua, usuarioconrol ur, usuarios us,solicitudes_cotizaciones sc","s.id_solicitudes=sc.id_solicitudes
                                    AND s.id_pedido=p.id_pedido AND g.id_gasto=p.id_gasto 
                                    AND ur.id_gasto=g.id_gasto AND us.id_usuarios=ur.id_usuarios
                                    AND ur.id_gasto=g.id_gasto 
                                    AND ua.id_unidad=g.id_unidad 
                                    AND p.id_unidad=".$id_unidadAdmin." order by sc.fecha_ini_licitacion desc");
                                                        
       $active="active";
        require_once("../vista/vista_solicitudes_enCotizacion.php");
    }

    static function mostrar_PDF($condicion){


       $active="active";
       // echo json_encode($dato);
        require_once("../vista/vistaPDFRechazadas.php");

    }
}
?>