<?php
$active = "";
	include_once("layouts/navegacionPendientes.php");

    require_once('../configuraciones/conexion.php');
    $conn = new Conexion();
    $estadoConexion = $conn->getConn();
    $cotizaciones = "SELECT * FROM solicitudes_cotizaciones WHERE estado_cotizacion='aceptada'";
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
											<!-- <th>#</th> -->
											<th>Id Cotizacion</th>
                                            <th>Id Solicitud</th>
                                            <th>Estado</th>
											<th>Fecha-Evaluacion</th>
											<th>Detalle</th>
											<th># Cotizaciones</th>
											
											
											<!-- <th class="text-right">Acciones</th> -->

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

                                            function obtenerUnidad($solicitud){
                                                //$unidadGasto = "SELECT S.nombre_gasto FROM solicitudes As S, pedido As P, usuarioconrol As U, unidad_gasto UG WHERE ".$solicitud."=S.id_solicitudes AND S.id_solicitudes" 
                                                //$querySolicitudes=$estadoConexion->query($solicitudes);
                                            }

                                            while($registroCotizaciones=$queryCotizaciones->fetch_array(MYSQLI_BOTH)){
                                                echo "<tr>
                                                        <td>".$registroCotizaciones['id_solicitud_cotizacion']."</td>
                                                        <td>".$registroCotizaciones['id_solicitudes']."</td>
                                                        <td>".$registroCotizaciones['estado_cotizacion']."</td>
                                                        <td>".$registroCotizaciones['fecha_evaluacion']."</td>
                                                        <td>".$registroCotizaciones['detalle']."</td>
                                                        <td>".$registroCotizaciones['cantidad_cotizaciones']."</td>
                                                        <td><a class='btn btn-info' target='_top' href=".direccionar('cotizacion',$registroCotizaciones['estado_cotizacion']).">Ver Informe</a></td>
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

<?php
include_once("layouts/footer.php");

?>