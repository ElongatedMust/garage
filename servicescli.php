<?php
// Include the database connection code and other necessary dependencies
require('header.php');

// Fetch the list of mechanic services from the database
$sql = "SELECT * FROM mechanic_services";
$stmt = $pdo->query($sql);
$services = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic Services</title>
    <link rel="stylesheet" href="styling/service.css">
</head>
<body>
    <h1>Mechanic Services</h1>
    <table>
        <tr>
            
            <th>Service</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Duration</th>
            <th>Category</th>
        </tr>
        <?php foreach ($services as $service) { ?>
        <tr>
           
            <td><?= $service['service_name'] ?></td>
            <td><?= $service['description'] ?></td>
            <td>$<?= $service['price'] ?></td>
            <td><?= $service['duration'] ?> minutes/hours</td>
            <td><?= $service['category'] ?></td>
        </tr>
        <?php } ?>
    </table>
    
</body>
</html>
