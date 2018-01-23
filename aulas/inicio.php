<?php
include_once "app.php";
$app = new App();
$app->validate_session();

App::show_head("Inicio");
App::show_navbar();

App::show_footer();
?>