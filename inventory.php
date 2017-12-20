<?php
include_once "app.php";
$app = new App();
$app->validate_session();
$result = $app->getDao()->getProducts();

App::show_head("Inventory");

echo '<div class="container"><table class="table table-hover table-dark">
<thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">First Name</th>
    <th scope="col">Last Name</th>
    <th scope="col">Username</th>
  </tr>
</thead>
<tbody>';

if ($result->rowCount() > 0) {
    // output data of each row
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
        <th scope="row">'.$row["id"].'</th>
        <td>'.$row["name"].'</td>
        <td>'.$row["price"].'</td>
        <td>'.$row["description"].'</td>
      </tr>';

    }
} else {
    echo "0 results";
}

echo '</tbody>
</table>
</div>';

App::show_footer();
?>