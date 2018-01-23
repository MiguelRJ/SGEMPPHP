<?php
include_once "app.php";
$app = new App();
$app->validate_session();

App::show_head("Añadir Dependency");
App::show_navbar();
?>

<div class="container">
<h1 class="text-center">Añadir dependencia</h1>
    <div class="row">
        <form method="POST" action="<?= $_SERVER['PHP_SELF'];?>" class="col-12 col-md-4 offset-md-4">
            <div class="form-group">
                <label for="inputShortname" class="col-form-label">Shortname</label>
                <input type="text" name="shortname" id="inputShortname" value="" required="true" autofocus="autofocus" class="form-control" maxlength="5" style="text-transform:uppercase;"/>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-form-label">Name</label>
                <input type="text" name="name" id="inputName" value="" required="true" class="form-control" maxlength="250"/>
            </div>
            <div class="form-group">
                <label for="inputDescription" class="col-form-label">Description</label>
                <input type="text" name="description" id="inputDescription" value="" required="true" class="form-control" maxlength="250"/>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-align-center">Añadir</button>
            </div>
        </form>
    </div>
</div> <!-- container -->

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $shortname=$_POST['shortname'];
    $name=$_POST['name'];
    $description=$_POST['description'];

        // realizamos la conexion a la base de datos, y se cimprueba si el usuario existe
        $app = new App();
        $app->getDao()->addDependency($name,$shortname,$description);

}

App::show_footer();
?>