<?php
include_once "../../biblioteca.php";
include_once "../../dao.php";
show_head("Inicio de sesion");
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
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-align-center">Inicia sesion</button>
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
        $dao = new Dao();
        if(!$dao->isConected()){
            echo "<p>".$dao->error."</p>";
        } elseif ($dao->validateUser($user,$password)){
            // guardar la sesion de usuario
            // redirecionamos a otra pagina
            echo "<script language='javascript'>window.location.href='inventory.php'</script>";
        } else {
            echo "<p>Usuario incorrecto</p>";
        }
    }
}
show_footer();
?>