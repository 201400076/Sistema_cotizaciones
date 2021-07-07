<?php 
require_once '../configuraciones/conectionRol.php';

function getListasUgasto(){
    $mysqli = getConn();
    $id = $_POST['id'];
    $query = "SELECT * FROM `unidad_gasto` WHERE id_unidad = $id";
    $result = $mysqli->query($query);
    $listasUgasto = '<option value="0">Elige Unidad de Gasto</option>';
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $listasUgasto .= "<option value='$row[id_gasto]'>$row[nombre_gasto]</option>";
    }
    return $listasUgasto;
}

echo getListasUgasto();