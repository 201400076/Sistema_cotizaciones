<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../librerias/phpMailer/Exception.php';
require '../librerias/phpMailer/PHPMailer.php';
require '../librerias/phpMailer/SMTP.php';

if(isset($_POST["enviar"])){
    if(empty($_POST["marcar"])){
        echo '<script language="javascript">window.location.href="../vista/correosEnviados.php?marcado=0";</script>';
    }else{
        $aux = 0;
        $remitente = $_POST["remitente"];
        $asunto = $_POST["asunto"];
        $descripcion = $_POST["descripcion"];
        foreach($_POST["marcar"] as $correo_marcado){
            $correo = trim($correo_marcado, '/');
            enviarCorreos($remitente, $asunto, $descripcion, $correo);
            echo '<script language="javascript">window.location.href="../vista/correosEnviados.php?marcado=1";</script>';
        }
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

        //Archivos adjuntos
        $mail->addAttachment('../archivos/Dimesiones de silla ideal.pdf', 'archivoEjemplo.pdf');    //Optional name
    
        //Contenido
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $descripcion;
    
        $mail->send();
        echo 'Correo enviado!';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}

?>