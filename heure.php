<?php
require('header.php');

// SQL query to fetch opening hours data
$sql = "SELECT * FROM opening_hours ";
$db = new Database;
$pdo = $db->getPDO();
$cars = $pdo->query($sql);
$result = $cars->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opening Hours</title>
    <link rel="stylesheet" href="styling/avis.css">
</head>
<body>
    <h1>Heure D'ouverture</h1>
    <?php
    if (!$result) {
        echo '<p>No opening hours found.</p>';
    } else {
        echo '<table>
                <tr>
                    <th>ID</th>
                    <th>Jour</th>
                    <th>Ouverture</th>
                    <th>Fermeture</th>
                </tr>';
        foreach ($result as $item) {
            echo '<tr>
                    <td>' . $item['id'] . '</td>
                    <td>' . $item['day_of_week'] . '</td>
                    <td>' . $item['opening_time'] . '</td>
                    <td>' . $item['closing_time'] . '</td>
                </tr>';
        }
        echo '</table>';
    }
    ?>
</body>
</html>
