<?php

require('header.php');

if (isset($_GET['id'])) {
    $listing_id = $_GET['id'];

    $db = new Database;
    $pdo = $db->getPDO();

    
    $sql = "SELECT * FROM images WHERE car_listing_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$listing_id]);
    $images = $stmt->fetchAll();
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <link rel="stylesheet" href="Styling/image_gallery.css">
</head>
<body>
    <div class="gallery">
        <?php
        foreach ($images as $image) {
            echo '<div class="image">';
            echo '<img class="image" src=".' . $image['path_image'] . '">';
            echo '</div>';
        }
        ?>
    </div>

    
</body>


</html>
