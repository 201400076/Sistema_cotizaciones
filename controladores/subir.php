<?php

    $ftp_server="pef.tis.cs.umss.edu.bo";
    $ftp_usuario="pef";
    $ftp_pass="h{4a9=Z^v%v:FcP";
    $con_id=ftp_connect($ftp_server);
    $lr=ftp_login($con_id,$ftp_usuario,$ftp_pass);
    if((!$con_id) || (!$lr)){
        echo 'no se pudo conectar';
    }else {
        echo 'conecto correctamente';
        if(isset($_FILES["archivo"])){
            $temp=explode(".",$_FILES['archivo']['name']);
            $source_file=$_FILES['archivo']['tmp_name'];
            $destino="archivos";
            $nombre=$_FILES["archivo"]['name'];
            //ftp_pasv($con_id,true);
            $subio=ftp_put($con_id,$destino.'/'.$nombre,$source_file,FTP_BINARY);
            if($subio){
                echo 'archivo subido';
            }else {
                echo 'error de';
            }
        }
    }
    /*
if(isset($_FILES["archivo"])){
    $archivo=$_FILES["archivo"]["name"];
    $carpeta=$_SERVER['DOCUMENT_ROOT'].'/Sistema_cotizaciones/archivos/solicitudesPedido/';

    if(move_uploaded_file($_FILES["archivo"]["tmp_name"],$carpeta.$archivo)){
        echo $archivo;
    }
}*/
?>