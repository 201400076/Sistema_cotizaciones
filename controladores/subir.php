<?php
if(isset($_FILES["archivo"])){
    $archivo=$_FILES["archivo"]["name"];
    $carpeta="../archivos/";
    

    if(move_uploaded_file($_FILES["archivo"]["tmp_name"],$carpeta.$archivo)){
        echo $archivo;
    }
}
?>