<?php
require('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    // Sanitize the form inputs
    $Nom = sanitizeInput($_POST['nom']);
    $Prenom = sanitizeInput($_POST['prenom']);
    $Email = sanitizeInput($_POST['email']);
    $Num = sanitizeInput($_POST['numero']);
    $Msg = sanitizeInput($_POST['message']);
    $listingId = intval($_POST['listing_id']); 

    // Update the contact form data in the database
    $sql = "UPDATE contact SET nom = :nom, prenom = :prenom, email = :email, numero = :numero, message = :message WHERE id = :listingId";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':nom', $Nom, PDO::PARAM_STR);
    $statement->bindParam(':prenom', $Prenom, PDO::PARAM_STR);
    $statement->bindParam(':email', $Email, PDO::PARAM_STR);
    $statement->bindParam(':numero', $Num, PDO::PARAM_STR);
    $statement->bindParam(':message', $Msg, PDO::PARAM_STR);
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
        // Error handling for database errors
        echo 'Error: ' . $e->getMessage();
    }
}

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}
?>
