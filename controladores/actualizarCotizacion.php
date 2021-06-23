<?php
    require '../configuraciones/conexion.php';

    $conn = new Conexion();
    $estadoconexion = $conn->getConn();

    $id_solicitud=$_GET["id"];
    $fecha=$_GET["fecha"];
    $codigoEstado=$_GET['e'];
    $detalle=$_GET['detalle'];

    actualizarCotizacion($id_solicitud,$fecha,$codigoEstado,$detalle);

    function actualizarCotizacion($id_solicitud,$fecha,$codigoEstado,$detalle){
        global $estadoconexion;
        //if(validarPatron($detalle,"/^[a-zA-Z][a-zA-Z0-9ñÑáéíóú\d_\s]{1,2800}$/i")){
            $stmt = $estadoconexion->prepare("UPDATE solicitudes_cotizaciones SET estado_cotizacion=?, fecha_evaluacion=?, detalle=?, empresa_adjudicada=? WHERE id_solicitudes=".$id_solicitud);
            
            if($codigoEstado == 0){
                $estado='rechazada';
                $empresa = NULL;
                $detalle = str_replace("_", " ", $detalle);
            }else{
                $empresa = $codigoEstado;
                $detalle = NULL;
                $estado='aceptada';
                $detalle=(NULL);
            }
            
            $stmt->bind_param("sssi",$estado,$fecha,$detalle,$empresa);
                if ($stmt->execute()) {
                    redireccion();
                } else {
                    echo 0;
            }
        //}else{
            //echo("no cumple el patron");
        //}
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
    
    function redireccion(){
        echo '<script language="javascript">window.location.href="../ruta/rutas.php?ruta=mostrar&con=cotizando"</script>';
    }
?>