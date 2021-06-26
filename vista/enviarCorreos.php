<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../configuraciones/conexion.php';
require '../librerias/phpMailer/Exception.php';
require '../librerias/phpMailer/PHPMailer.php';
require '../librerias/phpMailer/SMTP.php';

session_start();
$nombre = $_SESSION['nombreUA'];
$conn = new Conexiones();
$estadoconexion = $conn->getConn();

if(!empty($_POST)){
    $idSolicitud = $_GET["idSolicitud"];
    $fechaFin = $_GET["ff"];
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
        echo '<script language="javascript">window.location.href="../vista/correosEnviados.php?marcado=1";</script>';
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
        $user = generarUsername();
        $pass = generarPassword();

        while(usuarioExiste($user)){
            $user = generarUsername();
        }

        registraUsuarioTemporal($user, $pass, $idCorreoActual, 0, $idSolicitud);

        //Archivos adjuntos
        $rutaArchivo = "../archivos/cotizacionesIniciales/"."solicitudCotizacion.pdf";

        $mail->addAttachment($rutaArchivo);    //Optional name
        $mail->addAttachment("../archivos/cotizacionesIniciales/detallesItems.pdf");
        $detalles = "<br /><br />Para realizar su cotización puede hacerlo de dos formas posibles, a continuación se detallan las mismas:";
        $paso1 = "<br /><b>Opción 1:</b><br />  1. Descargar e imprimir el documento pdf adjunto en la presente.<br />  2. Llenar la cotización manualmente.<br />  3. Enviar la cotización a nuestras oficinas.";
        $paso2 = "<br /><b>Opción 2:</b><br />  1. Ir al siguiente enlace: http://localhost/Sistema_cotizaciones/vista/empresasSolicitantes.php <br />  2. Ingresar con los siguientes datos:<br />    Usuario:  ".$user."<br />    Contraseña:  ".$pass;
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
    $nombres = ["empresa", "compania", "negocio", "sociedad", "comercio", "establecimiento", "firma", "cotizador", "usuario"];
    $letras = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J","K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
    $nombre = $nombres[ mt_rand(0, count($nombres) -1) ];
    $letra1 = $letras[ mt_rand(0, count($letras) -1) ];
    $letra2 = $letras[ mt_rand(0, count($letras) -1) ];
    $numero1 = mt_rand(0,10);
    $numero2 = mt_rand(0,10);
    return "$nombre$letra1$numero1$letra2$numero2";
}

function generarPassword(){
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $password = "";
    for($i=0;$i<16;$i++) {
        $password .= substr($str,rand(0,62),1);
    }
    return $password;
}

function registraUsuarioTemporal($user, $password, $idEmpresa, $estado, $idSolicitud){
    global $estadoconexion;
    $pass = hashPassword($password);
    $stmt = $estadoconexion->prepare("INSERT INTO usuario_cotizador (user_cotizador, password_cotizador, id_empresa, estado_cotizador, id_solicitudes) VALUES(?,?,?,?,?)");
    $stmt->bind_param("ssiii", $user, $pass, $idEmpresa, $estado, $idSolicitud);
    if($stmt->execute()){
        return $estadoconexion->insert_id;
    }else{
        return 0;
    }
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

?>