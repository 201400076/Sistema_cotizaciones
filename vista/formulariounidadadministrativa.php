<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Cotizaciones</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../librerias/css/miestilo.css">
	<style>
		input:valid,
		textarea:valid {
			border: 1px solid green;
			border-radius: 4px;
		}
		input:invalid,
		textarea:invalid {
			border: 1px solid red;
			border-radius: 4px;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="row-fluid">
			<div class="col-md-12">
				<h2><span class="glyphicon glyphicon-edit"></span> Nueva Unidad Administrativa</h2>
				<hr>
					<a href="../ruta/rutaGasto.php?ruta=unidad">Ir a Unidad Gasto:</a>
				<hr>
				<div class="unidadAdministrativa">
					<form class="form-horizontal" method="post" action="../ruta/ruta.php?ruta=register" role="form" id="unidad_administrativa">
						<div class="row">
							<div class="col-md-12">
								<label for="id_facultad">Facultad:</label>
								<div class="form-group">
									<select class="form-control" name="id_facultad" id="id_facultad">
										<option value="">Seleccionar facultad...</option>   
										<?php
											foreach ($facultades as $facultad) {
												?>
												<option value="<?php echo $facultad['id_facultad']?>"><?php echo $facultad['nombre_facultad']?></option>

												<?php 
											}
										?>
									</select>
								</div>
							</div>

							<div class="col-md-12">
								<label for="nombre_unidad">Nombre Unidad Administrativa:</label>
								<div class="form-group">
									<input name="nombre_unidad" type="text" class="form-control" id="nombre_unidad" required pattern="[A-Za-z]{4,40}"
           title="Letras, Tamaño mínimo: 4. Tamaño máximo: 40" >
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="text-center">
								<button type="submit" class="btn btn-info">
									Registrar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>