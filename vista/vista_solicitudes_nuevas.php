<?php
	include('layouts/navAdministracion.php');
	include_once '../configuraciones/conexion.php';
    $conn = new Conexiones();
    $estadoConexion = $conn->getConn();
    $cotizaciones = "SELECT solicitudes.id_solicitudes, fecha_ini_licitacion, fecha_fin_licitacion FROM solicitudes_cotizaciones, solicitudes WHERE fecha_fin_licitacion IS NOT NULL AND solicitudes_cotizaciones.id_solicitudes=solicitudes.id_solicitudes AND solicitudes.estado='aceptada'";
	$queryCotizaciones=$estadoConexion->query($cotizaciones);
	while($listaFechas=$queryCotizaciones->fetch_array(MYSQLI_BOTH)){
		$ini = $listaFechas['fecha_ini_licitacion'];
		$fin = $listaFechas['fecha_fin_licitacion'];
		$id = $listaFechas['id_solicitudes'];
			$date1 = date_create(date("Y-m-d"));
			$date2 = date_create($fin);
			$diff = date_diff($date1,$date2);$d = $diff->format("%R");
			if($d == '-'){
				$consulta = "UPDATE solicitudes SET estado='aceptadaC' WHERE id_solicitudes=".$id;        	
                $resultado = $estadoConexion->prepare($consulta);
                $resultado->execute();
			}
	}
?>	
<div class="container-fluid">
<h2 class="card-title" style="text-align: center;"><strong>SOLICITUDES PENDIENTES</strong></h2>
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
											<th>#</th>
											<th>Id</th>
											<th>Fecha</th>
											<th>Solicitante</th>
											<th>Unidad</th>
											<th>Estado</th>
											<th>Detalle</th>
										</tr>
								
										<?php
									 	
										$i=0;
										foreach($dato as $valor):
										do{
										?>
										<tr align="center">
											<td><?php echo $i+1?></td>
											<td><?php echo($valor[$i]['id_solicitudes'])?></td>
											<td><?php echo($valor[$i]['fecha'])?></td>
											

											<td><?php echo($valor[$i]['nombres'])?></td>	
											<td><?php echo($valor[$i]['nombre_gasto'])?></td>		
											<!-- <td>
												<?php echo($valor[0]['detalle'])?><br>
												<div class="text-center">
 													<a href=""> <img src="../recursos/imagenes/pdf.png" class="rounded" alt="chania" width="25" heigth="25"></a>
												</div>
											</td>
											<td>
												Inf - Sistemas
											</td>
											
											<td>MEMI</td> -->
											<td>
												<span class="label label-warning"><?php echo($valor[$i]['estado'])?></span>

											</td>
											
											
											<td>
									
												<a class="btn btn-info" target="_top" href="../vista/vista_detalle.php?id_solicitud=<?php echo($valor[$i]['id_solicitudes'])?>&id_pedido=<?php echo($valor[$i]['id_pedido'])?>&id_usuario=<?php echo($valor[$i]['id_usuarios'])?>">Ver Detalle</a>
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

	//include_once("layouts/footer.php");
	include('../vista/layouts/piePagina.php');
?>
