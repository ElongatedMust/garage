<?php
require ('db.connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $model = $_POST['model'];
    $price = $_POST['price'];
    $year = $_POST['year'];
    $km = $_POST['km'];

    // Insert the car data into the database
    $sql = "INSERT INTO car_listing (model, price, year, km) VALUES (:model, :price, :year, :km)";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':model', $model, PDO::PARAM_INT);
    $statement->bindParam(':price', $price, PDO::PARAM_INT);
    $statement->bindParam(':year', $year, PDO::PARAM_STR);
    $statement->bindParam(':km', $km, PDO::PARAM_STR);

    if ($statement->execute()) {
        echo 'Car data has been inserted into the database.';
    } else {
        echo 'There was an error inserting the car data into the database: ' . $pdo->errorInfo()[2];
    }
}
?>
