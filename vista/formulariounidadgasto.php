<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cotizaciones</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/miestilo.css">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2><span class="glyphicon glyphicon-edit"></span> Nueva Unidad De Gasto</h2>
                <hr>
                <div class="unidad">
                    <form class="form-horizontal" method="post" action="/ruta/ruta.php?ruta=register" role="form" id="unidad_gasto">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="unidad_gasto" >Nombre Unidad de Gasto:</label>
                                <div class="form-group">
                                    <input name="nombre_unidad_gasto" type="text" class="form-control" id="nombre_unidad_gasto">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="unidad_administrativa" >Unidad Administrativa:</label>
                                <div class="form-group">
                                    <select name="nombre_unidad_administrativa" type="text" class="form-control" id="nombre_unidad_administrativa" onchange="load(1);">
                                        <option value="">Selecciona Unidad Administrativa</option>
                                        <option value="sistemas">sistemas</option>
                                        <option value="informatica">informatica</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="text-center">
                                <button type="submit" class="btn btn-info">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>