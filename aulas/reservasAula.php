<?php
include_once "app.php";
$app = new App();
$app->validate_session();

App::show_head("Reservar aula");
App::show_navbar();

if (isset($_GET['_id'])){
    $idClass = $_GET['_id'];
} else {
    $idClass = null;
}

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

if (isset($_POST['date'])){
    $date = $_POST['date'];
} else {
    $date = date("Y-m-d");
}

if (isset($_POST['id'])){
    $id = $_POST['id'];
} else {
    $id = $idClass;
}

$resultset = $app->getDao()->getClassById($id);
$resultBokings = $app->getDao()->getBookingJoinTimetableByIdClasDate($id,$date);
if (!$resultset){
    echo "<p>Error en la sentencia de la base de datos.</p>";
} else {
    $resultset->execute();
    $class= $resultset->fetchAll(PDO::FETCH_ASSOC);
} 

echo'<script>
    function showBookReason($bookReason) {
        alert(\'Motivo de la reserva: \n\'+$bookReason);
    }
</script>';

echo'<script>
    function confirmBook($idUser,$idClass,$idTimetable,$date) {
        $r = confirm("Esta seguro de querer reservar la fecha seleccionada?");
        if ($r == true) {
            $bookReason = prompt("Indique motivo de la reserva. \n(Debe escribir entre 15 y 250 caracteres para poder reservar)");
            if ($bookReason.length > 15 && $bookReason.length < 250) {
                window.location.href="confirmar.php?idUser=" +$idUser+ "&idClass=" +$idClass+ "&idTimeTable=" +$idTimetable+ "&date=" +$date+ "&bookReason=" +$bookReason
            } else {
                alert(\'Longitud incorrecta, no se ha podido cancelar, vuelva a intentarlo de nuevo.\');
            }
        }
    }
</script>';

if (!$resultBokings ){
    echo "<p>Error en la sentencia de la base de datos.</p>";
} else {
    $resultBokings ->execute();
    $books= $resultBokings ->fetchAll(PDO::FETCH_ASSOC);
} 

    echo '
    <div class="container-fluid">
        <div class="row justify-content-center">';

                echo '<div clas="col-4">
                        <form method="POST"  action="'.$_SERVER['PHP_SELF'].'" >
                                <h1>Elija una fecha</h1>
                                <div class="form-group">
                                    <label for="inputDate" class="col-form-label">Fecha de reserva</label>
                                    <input type="date" name="date" id="inputDate" value="'.$date.'" class="form-control" min="'.date("Y-m-d").'"/>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="id" id="inputId" value="'.$id.'" class="form-control"/>
                                </div>
                                    
                                <div style="float:right;" class="form-group text-left">
                                    <button type="submit" class="btn btn-primary ">Buscar</button>
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
            
            
            
            echo '
            <div class="col-1"></div>
            <div class="col-7">
                <h1>Reservas del aula "'.substr($app->getDao()->getClassShortnameByID($id), 0, 15).'" para el dia "'.$date.'"</h1>
                Resultados: '.count($books);

            if(count($books)==0){
                echo "<p>No existe ninguna aula con los datos indicados</p>";
            } else {
            echo '<table class="table table-hover table-dark table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Tramo</th>
                            
                            <th class="text-center" scope="col">Usuario</th>
                            <th class="text-center" scope="col">Razon Reserva</th>
                            <th class="text-center" scope="col">Reservar</th>
                        </tr>
                    </thead>
                <tbody>';

                    foreach ($books as $row) {
                        // substr($row["name"] , 0, 30) solo muestra los primeros 30 caracteres
                        //<th class="text-center align-middle" scope="row">'.substr($app->getDao()->getClassShortnameByID($row["_idClass"]), 0, 15).'</th>
                        echo '
                        <tr>
                            <th class="text-center align-middle" scope="row">'.$row["hour"].'</th>

                            

                            <th class="text-center align-middle" scope="row">'.$app->getDao()->getUSerUsernameByID($row["_idUser"]).'</th>
                            
                            <th class="text-center" scope="row">';

                            if ($row["bookReason"] != null) {
                                echo '
                                <button class="btn btn-outline-secondary" onclick="showBookReason(\''.$row["bookReason"].'\')">
                                    <img src="img/book.png" width="30" height="30"/>
                                </button>';
                            } else {

                            }

                            echo'
                            </th> <th class="text-center align-middle" scope="row">';
                                
                            if ($row["bookReason"] == null) {
                                echo '
                                <button class="btn btn-outline-secondary" onclick="confirmBook('.$app->getDao()->getUserIdByName($_SESSION['user']).','.$id.','.$row["_id"].','.str_replace("-","",$date).')">
                                    <img src="img/confirmBook.png" width="30" height="30"/>
                                </button>';
                            } else {
                                echo 'Fecha reservada.';
                            }

                            echo '</th>

                            </th>
                        </tr>';
                    }

                echo '</tbody></table>
            </div>
        </div>
    </div>';
}

App::show_footer();
?>