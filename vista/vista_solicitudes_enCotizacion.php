<?php
	include('layouts/navAdministracion.php');
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
											<th>Nro</th>
											<th>Id Solicitud</th>
											<th>Unidad Gasto</th>
											<!--<th>Fecha Inicio Lic</th>-->
											<!-- <th>Fecha-Aceptado</th> -->
											<th>Solicitante</th>
											<th>Dias Restantes</th>
											<th>Fecha Fin Lic</th>
											<th>Estado</th>
											<th>Nro Cotizaciones</th>
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

											<!--<td><?php //echo $valor[$i]['fecha_ini_licitacion']?></td>-->
											
											<!--<td><?php //echo $valor[$i]['fecha_evaluacion']?></td>-->

											<td><?php echo $valor[$i]['nombre_gasto']?></td>

											<td><?php echo $valor[$i]['nombres']?></td>

											<td><?php
												$date1 = date_create(date("Y-m-d"));
												$date2 = date_create($valor[$i]['fecha_fin_licitacion']);
												$diff = date_diff($date1,$date2);$d = $diff->format("%R");
												if($d == '-'){
													echo 'finalizado';
												}else if($d == '+'){
													$diferencia = $diff->format("%a");
													echo $diferencia;
												}
												?>
											</td>

											<td><?php echo $valor[$i]['fecha_fin_licitacion']?></td>

											<td><span class="label label-info"><?php echo $valor[$i]['estado_cotizacion']?></span></td>

											<td><?php echo $valor[$i]['cantidad_cotizaciones']?></td>

											<td>
												<a class="btn btn-info" target="_top" href="../vista/vista_tablasComparativas.php?id_solicitud=<?php echo($valor[$i]['id_solicitudes'])?>&id_solicitud_cotizacion=<?php echo($valor[$i]['id_solicitud_cotizacion'])?> ">Ver Cotizaciones</a>
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
	include('../vista/layouts/piePagina.php');
?>