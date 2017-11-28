<?php
    // En primer lugar se incluye los ficheros a usar
    // include(....);

    /**
     * En segundo lugar se definen las constantes
     * no se ouede definir una constante cont
     */
    define("TRIANGULO", 1);
    define("CUADRADO",2);
    define("RECTANGULO",3);
    define("CIRCUNFERENCIA",4);
    define("MIN_VALUE_RAND",1);
    define("MAX_VALUE_RAND",4);
    const PI = 3.14;

    //Definir variables
    $base = 3;
    $altura = 5;
    $lado = 3;
    $lado1 = 6;
    $lado2 = 7;
    $radio = 5;

print "
<!DOCTYPE html>
<html lang=\"es\">
    <head>
        <title>Area de una figura</title>
        <meta charset=\"utf8\"/>
    </head>
    <body>";
        $figura= rand(MIN_VALUE_RAND,MAX_VALUE_RAND);
        switch($figura){
            case TRIANGULO:
                echo ("El area del triangulo con base ".$base." y altura ".$altura." es ".area_triangulo());
                break;
            case CUADRADO:
                echo ("El area del cuadrado con lado ".$lado." es ".area_cuadrado());
                break;
            case RECTANGULO:
                echo ("El area del rectangulo con lado1 ".$lado1." y lado2 ".$lado2." es ".area_rectangulo());
                break;
            case CIRCUNFERENCIA:
                echo ("El area de la circunferencia con radio ".$radio." es ".area_circunferencia());
                break;
        }

        function area_triangulo(){
            global $base,$altura;
            // si una variable global se llama igual que una local usara la local
            // $base = 7;
            return (($base*$altura)/2);
        }

        function area_cuadrado(){
            // todas la variables definidas se añaden a un array (GLOBALS)
            return (pow($GLOBALS['lado'],2));
        }

        function area_rectangulo(){
            global $lado1,$lado2;
            return ($lado1*$lado2);
        }

        function area_circunferencia(){
            global $radio;
            return 2*PI*$radio;
        }
print "
    </body>
</html>
";
?>