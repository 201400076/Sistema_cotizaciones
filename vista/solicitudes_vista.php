<!DOCTYPE html>
<html lang="en">
<?php
    require("../modelo/solicitudes_modelo.php"); 
     $id_usuario=1;
     $pedidos=new Solicitudes();
     $registros=$pedidos->getItems($id_usuario);
     $_POST["nro"]=1;
     $_POST["fecha"]=date("Y-m-d");
     $encargado=$pedidos->getUsuario($id_usuario);  
     $nro=$pedidos->getPedido($id_usuario);
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
  
    <title>Panel de control - Cotizador Web</title>
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

</head>
<body>
<!--
<body class="fix-header card-no-border">
   
    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>
  
    <div id="main-wrapper">
       
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
               
                <div class="navbar-header">
                    <a class="navbar-brand">                        
                        <b>                        
                            <img src="../recursos/imagenes/icono.jpg" alt="homepage" class="light-logo" style="width:34px">
                        </b>                        
                        <span style="">                            
                            <span class="text-white" style=""><b> Sistema de Cotizaciones </b></span>

                        </span>
                    </a>
                </div>              
            </nav>
        </header>
        <aside class="left-sidebar" method="get">        
            <div class="scroll-sidebar">             
                <nav class="sidebar-nav active">
                    <ul id="sidebarnav" class="in">                     
                        <li class="active">                            
                            <ul aria-expanded="false" class="collapse">
                                <li ><a href="../ruta/ruta.php" id="nueva" name="nueva">Home</a></li>
                            </ul>
                        </li>
                        <li class="active">                           
                            <ul aria-expanded="false" class="collapse">
                                <li ><a href="../ruta/rutas.php?ruta=mostrar&con=nueva" id="nueva" name="nueva">Solicitudes Nuevas</a></li>                            
                            </ul>
                        </li>
                    </ul>
                </nav>
                
            </div>
         
        </aside>        
        <div class="page-wrapper" style="min-height: 600px;"> -->
    <h1>Solicitud de Pedido # <?php echo $nro?></h1>
    <h2><?php echo $_POST["fecha"]?></h2>
    <h2> Solicitado por: <?php echo $encargado?></h2>
    <h2></h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div id="tabla">
           <table id="tablaItems">
                <tr>
                    <th class="primeraFila" id="pNro">Nro</th>
                    <th class="primeraFila" id="pCantidad">Cantidad</th>
                    <th class="primeraFila" id="pUnidad">Unidad</th>
                    <th class="primeraFila" id="pDetalle">Detalle</th>
                    <th class="primeraFila" id="pArchivo">Archivo</th>              
                    
                </tr>
                <?php
                    foreach ($registros as $registro):
                ?>
                <tr>
                        <td><?php
                        echo $_POST['nro'];
                        $_POST['nro']++;?></td>
                        <td><?php echo $registro->cantida?></td>
                        <td><?php echo $registro->unidad?></td>
                        <td><?php echo $registro->detalle?></td>
                        <td><?php echo $registro->archivo?></td>    
                                             
                </tr>
                <?php
                    endforeach
                ?>
                <td><input type="text" name='id' size='10' class='centrado' value="<?php echo $_POST['nro'];?>" readonly></td>
                <td><input type="number" name='cantidad' size='10' class='centrado' min="1" max="1000000"></td>
                <td><input type="text" name='unidad' size='10' class='centrado'></td>
                <td><input type="text" name='detalle' size='10' class='centrado'></td>
                <td><input type="file" name='archivo' id='archivo' value="adjuntar" accept=".pdf"></td>
                <td><input type="submit" name='cr' class="cr" value='insertar' id="cr" onclick="validarCampos($_POST['cantidad'])"></td>
            </table>
        </div>
        <div id="justificacion">
            <textarea id="just" name="just" class="just" cols="133" rows="10" placeholder="Justificacion del pedido..."></textarea>
        </div>
        <input type="submit" id="enviarSolicitud" name="enviarSolicitud" value="Enviar y guardar">
    </form>   
</body>
<?php          
    if(isset($_POST["cr"])){                   
        $cantidad=$_POST["cantidad"];
        $unidad=$_POST["unidad"];;
        $detalle=$_POST["detalle"];;
        $archivo=$_FILES["archivo"]["name"];
        $peso=$_FILES["archivo"]["size"];
        $ruta="C:\wamp64\www\proyectos";
        $carpeta="../archivos/";
        if(!empty($cantidad) && $cantidad>0){
            if(!empty($unidad) && ((strlen($unidad)>1 && (strlen($unidad<=10))))){
                $checkArchivo=!empty($archivo);
                $checkDetalle=!empty($detalle) && strlen($detalle)>1 && strlen($detalle<=200);
                if($checkArchivo || $checkDetalle){
                    if(file_exists($carpeta) || @mkdir($carpeta)){
                        $orgien=$_FILES["archivo"]["tmp_name"];
                        $destino=$carpeta.$_FILES["archivo"]["name"];
                        if(@move_uploaded_file($orgien,$destino)){
                            $ruta="archivos/".$_FILES["archivo"]["name"];
                        }
                    }
                    $pedidos->addItemsPendientes($id_usuario,$cantidad,$unidad,$detalle,$archivo,$ruta);  
                    echo "<script language='javascript'>
                    Swal.fire('agrego un item');
                    </script>";
                    header("Location:solicitudes_vista");  
                }else{                    
                    echo "<script language='javascript'>
                    Swal.fire('debe ingresar un detalle o un archivo');
                    </script>";        
                }
            }else{
                echo "<script language='javascript'>
                Swal.fire('Debe introducir una unidad validad');
                </script>";
            }           
        } else{
            echo "<script language='javascript'>
                Swal.fire('Debe introducir una cantidad valida!');
                </script>";
        }    
    }
    if(isset($_POST["enviarSolicitud"])){
        $fecha=$_POST["fecha"];
        $justificacion=$_POST["just"];
        $tamPedido=$pedidos->getTamPedido($id_usuario);
        if($tamPedido>0){
            echo "<script language='javascript'>
                    Swal.fire('Su pedido fue eviado exitosamente!');
                    </script>"; 
            $pedidos->addPedido($fecha,$justificacion,$id_usuario);                       
        }else{
            echo "<script language='javascript'>
                    Swal.fire('Debe ingresar al menos un item!');
                    </script>";
        }
        
    }
    
?>
<!--<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>-->
</html>