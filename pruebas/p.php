<?php
        session_start();
        include('../vista/layouts/navAdministracion.php'); 
        $active = "";
        require_once '../vista/layouts/navegacionPendientes.php';
        require_once('../configuraciones/conexion.php');
        //require_once('../controladores/solicitudesController.php');
        require_once('../controladores/controlador_tablasComparativas.php');
        
        //$id_usuario=$_GET['id_usuario'];
        //$id_pedido=$_GET['id_pedido'];
        $id_solicitud=$_GET['id_solicitud'];

        $conn = new Conexiones();
        $estadoConexion = $conn->getConn();
        $cotizaciones = "SELECT * FROM solicitudes_cotizaciones WHERE id_solicitudes = ".$id_solicitud."";
        $queryCoti=$estadoConexion->query($cotizaciones);
        $registro=$queryCoti->fetch_array(MYSQLI_BOTH);
        //echo $registro['id_solicitud_cotizacion'];
        
        //Para probar se obtienen todas las empresas, se debe restringir a solo las empresas participantes en esta solicitud
        $empresas = "SELECT * FROM empresas";
        $queryEmpresas=$estadoConexion->query($empresas);
?>