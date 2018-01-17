<?php 
include_once "app.php";
$app = new App();
$app->validate_session();

if (isset($_GET['idDependency'])){
    $idDependency = $_GET['idDependency'];
}

App::show_head("Inventory");
App::show_navbar();

if (!isset($idDependency)){
    $resultset = $app->getDao()->getSectors();
} else {
    //echo $idDependency;
    $resultset = $app->getDao()->getSectorsByIdDependency($idDependency);
}
    
    // 1. Si hay un error con la base de datos
    if (!$resultset){
        echo "<p>Error en la sentencia de la base de datos.</p>";
    }
    // 2. No hay sectores en la dependecia
    else {
        $resultset->execute();
        $sector = $resultset->fetchAll(PDO::FETCH_ASSOC);
    if(count($sector)==0){
        echo "<p>No hay sectores en la dependencia.</p>";
    }else {

            echo '<div class="container"><h1>Listado de sectores</h1>'
            .'Resultados: '.count($sector).
            '<table class="table table-hover table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Short Name</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
              </tr>
            </thead>
            <tbody>';
              foreach ($sector as $row) {
                  echo '<tr>
                  <th scope="row">'.$row["id"].'</th>
                  <td>'.$row["shortname"].'</td>
                  <td>'.$row["name"].'</td>
                  <td>'.$row["description"].'</td>
                </tr>';
              }

          echo '</tbody>
          </table>
          </div>';
    }
}
App::show_footer();
?>