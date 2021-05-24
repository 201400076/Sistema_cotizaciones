<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Correos</title>
    <link rel="stylesheet" href="./css/estiloRol.css">
</head>
<body>
<?php
        require_once('../configuraciones/conexion.php');
        $conn = new Conexion();
        $estadoConexion = $conn->getConn();
        $empresas = "SELECT * FROM empresas";
        $queryEmpresas=$estadoConexion->query($empresas);
    ?>
<form action="enviarCorreos.php" method="post">
	
    <table id="example">
		<div class="alert alert-success">
			<h2 style="text-align:center;">Enviar Cotizaciones a empresas</h2>
		</div>
		<thead>
			<tr>
                <th>Codigo Empresa</th>
				<th>Nombre Empresa</th>
				<th>Correo Empresa</th>
				<th>Accion</th>
			</tr>
		</thead>
	    <tbody>
		<?php
		while($registroEmpresas=$queryEmpresas->fetch_array(MYSQLI_BOTH)){
            echo "<tr>
                    <td>".$registroEmpresas['id_empresa']."</td>
                    <td>".$registroEmpresas['nombre_empresa']."</td>
                    <td>".$registroEmpresas['correo_empresa']."</td>
                    <td><input type='checkbox' name='marcar[]' value=".$registroEmpresas['correo_empresa']."/></td>
                </tr>";
            } 
        ?>						 
		</tbody>
	</table>
	<br />				
	<button type="submit" name="enviar" value="Marcar empresa">
		Enviar
	</button>
    <?php
    require_once('../vista/enviarCorreos.php');
    ?>

</form>
</body>
</html>