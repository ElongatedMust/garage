<?php 
require('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $satisfaction = $_POST['satisfaction'];
    $comments = $_POST['comments'];

    
    $sql = "INSERT INTO avis (name, email, satisfaction, comments) VALUES (:name, :email, :satisfaction, :comments)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':satisfaction', $satisfaction);
    $stmt->bindParam(':comments', $comments);

    if ($stmt->execute()) {
        
        header('Location: success.php');
    } else {
        
        echo 'Error: Unable to submit your feedback.';
    }
}
?>
