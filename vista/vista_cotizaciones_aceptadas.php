<?php
	session_start();
	$id_unidadAdmin=$_SESSION['unidad'];
	include('layouts/navAdministracion.php');
    include('../configuraciones/conexion.php');
    $conn = new Conexiones();
    $estadoConexion = $conn->getConn();
    $cotizaciones = " SELECT * FROM pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto,solicitudes_cotizaciones 
							WHERE solicitudes.id_solicitudes=solicitudes_cotizaciones.id_solicitudes AND pedido.id_pedido=solicitudes.id_pedido
									AND usuarios.id_usuarios=pedido.id_usuarios	AND usuarios.id_usuarios=usuarioconrol.id_usuarios
									AND usuarioconrol.id_gasto=unidad_gasto.id_gasto AND solicitudes_cotizaciones.estado_cotizacion='aceptada'
									AND pedido.id_unidad=".$id_unidadAdmin." order by solicitudes_cotizaciones.fecha_evaluacion desc";
	$queryCotizaciones=$estadoConexion->query($cotizaciones);
?>
<style>
    td{
        text-align: center;
    }
</style>
<div class="container-fluid">
<h2 class="card-title" style="text-align: center;"><strong>COTIZACIONES ACEPTADAS</strong></h2>
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
											<!--<th>Id Cotizacion</th>-->
											<th>Nro</th>
                                            <th>Id Solicitud</th>
                                            <th>Unidad Gasto</th>
											<th>Solicitante</th>
											<th>Fecha-Evaluacion</th>
											<th>Nro Cotizaciones</th>
											<th>Estado</th>
											<th>Informe</th>
											<th>Detalle</th>
										</tr>

										<?php
											$aux = 1;
                                            while($registroCotizaciones=$queryCotizaciones->fetch_array(MYSQLI_BOTH)){
                                                echo "<tr>
                                                        <td>".$aux."</td>
                                                        <td>".$registroCotizaciones['id_solicitudes']."</td>
                                                        <td>".$registroCotizaciones['nombre_gasto']."</td>
														<td>".$registroCotizaciones['nombres']."</td>";
                                                        $idSol = $registroCotizaciones['id_solicitudes'];
														$idSolCot=$registroCotizaciones['id_solicitud_cotizacion'];
                                                echo    "<td>".$registroCotizaciones['fecha_evaluacion']."</td>
                                                        <td>".$registroCotizaciones['cantidad_cotizaciones']."</td>
														<td><span class='label label-success'>".$registroCotizaciones['estado_cotizacion']."</span></td>
                                                        <td><a class='btn btn-info' target='_blank' href='../vista/informeCotizaciones.php?id=$idSol&tipo=a'>Ver Informe</a></td>
														<td><a class='btn btn-info' target='_blank' href='../vista/vistaPDFCuadroComparativo.php?id_solicitud=$idSol& id_solicitud_cotizacion=$idSolCot'>Ver Cuadros</a></td>
                                                    </tr>";
													$aux++;
                                            } 
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