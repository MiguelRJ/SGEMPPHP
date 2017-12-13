<?php
include_once "../../biblioteca.php";
show_head("Inicio de sesion");
?>

<div class="container">
    <form method="POTS" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="">
        <label for="inputUser" class="">Usuario</label>
        <input type="text" name="user" id="inputUser" value="" required="true" autofocus="autofocus" class=""/>
        <label for="inputPass" class="">Usuario</label>
        <input type="password" name="password" id="inputPassword" value="" required="true" class=""/>
        <button type="submit" class="btn btn-primary">Inicia sesion</button>
    </form>
</div>

<?php
show_footer();
?>