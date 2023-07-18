<?php
require('connections/db.admin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $listingId = $_POST['listing_id'];

    // Delete listing from the car_listing table
    $deleteListingQuery = "DELETE FROM car_listing WHERE id = :listingId";
    $stmt = $pdo->prepare($deleteListingQuery);
    $stmt->bindParam(':listingId', $listingId);
    $stmt->execute();

    // Delete associated images from the images table
    $deleteImagesQuery = "DELETE FROM images WHERE car_listing_id = :listingId";
    $stmt = $pdo->prepare($deleteImagesQuery);
    $stmt->bindParam(':listingId', $listingId);
    $stmt->execute();

    // Optionally, you can also delete the physical image files from your server

    // Redirect back to the admin page or any other desired page
    header('Location: adminpage.php');
    exit;
}
?>
                                                                                                                                                                                                                                                                                                                                                                                    
<head>
    <title>admin page</title>
    <link rel="stylesheet" href="Styling/adminpage.css">
</head>
<main>
    <?php require 'header.php'; ?>
   
    <div>
        <?php
        $sql = "SELECT * FROM car_listing ";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();

        foreach ($result as $item) {
            echo '<div class="dashboard">';
            echo '<p>' . $item['id'] . '</p>';

            // Check if the necessary keys exist in the $item array
            if (isset($item['model']) && isset($item['price']) && isset($item['year']) && isset($item['km'])) {
                echo '<p>' . $item['model'] . '</p>';
                echo '<p>' . $item['price'] . '</p>';
                echo '<p>' . $item['year'] . '</p>';
                echo '<p>' . $item['km'] . '</p>';
            } else {
                echo '<p>Missing information</p>';
            }

            echo '<form action="deletions/delete_listing.php" method="post">';

            echo '<input type="hidden" name="listing_id" value="' . $item['id'] . '">';
            echo '<input type="submit" value="Delete">';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </div>
</main>
