<?php
require('connections/db.connect.php'); // Include the database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the image path from the database
    $query = "SELECT image_path FROM image WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $imagePath = $row['image_path'];

    // Delete the image from the file system
    if (unlink($imagePath)) {
        // Image deleted from the file system, now delete from the database
        $query = "DELETE FROM image WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

        if ($statement->execute()) {
            // Image deleted from the database
            header("Location: landingpage.php"); // Redirect back to the index page after successful deletion
            exit();
        } else {
            echo 'Error deleting image from the database.';
        }
    } else {
        echo 'Error deleting image from the file system.';
    }
} else {
    echo 'Invalid request.';
}
?>
