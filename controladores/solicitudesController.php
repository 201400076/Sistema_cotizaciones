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
		$dato = $solicitud->mostrar("pedido,solicitudes,usuarios","pedido.id_pedido=solicitudes.id_pedido
                                                            AND usuarios.id_usuarios=pedido.id_usuarios
                                                            AND estado='pendiente'");
       $active="active";
       // echo json_encode($dato);
        require_once("../vista/vista_solicitudes_nuevas.php");

    }
    static function mostrar_aceptada($condicion){

        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("pedido,solicitudes,usuarios","pedido.id_pedido=solicitudes.id_pedido
                                                             AND usuarios.id_usuarios=pedido.id_usuarios
                                                             AND estado='aceptada'");
       $active="active";
       // echo json_encode($dato);
        require_once("../vista/vista_solicitudes_aceptadas.php");

    }
    static function mostrar_rechazada($condicion){

        $solicitud =new Solicitud();
		$dato = $solicitud->mostrar("pedido,solicitudes,usuarios","pedido.id_pedido=solicitudes.id_pedido
                                                             AND usuarios.id_usuarios=pedido.id_usuarios
                                                             AND estado='rechazada'");
       $active="active";
       // echo json_encode($dato);
        require_once("../vista/vista_solicitudes_rechazadas.php");

    }
}
?>