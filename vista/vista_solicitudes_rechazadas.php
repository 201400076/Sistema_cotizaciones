<?php
	include('layouts/navAdministracion.php');
	//$active = "";
	//include_once("layouts/navegacionPendientes.php");
?>
<div class="container-fluid">

<h2 class="card-title" style="text-align: center;"><strong>SOLICITUDES RECHAZADAS</strong></h2>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					
					<div class="row">

						<div id="resultados" class="col-sm-12 "></div>
						<div class="outer_div" style="width:100%">
							<div class="table-responsive">
								<table class="table" method="get">
									<tbody>
										<tr align="center"class="warning">
											<th>Nro</th>
											<th>Id Solicitud</th>
											<th>Unidad Gasto</th>
											<th>Solicitante</th>
											<th>Fecha Recepcion</th>
											<th>Fecha Rechazo</th>
											
											<!-- <th>Detalle</th>
											<th>Departamento</th>
											<th>Unidad</th> -->
											
											<th>Estado</th>
											<th>Informe</th>

											
											<!-- <th class="text-right">Acciones</th> -->

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

											<!-- <td>
												Compra de Sillas<br>
												
												<div class="text-center">
 													<a href=""> <img src="../recursos/imagenes/pdf.png" class="rounded" alt="chania" width="25" heigth="25"></a>
												</div>
											</td>
											<td>
												Inf - Sistemas
											</td>
											
											<td>MEMI</td> -->
											<td>
												<span class="label label-danger"><?php echo $valor[$i]['estado']?></span>
											</td>
											

											<td>
									
												<a class="btn btn-info" target="_blank" href="../vista/vistaPDFRechazadas.php?id=<?php echo $i;?>">Ver Informe</a>
											</td>
											<!-- <td class="text-right">
												<div class="btn-group dropleft">
													<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Acciones
													</button>
													<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
														<a class="dropdown-item" href="editar_cotizacion.php?id=230" title="Editar cotizaci??n"><i class="fa fa-edit"></i> Editar</a>
														<a class="dropdown-item" href="#" title="Imprimir cotizaci??n" onclick="descargar('303');"><i class="fa fa-print"></i> Imprimir</a>
														<a class="dropdown-item" href="#" title="Enviar cotizaci??n" data-toggle="modal" data-target="#myModal" data-number="303" data-email="david.uqui@hotmail.com"><i class="fa fa-envelope"></i> Enviar Email</a>
														<a class="dropdown-item" href="#" title="Borrar cotizaci??n" onclick="eliminar('230')"><i class="fa fa-trash"></i> Eliminar</a>
													</div>
												</div>
											</td> -->

										</tr>

										<?php
										$i++;
										}
										while($i<sizeof($valor));
										endforeach;
										?>

									</tbody>
								</table>
								<!-- <div class="float-right">
									<nav aria-label="Page navigation example">
										<ul class="pagination">
											<li class="disabled page-item"><span><a class="page-link">??? Anterior</a></span></li>
											<li class="page-item active"><a class="page-link">1</a></li>
											<li class="page-item"><span><a class="page-link">Siguiente ???</a></span></li>
										</ul>
									</nav>
								</div> -->
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