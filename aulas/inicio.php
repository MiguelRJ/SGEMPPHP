<?php
include_once "app.php";
$app = new App();
$app->validate_session();

App::show_head("Inicio");
App::show_navbar();

$idUser = $app->getDao()->getUserIdByName($_SESSION['user']); // siempre va a haber un usuario
$resultset = $app->getDao()->getBooking($idUser);
if (!$resultset){
    echo "<p>Error en la sentencia de la base de datos.</p>";
} else {
    $resultset->execute();
    $booking = $resultset->fetchAll(PDO::FETCH_ASSOC);
} 

if(count($booking)==0){
    echo "<p>No hay sectores en la dependencia.</p>";
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
              </tr>
            </thead>
            <tbody>';
              foreach ($booking as $row) {
                  echo '<tr>
                  <th scope="row">'.$row["_idUser"].'</th>
                  <th scope="row">'.$row["_idClass"].'</th>
                  <th scope="row">'.$row["_idTimeTable"].'</th>
                  <th scope="row">'.$row["date"].'</th>
                </tr>';
              }

          echo '</tbody>
          </table>
          </div>';
}

App::show_footer();
?>