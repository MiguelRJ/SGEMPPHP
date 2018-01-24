<?php
include_once "app.php";
$app = new App();
$app->validate_session();

App::show_head("Inicio");
App::show_navbar();

echo '
<script>
    function cancelBook($url) {
        $r = confirm("Esta seguro de querer borrar la reserva seleccionada?");
        echo "ayuda";
        if ($r == true) {
            echo "<script language=\"javascript\">window.location.href=\"$url\"</script>
        }
    }
</script>';



$idUser = $app->getDao()->getUserIdByName($_SESSION['user']); // siempre va a haber un usuario
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
    echo '<div class="container"><h1>Listado de tus reservas</h1>'
            .'Resultados: '.count($booking).
            '<table class="table table-hover table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Aula</th>
                <th scope="col">Tramo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cancelar Reserva</th>
              </tr>
            </thead>
            <tbody>';
              foreach ($booking as $row) {
                  echo '<tr>
                  <th scope="row">'.$app->getDao()->getUSerUsernameByID($row["_idUser"]).'</th>
                  <th scope="row">'.$app->getDao()->getClassShortnameByID($row["_idClass"]).'</th>
                  <th scope="row">'.$app->getDao()->getTimeTableHourByID($row["_idTimeTable"]).'</th>
                  <th scope="row">'.$row["date"].'</th>
                  <th scope="row">
                        <button class="btn btn-outline-secondary" onclick="cancelBook(\'cancelar.php?idUser='.$row["_idUser"].'&idClass='.$row["_idClass"].'&idTimeTable='.$row['_idTimeTable'].'&date='.$row['date'].'\')">
                            <img src="img/cancelBook.png" width="30" height="30"/>
                        </button>
                  </th>                  
                </tr>';
              }
// <a href="cancelar.php?idUser='.$row["_idUser"].'&idClass='.$row["_idClass"].'&idTimeTable='.$row['_idTimeTable'].'&date='.$row['date'].'"></a>

          echo '</tbody>
          </table>
          </div>';
}

App::show_footer();
?>