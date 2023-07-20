<?php
require('connections/db.connect.php');

if (isset($_GET['id'])) {
    $listing_id = $_GET['id'];

    $db = new Database;
    $pdo = $db->getPDO();

    // Fetch the details of the selected car listing
    $sql = "SELECT * FROM images  WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$listing_id]);
    $listing = $stmt->fetch();

    if (!$listing) {
        header("Location: landingpage.php"); // Redirect back to landing page if listing not found
        exit();
    }
}
?>

<!-- Rest of the listing.php file remains the same -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listing</title>
    <link rel="stylesheet" href="Styling/car_listing.css">
</head>
<body>
    <?php if ($listing): ?>
        <div class="listing">
            
            <img src=".<?php echo $listing['path_image']; ?>" class="image-size">
            
        </div>
    <?php else: ?>
        <p>Listing not found.</p>
    <?php endif; ?>
</body>
</html>
