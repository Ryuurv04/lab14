<?php
    session_start();
    if(isset($_REQUEST['usuario']) && isset($_REQUEST['clave'])){

        $usuario=$_REQUEST['usuario'];
        $clave=$_REQUEST['clave'];

        $salt=substr($usuario,0,2);
        $clave_crypt=crypt($clave,$salt);

        require("class/usuarios.php");
        $obj_usuarios=new usuario();
        $usuario_valido=$obj_usuarios->validar_usuario($usuario,$clave_crypt);

        foreach($usuario_valido as $array_resp){
            foreach($array_resp as $value){
                $nfilas=$value;
            }
        }

        if($nfilas>0){
            $usuario_valido=$usuario;
            $_SESSION["usuario_valido"]=$usuario_valido;
        }    

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laboratorio 14 - login al sitio de noticias</title>
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>
<body>
    <?php
        //sesion iniciada
        if(isset($_SESSION["usuario_valido"])){
    ?>
    <h1>Gestion de noticias</h1>
    <hr>
        <ul>
            <li><a href="lab142.php">Listar todas las noticias</a></li>
            <li><a href="lab143.php">Listar noticias por partes</a></li>
            <li><a href="lab144.php">Buscar noticias</a></li>
        </ul>
    <hr>
    <p>[ <a href="logout.php">Desconectar</a> ]</p>
    <?php
        }
        //intento de entrada fallida
        elseif(isset($usuario)){
            print("<br><br>\n");
            print("<p ALIGN='CENTER'>Acceso no autorisado</p>\n");
            print("<p ALIGN='CENTER'>[ <a href='login.php'>Conectar</a> ]</p>");
        }
        //sesion no iniciada
        else{
            print("<br><br>\n");
            print("<p class='parrafocentrado'>Esta zona tiene el acceso restringido.<br> ". 
            " Para entrar debe identificasrse </p>\n");
            print("<form class='entrada' name='login' action='login.php' method='POST'>\n");
            print("<p><label class='etiqueta-entrada'>Usuario:</label>\n");
            print(" <input type='TEXT' name='usuario' size='15'></p>\n");
            print("<p><label class='etiqueta-entrada'>Clave:</label>\n");
            print(" <input type='TEXT' name='clave' size='15'></p>\n");
            print("<p> <input type='SUBMIT' value='entrar'></p>\n");
            print("</form>\n");

            print("<p class='parrafocentrado'>Nota: si no dispone de identificacion o tiene problemas " . 
            "para entrar<br>pongase en contacto con el " . 
            " <a href='MAILTO:webmaster@localhost'>administrador</a> del sitio</p>\n");

        }
    ?>
</body>
</html>