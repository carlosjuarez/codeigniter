<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Bienvenido</title>
    </head>
    <body>
        <?php 
            echo $menu;
        ?>
        <h1>
            Llamado desde el controlador
        </h1>
        <?php    
            echo getNombre(); 
        ?>
    </body>
</html>
