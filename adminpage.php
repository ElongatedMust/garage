<?php

require ('header.php');
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
    <title>Admin Page</title>
    <link rel="stylesheet" href="Styling/adminpage.css">
</head>
<main>
   
    <div class="dashboard">
        <h1>Admin Dashboard</h1>
        <?php
        $sql = "SELECT * FROM car_listing ";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();

        if (!$result) {
            echo '<p>No car listings found.</p>';
        } else {
            echo '<table>
                    <tr>
                        <th>ID</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Year</th>
                        <th>KM</th>
                        <th>Actions</th>
                    </tr>';
            foreach ($result as $item) {
                echo '<tr>
                        <td>' . $item['id'] . '</td>
                        <td>' . $item['model'] . '</td>
                        <td>' . $item['price'] . '</td>
                        <td>' . $item['year'] . '</td>
                        <td>' . $item['km'] . '</td>
                        <td>
                            <form action="deletions/delete_listing.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                            <form action="edit_listing.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="edit" value="Edit">
                            </form>
                        </td>
                    </tr>';
            }
            echo '</table>';
        }

        if ($isAdmin) {
            echo '<a href="register.php" class="add-button admin-button">Add User</a>';
        }
        ?>
    </div>
</main>

