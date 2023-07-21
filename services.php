<?php
require('header.php');

$sql = "SELECT * FROM mechanic_services";
$db = new Database;
$pdo = $db->getPDO();
$services = $pdo->query($sql);
$result = $services->fetchAll();

if (!$result) {
    echo '<p>No services found.</p>';
} else {
    echo '<table>
            <tr>
                <th>ID</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Duration (minutes)</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>';
    foreach ($result as $item) {
        echo '<tr>
                <td>' . $item['id'] . '</td>
                <td>' . $item['service_name'] . '</td>
                <td>' . $item['description'] . '</td>
                <td>$' . $item['price'] . '</td>
                <td>' . $item['duration'] . '</td>
                <td>' . $item['category'] . '</td>
                <td>
                    <form action="deletions/delete_service.php" method="post">
                        <input type="hidden" name="service_id" value="' . $item['id'] . '">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                    <form action="edit_service.php" method="post">
                        <input type="hidden" name="service_id" value="' . $item['id'] . '">
                        <input type="submit" name="edit" value="Edit">
                    </form>
                </td>
            </tr>';
    }
    echo '</table>';
}
?>
