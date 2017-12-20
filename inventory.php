<?php
include_once "app.php";
$app = new App();
$app->validate_session();
$result = $app->getDao()->getProducts();

App::show_head("Inventory");

if ($result->rowCount() > 0) {
    // output data of each row
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<p>id: ".$row["id"];
        echo " name: ".$row["name"];
        echo " precio: ".$row["price"]."<br>";
        echo " description: ".$row["description"]."</p>";
        
    }
} else {
    echo "0 results";
}

App::show_footer();
?>