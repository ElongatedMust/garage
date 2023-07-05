<?php
require ('connections/db.image.post.php');
require ('connections/db.carlisting.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded successfully
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = 'images/';  // Folder where you want to save the uploaded images
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        
        // Move the uploaded file to the desired location
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Image was saved successfully
            $imagePath = $targetFile;
            
            // Include the database connection file
            require('connections/db.connect.php');
            
            // Insert the image path into the database
            $sql = "INSERT INTO image (image_path) VALUES (:imagePath)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':imagePath', $imagePath);
            
            if ($stmt->execute()) {
                echo 'The file has been uploaded and the image path has been inserted into the database.';
            } else {
                echo 'There was an error inserting the image path into the database.';
            }
        } else {
            echo 'There was an error uploading the file.';
        }
    } else {
        echo 'No file was uploaded.';
    }
    
    // Retrieve the car form data
    $price = $_POST['price'];
    $year = $_POST['year'];
    $km = $_POST['km'];

    // Insert the car data into the database
    $sql = "INSERT INTO car_listing (price, year, km) VALUES (:price, :year, :km)";
    $statement = $pdo->prepare($sql);
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

<!-- HTML form -->
<form method="post" enctype="multipart/form-data" class="images">
    <input type="file" name="image" accept="image/*">
    <input type="int" name="price" placeholder="Prix">
    <input type="text" name="year" placeholder="Annee">
    <input type="text" name="km" placeholder="Kilometrage">
    <input type="submit" value="Publish">
</form>
