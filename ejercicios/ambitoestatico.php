<?php 
print "
<!DOCTYPE html>
<html lang=\"es\">
    <head>
        <title>Ambito Estatico</title>
        <meta charset=\"utf8\"/>
    </head>
    <body>";
    /**
     * Una variable estatica se inicializa en la primera llamada de la funcion, pero el valor de esa variable
     * no se pierde. Se utiliza en funciones RECURSIVAS.
     */
    function contador_visitas(){
        static $visitas = 0;
        static $visitas = 1+2; // Es correcto en php 5.6 y siguientes.
        //static $visitas = sqrt(121); // No se puede utilizar en la inicializacion de una constante el resultado de una funcion
        echo "<p>Se ha visitado la pagina: ".$visitas." veces.</p>";
        $visitas++;
    }
        $titulo = "Ambito estatico";
        print "<h1>$titulo</h1>";
        contador_visitas();
        contador_visitas();
        contador_visitas();
        contador_visitas();
        contador_visitas();
        contador_visitas();

print "
    </body>
</html>
";
?>