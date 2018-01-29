<?php
include_once 'app.php';
session_start();
$app = new App();
if (isset($_GET['idUser'])){
    $idUser = $_GET['idUser'];
}
if (isset($_GET['idClass'])){
    $idClass = $_GET['idClass'];
}
if (isset($_GET['idTimeTable'])){
    $idTimeTable = $_GET['idTimeTable'];
}
if (isset($_GET['date'])){
    $date = $_GET['date'];
}
if (isset($_GET['bookReason'])){
    $bookReason = $_GET['bookReason'];
}
if ($idUser == $app->getDao()->getUserIdByName($_SESSION['user'])) {
    $app->getDao()->insertBookReason($idUser,$idClass,$idTimeTable,$date,$bookReason);
    echo "<script language='javascript'>window.location.href='inicio.php'</script>";
} else { // Si el usuario actualmente logeado no es el mismo al que se indica en la url se redireccionara al logout (inyeccion sql)
    echo "<script language='javascript'>window.location.href='logout.php'</script>";
}

?>