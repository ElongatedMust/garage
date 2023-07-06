<?php
require('connections/db.connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imagePath = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = 'images/';
        $targetFile = $targetDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = $targetFile;
        }
    }

    $price = $_POST['price'];
    $year = $_POST['year'];
    $km = $_POST['km'];

    $carSql = "INSERT INTO car_listing (price, year, km) VALUES (:price, :year, :km)";
    $carStatement = $pdo->prepare($carSql);
    $carStatement->bindParam(':price', $price, PDO::PARAM_INT);
    $carStatement->bindParam(':year', $year, PDO::PARAM_STR);
    $carStatement->bindParam(':km', $km, PDO::PARAM_STR);

    if ($carStatement->execute()) {
        echo 'Car data has been inserted into the database.';

        if (!empty($imagePath)) {
            $imageSql = "INSERT INTO image (image_path) VALUES (:imagePath)";
            $imageStatement = $pdo->prepare($imageSql);
            $imageStatement->bindParam(':imagePath', $imagePath);

            if ($imageStatement->execute()) {
                echo 'The file has been uploaded and the image path has been inserted into the database.';
            } else {
                echo 'There was an error inserting the image path into the database.';
            }
        }

        // Redirect to a different page to prevent form resubmission
        header("Location: success.php");
        exit();
    } else {
        echo 'There was an error inserting the car data into the database: ' . $carStatement->errorInfo()[2];
    }
}
?>