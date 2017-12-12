<?php

include "biblioteca.php";
include_once "Triangulo.php";

$triangulo = new Triangulo(10,10);
$cateto1 = $triangulo->getCatetoMenor();
$cateto2 = $triangulo->getCatetoMayor();

// funcion que calcula la hipotenusa de un triangulo
function hipotenusa ($cateto1,$cateto2){
    return sqrt((pow($cateto1, 2)) + (pow($cateto2, 2)));
}
$hipotenusa = hipotenusa($cateto1,$cateto2);

show_head("Hipotenusa de un triangulo");

echo "<h2>Hipotenusa de dos catetos</h2>";
if(!empty($cateto1) || !empty($cateto2)){
    echo "<h3> Hipotenusa: ".$hipotenusa."</h3>";
} else {
    echo "no has añadido valores en los catetos.";
}

show_footer();

?>