<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../librerias/phpMailer/Exception.php';
require '../librerias/phpMailer/PHPMailer.php';
require '../librerias/phpMailer/SMTP.php';



if(isset($_POST["enviar"])){
    if(empty($_POST["marcar"])){
        echo "<h1>No se ha marcado nada</h1>";
    }else{
        $aux = 0;
        foreach($_POST["marcar"] as $correo_marcado){
            $correo = trim($correo_marcado, '/');
            enviarCorreos($correo);
        }
    }
}

function enviarCorreos($correo){
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
        $mail->Username = 'CORREO_ORIGEN';//correo
        $mail->Password = 'CONTRASENA_DEL_CORREO_ORIGEN';//Contrasena
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
    
        //Destino
        $mail->setFrom('CORREO ORIGEN', 'NOMBRE DEL EMISARIO');    //Configurar el emisario(origen)

        $mail->addAddress($correo); //<--Enviar a este correo
    
        //Archivos adjuntos
        //$mail->addAttachment('../recursos/imagenes/icono.jpg', 'iconoEjemplo.jpg');    //Optional name
    
        //Contenido
        $mail->isHTML(true);
        $mail->Subject = 'PRUEBA 4';
        $mail->Body    = 'Este es el ejemplo #4 para probar el envio de correos a multiples destinos con archivo adjunto';
    
        $mail->send();
        echo 'Correo enviado!';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
    }
}

?>