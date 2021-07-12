<?php
    session_start();
    $unidadAdmin = $_SESSION['unidad'];
    include("layouts/navAdministracion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="../librerias/css/blue.css" id="theme" rel="stylesheet">
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
    <title>Busqueda de Empresas</title>
    <link rel="stylesheet"  type="text/css" href="../librerias/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css"> 
    <style>
        td{
            text-align: center;
            height: auto;
        }
    </style>  
</head>
<body class="fix-header card-no-border">
    <?php
        $consulta="SELECT * FROM empresas, rubros where empresas.rubro=rubros.id_rubro order by empresas.id_empresa ASC";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $empresas=$resultado->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <section class="mt-4">
        <div class="row">
            <div class="col-lg-12">
                <h2>Busqueda de Cotizaciones</h2>
            </div>
        </div>
    </section>


    <div class="container-fluid">
            <div class="col-md-12">
                <div class="card" >
                    <div class="card-body" >
                        <div class="row">
                                <div class="outer_div" style="width:90%;margin: auto;">
                                    <div class="table-responsive">        
                                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed table-hover table-sm" style="width:100%">
                                            <thead class="text-center">
                                                <tr>
                                                    <th>ID EMPRESA</th>
                                                    <th>NOMBRE</th>
                                                    <th>CORREO</th>
                                                    <th>RUBRO</th>                                                              
                                                    <th>NIT</th>                                                              
                                                    <th>TELEFONO</th>                                                              
                                                    <th>DIRECCION</th>                                                              
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php                                         
                                            foreach($empresas as $e){
                                                echo "<tr>
                                                        <td>".$e['id_empresa']."</td>
                                                        <td>".$e['nombre_empresa']."</td>
                                                        <td>".$e['correo_empresa']."</td>
                                                        <td>".$e['nombre_rubro']."</td>
                                                        <td>".$e['nit']."</td>
                                                        <td>".$e['telefono']."</td>
                                                        <td>".$e['direccion']."</td>
                                                
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
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>  
    </div>
    <script src="../librerias/popper/popper.min.js"></script>
    <script src="../librerias/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../librerias/datatables/datatables.min.js"></script>    
    <script type="text/javascript" src="../controladores/controladorVistaDetalle.js"></script>  
</body>
<?php
    //include_once("../vista/layouts/piePagina.php");
?>
</html>
