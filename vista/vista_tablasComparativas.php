<?php
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas Comparativas</title>
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
</head>
<body>
    <?php
        //$active = "";
        //require_once '../vista/layouts/navegacionPendientes.php';
        require_once('../configuraciones/conexion.php');
        //require_once('../controladores/solicitudesController.php');
        require_once('../controladores/controlador_tablasComparativas.php');
        
        //$id_usuario=$_GET['id_usuario'];
        //$id_pedido=$_GET['id_pedido'];
        $id_solicitud=$_GET['id_solicitud'];

        $conn = new Conexiones();
        $estadoConexion = $conn->getConn();
        $cotizaciones = "SELECT * FROM solicitudes_cotizaciones WHERE id_solicitudes = ".$id_solicitud."";
        $queryCoti=$estadoConexion->query($cotizaciones);
        $registro=$queryCoti->fetch_array(MYSQLI_BOTH);
        //echo $registro['id_solicitud_cotizacion'];

        $empresas = "SELECT * FROM usuario_cotizador, empresas WHERE id_solicitudes=".$id_solicitud." AND empresas.id_empresa=usuario_cotizador.id_empresa";
        $queryEmpresas=$estadoConexion->query($empresas);

        session_start();
        $unidadAdmin = $_SESSION['unidad'];
        include("layouts/navAdministracion.php");
    ?>
    <h1 style="text-align: center;">Tablas Comparativas</h1>
    <h2 style="text-align: center;">Solicitud de Cotizacion #<?php echo $id_solicitud;?></h2>

    <div class="container-fluid">
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
                                            <th>Id_Item</th>
											<th>Cantidad</th>
											<th>Unidad</th>
											<th>Detalle</th>
											<!-- <th>Detalle</th>
											<th>Departamento</th>
											<th>Unidad</th> -->

											<th>Archivo</th>
                                            
										<?php
                                        foreach($data2 as $ne){
                                            echo"<th>".$ne['nombre_empresa']."</th>";
                                        }
                                        ?>
										
											<!-- <th class="text-right">Acciones</th> -->

										</tr>
								
										<?php
                                         
                                     

                                        /*  $id_solicitud=$_GET['id_solicitud'];
                                        
                                        
                                        $solicitud =new Solicitud();
                                        $dato = $solicitud->mostrar("cotizacion_items ci, items i,empresas e ","ci.id_items=i.id_items 
                                                                                                                AND e.id_empresa=ci.id_empresa
                                                                                                                AND id_solicitudes=".$id_solicitud.""); 
                                        
                                            $rep=0;
                                        	 $i=0;
                                             $aux=0;
                                             $precioParcial=array();
                                            foreach($dato as $valor):
                                             do{  */
                                           
                                            $aux;
                                            $aux2=0;
                                            $id2=0;
                                            $valores=array();
                                                foreach($data as $a){
                                                    $id=$a['id_items'];
                                            
                                                    echo"<tr align='center'>";
                                                    echo "<td>". $a['id_items']."</td>";
                                                    echo "<td>". $a['cantidad']."</td> ";
                                                    echo" <td>". $a['unidad']."</td>";
                                                    echo" <td>". $a['detalle']."</td>\n";
                                                    if($a['archivo']==null){
                                                        echo"<script> function demoA () { alert('No existe ningun archivo'); }</script>";
                                                        echo" <td> <a href='' value='Alert' onclick='demoA()'>archivo.pdf</a></td>";
                                                        //echo"<input type='button' value='Alert' onclick='demoA()'";
                                                        
                                                        
                                                    }
                                                    else{
                                                        echo" <td> <a target='black' href='../archivos/".$a['archivo']."'>archivo.pdf</a></td>";
                                                    }
                                                   
                                                   // var_dump($a['archivo']);
                                                    
                                                    $id2++;
                                                    //echo $a['id_items'].'--';
                                                    foreach($data1 as $d){
                                                        if($d['id_items']==$id){
                                                           

                                                            $aux="<td>".$d['precio_parcial']."</td>";
                                                            echo $aux;
                                                            
                                                           
                                                            $valores[]=(int)$d['precio_parcial'];
                                                           // echo count(array($valores));
                                                          //var_dump($valores);
                                                        
                                                            
                                                        }
                                                       // echo $aux;

                                        ?>
		<!-- 								<tr align="center">
                                            <td><?php echo($a['id_items'])?></td>
											<td><?php echo($a['cantidad'])?></td>
											<td><?php echo($a['unidad'])?></td>
											<td><?php echo($a['detalle'])?></td>

											<td><a href="#">Archivo.pdf</a></td>	
											<td><?php echo($d['precio_parcial'])?></td>		
											
											
												
											<td><?php echo($d['precio_parcial'])?></td>

                                            <td><?php echo($d['precio_parcial'])?></td>
											
											
											<td></td>
                                            <td></td>

											

										</tr> -->

										<?php
                                           
                                        }
                                       // echo $id2;
                                         echo"</tr>";
                                        
                                    } 
                                  /*   function revisarPdf($archivo){
                                        foreach($data as $aux){
                                        
                                        if($archivo==null){
                                            echo"<script language='javascript'>alert('Que haces mijo');</script>";
                                        }
                                        else{
                                            echo $a['archivo'];
                                        }
                                    }
                                    } */
																			
										?>

                                    
									<tbody>
                                        <tbody>
                                        <tr align="center"class="warning">
                                            <th>Totales</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        <?php
                                        $suma=0;
                                        $tam=sizeof($valores)/2;
                                        $tam2=sizeof($valores);
                                        $tamAux=$tam;
                                        for($i=0;$i<$tam;$i++){
                                            for($j=$tamAux;$j<$tam2;$j++){
                                            //var_dump(sizeof($valores));
                                                $suma=$valores[$i]+$valores[$j];
                                                echo "<th>".$suma."</th>";

                                                $suma=0;
                                                $j+=$tam;
                                                //var_dump(sizeof($valores)/$id2);
                                            }
                                            $tamAux++;
                                        }
                                        ?>

                                       <!--  <th><?php echo $suma;?></th>  -->     
											
                                            
                                            <!-- <th class="text-right">Acciones</th> -->

										</tr>
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



<div>
<div class="col-lg-11" style="text-align: right;">
            <a class="btn btn-info" target="_blank" href="../vista/vistaPDFCuadroComparativo.php?id_solicitud=<?php echo $id_solicitud;?>">Generar PDF</a>
        </div>

</divS>

    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <label for="empresasCotizadoras">Seleccione la Empresa Adjudicada a la Cotizacion:</label><br>
            <select name="empresasCotizadoras" id="empresasCotizadoras">
                <?php
                    while($listaEmpresas=$queryEmpresas->fetch_array(MYSQLI_BOTH)){
                        $empresaActualNombre = $listaEmpresas['nombre_empresa'];
                        $idEmpresaActual = $listaEmpresas['id_empresa'];
                        echo "<option value=".$idEmpresaActual.">".$empresaActualNombre."</option>";
                    }
                ?>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <button class="btn btn-success" id="botonAceptar">ACEPTAR</button>
            <button class="btn btn-danger" id="botonRechazar">RECHAZAR</button>
            <button class="btn btn-secondary" id="botonCancelar" value="Cancelar">CANCELAR</button>
        </div>
    </div>

    <script>
        var id = '<?php echo $_GET['id_solicitud']?>';
    </script>
    <script src="../controladores/evaluarCotizacion.js"></script>
</body>
<?php
    include_once("../vista/layouts/piePagina.php");
?>
</html>