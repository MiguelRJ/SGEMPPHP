<?php 
/**
 * matrices http://www.mclibre.org/consultar/php/lecciones/php-matrices.html
 */
print "
<!DOCTYPE html>
<html lang=\"es\">
    <head>
        <title>Matrices array</title>
        <meta charset=\"utf8\"/>
    </head>
    <body>";
        $titulo = "Matrices array";
        print "<h1>$titulo</h1>";


        // Las matices no son tipadas y se pueden tener diferentes tipos
        $nacimientos=["Santiago","Ramon y cajal",1852];
        echo "<p> $nacimientos[0]"." $nacimientos[1] nacio en el año"." $nacimientos[2] </p>";


        // Las matrices pueden ser asociativas
        $informacion=[
            ["nombre"=>"Santiago","apellido"=>"Ramon y Cajal","anio"=>1852],
            ["nombre"=>"Juan","apellido"=>"Casals","anio"=>1932]
        ];
        echo "<p>".print_r($informacion,true)."</p>";


        // Las matrices pueden ser multidimensionales
        $informacion2 = array (array("nombre"=>"Santiago","apellido"=>"Ramon y Cajal","anio"=>1852),
                                array("nombre"=>"Juan","apellido"=>"Casals","anio"=>1932));
        echo "<p>".print_r($informacion2,true)."</p>";
        // En las matrices multidimensionales se debe concatenar porque no hace la conversion a string de las key
        echo "<p>Datos de segundo medico: ".$informacion2[1]["nombre"]."</p>";
        // O bien se puede utilizar las llaves
        echo "<p>Datos de segundo medico: {$informacion2[1]['nombre']}</p>";

        // si varios elementos usan la misma clave solo se muestra el ultimo
        // PHP convierte las claves
        // PHP no distingue entre array indexados (con key numerica y en orden) con asociativas
        echo "<h3>Sobreescritura</h3>";
        $abecedario = array(
            1=>"a",
            "1"=>"b",
            1.5=>"c",
            true=>"d"
        );
        echo "<p>".print_r($abecedario,true)."</p>";
        $arraymixto = array(
            "uno"=>"a",
            "dos"=>"b",
            100=>"c",
            -100=>"d"
        );
        echo "<p>".print_r($arraymixto,true)."</p>";
        $arraysorpresa = array(
            "a",
            "b",
            6 => "c",
            -"d"
        );
        $arraysorpresa[] = array();
        $arraysorpresa[] = array(1,2,3);
        echo "<p>".print_r($arraysorpresa,true)."</p>";
        echo "<p>Numero de elementos del array es ".count($arraysorpresa)."</p>";

        /**
         * las matrices asociativas no pueden recorrerse con un bucle
         * $arraysorpresa aunque tenga 6 elementos no tiene ninguno en las posiciones 2 3 4
         * entonces el for da error
         */
        //for ($i=0; $i<count($arraysorpresa); $i++) 
            //echo "Posicion: ".$i." contiene: ".$arraysorpresa[$i]."</p>";

        echo "<p> se debe utilizar for each para recorrer los array asociativos</p>";
        $i = 0;
        foreach ($arraysorpresa as $elemento){
            if(!is_array($elemento)) {
                echo "<p>Posicion: ".$i." contiene: ".$elemento."</p>";
            } else {
                echo "<p>Posicion: ".$i." contiene: ".print_r($elemento,true)."</p>";
            }
            $i++;
        }
        
print "
    </body>
</html>
";
?>