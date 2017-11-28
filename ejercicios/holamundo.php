<!DOCTYPE html>
<html lang="es">
<html>
    <head>
        <title>hola mundo php</title>
        <meta charset="utf8"/>
    </head>
    <!--
        Este es un coentario en html
    -->
    <body>
        <?php
        // en php tambien hay comentarios de linea
        /**
         * Ejemplo donde se comprueba que las comillas dobles interpretan el contenido de la cadena
         * y muestra correctamente la variable $saludo
         * Las comillas simples no imterpretan el contenido de la cadena
         */
            $saludo="Hola mundo";
            $pregunta="¿Como estas?";
            echo("<p>$saludo</p>");
            print("<p>$pregunta</p>");
            echo("<p>".$saludo."</p>");
            print('<p>'.$pregunta.'</p>')
        ?>
    </body>
</html>