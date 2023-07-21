<?php
require('../header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token before processing the form submission (if you have implemented CSRF protection)
    // ...

    // Retrieve the ID of the contact form data to be deleted
    $listingId = intval($_POST['listing_id']); // Ensure the ID is an integer

    // Delete the contact form data from the database
    $sql = "DELETE FROM contact WHERE id = :listingId";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':listingId', $listingId, PDO::PARAM_INT);

    try {
        if ($statement->execute()) {
            // Data deleted successfully
            echo 'Data deleted successfully!';
            // Optionally, you can redirect the admin back to the admin dashboard
            header('Location: ../adminpage.php');
            exit;
        } else {
            // Error handling if the deletion fails
            echo 'Error deleting data.';
        }
    } catch (PDOException $e) {
        // Error handling for database errors
        echo 'Error: ' . $e->getMessage();
    }
}
?>
