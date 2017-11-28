<?php 
print "
<!DOCTYPE html>
<html lang=\"es\">
    <head>
        <title>Superglobal server</title>
        <meta charset=\"utf8\"/>
    </head>
    <body>";
        $titulo = "Informacion de la variable supergloval server";
        echo "<pre>".print_r ($_SERVER,true)."</pre>";
print "
    </body>
</html>
";
?>