<?php
require('../connections/db.connect.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $listingId = $_POST['listing_id'];

    // Delete listing from the car_listing table
    $deleteListingQuery = "DELETE FROM car_listing WHERE id = :listingId";
    $stmt = $pdo->prepare($deleteListingQuery);
    $stmt->bindParam(':listingId', $listingId, PDO::PARAM_INT);
    $stmt->execute();

    // Delete associated images from the images table
    $deleteImagesQuery = "DELETE FROM images WHERE car_listing_id = :listingId";
    $stmt = $pdo->prepare($deleteImagesQuery);
    $stmt->bindParam(':listingId', $listingId, PDO::PARAM_INT);
    $stmt->execute();

    // Optionally, you can also delete the physical image files from your server

    // Redirect back to the admin page or any other desired page
    header('Location: ../adminpage.php');
    exit;
}
?>
