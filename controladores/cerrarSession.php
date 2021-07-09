<?php
    session_start();
    $_SESSION["usuario"]=null;
    $_SESSION["unidad"]=null;
    $_SESSION["nombre_usuario"]=null;
    session_destroy();
    header("Location:../index.php");
?>