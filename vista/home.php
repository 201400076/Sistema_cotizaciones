<?php
/*if (isset($_GET['ruta'])) {
	# code...
} else {
	header("location: ../ruta/ruta.php");
}*/

$active = "active";
include_once("layouts/navegacion.php");

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2><span class="glyphicon glyphicon-edit"></span> Home</h2>

			<div class="unidadAdministrativa">
				<h1></h1>
				<hr>
				<h3>Seccion Unidades Administrativas</h3>
				<hr>
				<a class="btn btn-primary" style="width: 300px;background-color: #45A049;" href="../ruta/ruta.php?ruta=index">Crear Nueva Unidad Administrativa</a>
				<hr>
				<a class="btn btn-primary" style="width: 300px;background-color: #45A049;" href="../ruta/ruta.php?ruta=unidad">Crear Nueva Unidad de Gasto</a>
				<hr>
				<a class="btn btn-danger" style="width: 300px;" href="../ruta/ruta.php?ruta=listar">Listar Unidad Administrativa</a>
				<hr>
				<a class="btn btn-danger" style="width: 300px;" href="../ruta/ruta.php?ruta=listarGasto">Listar Unidad Gasto</a>
				<hr>
				<h3>Seccion Usuarios</h3>
				<hr>
				<a class="btn btn-primary" style="width: 300px;background-color: #45A049;" href="../vista/formularioRU.php">Crear Nuevo Usuario</a>
				<hr>
			</div>
		</div>

	</div>
</div>
<?php
include_once("layouts/footer.php");

?>