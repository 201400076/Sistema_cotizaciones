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
       
       // echo json_encode($dato);
        require_once("../vista/vista_solicitudes_nuevas.php");

    }
    static function mostrar_nueva($condicion){

        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto","pedido.id_pedido=solicitudes.id_pedido
                                                            AND usuarios.id_usuarios=pedido.id_usuarios
                                                            AND usuarios.id_usuarios=usuarioconrol.id_usuarios
                                                            AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
                                                            AND estado='pendiente'
                                                            order by fecha desc");
        //$contarFilas=$dato->num_rows();
       $active="active";
       // echo json_encode($dato);
        require_once("../vista/vista_solicitudes_nuevas.php");

    }
    static function mostrar_aceptada($condicion){

        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto","pedido.id_pedido=solicitudes.id_pedido
                                                            AND usuarios.id_usuarios=pedido.id_usuarios
                                                            AND usuarios.id_usuarios=usuarioconrol.id_usuarios
                                                            AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
                                                            AND estado='aceptada'
                                                            order by fecha_evaluacion desc");
       $active="active";
       // echo json_encode($dato);
        require_once("../vista/vista_solicitudes_aceptadas.php");

    }
    static function mostrar_rechazada($condicion){

        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto","pedido.id_pedido=solicitudes.id_pedido
                                                        AND usuarios.id_usuarios=pedido.id_usuarios
                                                        AND usuarios.id_usuarios=usuarioconrol.id_usuarios
                                                        AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
                                                        AND estado='rechazada'
                                                        order by fecha_evaluacion desc");
       $active="active";
       // echo json_encode($dato);
        require_once("../vista/vista_solicitudes_rechazadas.php");

    }

    static function mostrar_cotizando($condicion){

        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto,solicitudes_cotizaciones","solicitudes.id_solicitudes=solicitudes_cotizaciones.id_solicitudes
                                                            AND pedido.id_pedido=solicitudes.id_pedido
                                                            AND usuarios.id_usuarios=pedido.id_usuarios
                                                            AND usuarios.id_usuarios=usuarioconrol.id_usuarios
                                                            AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
                                                            AND solicitudes_cotizaciones.estado_cotizacion='cotizando'
                                                            order by solicitudes_cotizaciones.fecha_licitacion desc");
                                                        
       $active="active";
       // echo json_encode($dato);
        require_once("../vista/vista_solicitudes_enCotizacion.php");

    }

    static function mostrar_PDF($condicion){


       $active="active";
       // echo json_encode($dato);
        require_once("../vista/vistaPDFRechazadas.php");

    }
}
?>