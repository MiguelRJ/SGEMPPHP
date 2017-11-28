<?php

include "biblioteca.php";

// print_r($_REQUEST);
// print_r($_POST);
// print_r($_GET);

$cateto1 = $_POST['cateto1'];
$cateto2 = $_POST['cateto2'];
$mostrar = isset($_POST['mostrar']);

// funcion que calcula la hipotenusa de un triangulo
function hipotenusa ($cateto1,$cateto2){
    return sqrt((pow($cateto1, 2)) + (pow($cateto2, 2)));
}
$hipotenusa = hipotenusa($cateto1,$cateto2);

show_head("Hipotenusa de un triangulo");

echo "<h1>Hipotenusa de dos catetos</h1>";
if(!empty($cateto1) || !empty($cateto2)){
    if ($mostrar){
        echo "<p>Cateto 1: ".$cateto1."</p>";
        echo "<p>Cateto 2: ".$cateto2."</p>";
    }
    echo "<h2> Hipotenusa: ".$hipotenusa."</h2>";
} else {
    echo "no has añadido valores en los catetos.";
}


show_footer();

?>