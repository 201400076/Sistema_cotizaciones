<?php
    require_once("../modelo/solicitudes_administracion.php");        
    $id_usuario=1;
    $id_pedido=114;
    $id_solicitud=2;
    
    include_once '../modelo/conexionPablo.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $id_pendientes=1;
    $consulta="SELECT id_pedido,cantidad,unidad,detalle,archivo,ruta FROM items WHERE items.id_pedido='$id_pedido'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_pendientes'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];

    $consulta="SELECT fecha,justificacion FROM pedido WHERE pedido.id_pedido='$id_pedido'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data3=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $fecha=$data3['0']['fecha'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->    
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link href="../librerias/css/styles.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="../librerias/css/blue.css" id="theme" rel="stylesheet">
    <link rel="icon" href="assets/images/cart_icon2.png">
    <!--alerts CSS -->
 
    <link href="../librerias/css/topbar.css">
    <link rel="stylesheet" href="../librerias/css/miestilo.css">
    <link rel="stylesheet" href="../librerias/css/miestilogasto.css">
    
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
    <title>solicitud de pedido</title>
    <link rel="stylesheet" href="css/estilosSolicitud.css?v=<?php echo(rand()); ?>" />
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../librerias/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <!--<link rel="stylesheet" href="css/estilosSolicitud.css">  -->
      
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="../librerias/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="../librerias/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">       

</head>
<body class="fix-header card-no-border">   

    <section class="mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h2>Solicitado por:  <?php echo $nombre?></h2>
            </div>
            <div class="col-lg-12">
                <h2>Fecha de solicitud:  <?php echo $fecha?></h2>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-dark" data-toggle="modal">Justificacion</button>    
            </div>    
        </div>    
    </div> 

    <div class="container mt-4 mb-4">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>id_pendientes</th>
                                <th>cantidad</th>
                                <th>unidad</th>                                
                                <th>detalle</th>  
                                <th>archivo</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>                            
                            <tr>
                                <td><?php echo $dat['id_pedido'] ?></td>
                                <td><?php echo $dat['cantidad'] ?></td>
                                <td><?php echo $dat['unidad'] ?></td>
                                <td><?php echo $dat['detalle'] ?></td>                                  
                                <td><a target='_black' href="/proyectos/<?php echo $dat['ruta']?>" type='button'> <?php echo $dat['archivo']?> </a>        
                                </td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    


    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">                       
                <div class="form-group">  
                        
                    <?php 
                    if($data3['0']['justificacion']==''){
                        echo "<p class='text-secondary'>No hay ninguna justificacion!!!</p>";
                    }else{
                        echo "<p>".$data3['0']['justificacion']."</p>";
                    }                
                    ?>
                    </p>                  
                    
                </div>                           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-block" data-dismiss="modal">Atras</button>                
            </div>
        </form>    
        </div>
    </div>
</div>  


<!-- MARCO  -->
    <?php
        if(isset($_POST["ej"])){
            
        }
    ?>

<div class="row">
    <div class="col-lg-12 botones">
        <button class="btn-success" id="botonAceptar">Aceptar</button>
        <button class="btn-danger" id="botonRechazar">Rechazar</button>
        <button class="btn-dark" id="botoCancelar" onClick="window.parent.location='../ruta/rutas.php?ruta=mostrar&con=nueva'" value="Cancelar">Cancelar</button>
    </div>
</div>

<script>
    var id = '<?php echo($id_sol);?>';
    var id_pedido = '<?php echo($id_ped);?>';
    var id_usuario = '<?php echo($id_usu);?>';
    var montoSolicitud = '<?php echo($monto_solicitud);?>';
    var montoUnidad = '<?php echo($monto_unidad);?>';
</script>
<script src="../controladores/evaluarPedidoSolicitud.js"></script>

<script src="../librerias/jquery/jquery-3.3.1.min.js"></script>
    <script src="../librerias/popper/popper.min.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="../controladores/controladorVistaDetalle.js"></script>  
    
</body>
</html>