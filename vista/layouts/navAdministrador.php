<?php
    session_start();
    require_once ('../../modelo/conexionPablo.php');
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    $administrador=  27;//$_SESSION["usuario"];

    $consulta="SELECT * FROM usuarios s,usuarioconrol c, unidad_gasto u WHERE c.id_usuarios=s.id_usuarios and u.id_gasto=c.id_gasto  and s.id_usuarios='$administrador'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $gasto=$resultado->fetchAll(PDO::FETCH_ASSOC);
    
    $consulta="SELECT * FROM usuarios s,usuarioconrol c WHERE c.id_usuarios=s.id_usuarios  and s.id_usuarios='$administrador'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $administracion=$resultado->fetchAll(PDO::FETCH_ASSOC);

    $consulta="SELECT nombres,apellidos FROM usuarios WHERE usuarios.id_usuarios='$administrador'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data2=$resultado->fetchAll(PDO::FETCH_ASSOC);
    $nombre=$data2['0']['nombres'];   

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
    <link href="../../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../../vista/css/headers.css" rel="stylesheet">
    <script src="../../librerias/bootstrap/jjs/bootstrap.bundle.min.js"></script>    
    <script src="../../librerias/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../librerias/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../vista/css/estiloFRU.css" media="screen" />      
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
                <h3>Administrador del Sistema</h3>                         
              </div>
            </div>
        </div>  
        <div class="col-2">
           <div class="dropdown text-end icono">
              <a href="#" class=" link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../../recursos/imagenes/usuario.png" alt="mdo" width="32" height="32" class="rounded-circle mt-2">
              </a>
              <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">          
                <li><a class="dropdown-item" href="#"> <?php echo $nombre?></a></li>                
                <li><hr class="dropdown-divider"></li>
                <li><hr class="dropdown-divider"></li>
                <?php 
                  echo "<li><p class='ml-4'><b>Administrador de sistema</b></p></li>";
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
                  Unidades administrativas
                </p>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">          
                  <li><a class="dropdown-item" href="#">Crear unidad administrativa</a></li>                  
                  <li><a class="dropdown-item" href="#">Listar uniadades administrativas</a></li>
                </ul>
          </div>
        </div>
        <div class="color-secondary col">
          <div class="dropdown text-end">
                <p  class="dropdown-toggle mt-2" id="dropdownUser1" data-bs-toggle="dropdown">
                  Unidades de gasto
                </p>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">          
                <li><a class="dropdown-item" href="#">Crear unidad de gasto</a></li>                  
                  <li><a class="dropdown-item" href="#">Listar uniadades de gasto</a></li>
                </ul>
          </div>
        </div>
        <div class="color-secondary col">
          <div class="dropdown text-end">
                <p  class="dropdown-toggle mt-2" id="dropdownUser1" data-bs-toggle="dropdown">
                  Usuarios
                </p>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">  
                  <li><a class="dropdown-item" href="../vista/formularioRE.php">Crear usuario</a></li>                  
                  <li><a class="dropdown-item" href="../vista/ListadoEmpresas.php">Listar usuarios</a></li>
                  <li><a class="dropdown-item" href="../vista/ListadoEmpresas.php">Asignar rol a usuarios</a></li>
                </ul>
          </div>
        </div>                           
</div>
