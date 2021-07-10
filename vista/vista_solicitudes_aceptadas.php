<?php
	include('layouts/navAdministracion.php');
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
												<a style="padding: 0; margin-top: 0;" target="_blank" href="../archivos/cotizacionesIniciales/solicitudCotizacion<?php echo $valor[$i]['id_solicitudes']?>.pdf">
													<input style="padding: 0; margin-top: 0;" type="image" src="../recursos/imagenes/iconoImprimir.png" name="imprimir" alt="imprimir" width="40px"/>
												</a>
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
<script type="text/javascript" src="../controladores/controladorRegistroManual.js"></script>  
<?php
	include('../vista/layouts/piePagina.php');
?>