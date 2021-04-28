<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require("p.php");
        require_once("items.php");
        $_POST["items"]=array();
        if(isset($_POST["h"])){
            $_POST["items"]=new Items($_POST["hh"],$_POST["hh"],$_POST["hh"],$_POST["hh"],$_POST["hh"]);
        }
    ?>
    <form action="" method = "post">
        <?php
            foreach($_POST["items"] as $i):
                echo $i->getCantidad() . "funciono";
            endforeach;
        ?>
        <input type="text" id="hh" name="hh" class="hh">
        <input type="submit" id="h" name="h" class="h">        
    </form>
</body>
</html>