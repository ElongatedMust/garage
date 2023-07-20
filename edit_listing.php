<?php
require('connections/db.admin.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $listingId = $_POST['listing_id'];

    // Retrieve the listing details from the car_listing table based on the listing ID
    $selectListingQuery = "SELECT * FROM car_listing WHERE id = :listingId";
    $stmt = $pdo->prepare($selectListingQuery);
    $stmt->bindParam(':listingId', $listingId);
    $stmt->execute();
    $listing = $stmt->fetch();

    if ($listing && isset($listing['model'])) {
        // Display the form with input fields pre-populated with the listing details
        echo '<form action="update_listing.php" method="post">';
        echo '<input type="hidden" name="listing_id" value="' . $listing['id'] . '">';
        echo 'Model: <input type="text" name="model" value="' . $listing['model'] . '"><br>';
        echo 'Price: <input type="text" name="price" value="' . $listing['price'] . '"><br>';
        echo 'Year: <input type="text" name="year" value="' . $listing['year'] . '"><br>';
        echo 'KM: <input type="text" name="km" value="' . $listing['km'] . '"><br>';
        echo '<input type="submit" name="update" value="Update">';
        echo '</form>';
    } else {
        echo 'Listing not found or missing information.';
    }
}
?>
