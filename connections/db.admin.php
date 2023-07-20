<?php
// require('db.connect.php');
// $db = new Database;
// $pdo = $db->getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = $_POST['model'];
    $price = $_POST['price'];
    $year = $_POST['year'];
    $km = $_POST['km'];

    $errors = []; // Array to store validation errors

    // Validate the "model" field
    if (empty($model)) {
        $errors[] = 'The "model" field cannot be empty.';
    }

    // Validate the "price" field
    if (!is_numeric($price) || $price <= 0) {
        $errors[] = 'The "price" field must be a positive number.';
    }

    // Validate the "year" field
    if (!preg_match('/^\d{4}$/', $year)) {
        $errors[] = 'The "year" field must be a valid 4-digit year.';
    }

    // Validate the "km" field
    if (!is_numeric($km) || $km < 0) {
        $errors[] = 'The "km" field must be a non-negative number.';
    }

    if (empty($errors)) {
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
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    }
}
?>
