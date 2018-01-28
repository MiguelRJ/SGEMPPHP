<?php
include_once "app.php";
$app = new App();
$app->validate_session();

App::show_head("Buscar Aula");
App::show_navbar();

if (isset($_POST['name'])){
    $name = $_POST['name'];
} else {
    $name = null;
}

if (isset($_POST['shortname'])){
    $shortname = $_POST['shortname'];
} else {
    $shortname = null;
}

$resultset = $app->getDao()->getClassBy($name,$shortname);
if (!$resultset){
    echo "<p>Error en la sentencia de la base de datos.</p>";
} else {
    $resultset->execute();
    $class= $resultset->fetchAll(PDO::FETCH_ASSOC);
} 

    echo '
    <div class=".container-fluid">
        <div class="row" style="margin-right: 0px;margin-left: 0px;">
        <div class="col-1"></div>
            <div class="col-3">';

                echo '<div class="container">
                    <h1>Busqueda aulas</h1>
                        <form method="POST" action="'.$_SERVER['PHP_SELF'].'" >
                            <div class="form-group">
                                <label for="inputName" class="col-form-label">Nombre</label>
                                <input type="text" name="name" id="inputName" value="'.$name.'" autofocus="autofocus" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="inputShorName" class="col-form-label">Nombre corto</label>
                                <input type="text" name="shortname" id="inputShorName" value="'.$shortname.'" class="form-control"/>
                            </div>
                            
                            <div style="float:right;" class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-align-center">Buscar</button>
                            </div>   
                        </form>
                </div>';
                
            /* mas opciones de listado
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
            */
            
            
            
            echo '</div>
            <div class="col-1"></div>
            <div class="col-6" id="buscaraulas">
                <h1>Aulas registradas</h1>
                Resultados: '.count($class);

            if(count($class)==0){
                echo "<p>No existe ninguna aula con los datos indicados</p>";
            } else {
            echo '<table class="table table-hover table-dark table-striped">
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
                        // substr($row["name"] , 0, 30) solo muestra los primeros 30 caracteres
                        echo '
                        <tr>
                            <th class="text-center align-middle" scope="row">'.substr($row["name"], 0, 30).'</th>

                            <th class="text-center align-middle" scope="row">'.substr($row["shortname"], 0, 15).'</th>

                            <th class="text-center align-middle" scope="row">'.substr($row["location"], 0, 15).'</th>

                            <th class="text-center align-middle" scope="row">'.$row["tic"].'</th>

                            <th class="text-center align-middle" scope="row">'.$row["numpc"].'</th>

                            <th class="text-center align-middle" scope="row">Reservar</th>

                            </th>
                        </tr>';
                    }

                echo '</tbody></table>
            </div>
            <div class="col-1"></div>
        </div>
    </div>';
}

App::show_footer();
?>