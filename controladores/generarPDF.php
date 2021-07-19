<?php
include_once '../modelo/conexionPablo.php';
require '../librerias/fpdf/fpdf.php';
require_once('../configuraciones/conexion.php');

$id_solicitud=$_POST['id_solicitud'];
    
session_start();
$nombre = $_SESSION['nombre_usuario'];
$conn = new Conexiones();
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$estadoconexion = $conn->getConn();


    $user = generarUsername();
    $pass = generarPassword();

        while(usuarioExiste($user)){
            $user = generarUsername();
        }
    $id_empresa=0.;
    $estado=0;
    $rol = 'Empresa';

    $consulta = "INSERT INTO usuario_cotizador (user_cotizador,password_cotizador,id_empresa,estado_cotizador,id_solicitudes,rolAsignado) 
    VALUES ('$user', '$pass', '$id_empresa', '$estado', $id_solicitud, '$rol')";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 
    $consulta = "SELECT * FROM usuario_cotizador ORDER BY id_usuario_cotizador DESC LIMIT 1";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $usuarioCotizador=$resultado->fetchAll(PDO::FETCH_ASSOC);
    generarArchivoPDF($user);
    print json_encode($usuarioCotizador, JSON_UNESCAPED_UNICODE);


function generarUsername(){
    global $estadoconexion;
   
    //$i=0;
    $res = $estadoconexion->query("SELECT max(id_usuario_cotizador) FROM usuario_cotizador");
    $fila = mysqli_fetch_array($res);
    $max=$fila[0];
   /*  foreach($res as $elem){
        $codigo[$i]=$elem['id_usuario_cotizador'];
        //var_dump($codigo);
        
    } */
    $max++;
    $tis="TIS";
    $nombres = ["empresa", "compania", "negocio", "sociedad", "comercio", "establecimiento", "firma", "cotizador", "usuario"];
    $letras = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J","K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    $nombre = 'cotizacion';//$nombres[ mt_rand(0, count($nombres) -1) ];
    $letra1 = $letras[ mt_rand(0, count($letras) -1) ];
    $letra2 = $letras[ mt_rand(0, count($letras) -1) ];
    $numero1 = mt_rand(0,9);
    $numero2 = mt_rand(0,9);
    return "$tis"."-"."$letra1$numero1$letra2$numero2"."-"."00$max";

   // return "$tis"."-"."$nombre$letra1$numero1$letra2$numero2";
}


function generarPassword(){
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $password = "";
    for($i=0;$i<16;$i++) {
        $password .= substr($str,rand(0,62),1);
    }
    return $password;
}

function usuarioExiste($usuario){
    global $estadoconexion;

    $stmt = $estadoconexion->prepare("SELECT user_cotizador FROM usuario_cotizador WHERE user_cotizador = ? LIMIT 1");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();
    $num = $stmt->num_rows;
    $stmt->close();
    
    if($num > 0){
        return true;
    }else{
        return false;
    }
}

function hashPassword($pass){
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    return $hash;
}

function generarArchivoPDF($id_solicitud){   
        //$detalle = 'Archivo de Cotizacion Nro: ' . $id_solicitud;
        $nombre = $id_solicitud . '.pdf';
        $ruta = '../archivos/cotizacionesEnviadas/' . $nombre;
    
        date_default_timezone_set('America/Lima'); //Configuramos el horario de acuerdo a la ubicación del servidor
        class PDF extends FPDF
        {
            function Header()
            {
                // Logo
                $this->Image('../recursos/imagenes/umss.png', 8, 1, 53);
                $ancho = 185;
                $this->setFont('Arial', 'B', 10);
                $this->SetY(12); //Mencionamos que el curso en la posición Y empezará a los 12 puntos para escribir el Usuario:
                $this->Cell($ancho,10,'Fac.Economia',0,0,'R');
                $this->SetY(15);
                $this->Cell($ancho,10,'sistema.cotizaciones.umss@gmail.com',0,0,'R');
                $this->SetY(18);
                $this->Cell($ancho,10,utf8_decode('Dir: Av. Oquendo final Jordán(Campus Central)'),0,0,'R');
                
            }
            function Body(){
                $yy = 10; //Variable auxiliar para desplazarse 40 puntos del borde superior hacia abajo en la coordenada de las Y para evitar que el título este al nivel de la cabecera.
                $y = $this->GetY(); 
                //$x = 12;
                $this->AddPage($this->CurOrientation);
                 
                $this->SetFont('helvetica', 'BU', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
                $this->SetXY(45, 35); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
                $this->Cell(120, 10, "Solicitud de Cotizacion", 0, 1, 'C');
                
                $this->setTextColor(255, 87 , 51);
                $this->SetXY(150, 35);
                $this->SetFont('helvetica', 'B', 15);
                $this->Cell(12, 10, utf8_decode("N°:"), 0, 1, 'C');
                $this->setTextColor(0, 0 , 0);
                $this->SetFont('Arial', '', 12);
                $this->setY(50);
                $this->Cell(50,10,'Responsable  : ',0,0,'L');
                $this->setXY(10,55);
                $this->Cell(50,10,'Solicitante      : ',0,0,'L');
                $this->setXY(10,60);
                $this->Cell(50,10,'Encargado de: ',0,0,'L');
            
            
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
                $this->GetX();
                $this->GetY();
                $func = function ($text, $c_width) {
                    $len = strlen($text);
                    $twidth = $this->GetStringWidth($text);
                    if($twidth==0){
                        $split = floor($c_width * $len) - 0.5;
                    }else{
                        $split = floor($c_width * $len / $twidth) - 0.5;
                    }

                    
                    $w_text = explode("\n", wordwrap($text, intval($split), "\n", true));
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
        
        require_once('../configuraciones/conexion.php');
    
        $nomUsuAdm = $_SESSION['nombre_usuario'];
        $unidad = $_SESSION['unidad'];

        $idRescate=32;//$_GET['id_solicitud'];
        
        $conn = new Conexiones();
        $estadoConexion = $conn->getConn();
        $cotizaciones = "SELECT unidad_gasto.nombre_gasto, solicitudes.id_solicitudes, solicitudes_cotizaciones.fecha_ini_licitacion, solicitudes_cotizaciones.fecha_evaluacion, usuarios.nombres, usuarios.apellidos, solicitudes_cotizaciones.detalle, empresa_adjudicada FROM pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto,solicitudes_cotizaciones WHERE solicitudes.id_solicitudes=solicitudes_cotizaciones.id_solicitudes
                                                                                                                        AND pedido.id_pedido=solicitudes.id_pedido
                                                                                                                                AND usuarios.id_usuarios=pedido.id_usuarios
																															AND usuarios.id_usuarios=usuarioconrol.id_usuarios
																															AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
																															AND solicitudes.id_solicitudes=".$idRescate;
    	$queryCotizaciones=$estadoConexion->query($cotizaciones);
        $registroCotizaciones=$queryCotizaciones->fetch_array(MYSQLI_BOTH);



        $conn = new Conexiones();
        $estadoconexion = $conn->getConn();
        $res = $estadoconexion->query("SELECT max(id_usuario_cotizador) FROM usuario_cotizador");
        $fila = mysqli_fetch_array($res);
        $max=$fila[0];
        $max++;

        $pdf = new PDF('P', 'mm', 'A4');
        //$pdf->Body();
        $lineheight = 8;
        $fontsize = 10;
        $pdf->Body();
        $pdf->SetFont('Arial', '', $fontsize);
        $pdf->SetAutoPageBreak(true, 30);
        $pdf->SetMargins(20, 1, 20);
       
        //$pdf->AddPage();
        $pdf->Ln();
        $table = reporteCotizacion($id_solicitud,$unidad);
        $widths = array(10, 20, 22, 80, 20, 20);
        $pdf->plot_table($widths, $lineheight, $table);
        //###############################################################   
        /*     $pdf->setFont('Arial','B',8);
            $pdf->SetY(12);
            $pdf->Cell(190, 10,utf8_decode($datosUnidad['nombre_facultad']), 0, 0, 'R');
            $pdf->SetY(16);
            $pdf->Cell(190, 10,'sistema.cotizaciones.umss@gmail.com', 0, 0, 'R');   
            $pdf->SetY(20);
            $pdf->Cell(190, 10,utf8_decode('Dir: Av. Oquendo final Jordán(Campus Central)'), 0, 0, 'R');  */
        

    
    
        $pdf->setTextColor(255, 87 , 51);
        $pdf->SetFont('helvetica', 'B', 15);
        $pdf->setXY(160,30);
        $pdf->Cell(10,20,$id_solicitud,0,0,'L');
        $pdf->setTextColor(0, 0 , 0);
        $pdf->SetFont('Times','BI',14);
        $pdf->setXY(155,15);
        $pdf->Cell(10,80,$registroCotizaciones['id_solicitudes'],0,0,'L');
        $pdf->setXY(170,35);
        $pdf->Cell(10,50,$registroCotizaciones['fecha_ini_licitacion'],0,0,'L');
        $pdf->setXY(170,40);
        $pdf->Cell(10,50,$registroCotizaciones['fecha_evaluacion'],0,0,'L');
        $pdf->setXY(40,30);
        $pdf->Cell(10,50,$nomUsuAdm,0,0,'L');
        $pdf->setXY(40,35);
        $pdf->Cell(10,50,$registroCotizaciones['nombres']." ".$registroCotizaciones['apellidos'],0,0,'L');
        $pdf->setXY(40,40); 
        $pdf->Cell(10,50,$registroCotizaciones['nombre_gasto'],0,0,'L');

        /* $pdf->SetFont('Times','BI',13);
        $pdf->SetXY(25,45);
        $pdf->Cell(150, 10, utf8_decode($datosUnidad['nombre_unidad']), 0, 1, 'C'); */

        $pdf->SetFont('Times','I',14);
        $pdf->setY(95);
        $pdf->setX(15);



        $pdf->Output($ruta, 'F');
    }
    function reporteCotizacion($id_solicitud,$unidad)
    {
        $objeto = new Conexion();
        $conexion = $objeto->Conectar();

        $consulta = "SELECT items.cantidad, items.unidad, items.detalle, solicitudes.id_solicitudes, items.id_pedido FROM pedido,items,solicitudes WHERE pedido.id_pedido=items.id_pedido AND pedido.id_pedido=solicitudes.id_pedido AND solicitudes.id_solicitudes=".$id_solicitud." AND pedido.id_unidad=".$unidad;
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        $mysqli = new mysqli('localhost', 'root', '', 'sistema_de_cotizaciones');
        $query = "SELECT items.cantidad, items.unidad, items.detalle, solicitudes.id_solicitudes, items.id_pedido FROM pedido,items,solicitudes WHERE pedido.id_pedido=items.id_pedido AND pedido.id_pedido=solicitudes.id_pedido AND solicitudes.id_solicitudes=".$id_solicitud." AND pedido.id_unidad=".$unidad;
        $respuesta = [];
        $numero = 0;

        foreach($data as $d){
            if($id_solicitud==$d['id_solicitudes']){
                $numero = $numero + 1;
                $cantidad = $d['cantidad'];
                $unidad = $d['unidad'];
                $detalle = $d['detalle'];
                $preciounitario = "";
                $preciototal = "";
                array_push($respuesta, [utf8_decode($numero), utf8_decode($cantidad), utf8_decode($unidad), utf8_decode($detalle), utf8_decode($preciounitario), utf8_decode($preciototal)]);
            }
        }
        $contador = 0;
        return $respuesta;
    }
?>