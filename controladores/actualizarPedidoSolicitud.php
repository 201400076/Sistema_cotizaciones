<?php
    require '../configuraciones/conexion.php';
    require '../librerias/fpdf/fpdf.php';

    $conn = new Conexiones();
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
        
        date_default_timezone_set('America/Lima'); //Configuramos el horario de acuerdo a la ubicación del servidor
    class PDF extends FPDF
    {
        function Header()
        {
            // Logo
            $this->Image('../recursos/imagenes/umss.png', 8, 1, 53);
            $ancho = 172;
            $this->setFont('Arial', 'B', 8);
            $this->SetY(12); //Mencionamos que el curso en la posición Y empezará a los 12 puntos para escribir el Usuario:
            $this->Cell($ancho,10,'programandoElFuturo.SRL@gmail.com',0,0,'R');
            $this->SetY(15);
            $this->Cell($ancho,10,'NIT: 6407874001 ',0,0,'R');
            $this->SetY(18);
            $this->Cell($ancho,10,utf8_decode('Vinto - Motecato, calle Bélgica y Noruega'),0,0,'R');
            $this->SetY(21);
            $this->Cell($ancho,10,utf8_decode('(+591) 76436540 - 44355215'),0,0,'R');
        }
        function Body(){
            $yy = 10; //Variable auxiliar para desplazarse 40 puntos del borde superior hacia abajo en la coordenada de las Y para evitar que el título este al nivel de la cabecera.
            $y = $this->GetY(); 
            //$x = 12;
            $this->AddPage($this->CurOrientation);
             
            $this->SetFont('helvetica', 'BU', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
            $this->SetXY(45, 35); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
            $this->Cell(120, 10, "Solicitud de Cotizacion", 0, 1, 'C');
        
            $this->SetFont('Arial', '', 12);
            $this->setY(50);
            $this->Cell(50,10,'Solicitado Por: ',0,0,'L');
        
        
            $this->setY(50);
            $this->setX(105);
            $this->Cell(50,10,utf8_decode('Solicitud N°:'),0,0,'R');
            $this->setY(55);
            $this->setX(120);
            $this->Cell(50,10,'Fecha de recepcion:',0,0,'R');
            $this->setY(60);
            $this->setX(116);
            $this->Cell(50,10,'Fecha de revision:',0,0,'R');
        
        }
        
        function plot_table($widths, $lineheight, $table, $border = 1, $aligns = array(), $fills = array(), $links = array())
        {
            $func = function ($text, $c_width) {
                $len = strlen($text);
                $twidth = $this->GetStringWidth($text);
                $split = floor($c_width * $len / $twidth) - 0.5;
                $w_text = explode("\n", wordwrap($text, $split, "\n", true));
                return $w_text;
            };
            foreach ($table as $line) {
                $line = array_map($func, $line, $widths);
                $maxlines = max(array_map("count", $line));
                foreach ($line as $key => $cell) {
                    $x_axis = $this->getx();
                    $height = $lineheight * $maxlines / count($cell);
                    $len = count($line);
                    $width = (isset($widths[$key]) === TRUE ? $widths[$key] : $widths / count($line));
                    $align = (isset($aligns[$key]) === TRUE ? $aligns[$key] : '');
                    $fill = (isset($fills[$key]) === TRUE ? $fills[$key] : false);
                    $link = (isset($links[$key]) === TRUE ? $links[$key] : '');
                    foreach ($cell as $textline) {
                        $this->cell($widths[$key], $height, $textline, 0, 0, 'L', $fill, $link);
                        //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
                        $height += 2 * $lineheight * $maxlines / count($cell);
                        $this->SetX($x_axis);
                    }
                    if ($key == $len - 1
                    ) {
                        $lbreak = 1;
                    } else {
                        $lbreak = 0;
                    }
                    $this->cell($widths[$key], $lineheight * $maxlines, '', $border, $lbreak);
                }
            }
        }
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial', 'I', 8);
            // Número de página
            $this->Cell(0, 10,'Page '.$this->PageNo() . '/{nb}',0,0,'C');
        }  
    }

    $pdf = new PDF('P', 'mm', 'A4');
    $pdf->Body();
    $lineheight = 8;
    $fontsize = 10;
    
    $pdf->SetFont('Arial', '', $fontsize);
    $pdf->SetAutoPageBreak(true, 30);
    $pdf->SetMargins(20, 1, 20);

    $pdf->AddPage();
    $pdf->Ln();
    $table = reporteCotizacion($id_solicitud);
    $widths = array(10, 20, 22, 80, 20, 20);
    $pdf->plot_table($widths, $lineheight, $table);
    $pdf->Output($ruta, 'F');
}
    
    function redireccion(){
        echo '<script language="javascript">window.location.href="../ruta/rutas.php?ruta=mostrar&con=nueva"</script>';
    }
    function reporteCotizacion($id_solicitud)
{
    $mysqli = new mysqli('localhost', 'root', '', 'sistema_de_cotizaciones');
    $query = "SELECT items.cantidad, items.unidad, items.detalle, solicitudes.id_solicitudes, items.id_pedido  FROM pedido,items,usuarios,usuarioconrol,unidad_gasto, solicitudes WHERE pedido.id_pedido=items.id_pedido 
                                                                                            AND usuarios.id_usuarios=pedido.id_usuarios 
                                                                                            AND usuarios.id_usuarios=usuarioconrol.id_usuarios
                                                                                            AND usuarioconrol.id_gasto=unidad_gasto.id_gasto";
    $respuesta = [];
    $numero = 0;
    $resultado = $mysqli->query($query);
    array_push($respuesta, ['Nro', 'Cantidad', 'Unidad', 'Detalle', 'Precio Unitario', 'Precio Total']);
    while ($valor = $resultado->fetch_assoc()) {

        if ($id_solicitud == $valor['id_solicitudes']) {
            $numero = $numero + 1;
            $cantidad = $valor['cantidad'];
            $unidad = $valor['unidad'];
            $detalle = $valor['detalle'];
            $preciounitario = "";
            $preciototal = "";
            array_push($respuesta, [utf8_decode($numero), utf8_decode($cantidad), utf8_decode($unidad), utf8_decode($detalle), utf8_decode($preciounitario), utf8_decode($preciototal)]);
        }
        //$contador++;
    }
    $contador = 0;
    return $respuesta;
}
?>