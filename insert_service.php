<?php
require('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceName = $_POST['service_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $category = $_POST['category'];

    $insertServiceQuery = "INSERT INTO mechanic_services (service_name, description, price, duration, category) 
                           VALUES (:service_name, :description, :price, :duration, :category)";
    $stmt = $pdo->prepare($insertServiceQuery);
    $stmt->bindParam(':service_name', $serviceName);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':duration', $duration);
    $stmt->bindParam(':category', $category);
    $stmt->execute();

   
    header('Location: index.php');
    exit;
}
?>
