<?php
    require '../configuraciones/conexion.php';
    require '../librerias/fpdf/fpdf.php';

    $conn = new Conexion();
    $estadoconexion = $conn->getConn();

    $id_solicitud=$_GET["id"];
    $fecha=$_GET["fecha"];
    $codigoEstado=$_GET['e'];
    $detalle=$_GET['detalle'];

    actualizarSolicitud($id_solicitud,$fecha,$codigoEstado,$detalle);

    function actualizarSolicitud($id_solicitud,$fecha,$codigoEstado,$detalle){
        global $estadoconexion;
        //if(validarPatron($detalle,"/^[a-zA-Z][a-zA-Z0-9ñÑáéíóú\d_\s]{1,2800}$/i")){
            $stmt = $estadoconexion->prepare("UPDATE solicitudes SET estado=?, fecha_evaluacion=?, detalle=? WHERE id_solicitudes=".$id_solicitud);
            if($codigoEstado == 0){
                $estado='rechazada';
                $detalle = str_replace("_", " ", $detalle);
            }else{
                registrarSolicitudCotizacion($id_solicitud, $fecha, $codigoEstado);
                $estado='aceptada';
                $detalle=(NULL);

                //archivo pdf
                generarArchivoPDF($id_solicitud);
            }
            
            $stmt->bind_param("sss",$estado,$fecha,$detalle);
                if ($stmt->execute()) {
                    redireccion();
                } else {
                    echo 0;
            }
            //registrarCotizacion($id_solicitud, $fecha, $codigoEstado);
        //}else{
            //echo("no cumple el patron");
        //}
    }

    function registrarSolicitudCotizacion($idSolicitud, $fechaInicio, $dias){
        $fechaFin = date("Y-m-d",strtotime($fechaInicio."+ ".$dias." days")); 
        //echo $fechaFin;
        global $estadoconexion;
        $estado = 'cotizando';
            $stmt = $estadoconexion->prepare("INSERT INTO solicitudes_cotizaciones (id_solicitudes, fecha_ini_licitacion, fecha_fin_licitacion, estado_cotizacion) VALUES(?,?,?,?)");
            $stmt->bind_param("isss", $idSolicitud, $fechaInicio, $fechaFin, $estado);
            if($stmt->execute()){
                return $estadoconexion->insert_id;
            }else{
                return 0;
            }
    }

    function validarPatron($str, $patron){
        $str = trim($str);
        if ($str !== '') {
            $pattern = $patron;
            if (preg_match($pattern, $str)) {
                return true;   
            }
        }
        return false;   
    }

    //funcion temporal
    function generarArchivoPDF($id_solicitud){
        $detalle = 'Archivo de Cotizacion Nro: '.$id_solicitud;
        $nombre = 'solicitudCotizacion'.$id_solicitud.'.pdf';
        $ruta = '../archivos/cotizacionesIniciales/'.$nombre;
        
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',24);
        $pdf->Cell(30, 10, $detalle);
        $pdf->Output($ruta,'F');
    }
    
    function redireccion(){
        echo '<script language="javascript">window.location.href="../ruta/rutas.php?ruta=mostrar&con=nueva"</script>';
    }
?>