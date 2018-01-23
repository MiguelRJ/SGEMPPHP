<?php
include_once 'app.php';
session_start();
$app = new App();
$app->invalidate_session();
echo "<script language='javascript'>window.location.href='login.php'</script>";
?>