<?php
//https://trello.com/b/OePiF9xp/proyecto-cotizaiones
//header("Location:../ruta/rutas.php?ruta=mostrar&con=nueva");
//$dir="../ruta/rutas.php?ruta=mostrar&con=nueva";
//header('Location:'. $dir);

/* echo "<script> 
var str=decodeURIComponent('../ruta/rutas.php?ruta=mostrar&con=nueva');

window.location=str;

</script>";  */

//echo "<meta http-equiv='refresh' content=1'; url=http://localhost/Sistema_cotizaciones/ruta/rutas.php?ruta=mostrar&con=nueva'>";


/* echo"<script language='JavaScript'>
  var pagina='../ruta/rutas.php?ruta=mostrar&con=nueva'
  var timer=0;
  var valor=1;
  function redireccionar() {
	  location.href=pagina
  }
  

  
  tiempo(valor);
  
  
  function tiempo(val){
	  var aux=val;
	  for(var i=1;i<10;i++){
	  timer=setInterval('redireccionar()', 3000*i);
	  if(valor==1){
		  clearInterval(timer);
	  }
	  aux=2;
	  }
  }
  
</script>"; */





/* echo"<script language='JavaScript'>
var c=0;
(function(){
  var contador=false;
  var pagina='../ruta/rutas.php?ruta=mostrar&con=nueva'
  var intervalo=0;
  var time=0;
  var redireccionar=function(){
	  
		  location.href=pagina;
	  
  
  };

  function random(min, max) {
	  return Math.floor((Math.random() * (max - min + 1)) + min);
  }

  if(c===0){
	  c++;

	  time=500*random(1,3);
	  
	   intervalo=setInterval(redireccionar,time);
	  
	  
  }
  if(contador){
	  intervalo=setInterval(redireccionar,10000);
  }

  
}())
clearInterval(intervalo);
</script>"; 
*/





/* echo"<script>
  setTimeout(function () {
  // Redirigir con JavaScript
  window.location.href= '../ruta/rutas.php?ruta=mostrar&con=nueva';
}50000);
</script>"; */


//header("http://localhost/Sistema_cotizaciones/ruta/rutas.php?ruta=mostrar&con=nueva");
	

	//$active = "active";
	//include_once("layouts/navegacionPendientes.php");
	include('layouts/navAdministracion.php');
	
	
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

	//include_once("layouts/footer.php");
	include('../vista/layouts/piePagina.php');
?>
