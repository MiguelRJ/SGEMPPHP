<?php
include_once "app.php";
$app = new App();
$app->validate_session();

App::show_head("Inicio");
App::show_navbar();

// script para añadir motivo de cancelacion a la reserva
echo'<script>
    function cancelBook($idUser,$idClass,$idTimetable,$date) {
        $r = confirm("Esta seguro de querer borrar la reserva seleccionada?");
        if ($r == true) {
            $cancelReason = prompt("Indique motivo de cancelacion. \n(Debe escribir entre 15 y 250 caracteres para poder cancelar)");
            if ($cancelReason.length > 15 && $cancelReason.length < 250) {
                window.location.href="cancelar.php?idUser=" +$idUser+ "&idClass=" +$idClass+ "&idTimeTable=" +$idTimetable+ "&date=" +$date+ "&cancelReason=" +$cancelReason
            } else {
                alert(\'Longitud incorrecta, no se ha podido cancelar, vuelva a intentarlo de nuevo.\');
            }
        }
    }
</script>';

// script para mostrar la razon por la que se hizo la reserva, solo muestra un alert con el mensaje
echo'<script>
    function showBookReason($bookReason) {
        alert(\'Motivo de la reserva: \n\'+$bookReason);
    }
</script>';

// script para mostrar la razon por la que se ha cancelado la reserva, solo muestra un alert con el mensaje
echo'<script>
    function showCancelReason($cancelReason) {
        alert(\'Motivo de la cancelacion: \n\'+$cancelReason);
    }
</script>';

$idUser = $app->getDao()->getUserIdByName($_SESSION['user']); // siempre va a haber un usuario porque ha iniciado sesion
$resultset = $app->getDao()->getBooking($idUser);
if (!$resultset){
    echo "<p>Error en la sentencia de la base de datos.</p>";
} else {
    $resultset->execute();
    $booking = $resultset->fetchAll(PDO::FETCH_ASSOC);
} 

if(count($booking)==0){
    echo "<p>No tienes ningun aula reservada.</p>";
} else {
    echo '<div class="container">
    <h1>Listado de tus proximas reservas</h1>'.
            //'Resultados: '.count($booking).
            '<table class="table table-hover table-dark table-striped">
            <thead>
              <tr>
                <th class="text-center" scope="col">Usuario</th>
                <th class="text-center" scope="col">Aula</th>
                <th class="text-center" scope="col">Tramo</th>
                <th class="text-center" scope="col">Fecha</th>
                <th class="text-center" scope="col">Razon Reserva</th>
                <th class="text-center" scope="col">Cancelar Reserva</th>
              </tr>
            </thead>
            <tbody>';
              foreach ($booking as $row) {
                if ( str_replace("-","",$row["date"]) >= date("Ymd")) { // si la fecha de la reserva es mayor a la de hoy lista
                    if ($row["cancelReason"] == null) { // si no tiene motivo de cancelacion esque no ha sido cancelada
                        echo '<tr>
                        <th class="text-center align-middle" scope="row">'.$app->getDao()->getUSerUsernameByID($row["_idUser"]).'</th>

                        <th class="text-center align-middle" scope="row">'.substr($app->getDao()->getClassShortnameByID($row["_idClass"]), 0, 15).'</th>

                        <th class="text-center align-middle" scope="row">'.$app->getDao()->getTimeTableHourByID($row["_idTimeTable"]).'</th>

                        <th class="text-center align-middle" scope="row">'.str_replace("-","/",$row["date"]).'</th>

                        <th class="text-center" scope="row">
                                <button class="btn btn-outline-secondary" onclick="showBookReason(\''.$row["bookReason"].'\')">
                                    <img src="img/book.png" width="30" height="30"/>
                                </button>
                        </th> <th class="text-center" scope="row">';

                            if ($row["cancelReason"] == null) {
                                echo '<button class="btn btn-outline-secondary" onclick="cancelBook('.$row["_idUser"].','.$row["_idClass"].','.$row["_idTimeTable"].','.str_replace("-","",$row["date"]).')">
                                    <img src="img/cancelBook.png" width="30" height="30"/>
                                </button>';
                            }

                        echo '</th></tr>';
                    }
                }

              } // str_replace("-","",$row["date"]) // quita los caracteres que separa los numeros y aun asi sirve para usarlo en mysql

          echo '</tbody></table></div>';
}
/* boton cancelar para usarlo despues
if ($row["cancelReason"] != null) {
                                echo '<button class="btn btn-outline-secondary" onclick="showCancelReason(\''.$row["cancelReason"].'\')">
                                    <img src="img/cancel.png" width="30" height="30"/>
                                </button>';
                            }
*/

App::show_footer();
?>