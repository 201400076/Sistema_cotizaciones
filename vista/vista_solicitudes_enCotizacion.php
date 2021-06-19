<?php
$active = "";
	include_once("layouts/navegacionPendientes.php");
?>
<div class="container-fluid">
<h2 class="card-title" style="text-align: center;"><strong>SOLICITUDES EN COTIZACION</strong></h2>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					
					<div class="row">
						<div id="resultados" class="col-sm-12 "></div>
						<div class="outer_div" style="width:100%">
							<div class="table-responsive ">
								<table class="table">
									<tbody>
										<tr align="center"class="warning">
											<th>#</th>
											<th>Id</th>
											<th>Fecha-Recepcion</th>
											<th>Fecha-Aceptado</th>
											<th>Solicitante</th>
											<th>Unidad</th>
											<th>Estado</th>
											<th>Accion</th>

										</tr>

										<?php
										
											$i=0;
											foreach($dato as $valor):
											do{
										
										?>
										<tr align="center">
											<td><?php echo $i+1?></td>

											<td><?php echo $valor[$i]['id_solicitudes']?></td>

											<td><?php echo $valor[$i]['fecha']?></td>

											<td><?php echo $valor[$i]['fecha_evaluacion']?></td>

											<td><?php echo $valor[$i]['nombres']?></td>

											<td><?php echo $valor[$i]['nombre_gasto']?></td>

											<td>
												<span class="label label-info"><?php echo $valor[$i]['estado']?></span>

											</td>

											<td>
									
												<!-- <a class="btn btn-info" target="_top" href="../vista/vista_detalle.php?id_solicitud=<?php //echo($valor[$i]['id_solicitudes'])?>&id_pedido=<?php //echo($valor[$i]['id_pedido'])?>&id_usuario=<?php echo($valor[$i]['id_usuarios'])?>">Ver Detalle</a> -->
												<a class="btn btn-info" target="_top">EVALUAR</a>
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

<?php
include_once("layouts/footer.php");

?>