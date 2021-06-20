<?php
$active = "";
	include_once("layouts/navegacionPendientes.php");

    require_once('../configuraciones/conexion.php');
    $conn = new Conexion();
    $estadoConexion = $conn->getConn();
    //$cotizaciones = "SELECT * FROM solicitudes_cotizaciones WHERE solicitudes_cotizaciones.estado_cotizacion='aceptada'";
    $cotizaciones = " SELECT * FROM pedido,solicitudes,usuarios,usuarioconrol,unidad_gasto,solicitudes_cotizaciones WHERE solicitudes.id_solicitudes=solicitudes_cotizaciones.id_solicitudes
																															AND pedido.id_pedido=solicitudes.id_pedido
																															AND usuarios.id_usuarios=pedido.id_usuarios
																															AND usuarios.id_usuarios=usuarioconrol.id_usuarios
																															AND usuarioconrol.id_gasto=unidad_gasto.id_gasto
																															AND solicitudes_cotizaciones.estado_cotizacion='rechazada'
																															order by solicitudes_cotizaciones.fecha_evaluacion desc";
	$queryCotizaciones=$estadoConexion->query($cotizaciones);
?>
<style>
    td{
        text-align: center;
    }
</style>
<div class="container-fluid">
<h2 class="card-title" style="text-align: center;"><strong>COTIZACIONES RECHAZADAS</strong></h2>
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
											<!-- <th>#</th> -->
											<th>Id Cotizacion</th>
                                            <th>Id Solicitud</th>
                                            <th>Unidad</th>
											<th>Fecha-Evaluacion</th>
											<th># Cotizaciones</th>
											<th>Estado</th>
											<th>Accion</th>

										</tr>

										<?php
                                        function direccionar($tipo, $estado){
                                            $res = '';
                                            if($tipo == 'pedido'){
                                                if($estado == 'aceptada'){
                                                    $res = '../ruta/rutas.php?ruta=mostrar&con=aceptada';
                                                }else if($estado == 'rechazada'){
                                                    $res = '../ruta/rutas.php?ruta=mostrar&con=rechazada';
                                                }else if($estado == 'pendiente'){
                                                    $res ='../ruta/rutas.php?ruta=mostrar&con=nueva';
                                                }  
                                            }else if($tipo == 'cotizacion'){
                                                if($estado == 'aceptada'){
                                                    //$res = '../ruta/rutas.php?ruta=mostrar&con=aceptada';
                                                }else if($estado == 'rechazada'){
                                                    //$res = '../ruta/rutas.php?ruta=mostrar&con=rechazada';
                                                }else if($estado == 'cotizando'){
                                                    $res = '../ruta/rutas.php?ruta=mostrar&con=cotizando';
                                                }
                                            }  
                                            return $res;    
                                        }


                                        while($registroCotizaciones=$queryCotizaciones->fetch_array(MYSQLI_BOTH)){
                                            
                                            echo "<tr>
                                                    <td>".$registroCotizaciones['id_solicitud_cotizacion']."</td>
                                                    <td>".$registroCotizaciones['id_solicitudes']."</td>";
                                                    $idSol = $registroCotizaciones['id_solicitudes'];
                                            echo    "<td>".$registroCotizaciones['nombre_gasto']."</td>
                                                    <td>".$registroCotizaciones['fecha_evaluacion']."</td>
                                                    <td>".$registroCotizaciones['cantidad_cotizaciones']."</td>
													<td><span class='label label-danger'>".$registroCotizaciones['estado_cotizacion']."</span></td>
                                                    <td><a class='btn btn-info' target='_blank' href='../vista/informeCotizaciones.php?id=$idSol&tipo=r'>Ver Informe</a></td>
                                                </tr>";
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

<?php include_once("layouts/footer.php");?>