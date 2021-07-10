<?php
    include_once ('../modelo/conexionPablo.php');
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $id_administrador=  $_SESSION["usuario"];

    $consulta="SELECT * FROM usuarios s,usuarioconrol c, unidad_gasto u WHERE c.id_usuarios=s.id_usuarios and u.id_gasto=c.id_gasto  and s.id_usuarios='$id_administrador'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $gasto=$resultado->fetchAll(PDO::FETCH_ASSOC);
    
    $consulta="SELECT * FROM usuarios s,usuarioconrol c, unidad_administrativa u WHERE c.id_usuarios=s.id_usuarios and u.id_unidad=c.id_unidad  and s.id_usuarios='$id_administrador'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $administracion=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$id_administrador'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['apellidos']." ".$data2['0']['nombres'];   
    
    $id_unidad=$_SESSION['unidad'];

    $consulta="SELECT * FROM unidad_administrativa a WHERE a.id_unidad='$id_unidad'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $unidad_gasto=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title></title>
    <!-- Bootstrap core CSS -->
    <link href="../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../vista/css/headers.css" rel="stylesheet">
    <script src="../librerias/bootstrap/jjs/bootstrap.bundle.min.js"></script>    
    <script src="../librerias/jquery/jquery-3.3.1.min.js"></script>
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../vista/css/estiloFRU.css" media="screen" />      
  </head>
<body>

<div class="container-fluid">
    <div class="row nav">
        <div class=" col-10">          
            <div class="row">
              <div class="col-10">
                <h4>Sistema de cotizacion</h4>                         
              </div>
              <div class="col-10">
                <h3><?php echo $unidad_gasto[0]['nombre_unidad']?></h3>                         
              </div>
            </div>
        </div>  
        <div class="col-2">
           <div class="dropdown text-end icono">
              <a href="#" class=" link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../recursos/imagenes/usuario.png" alt="mdo" width="32" height="32" class="rounded-circle mt-2">
              </a>
              <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">          
                <li><a class="dropdown-item" href="#"> <?php echo $nombre?></a></li>                
                <li><hr class="dropdown-divider"></li>
                <li><hr class="dropdown-divider"></li>
                <?php 
                if(!empty($administracion)){
                  echo "<li><p class='ml-4'><b>Unidad Administrativa</b></p></li>";
                  foreach($administracion as $ad){
                    $id_unidad=$ad['id_unidad'];
                    echo "<li><a class='dropdown-item' href='../ruta/rutaUsuarios.php?tipo=administracion&id_unidad=".$id_unidad."'>".$ad['nombre_unidad']."</a></li>";
                  }
                }
                ?>
                <li><hr class="dropdown-divider"></li>
                <?php 
                if(!empty($gasto)){
                  echo "<li><p class='ml-4'><b>Unidad de Gasto</b></p></li>";                
                  foreach($gasto as $g){
                    $id_gasto=$g['id_gasto'];
                    echo "<li><a class='dropdown-item' href='../ruta/rutaUsuarios.php?tipo=gasto&id_unidad=".$id_gasto."'>".$g['nombre_gasto']."</a></li>";
                  }
                }
                ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../controladores/cerrarSession.php">Salir</a></li>
              </ul>
            </div>
        </div>    
    </div>      
      <div class="row barra">              
        <div class="color-secondary col">
          <div class="dropdown text-end">
                <p  class="dropdown-toggle mt-2" id="dropdownUser1" data-bs-toggle="dropdown">
                  Solicitudes de pedido
                </p>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">          
                  <li><a class="dropdown-item" href="../ruta/rutas.php?ruta=mostrar&con=nueva">Solicitudes Pendientes</a></li>                  
                  <li><a class="dropdown-item" href="../ruta/rutas.php?ruta=mostrar&con=aceptada">Solicitudes Aceptadas</a></li>
                  <li><a class="dropdown-item" href="../ruta/rutas.php?ruta=mostrar&con=rechazada">Solicitudes Rechazadas</a></li>
                </ul>
          </div>
        </div>
        <div class="color-secondary col">
          <div class="dropdown text-end">
                <p  class="dropdown-toggle mt-2" id="dropdownUser1" data-bs-toggle="dropdown">
                  Solicitudes de cotizaciones
                </p>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">          
                  <li><a class="dropdown-item" href="../ruta/rutas.php?ruta=mostrar&con=cotizando">Evaluar Cotizaciones</a></li>                  
                  <li><a class="dropdown-item" href="../vista/vista_cotizaciones_aceptadas.php">Cotizaciones Aceptadas</a></li>
                  <li><a class="dropdown-item" href="../vista/vista_cotizaciones_rechazadas.php">Cotizaciones Rechazadas</a></li>
                </ul>
          </div>
        </div>
        <div class="color-secondary col">
          <div class="dropdown text-end">
                <p  class="dropdown-toggle mt-2" id="dropdownUser1" data-bs-toggle="dropdown">
                  Empresas
                </p>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">  
                  <li><a class="dropdown-item" href="../vista/formularioRE.php">Registrar Empresas</a></li>                  
                  <li><a class="dropdown-item" href="#">Listado de Empresas</a></li>
                  <li><a class="dropdown-item" href="../vista/empresasSolicitantes.php">Cotizacion Empresas</a></li>
                </ul>
          </div>
        </div>
        <div class="color-secondary col">
          <div class="dropdown text-end">
                <p  class="mt-2">
                  <a href="../vista/seguimientoSolicitudes.php">Buscar Solicitudes</a>
                </p>                
          </div>
      </div>                           
</div>
