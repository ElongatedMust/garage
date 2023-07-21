<?php
require ('connections/db.image.post.php');
require ('connections/db.carlisting.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $targetDir = 'images/';  
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        
       
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
           
            $imagePath = $targetFile;
            
           
            
           
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
    
    
    $price = $_POST['price'];
    $year = $_POST['year'];
    $km = $_POST['km'];

    
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


<form method="post" enctype="multipart/form-data" class="images">
    <input type="file" name="image" accept="image/*">
    <input type="int" name="price" placeholder="Prix">
    <input type="text" name="year" placeholder="Annee">
    <input type="text" name="km" placeholder="Kilometrage">
    <input type="submit" value="Publish">
</form>
