<div class="container-fluid">


	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Solicitudes Rechazadas</h4>
					
					<div class="row">

						<div id="resultados" class="col-sm-12 "></div>
						<div class="outer_div" style="width:100%">
							<div class="table-responsive">
								<table class="table">
									<tbody>
										<tr align="center"class="warning">
											<th>#</th>
											<th>Fecha</th>
											<th>Detalle</th>
											<th>Departamento</th>
											<th>Unidad</th>
											<th>Estado</th>
											
											<th class="text-right">Acciones</th>

										</tr>
										<tr align="center">
											<td>10</td>
											<td>07-04-2021</td>
											<td>
												Compra de Sillas<br>
												
												<div class="text-center">
 													<a href=""> <img src="../recursos/imagenes/pdf.png" class="rounded" alt="chania" width="25" heigth="25"></a>
												</div>
											</td>
											<td>
												Inf - Sistemas
											</td>
											
											<td>MEMI</td>
											<td>
												<span class="label label-danger">Rechazado</span>


											<td class="text-right">
												<div class="btn-group dropleft">
													<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														Acciones
													</button>
													<div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 37px, 0px); top: 0px; left: 0px; will-change: transform;">
														<a class="dropdown-item" href="editar_cotizacion.php?id=230" title="Editar cotización"><i class="fa fa-edit"></i> Editar</a>
														<a class="dropdown-item" href="#" title="Imprimir cotización" onclick="descargar('303');"><i class="fa fa-print"></i> Imprimir</a>
														<a class="dropdown-item" href="#" title="Enviar cotización" data-toggle="modal" data-target="#myModal" data-number="303" data-email="david.uqui@hotmail.com"><i class="fa fa-envelope"></i> Enviar Email</a>
														<a class="dropdown-item" href="#" title="Borrar cotización" onclick="eliminar('230')"><i class="fa fa-trash"></i> Eliminar</a>
													</div>
												</div>
											</td>

										</tr>
									</tbody>
								</table>
								<div class="float-right">
									<nav aria-label="Page navigation example">
										<ul class="pagination">
											<li class="disabled page-item"><span><a class="page-link">‹ Anterior</a></span></li>
											<li class="page-item active"><a class="page-link">1</a></li>
											<li class="page-item"><span><a class="page-link">Siguiente ›</a></span></li>
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




</div>