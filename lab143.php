<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorio 11.1</title>
    <link rel="stylesheet" href="css/estilo.css" type="text/css">

</head>
<body>
    <h1>Consulta de noticias</h1>
    <?php
    if(isset($_SESSION["usuario_valido"])){
        require_once("class/noticias.php");
      
        //codigo bueno
        $obj_noticia=new noticia();
        //prueba de conteo
       
        //bueno
       
       if (array_key_exists('enviar', $_POST)) {
            $min = $_REQUEST['min'];
            $max = $_REQUEST['max'];
        } 
        else {
            $min = 0;
            $max = 3;
        }  

    
        if ($_REQUEST['enviar'] == "1") {
            $min = ((int)$min) + 3;
            $max = ((int)$max) + 2;
        } else if ($_REQUEST['enviar'] == "0") {
            $min = ((int)$min) - 3;
            $max = ((int)$max) -  2;
        } 
        $total = $obj_noticia->cantidad_noticias();
        $noticia = $obj_noticia->enlistar($min, $max);
        
        $nfilas = count($noticia);
        
    
        //validacion de los botones
        if ($min <= 0) {
            $btn1 = "<button type='submit' name='enviar' disabled='true' value='0'>Anterior</button> ";
            $btn2 = "<button type='submit' name='enviar' value='1'>Siguiente</button>";
        }
        else if ($max >= $total) {
            $btn1 = "<button type='submit' name='enviar' value='0'>Anterior</button> ";
            $btn2 = "<button type='submit' name='enviar' disabled='true' value='1'>Siguiente</button>";
        }
        else{
            $btn1 = "<button type='submit' name='enviar' value='0'>Anterior</button> ";
            $btn2 = "<button type='submit' name='enviar' value='1'>Siguiente</button>";
        }
    
    
        if ($nfilas > 0) {
            print("
                <form action='lab111.php' method='post'>
                <input type='hidden' name='min' value='$min'>
                <input type='hidden' name='max' value='$max'>
                <p> Mostrando noticias ". $min+1 ." a $max de un total de $total. 
                [
                    $btn1
                |
                    $btn2
                ]
                <p>
                <BR>
            </form>
            ");
        }
        if($nfilas>0){
            print("<TABLE>\n");
            print("<TR>\n");
            print("<TH>Titulo</TH>\n");
            print("<TH>Texto</TH>\n");
            print("<TH>Categoria</TH>\n");
            print("<TH>Fecha</TH>\n");
            print("<TH>Imagen</TH>\n");
            print("</TR>\n");
            
            foreach($noticia as $resultado){
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