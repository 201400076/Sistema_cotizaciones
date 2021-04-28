<?php
    require_once("../modelo/solicitudes_modelo.php");
    $idPendiente=$_GET["id"];
    $pedidos=new Solicitudes();
    $registros=$pedidos->borrarItem($pedidos);
?>