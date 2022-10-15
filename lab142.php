<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 9.1</title>
    <link rel="stylesheet" href="css/estilo.css" type="text/css">

</head>
<body>
    <h1>Consulta de noticias</h1>
    <?php
    if(isset($_SESSION["usuario_valido"])){
        require_once("class/noticias.php");

        $obj_noticia=new noticia();
        $noticias=$obj_noticia->consultar_noticias();

        $nfilas=count($noticias);

        if($nfilas>0){
            print("<TABLE>\n");
            print("<TR>\n");
            print("<TH>Titulo</TH>\n");
            print("<TH>Texto</TH>\n");
            print("<TH>Categoria</TH>\n");
            print("<TH>Fecha</TH>\n");
            print("<TH>Imagen</TH>\n");
            print("</TR>\n");
            
            foreach($noticias as $resultado){
                print("<TR>\n");
                print("<TD>". $resultado['titulo'] ."</TD>\n");
                print("<TD>". $resultado['texto'] ."</TD>\n");
                print("<TD>". $resultado['categoria'] ."</TD>\n");
                print("<TD>". date("j/n/Y",strtotime($resultado['fecha'])) ."</TD>\n");

                if($resultado['imagen']!=""){
                    print("<TD><A TARGET='_blank' HREF='img/" .$resultado['imagen'] . "'><IMG BORDER='0' SRC='img/iconotexto.gif'><A></TD>\n");
                }
                else{
                    print("<TD>&nbsp;</TD>\n");
                }
                print("</TR>\n");

            }
            print("</TABLE>\n");
        }
        else{
            print("No noticias disponibles");

        }


    ?>
    <p>[ <a href="login.php">Menu Principal</a> ]</p>
    <?php
    }
    else{
        print("<br><br>\n");
        print("<p ALIGN='CENTER'>Acceso no autorisado</p>\n");
        print("<p ALIGN='CENTER'>[ <a href='login.php'>Conectar</a> ]</p>");
    }
    ?>
</body>
</html>