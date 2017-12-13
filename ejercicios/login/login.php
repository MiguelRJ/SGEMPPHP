<?php
include_once "../../biblioteca.php";
show_head("Inicio de sesion");
?>

<div class="container">
    <div class="row">
        <form method="POTS" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="col-12 col-md-4 offset-md-4">
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
show_footer();
?>