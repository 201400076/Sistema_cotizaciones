
<?php
$active = "active";

	include_once("layouts/navegacion.php");
	
	
	
?>	
<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Solicitudes Pendientes</h4>
					
					<div class="row">

						<div id="resultados" class="col-sm-12 "></div>
						<div class="outer_div" style="width:100%">
							<div class="table-responsive">
								<table class="table">
									<tbody>
										<tr align="center"class="warning">
											<th>#</th>
											<th>Fecha</th>
											<!-- <th>Detalle</th>
											<th>Departamento</th>
											<th>Unidad</th> -->

											<th>Solicitante</th>
											<th>Unidad</th>
											<th>Estado</th>
											<th>Detalle</th>
										
											<!-- <th class="text-right">Acciones</th> -->

										</tr>
								
										<?php
									 	
										$i=0;
										foreach($dato as $valor):
										do{
									
										
										?>
										<tr align="center">
											<td><?php echo $i+1?></td>
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
									
												<a class="btn btn-info" target="_top" href="../vista/vista_detalle.php">Ver Detalle</a>
											</td>

											<!-- <td class="text-right">
												<div class="btn-group dropleft">
													<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Acciones
													</button>
													<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
														<a class="dropdown-item" href="editar_cotizacion.php?id=230" title="Editar cotización"><i class="fa fa-edit"></i> Aceptar</a>
														<a class="dropdown-item" href="#" title="Imprimir cotización" onclick="descargar('303');"><i class="fa fa-print"></i> Rechazar</a>
							
													</div>
												</div>
											</td> -->

										</tr>


									<!-- ################segunda fila manual de momento -->
								


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
											<li class="disabled page-item"><span><a class="page-link">‹ Siguiente</a></span></li>
											<li class="page-item active"><a class="page-link">1</a></li>
											<li class="page-item"><span><a class="page-link">Anterior ›</a></span></li>
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

include_once("layouts/footer.php");

?>
