<?php
require('db.avis.php');
$sql = "SELECT * FROM avis ";
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
    <title>Satisfaction Form</title>
    <link rel="stylesheet" href="styling/avis.css">
</head>
<body>
    <h1>Customer Satisfaction Form</h1>
    <form  method="post">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="satisfaction">Niveau de satisfaction:</label>
        <select id="satisfaction" name="satisfaction" required>
            <option value="">Select</option>
            <option value="Very Satisfied">Tres satisfait</option>
            <option value="Satisfied">Satisfait</option>
            <option value="Neutral">Neutre</option>
            <option value="Dissatisfied">Pas satisfait</option>
            <option value="Very Dissatisfied">Tres insatisfait</option>
        </select><br>

        <label for="comments">Comments:</label><br>
        <textarea id="comments" name="comments" rows="4" cols="50" required></textarea><br>

        <input type="submit" value="Submit">
    </form>

    <?php 
    if (!$result) {
    echo '<p>impossible de trouver les donnees.</p>';
} else {
    echo '<table>
            <tr>
                
                <th>Nom</th>
                <th>Email</th>
                <th>Satisfaction</th>
                <th>Comments</th>
                <th>date</th>
               
            </tr>';
    foreach ($result as $item) {
        echo '<tr>
               
                <td>' . $item['name'] . '</td>
                <td>' . $item['email'] . '</td>
                <td>' . $item['satisfaction'] . '</td>
                <td>' . $item['comments'] . '</td>
                <td>' . $item['created_at'] . '</td>
                
            </tr>';
    }
    echo '</table>';
}?>
</body>
</html>
