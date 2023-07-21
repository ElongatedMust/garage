<?php
require('./header.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $Nom = $_POST['nom'];
    $Prenom = $_POST['prenom'];
    $Email = $_POST['email'];
    $Num = $_POST['numero'];
    $Msg = $_POST['message'];

    // Insert the car data into the database
    $sql = "INSERT INTO contact (nom, prenom, email, numero, message) VALUES (:nom, :prenom, :email, :numero, :message)";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':nom', $Nom, PDO::PARAM_STR);
    $statement->bindParam(':prenom', $Prenom, PDO::PARAM_STR);
    $statement->bindParam(':email', $Email, PDO::PARAM_STR);
    $statement->bindParam(':numero', $Num, PDO::PARAM_STR);
    $statement->bindParam(':message', $Msg, PDO::PARAM_STR);
    if ($statement->execute()) {
        echo 'Message envoye.';
    } else {
        echo 'error ' . $pdo->errorInfo()[2];
    }
}
?>
