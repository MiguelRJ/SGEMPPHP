<?php
include "biblioteca.php";

if (isset($_POST['nombre'])){
    $nombre=$_POST['nombre'];
}
if (isset($_POST['apellido'])){
    $apellido=$_POST['apellido'];
}
if (isset($_POST['correo'])){
    $correo=$_POST['correo'];
}
if (isset($_POST['dia'])){
    $dia=$_POST['dia'];
}
if (isset($_POST['mes'])){
    $mes=$_POST['mes'];
}
if (isset($_POST['ano'])){
    $ano=$_POST['ano'];
}
if (isset($_POST['ciudad'])){
    $ciudad=$_POST['ciudad'];
}
if (isset($_POST['postal'])){
    $postal=$_POST['postal'];
}
if (isset($_POST['postal'])){
    $postal=$_POST['postal'];
}
if (isset($_POST['pais'])){
    $pais=$_POST['pais'];
}
if (isset($_POST['usuario'])){
    $usuario=$_POST['usuario'];
}
if (isset($_POST['contrasena'])){
    $contrasena=$_POST['contrasena'];
}
if (isset($_POST['contrasena2'])){
    $contrasena2=$_POST['contrasena2'];
}
if (isset($_POST['oferta'])){
    $oferta=$_POST['oferta'];
}
if (isset($_POST['declaraciones'])){
    $declaraciones=$_POST['declaraciones'];
}

show_head("Formulario");

if(isset($nombre,$apellido)) { // nombre es obligatorio
    echo "<p> Nombre: ".$nombre." ".$apellido."</p>";
}
echo "<p> Correo: ".$correo."</p>";
if ( isset($dia,$mes,$ano) ){
    echo "<p> Fecha nacimiento: ".$dia."/".$mes."/".$ano."</p>";
}
if ( isset($ciudad) && !empty($ciudad) ){
    echo "<p> Ciudad: ".$ciudad."</p>";
}
if ( isset($postal) && !empty($postal) ){
    echo "<p> Codigo postal: ".$postal."</p>";
}
if ( isset($pais) && !empty($pais) ){
    echo "<p> Pais: ".$pais."</p>";
}
if ( isset($usuario) && !empty($usuario) ){
    echo "<p> Usuario: ".$usuario."</p>";
}
if ( isset($contrasena, $contrasena2) ){ //es obligatorio
    if ($contrasena == $contrasena2){
        echo "<p> Contraseña: ".$contrasena."</p>";
    } else {
        echo "<p> Las contraseñas no son iguales.</p>";
    }
}

if (isset($oferta)){ // si no se obtiene ningun valor hara el else
    echo "<p> El usuario quiere recibir ofertas cada ".$oferta.".</p>";
} else {
    echo "<p> El usuario no quiere recibir ofertas nunca.</p>";    
}

if(isset($declaraciones)){
    echo "<p> El usuario ha aceptado la privacidad y las cookies.</p>";    
} else {
    echo "<p> El usuario NO ha aceptado la privacidad y las cookies.</p>";        
}


show_footer();

?>