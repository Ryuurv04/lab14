<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Desconectar</title>
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>
<body>
    <?php
        if(isset($_SESSION["usuario_valido"])){
            session_destroy();
            print("<br><br><p align='center'>Conexion finalizada</p>\n");
            print("<p ALIGN='CENTER'>[ <a href='login.php'>Conectar</a> ]</p>");
        }
        else{
            print("<br><br>");
            print("<p align='center'>No existe una conexion activada</p>\n");
            print("<p ALIGN='CENTER'>[ <a href='login.php'>Conectar</a> ]</p>");
        }
    ?>
</body>
</html>