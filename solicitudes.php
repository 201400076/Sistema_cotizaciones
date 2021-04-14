<?php
    require('conexion.php');
    $solicitudes=new Conexion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Solicitudes de cotizacion</h1>
    <input type="date" name="fecha">
    <h2>Nº Numero de pedido</h2>
    <h2>Solicitado por proyecto:   </h2>
    <table width = "50%" border="0">
        <tr>
            <td class="primeraFila">Nro</td>
            <td class="primeraFila">Cantidad</td>
            <td class="primeraFila">Unidad</td>
            <td class="primeraFila">Detalle</td>
            <td class="primeraFila">Adjuntar Arhivo</td>
        </tr>
        <td><input type="text" name='nro' size='10' class='centrado'></td>
        <td><input type="text" name='cantidad' size='10' class='centrado'></td>
        <td><input type="text" name='unidad' size='10' class='centrado'></td>
        <td><input type="text" name='detalle' size='10' class='centrado'></td>
        <td><input type="submit" name='adjuntar' size='10' value='adjuntar' class='centrado'></td>
        <td><input type="submit" name='Insertar' size='10' value='insertar'class='centrado'></td>
    </table>
    <input type="submit">
    <h1>Proyecto</h1>
</body>
</html>