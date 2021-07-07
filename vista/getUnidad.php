<?php
	include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();


    $html= "<option value='0'>Seleccionar Unidad</option>";
    $id_rol = $_POST['id_rol'];
    $data = null;

    //$consulta = "SELECT u.id_usuarios, u.nombres, u.apellidos, u.usuario, r.nombreRol FROM roles r INNER JOIN usuarios u ON r.id_usuario = u.id_usuarios";

    //$query = "SELECT id_unidad, nombre_unidad FROM unidad_administrativa";
    //$resultado = mysqli_query($query);

    //$consulta = "SELECT * FROM unidad_administrativa";
    //$consulta = "SELECT * FROM usuarioconrol WHERE id_unidad='$id_unidad'";
    if($id_rol==1){
        $consulta = "SELECT * FROM unidad_gasto";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        foreach($data as $d)
	    {
		$html.= "<option value='".$d['id_gasto']."'>".$d['nombre_gasto']."</option>";
	    }

    }elseif($id_rol==2){
        $consulta = "SELECT * FROM unidad_administrativa";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $d)
	    {
		$html.= "<option value='".$d['id_unidad']."'>".$d['nombre_unidad']."</option>";
	    }
    }
	//$resultadoM = $mysqli->query($queryM);
	echo $html;
?>