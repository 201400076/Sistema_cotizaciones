<?php
$active = "";
include_once("layouts/navegacion.php");

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2><span class="glyphicon glyphicon-edit"></span> Modificar Datos de Unidad Administrativa</h2>
			<hr>
			<div class="unidadAdministrativa">
				<form class="form-horizontal" method="post" action="../ruta/ruta.php?ruta=actualizar&md=unidad&id=<?php echo $id?>" role="form" id="unidad_administrativa">
					<div class="row">
						<div class="col-md-12">
							<label for="id_facultad">Facultad:</label>
							<div class="form-group">
								<select class="form-control" name="id_facultad" id="id_facultad">
									<option value="">Seleccionar facultad...</option>
									<?php
									foreach ($facultades as $facultad) {
									?>
										<option <?php if($facultad['id_facultad'] == $unidad[0]['id_facultad']) echo 'selected'; ?> value="<?php echo $facultad['id_facultad'] ?>"><?php echo $facultad['nombre_facultad'] ?></option>

									<?php
									}
									?>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<label for="nombre_unidad">Nombre Unidad Administrativa:</label>
							<div class="form-group">
								<input value="<?php echo $unidad[0]['nombre_unidad']; ?>" name="nombre_unidad" type="text" class="form-control" id="nombre_unidad" required pattern="[A-Za-z, ]{4,40}" title="Letras, Tamaño mínimo: 4. Tamaño máximo: 40">
							</div>
						</div>
						<div class="col-md-12">
							<label for="monto_tope">Monto Tope (Bs):</label>
							<div class="form-group">
								<input value="<?php echo $unidad[0]['monto_tope']; ?>" name="monto_tope" type="number" class="form-control" id="monto_tope" required pattern="[0-9]" title="Numeros">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="text-center">
							<button type="submit" class="btn btn-info">
								Actualizar
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
include_once("layouts/footer.php");

?>