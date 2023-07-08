<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded successfully
    if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
        $targetDir = 'images/';  // Folder where you want to save the uploaded images
        $targetFile = $targetDir . basename($_FILES['images']['name']);
        
        // Move the uploaded file to the desired location
        if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFile)) {
            // Image was saved successfully
            $imagePath = $targetFile;
            
            // Include the database connection file
            require('connections/db.connect.php');
            
            // Insert the image path into the database
            $sql = "INSERT INTO images (path_image) VALUES (:imagePath)";
            $db = new Database;
            $pdo = $db->getPDO();
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
}

error_reporting(E_ALL);
ini_set('display_errors', 1);


