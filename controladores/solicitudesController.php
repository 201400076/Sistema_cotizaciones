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
        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("solicitudes, pedido, usuarios, usuarioconrol, unidad_gasto, unidad_administrativa","solicitudes.estado='pendiente' 
                                                AND solicitudes.id_pedido=pedido.id_pedido AND  pedido.id_unidad=unidad_gasto.id_unidad 
                                                AND usuarioconrol.id_gasto=unidad_gasto.id_gasto AND usuarios.id_usuarios=pedido.id_usuarios 
                                                AND usuarios.id_usuarios=usuarioconrol.id_usuarios AND unidad_administrativa.id_unidad=pedido.id_unidad 
                                                AND pedido.id_unidad=".$id_unidadAdmin." order by pedido.fecha desc");
       $active="active";
        require_once("../vista/vista_solicitudes_nuevas.php");
    }
    static function mostrar_aceptada($condicion){
        session_start();
        $id_unidadAdmin=$_SESSION['unidad'];
        $solicitud =new Solicitud();
        $dato = $solicitud->mostrar("solicitudes, pedido, usuarios, usuarioconrol, unidad_gasto, unidad_administrativa","solicitudes.estado='aceptada' 
                                                AND solicitudes.id_pedido=pedido.id_pedido AND  pedido.id_unidad=unidad_gasto.id_unidad 
                                                AND usuarioconrol.id_gasto=unidad_gasto.id_gasto AND usuarios.id_usuarios=pedido.id_usuarios 
                                                AND usuarios.id_usuarios=usuarioconrol.id_usuarios AND unidad_administrativa.id_unidad=pedido.id_unidad 
                                                AND pedido.id_unidad=".$id_unidadAdmin." order by solicitudes.fecha_evaluacion desc");
       $active="active";
        require_once("../vista/vista_solicitudes_aceptadas.php");

    }
    static function mostrar_rechazada($condicion){
        session_start();
        $id_unidadAdmin=$_SESSION['unidad'];
        $solicitud =new Solicitud();
        $dato = $solicitud->mostrar("solicitudes, pedido, usuarios, usuarioconrol, unidad_gasto, unidad_administrativa","solicitudes.estado='rechazada' 
                                                AND solicitudes.id_pedido=pedido.id_pedido AND  pedido.id_unidad=unidad_gasto.id_unidad 
                                                AND usuarioconrol.id_gasto=unidad_gasto.id_gasto AND usuarios.id_usuarios=pedido.id_usuarios 
                                                AND usuarios.id_usuarios=usuarioconrol.id_usuarios AND unidad_administrativa.id_unidad=pedido.id_unidad 
                                                AND pedido.id_unidad=".$id_unidadAdmin." order by solicitudes.fecha_evaluacion desc");
       $active="active";
        require_once("../vista/vista_solicitudes_rechazadas.php");
    }

    static function mostrar_cotizando($condicion){
        session_start();
        $id_unidadAdmin=$_SESSION['unidad'];

        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto,solicitudes_cotizaciones","solicitudes.id_solicitudes=solicitudes_cotizaciones.id_solicitudes
                                                            AND pedido.id_pedido=solicitudes.id_pedido
                                                            AND usuarios.id_usuarios=pedido.id_usuarios
                                                            AND usuarios.id_usuarios=usuarioconrol.id_usuarios
                                                            AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
                                                            AND solicitudes_cotizaciones.estado_cotizacion='cotizando'
                                                            AND pedido.id_unidad=".$id_unidadAdmin." order by solicitudes_cotizaciones.fecha_ini_licitacion desc");
                                                        
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