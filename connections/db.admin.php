<?php
require('connections/db.connect.php');
$db = new Database;
$pdo = $db->getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = $_POST['model'];
    $price = $_POST['price'];
    $year = $_POST['year'];
    $km = $_POST['km'];

    $carSql = "INSERT INTO car_listing (model, price, year, km) VALUES (:model, :price, :year, :km)";

    $carStatement = $pdo->prepare($carSql);
    $carStatement->bindParam(':model', $model, PDO::PARAM_STR);
    $carStatement->bindParam(':price', $price, PDO::PARAM_INT);
    $carStatement->bindParam(':year', $year, PDO::PARAM_STR);
    $carStatement->bindParam(':km', $km, PDO::PARAM_STR);

    if ($carStatement->execute()) {
        echo 'Car data has been inserted into the database.';
        // Redirect to a different page to prevent form resubmission
        header("Location: success.php");
        exit();
    } else {
        echo 'There was an error inserting the car data into the database: ' . $carStatement->errorInfo()[2];
    }
}
?>

