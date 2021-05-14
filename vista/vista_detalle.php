<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../librerias/js/sweetalert2.all.min.js"></script>
    <script src="../librerias/js/jquery-3.6.0.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="css/estilosSolicitud.css">

    <style>
         .botones{
            width: auto;
            margin-top: 100px;
            text-align: center;
        }
        
        button{
            display: inline-block;
        }
    </style>

</head>
<body>
<?php
    $id_usuario=1;
    $id_pedido=76;
    $id_solicitud=20;
    require_once("../modelo/solicitudes_modelo.php");   
    $pedidos=new Solicitudes();
    $registros=$pedidos->getItemsPedido($id_usuario,$id_pedido,$id_solicitud);
    $just=$pedidos->getJustificacion($id_usuario,$id_pedido,$id_solicitud);
    $_POST["nro"]=1;
    
?>
<form action="">    
    <div id="form-detalle">
        <label>Solicitado por: Montecinos Gomez Juan Pablo</label><br>
        <label>Unidad de gasto: Laboratorio de informatica y sistemas</label><br>
        <label>Fecha de solicitud: 2021-04-20</label>

        <div id="tabla">
            <table id="tablaItems">
                <tr>
                    <th class="primeraFila">Nro</th>
                    <th class="primeraFila">Cantidad</th>
                    <th class="primeraFila">Unidad</th>
                    <th class="primeraFila">Detalle</th>
                    <th class="primeraFila">Archivo</th>              
                </tr>
                <?php
                    foreach ($registros as $registro):
                ?>
                <tr>
                        <td><?php
                        echo $_POST['nro'];
                        $_POST['nro']++;?></td>
                        <td><?php echo $registro->cantidad?></td>
                        <td><?php echo $registro->unidad?></td>
                        <td><?php echo $registro->detalle?></td>
                        <td><?php echo $registro->archivo?></td>    
                                             
                </tr>
                <?php
                    endforeach
                ?>
            </table>
        </div>
        <textarea name="justificacion" id="justificacion" cols="30" rows="10"><?php echo $just?></textarea>
    </div>
</form>

<!-- MARCO  -->

<div class="botones">
    <button id="botonAceptar">Aceptar</button>
    <button id="botonRechazar">Rechazar</button>
</div>

<script>
        $('#botonAceptar').on('click', function(){
            Swal.fire({
                title: 'Esta seguro de aceptar esta Solicitud?',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'SI',
                cancelButtonText: 'NO'
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('SOLICITUD ACEPTADA!','','success')
                }else{
                    Swal.fire('AUTORIZACION CANCELADA!','Se cancelo la autorizacion de la Solicitud','info')
                }
            })
        })

        $('#botonRechazar').on('click', function(){
            Swal.fire({
                input: 'textarea',
                inputLabel: 'Justificacion de Rechazo de Solicitud',
                inputPlaceholder: 'Ingrese los motivos por el cual se rechazo la solicitud de Pedido...',
                inputAttributes: {
                    'aria-label': 'Type your message here'
                },
                showCancelButton: true
                }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('SOLICITUD RECHAZADA!','Se registro la justificacion para el rechazo de la solicitud','success')
                }else{
                    Swal.fire('RECHAZO DE SOLICITUD CANCELADA!','Se cancelo el rechazo de la Solicitud','info')
                }
            })

                if (text) {
                Swal.fire(text)
                }
        })   
    </script>

</body>
</html>