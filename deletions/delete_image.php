<?php
// Include the necessary database connection file
require('../connections/db.connect.php');

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['car_listing_id']) && isset($_POST['image_id'])) {
        // Retrieve the image path from the database using the image_id
        $carListingId = $_POST['car_listing_id'];
        $imageId = $_POST['image_id'];

        // Fetch the image path from the database using $imageId
        $fetchSql = "SELECT path_image FROM images WHERE id = :imageId AND car_listing_id = :carListingId LIMIT 1";
        $fetchStmt = $pdo->prepare($fetchSql);
        $fetchStmt->bindParam(':imageId', $imageId, PDO::PARAM_INT);
        $fetchStmt->bindParam(':carListingId', $carListingId, PDO::PARAM_INT);
        $fetchStmt->execute();
        $imageData = $fetchStmt->fetch(PDO::FETCH_ASSOC);

        if ($imageData) {
            // Delete the image from the file system
            $imagePath = '.' . $imageData['path_image']; // Assuming the path in the database starts with '/images/'
            if (unlink($imagePath)) {
                // Image file successfully deleted from the file system, now delete the database record
                $deleteSql = "DELETE FROM images WHERE id = :imageId AND car_listing_id = :carListingId";
                $deleteStmt = $pdo->prepare($deleteSql);
                $deleteStmt->bindParam(':imageId', $imageId, PDO::PARAM_INT);
                $deleteStmt->bindParam(':carListingId', $carListingId, PDO::PARAM_INT);

                if ($deleteStmt->execute()) {
                    echo 'The image has been deleted successfully.';
                } else {
                    echo 'There was an error deleting the image from the database.';
                }
            } else {
                echo 'There was an error deleting the image file from the file system.';
            }
        } else {
            echo 'Image not found in the database.';
        }
    } else {
        echo 'Invalid request. Missing car_listing_id or image_id.';
    }
} else {
    echo 'Invalid request method.';
}
