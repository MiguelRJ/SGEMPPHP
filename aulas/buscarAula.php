<?php
include_once "app.php";
$app = new App();
$app->validate_session();

App::show_head("Buscar Aula");
App::show_navbar();

$resultset = $app->getDao()->getClass();
if (!$resultset){
    echo "<p>Error en la sentencia de la base de datos.</p>";
} else {
    $resultset->execute();
    $class= $resultset->fetchAll(PDO::FETCH_ASSOC);
} 

if(count($class)==0){
    echo "<p>No existe ninguna aula.</p>";
} else {

    echo '
    <div class=".container-fluid">
        <div class="row justify-content-center">
            
            <div class="col-3">';?>
            <script>
                function load_home() {
                    document.getElementById("buscaraulas").innerHTML='<object data="inicio.php" ></object>';
                }
            </script>

                <div class="container">
                    <h1>Busqueda aulas</h1>
                        <form method="POST" action="<?= $_SERVER['PHP_SELF'];?>" >
                            <div class="form-group">
                                <label for="inputName" class="col-form-label">Nombre</label>
                                <input type="text" name="name" id="inputName" value="" autofocus="autofocus" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="inputShorName" class="col-form-label">Nombre corto</label>
                                <input type="text" name="shortname" id="inputShorName" value="" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="inputLocation" class="col-form-label">Ubicacion</label>
                                <input type="text" name="location" id="inputLocation" value="" class="form-control"/>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-6" for="inputNumpc">Num PC
                                        <input type="number" name="numpc" id="inputNumpc" value="" class="form-control" min="0"/>
                                    </label>
                                <div class="col-sm-6">
                                    <div class="form-check">
                                        </br>
                                        <label class="form-check-label" for="inputTic">
                                            <input class="form-check-input" name="tic" id="inputTic" type="checkbox"> Aula TIC
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right;" class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-align-center">Buscar</button>
                            </div>   
                        </form>
                </div>
                
            <?php echo '</div>
            <div class="col-6" id="buscaraulas">
                <h1>Aulas registradas</h1>'.
                //'Resultados: '.count($booking).
                '<table class="table table-hover table-dark table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Nombre</th>
                            <th class="text-center" scope="col">nombre Corto</th>
                            <th class="text-center" scope="col">Location</th>
                            <th class="text-center" scope="col">Tic</th>
                            <th class="text-center" scope="col">Num PC</th>
                            <th class="text-center" scope="col">Reservar</th>
                        </tr>
                    </thead>
                <tbody>';

                    foreach ($class as $row) {
                        echo '
                        <tr>
                            <th class="text-center align-middle" scope="row">'.$row["name"].'</th>

                            <th class="text-center align-middle" scope="row">'.$row["shortname"].'</th>

                            <th class="text-center align-middle" scope="row">'.$row["location"].'</th>

                            <th class="text-center align-middle" scope="row">'.$row["tic"].'</th>

                            <th class="text-center align-middle" scope="row">'.$row["numpc"].'</th>

                            <th class="text-center align-middle" scope="row">Reservar</th>

                            </th>
                        </tr>';
                    }

                echo '</tbody></table>
            </div>
        </div>
    </div>';
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name=$_POST['name'];
    $shortname=$_POST['shortname'];
    $location=$_POST['location'];
    if (isset($_POST['tic'])) {
        $tic = true;
    } else {
        $tic = false;
    }
    $numpc=$_POST['numpc'];

    $app = new App();
    if(!$app->getDao()->isConected()){
        echo "<p>".$app->getDao()->error."</p>";
    } else {
        
    }
}


App::show_footer();
?>