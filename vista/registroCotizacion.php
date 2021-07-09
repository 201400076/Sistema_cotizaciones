<?php
    session_start();
    $estado=$_GET['estado'];
    if($estado=='empresa'){
        include('layouts/navEmpresa.php'); 
    }else{
        include('../vista/layouts/navAdministracion.php'); 
    }
    $id_solicitud=$_GET['solicitud'];
    $id_empresa=$_GET['empresa'];
    $nombre=$_GET['nombre'];
    $id_pendientes=1;
    $consulta="SELECT i.id_items,i.cantidad, i.unidad,i.detalle,i.archivo,i.ruta FROM solicitudes s, pedido p, items i WHERE (s.id_pedido=p.id_pedido && p.id_pedido=i.id_pedido) && s.id_solicitudes='$id_solicitud'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta="SELECT i.descripcion,i.marca,i.modelo,i.precio_parcial,i.id_items,i.precio_unitario FROM cotizacion_items i, solicitudes s WHERE i.id_solicitudes=s.id_solicitudes and i.id_solicitudes='$id_solicitud' and i.id_empresa='$id_empresa'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data1=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="#" />  
<title></title>
  
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../librerias/css/bootstrap.min.css">
<!-- CSS personalizado --> 
<link rel="stylesheet" href="css/estilosSolicitud.css">  
  
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" type="text/javascript" href="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
<!--datables CSS básico-->
<link rel="stylesheet" type="text/css" href="../librerias/datatables/datatables.min.css"/>
<!--datables estilo bootstrap 4 CSS-->  
<link rel="stylesheet"  type="text/css" href="../librerias/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">       
<script src="../librerias/js/sweetalert2.all.min.js"></script>
</head>

<body> 

<div class="container-fluid">
    <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">        
                    <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead class="text-center">
                        <tr>                
                            <th>id_items</th>
                            <th>cantidad</th>
                            <th>unidad</th>                                
                            <th>detalle</th>  
                            <th>archivo</th>  
                            <th>marca</th>  
                            <th>modelo</th>  
                            <th>descripcion</th>  
                            <th>p/unitario</th>  
                            <th>p/parcial</th>  
                            <th>Acciones</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php                            
                        foreach($data as $dat) {                                                        
                        ?>                            
                        <tr>                            
                            <td><?php echo $dat['id_items'] ?></td>
                            <td><?php echo $dat['cantidad'] ?></td>
                            <td><?php echo $dat['unidad'] ?></td>
                            <td><?php echo $dat['detalle'] ?></td>                            
                            <td>
                                <a target='_black' href="/Sistema_cotizaciones/<?php echo $dat['ruta']?>" type='button'> <?php echo $dat['archivo']?> </a>        
                            </td>
                            <?php  
                            $item_cotizacion=false;                          
                            foreach($data1 as $d) {                                                        
                                if($dat['id_items']==$d['id_items']){
                                    echo "<td>".$d['descripcion']."</td>";
                                    echo "<td>".$d['marca']."</td>";
                                    echo "<td>".$d['modelo']."</td>";
                                    echo "<td>".$d['precio_unitario']."</td>";
                                    echo "<td>".$d['precio_parcial']."</td>";                                        
                                    echo "<td></td>";
                                    $item_cotizacion=true;
                                    break;
                                }
                            }
                            if(!$item_cotizacion){
                                echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";
                                    echo "<td></td>";                                                                            
                                    echo "<td></td>";                                                                            
                            }
                            ?>                            
                            
                        </tr>                        
                        <?php
                            }
                        ?>                                
                    </tbody>        
                   </table>                    
                </div>
            </div>
    </div>  
    <div class="container-fluid">
        <div class="form-group" style="width:100%">    
            <div class="col-12">
                <button type="button" id="btnEnviar" class="btn btn-dark text-center btn-block mt-2 mb-2 btnEnviar" data-toggle="modalJust">ENVIAR Y GUARDAR</button>
            </div>
        </div>
    </div>
</div>    
  
<!--Modal para CRUD-->
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
                <label for="descripcion" class="col-form-label">DESCRIPCION:</label>
                <input type="text" class="form-control descripcion" id="descripcion">
            </div>  
            <div class="form-group">
                <label for="unit" class="col-form-label">PRECIO UNITARIO:</label>
                <input type="number" class="form-control unit" oninput="calcular()" step="0.001" id="unit" min=1 max=1000000>
            </div>                
            <div class="form-group">
                <label for="cantidad" class="col-form-label">CANTIDAD:</label>
                <input type="number" class="form-control cantidad"  readonly="readonly"  oninput="calcular()" id="cantidad">       
            </div>
            <div class="form-group">
                <label for="total" class="col-form-label">PRECIO PARCIAL:</label>
                <input type="number" class="form-control total"  readonly="readonly" oninput="calcular()" id="total">        
            </div>                         
            <div class="form-group">
                <label for="marca" class="col-form-label">MARCA:</label>
                <input type="text" class="form-control marca" id="marca">
            </div>  
            <div class="form-group">
                <label for="modelo" class="col-form-label">MODELO:</label>
                <input type="text" class="form-control modelo" id="modelo">
            </div>  
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">CANCELAR</button>
            <button type="submit" id="btnGuardar" class="btn btn-dark">INSERTAR</button>
        </div>
    </form>    
    </div>
</div>
</div>    

<!-- jQuery, Popper.js, Bootstrap JS -->
<script src="../librerias/jquery/jquery-3.3.1.min.js"></script>
<script src="../librerias/popper/popper.min.js"></script>
<script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
  
<!-- datatables JS -->
<script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
<script>
    var id_solicitud = '<?php echo $id_solicitud?>';
    var id_empresa = '<?php echo $id_empresa?>';
    var nombre_usu = '<?php echo $nombre?>';
    var estado = '<?php echo $estado?>';
</script>
<script type="text/javascript" src="../controladores/controladorCotizaaciones.js"></script>  


</body>
<script type="text/javascript">
    function calcular(){
        try {          
            if(document.getElementById("unit").value>0){
                console.log();
                console.log(parseFloat(document.getElementById("cantidad").value));
                var a = parseFloat(document.getElementById("cantidad").value) || 0,
                b = parseFloat(document.getElementById("unit").value) || 0;
                document.getElementById("total").value=a*b;
            }else{
                alert("solo puede ingresar valores mayores a 0");
            }
        } catch (error) {
            console.log(error);
        }
    }
</script>
</html>


