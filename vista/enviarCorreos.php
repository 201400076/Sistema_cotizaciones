<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../librerias/phpMailer/Exception.php';
require '../librerias/phpMailer/PHPMailer.php';
require '../librerias/phpMailer/SMTP.php';

if(!empty($_POST)){
    if(empty($_POST["marcar"])){
        echo '<script language="javascript">window.location.href="../vista/correosEnviados.php?marcado=0";</script>';
    }else{
        $remitente = $_POST["remitente"];
        $asunto = $_POST["asunto"];
        $descripcion = $_POST["descripcion"];
        foreach($_POST["marcar"] as $correo_marcado){
            $correo = trim($correo_marcado, '/');
            enviarCorreos($remitente, $asunto, $descripcion, $correo);
        }
        echo '<script language="javascript">window.location.href="../vista/correosEnviados.php?marcado=1";</script>';
    }
}

function enviarCorreos($remitente, $asunto, $descripcion, $correo){
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
        $mail->Username = 'marcoescalera2017@gmail.com';//correo
        $mail->Password = 'Xmaesc1997X';//Contrasena
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        //Destino
        $mail->setFrom('marcoescalera2017@gmail.com', $remitente);    //Configurar el emisario(origen)

            
        $mail->addAddress($correo); //<--Enviar a este correo
        $user = generarUsername();
        $pass = generarPassword();
        //Archivos adjuntos
        $mail->addAttachment('../archivos/Solicitud_de_cotizacion_Cod25.pdf');    //Optional name
        $detalles = "<br /><br />Para realizar su cotización puede hacerlo de dos formas posibles, a continuación se detallan las mismas:";
        $paso1 = "<br /><b>Opción 1:</b><br />  1. Descargar e imprimir el documento pdf adjunto en la presente.<br />  2. Llenar la cotización manualmente.<br />  3. Enviar la cotización a nuestras oficinas especificadas en el pie del documento.";
        $paso2 = "<br /><b>Opción 2:</b><br />  1. Ir al siguiente enlace: http://localhost/Sistema_cotizaciones/vista/empresasSolicitantes.php <br />  2. Ingresar con los siguientes datos:<br />    Usuario:  ".$user."<br />    Contraseña:  ".$pass;
        //Contenido
        $mail->isHTML(true);
        $mail->Subject = $asunto;
            
        $mail->Body    = $descripcion.$detalles.$paso1.$paso2;
        
        $mail->send();

        //echo 'Correo enviado!'
        
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

?>