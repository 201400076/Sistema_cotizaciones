<?php
if(isset($_FILES["archivo"])){
    $archivo=$_FILES["archivo"]["name"];
    $carpeta=$_SERVER['DOCUMENT_ROOT'].'/Sistema_cotizaciones/archivos/cotizacionManual/';

    if(move_uploaded_file($_FILES["archivo"]["tmp_name"],$carpeta.$archivo)){
        echo $archivo;
    }
}
?>