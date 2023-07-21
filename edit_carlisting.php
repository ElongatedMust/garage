<?php
require('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $listingId = $_POST['listing_id'];

    
    $sql = "SELECT * FROM car_listing WHERE id = :listingId";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':listingId', $listingId, PDO::PARAM_INT);
    $statement->execute();
    $carData = $statement->fetch(PDO::FETCH_ASSOC);

   
    if ($carData) {
        echo '<h1>Edit Car Listing</h1>';
        echo '<form action="process_caredit.php" method="post">';
        echo '<input type="hidden" name="listing_id" value="' . $carData['id'] . '">';
        echo 'Model: <input type="text" name="model" value="' . $carData['model'] . '"><br>';
        echo 'Price: <input type="text" name="price" value="' . $carData['price'] . '"><br>';
        echo 'Year: <input type="text" name="year" value="' . $carData['year'] . '"><br>';
        echo 'KM: <input type="text" name="km" value="' . $carData['km'] . '"><br>';
        echo '<input type="submit" name="submit" value="Update">';
        echo '</form>';
    } else {
        echo 'Car data not found.';
    }
}
?>

<link rel="stylesheet" href="styling/edit.css">
