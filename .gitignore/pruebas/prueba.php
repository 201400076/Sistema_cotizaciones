<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript">
        window.onload=inicio;
        
    </script>
</head>
<body>
    <?php
        if(isset($_POST["btn"])){
            echo "funciona";
        }
    ?>
    <form action="" method="post">
        <input type="text" name="nom" id="nom">
        <input type="submit" name="btn" id="btn">
    </form>
</body>
</html>