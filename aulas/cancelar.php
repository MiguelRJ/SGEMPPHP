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
$app->getDao()->deleteBooking($idUser,$idClass,$idTimeTable,$date);
echo "<script language='javascript'>window.location.href='inicio.php'</script>";
?>