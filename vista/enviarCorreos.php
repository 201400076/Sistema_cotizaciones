<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once '../modelo/conexionPablo.php';
require '../configuraciones/conexion.php';
require '../librerias/phpMailer/Exception.php';
require '../librerias/phpMailer/PHPMailer.php';
require '../librerias/phpMailer/SMTP.php';

session_start();
$nombre = 'juanito'; $_SESSION['nombre_usuario'];
$conn = new Conexiones();
$estadoconexion = $conn->getConn();


if(!empty($_POST)){
    $idSolicitud = 28;$_GET["idSolicitud"];
    $fechaFin = "2021-08-01";$_GET["ff"];
    $remitente = $nombre;

    if(empty($_POST["marcar"])){
        echo '<script language="javascript">window.location.href="../vista/correosEnviados.php?marcado=0";</script>';
    }else{
        $asunto = $_POST["asunto"];
        $descripcion = $_POST["descripcion"];
        $listaCorreos = obtenerCorreos();
        $listaIds = obtenerIds();
        foreach($_POST["marcar"] as $correo_marcado){
            $correo = trim($correo_marcado, '/');
            $idCorreoActual = obtenerIdEmpresa($correo, $listaCorreos, $listaIds);
            enviarCorreos($remitente, $asunto, $descripcion, $correo, $idCorreoActual,$idSolicitud, $fechaFin);            
        }
        //echo '<script language="javascript">window.location.href="../vista/correosEnviados.php?marcado=1";</script>';
    }
}

function enviarCorreos($remitente, $asunto, $descripcion, $correo, $idCorreoActual,$idSolicitud,$fechaFin){
    $mail = new PHPMailer(true);
    $mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );
    
    try {
        //Configuracion del servidor
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sistema.cotizaciones.umss@gmail.com';//correo
        $mail->Password = 'UMSS2021';//Contrasena
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        //Destino
        $mail->setFrom('sistema.cotizaciones.umss@gmail.com', $remitente);    //Configurar el emisario(origen)

        $mail->addAddress($correo); //<--Enviar a este correo
        $user = generarUsername($idSolicitud);
        $pass = generarPassword();

        while(usuarioExiste($user)){
            $user = generarUsername($idSolicitud);
        }

        registraUsuarioTemporal($user, $pass, $idCorreoActual, 0, $idSolicitud);
        $rutaArchivo = "../archivos/cotizacionesIniciales/"."solicitudCotizacion".$idSolicitud.".pdf";

        $mail->addAttachment($rutaArchivo); 
        $mail->addAttachment("../archivos/cotizacionesIniciales/detallesItems.pdf");
        $detalles = "<br /><br />Para realizar su cotización puede hacerlo de dos formas posibles, a continuación se detallan las mismas:";
        $paso1 = "<br /><b>Opción 1:</b><br />  1. Descargar e imprimir el documento pdf adjunto en la presente.<br />  2. Llenar la cotización manualmente.<br />  3. Enviar la cotización a nuestras oficinas.";
        $paso2 = "<br /><b>Opción 2:</b><br />  1. Ir al siguiente enlace: http://pef.tis.cs.umss.edu.bo/index.php <br />  2. Ingresar con los siguientes datos:<br />    Usuario:  ".$user."<br />    Contraseña:  ".$pass;
        $paso3 = "<br /><b>PD</b>: Enviar su cotizacion antes de la siguiente fecha: <b>".$fechaFin."</b>";
        //Contenido
        $mail->isHTML(true);
        $mail->Subject = $asunto;
            
        $mail->Body    = $descripcion.$detalles.$paso1.$paso2.$paso3;
        
        $mail->send();
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}
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
    $numero1 = mt_rand(0,10);
    $numero2 = mt_rand(0,10);
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

function registraUsuarioTemporal($user, $password, $id_empresa, $estado, $id_solicitud){
    $pass = hashPassword($password);
    $rol = 'Empresa';

    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "INSERT INTO usuario_cotizador (user_cotizador,password_cotizador,id_empresa,estado_cotizador,id_solicitudes,rolAsignado) 
    VALUES ('$user', '$pass', '$id_empresa', '$estado', $id_solicitud, '$rol')";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute(); 

    $consulta = "SELECT * FROM usuario_cotizador ORDER BY id_usuario_cotizador DESC LIMIT 1";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerIds(){
    global $estadoconexion;
    $resultado = $estadoconexion->query("SELECT id_empresa FROM empresas");
    if (!$resultado) {
        echo 'No se pudo ejecutar la consulta: ';// . $estadoconexion->mysql_error();
        exit;
    }
    $fila = array();
    $i=0;
    foreach($resultado as $elemento){
        $fila[$i] = $elemento['id_empresa'];
        $i++;
    }
    return $fila;
}

function obtenerCorreos(){
    global $estadoconexion;
    $resultado1 = $estadoconexion->query("SELECT correo_empresa FROM empresas");
    if (!$resultado1) {
        echo 'No se pudo ejecutar la consulta: ';// . $estadoconexion->mysql_error();
        exit;
    }
    $fila = [];
    $i=0;
    foreach($resultado1 as $elemento){
        $fila[$i] = $elemento['correo_empresa'];
        $i++;
    }
    return $fila;
}

function obtenerIdEmpresa($correo, $listaCorreos, $listaIds){
    $aux = 0;
    for($i=0;$i<count($listaCorreos)-1;$i++){
        if($listaCorreos[$i]==$correo){
            $aux = $listaIds[$i];
        }
    }
    return $aux;
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

function generarArchivoPDF($id_solicitud, $unidad){   
    //$detalle = 'Archivo de Cotizacion Nro: ' . $id_solicitud;
    $nombre = 'solicitudCotizacion' . $id_solicitud . '.pdf';
    $ruta = $_SERVER['DOCUMENT_ROOT'].'/Sistema_cotizaciones/archivos/cotizacionesEnviadas/'.$nombre;

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
            $this->Cell($ancho,10,'SOLICITUD DE COTIZACION',0,0,'R');
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

    $pdf = new PDF('P', 'mm', 'A4');
    //$pdf->Body();
    $lineheight = 8;
    $fontsize = 10;
    
    $pdf->SetFont('Arial', '', $fontsize);
    $pdf->SetAutoPageBreak(true, 30);
    $pdf->SetMargins(20, 1, 20);

    $pdf->AddPage();
    $pdf->Ln();
    $table = reporteCotizacion($id_solicitud,$unidad);
    $widths = array(10, 20, 22, 80, 20, 20);
    $pdf->plot_table($widths, $lineheight, $table);
    $pdf->Output($ruta, 'F');
}

?>