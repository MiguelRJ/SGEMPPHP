<?php
include_once "app.php";
$app = new App();
$app->validate_session();
$result = $app->getDao()->getDependency();

/*$dependency=$result->fetchAll();
foreach($dependency as $fila) {
  echo $fila['id']." ".$fila['shortname']." ".$fila['name']." ".$fila['description']."<br>";
}*/

App::show_head("Inventory");
App::show_logout();

if ($result->rowCount() > 0) {
  echo '<div class="container"><h1>Listado de dependencias</h1>'
  .'Resultados: '.$result->rowCount().
  '<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Short Name</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Sector</th>
    </tr>
  </thead>
  <tbody>';
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
        <th scope="row">'.$row["id"].'</th>
        <td>'.$row["shortname"].'</td>
        <td>'.$row["name"].'</td>
        <td>'.$row["description"].'</td>
        <td><a href="#"><img src="sector.png" width="30" height="30"/></a></td>
      </tr>';

    }
} else {
    echo "No hay resultadoa";
}

echo '</tbody>
</table>
</div>';

App::show_footer();
?>