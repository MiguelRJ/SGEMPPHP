<?php

include_once "app.php";

session_start(); // Genera un id en el servidor

App::show_head("Registro"); // Acceder a static function de App.php
?>

<div class="container">
    <div class="row">
        <form method="POST" action="<?= $_SERVER['PHP_SELF'];?>" class="col-12 col-md-4 offset-md-4">
        <h1 class="text-center">Registro</h1>

            <div class="form-group">
                <label for="inputUser" class="col-form-label">Usuario</label>
                <input type="text" name="user" id="inputUser" value="" required="true" autofocus="autofocus" class="form-control"/>
            </div>

            <div class="form-group">
                <label for="inputPass" class="col-form-label">Contraseña</label>
                <input type="password" name="password" id="inputPassword" value="" required="true" class="form-control"/>
            </div>

            <div class="form-group">
                <label for="inputName" class="col-form-label">Nombre Completo</label>
                <input type="text" name="name" id="inputName" value="" required="true" class="form-control"/>
            </div>

            <div class="form-group">
                <label for="inputDate" class="col-form-label">Año nacimiento</label>
                <input type="date" name="date" id="inputDate" value="" required="true" class="form-control"/>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-form-label">Email</label>
                <input type="email" name="email" id="inputEmail" value="" required="true" class="form-control"/>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-align-center">Registrarse</button>
            </div>

        </form>
    </div>
</div> <!-- container -->

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $user=$_POST['user'];
    $password=$_POST['password'];
    $name=$_POST['name'];
    $date=$_POST['date'];
    $email=$_POST['email'];
    $app = new App();

    if($app->getDao()->existsUserUsername($user)){

        echo "<p>Este usuario ya ha sido registrado ($user)</p>";

    } elseif ($app->getDao()->existsUserEmail($email)) {

        echo "<p>Este email ya ha sido registrado ($email)</p>";

    } else {

        if ($app->getDao()->insertUser($user,$password,$name,$date,$email)){

            echo '<script language="javascript">alert("Registrado Correctamente");</script>'; 
            echo "<script language='javascript'>window.location.href='inicio.php'</script>";

        } else {

            echo '<script language="javascript">alert("Error intentelo de nuevo mas tarde);</script>'; 
            
        }

    }
}
App::show_footer();
?>