<?php
require('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    // Sanitize the form inputs
    $model = sanitizeInput($_POST['model']);
    $price = sanitizeInput($_POST['price']);
    $year = sanitizeInput($_POST['year']);
    $km = sanitizeInput($_POST['km']);
    $listingId = $_POST['listing_id'];

    // Update the contact form data in the database
    $sql = "UPDATE car_listing SET model = :model, price = :price, year = :year, km = :km WHERE id = :listingId"; 
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':model', $model, PDO::PARAM_STR);
    $statement->bindParam(':price', $price, PDO::PARAM_INT);
    $statement->bindParam(':year', $year, PDO::PARAM_INT);
    $statement->bindParam(':km', $km, PDO::PARAM_INT);
    $statement->bindParam(':listingId', $listingId, PDO::PARAM_INT);

    try {
        if ($statement->execute()) {
            
            echo 'Data updated successfully!';
           
            header('Location: adminpage.php');
            exit;
        } else {
            
            echo 'Error updating data.';
        }
    } catch (PDOException $e) {
        
        echo 'Error: ' . $e->getMessage();
    }
}

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}
?>
