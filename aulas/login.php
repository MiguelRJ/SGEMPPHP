<?php

include_once "app.php";

session_start(); // Genera un id en el servidor

App::show_head("Inicio de sesion"); // Acceder a static function de App.php
?>

<div class="container">
    <div class="row">
        <form method="POST" action="<?= $_SERVER['PHP_SELF'];?>" class="col-12 col-md-4 offset-md-4">
        <h1 class="text-center">Inicio sesion</h1>
            <div class="form-group">
                <label for="inputUser" class="col-form-label">Usuario</label>
                <input type="text" name="user" id="inputUser" value="" required="true" autofocus="autofocus" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="inputPass" class="col-form-label">Contraseña</label>
                <input type="password" name="password" id="inputPassword" value="" required="true" class="form-control"/>
            </div>
            <div style="float:right;" class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-align-center">Inicia sesion</button>
            </div>
            <div style="float:left;" class="form-group text-left">
                <a href="registro.php">Registrate</a>
            </div>
        </form>
    </div>
</div> <!-- container -->

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user=$_POST['user'];
    $password=$_POST['password'];
    if(empty($user)){
        echo "<p>Debe de introducir un nombre de usuario</p>";
    } else {
        // realizamos la conexion a la base de datos, y se cimprueba si el usuario existe
        $app = new App();
        if(!$app->getDao()->isConected()){
            echo "<p>".$app->getDao()->error."</p>";
        } elseif ($app->getDao()->validateUser($user,$password)){
            $app->init_session($user); // guardar la sesion de usuario
            // redirecionamos a otra pagina
            echo "<script language='javascript'>window.location.href='inicio.php'</script>";
        } else {
            echo "<p>Datos incorrectos</p>";
        }
    }
}
App::show_footer();
?>