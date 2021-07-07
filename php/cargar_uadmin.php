<?php 
require_once '../configuraciones/conectionRol.php';

function getListasUadmin(){
  $mysqli = getConn();
  $query = 'SELECT * FROM `unidad_administrativa`';
  $result = $mysqli->query($query);
  $listas = '<option value="0">Elige Unidad Administrativa</option>';
  while($row = $result->fetch_array(MYSQLI_ASSOC)){
    $listas .= "<option value='$row[id_unidad]'>$row[nombre_unidad]</option>";
  }
  return $listas;
}

echo getListasUadmin();