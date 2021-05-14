<script src="https://kit.fontawesome.com/cbec68f37d.js"></script>
</head>
<body>
<script>
$(document).ready(function(){
$("#change").keyup(function(){
    var parametros="change="+$(this).val()
    $.ajax({
        data: parametros,
        url: 'update.php',
        type:  'GET',
        beforeSend: function () {},
            success:  function (response) {    
            $(".salida").html(response);
        },
        error:function(){
            alert("error")
        }
    });
})
})
</script>

<div class="container w-75 p-5">
<h3 class="mb-4">Activar y desactivar</h3>
<?php
$list = $conn->query("SELECT * FROM proyectos");
while ($fila = $list->fetch()) {
if($fila['pestado'] == '0') {
?>
<p>
Activo <span class="text-primary" id="change"><a href="#"><i class="fas fa-toggle-on"></i></a></span>
</p>
<?php } else { ?>
<p>
Inactivo <span class="text-muted"><i class="fas fa-toggle-off"></i></span>
</p>
<?php } } ?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>