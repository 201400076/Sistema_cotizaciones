<?php
	include('layouts/navAdministracion.php');
	require_once '../configuraciones/conexion.php';
    $conn = new Conexiones();
?>
<div class="container-fluid">

<h2 class="card-title" style="text-align: center;"><strong>SOLICITUDES ACEPTADAS</strong></h2>


	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div id="resultados" class="col-sm-12 "></div>
						<div class="outer_div" style="width:100%">
							<div class="table-responsive">
								<table class="table">
									<tbody>
										<tr align="center"class="warning">
											<th>Nro</th>
											<th>Id Solicitud</th>
											<th>Unidad Gasto</th>
											<th>Solicitante</th>
											<th>Fecha Recepcion</th>
											<th>Fecha Aceptado</th>
											<th>Estado</th>
											<th>Accion</th>
											<th>Accion</th>
											<th>Cotizacion Pdf</th>
										</tr>

										<?php
										
											$i=0;
											foreach($dato as $valor):
											do{
										
										?>
										<tr align="center">
											<td><?php echo $i+1?></td>

											<td><?php echo $valor[$i]['id_solicitudes']?></td>

											<td><?php echo $valor[$i]['nombre_gasto']?></td>

											<td><?php echo $valor[$i]['nombres']?></td>

											<td><?php echo $valor[$i]['fecha']?></td>

											<td><?php echo $valor[$i]['fecha_evaluacion']?></td>

											<td>
												<span class="label label-success"><?php echo $valor[$i]['estado']?></span>

											</td>

											<td>
												<a class="btn btn-info" target="_top" href="../vista/formularioEnviarCotizaciones.php?idSolicitud=<?php echo $valor[$i]['id_solicitudes']?>">Cotizar</a>
											</td>
											<td>
												<button type="button" id="btnGuardarJust" class=" btnGuardarJust btn btn-info">Registrar</button>
											</td>
											<td>
													<input style="padding: 0; margin-top: 0;" id="imprimir" class="imprimir" type="image" src="../recursos/imagenes/iconoImprimir.png" name="imprimir" alt="imprimir" width="40px"/>
											</td>

										</tr>


										<?php
										$i++;
										}
										while($i<sizeof($valor));

										endforeach;
										?>
										
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modalCRUDJust" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class=" text-center modal-title1" id="exampleModalLabel">Enviar Solicitud de Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">            
                <div class="form-group">
                <label for="Justificacion" class="col-form-label">Justificacion:</label>
                <textarea  class="form-control"  id="Justificacion" cols="20" rows="5" placeholder="Puede agregar una justificacion..."></textarea>                
                </div>                         
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">CANCELAR</button>
                <button type="button" id="btnGuardarJust" class=" btnGuardarJust btn btn-dark">GUARDAR</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class=" text-center modal-title1" id="exampleModalLabel">Formulario de Registro de Empresa</h5>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">            
                <div class="form-group">
					<div class="row">
						<div class="col-25">
							<label for="nombre">Nombre Empresa:</label>
						</div>
						<div class="col-75">
							<input type="text" id="nombre" name="nombre" required>

						</div>
					</div>

					<div class="row">
						<div class="col-25">
							<label for="corto">Nombre corto:</label>
						</div>
						<div class="col-75">
							<input type="text" id="corto" name="corto" required>
						</div>
					</div>

					<div class="row">
						<div class="col-25">
							<label for="correo">Correo electrónico:</label>
						</div>
						<div class="col-75">
							<input type="email" id="correo" name="correo" required>
						</div>
					</div>

					<div class="row">
						<div class="col-25">
							<label for="nit">NIT:</label>
						</div>
						<div class="col-75">
							<input type="number" id="nit" name="nit" required>
						</div>
					</div>

					<div class="row">
						<div class="col-25">
							<label for="telefono">Telefono:</label>
						</div>
						<div class="col-75">
							<input type="tel" id="telefono" name="telefono" required>
						</div>
					</div>
					<div class="row">
						<div class="col-25">
							<label for="direccion">Direccion:</label>
						</div>
						<div class="col-75">
							<input type="text" id="direccion" name="direccion" required>
						</div>
					</div>

					<div class="row">
						<div class="col-25">
							<label for="rubro">Rubro:</label>
						</div>
						<div class="col-75">
							<input list="rubro" id="ru" name="rubro" style="width: 100%;padding: 12px;border-radius: 10px;" placeholder="Elija el rubro de su empresa" required>
						<?php
							
							$estadoConexion = $conn->getConn();
							$rubros = "SELECT * FROM rubros";
							$queryRubros=$estadoConexion->query($rubros);
							
							echo "<datalist id='rubro'>";
							while($listaRubros=$queryRubros->fetch_array(MYSQLI_BOTH)){
								$rubroActualNombre = $listaRubros['nombre_rubro'];
								$idRubroActual = $listaRubros['id_rubro'];
								echo "<option label='".$rubroActualNombre."' value=".$idRubroActual.">".$rubroActualNombre;
							}
							echo '</datalist>';
						?>
							<!--<input type="text" id="rubro" name="rubro" value="<?php //echo isset($_POST['rubro']) ? $_POST['rubro'] : '';?>" required>-->
						</div>
					</div>
                </div>                         
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">CANCELAR</button>
                <button type="button" id="registrarEmpresa" class=" registrarEmpresa btn btn-dark">GUARDAR</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

<script type="text/javascript" src="../controladores/controladorRegistroManual.js"></script>  
<?php
	include('../vista/layouts/piePagina.php');
?>