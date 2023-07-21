<?php


require('connections/db.admin.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $listingId = $_POST['listing_id'];

    
    $deleteListingQuery = "DELETE FROM car_listing WHERE id = :listingId";
    $stmt = $pdo->prepare($deleteListingQuery);
    $stmt->bindParam(':listingId', $listingId);
    $stmt->execute();

    
    $deleteImagesQuery = "DELETE FROM images WHERE car_listing_id = :listingId";
    $stmt = $pdo->prepare($deleteImagesQuery);
    $stmt->bindParam(':listingId', $listingId);
    $stmt->execute();

    
    header('Location: adminpage.php');
    exit;
}

?>
                                                                                                                                                                                                                                                                                                                                                                                    
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="Styling/adminpage.css">
</head>
<main>
   
    <div class="dashboard">
        <h1>Admin Dashboard</h1>
        <?php
        $sql = "SELECT * FROM car_listing ";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();

        if (!$result) {
            echo '<p>No car listings found.</p>';
        } else {
            echo '<table>
                    <tr>
                        <th>ID</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Year</th>
                        <th>KM</th>
                        <th>Actions</th>
                    </tr>';
            foreach ($result as $item) {
                echo '<tr>
                        <td>' . $item['id'] . '</td>
                        <td>' . $item['model'] . '</td>
                        <td>' . $item['price'] . '</td>
                        <td>' . $item['year'] . '</td>
                        <td>' . $item['km'] . '</td>
                        <td>
                            <form action="deletions/delete_listing.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                            <form action="edit_carlisting.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="edit" value="Edit">
                            </form>
                        </td>
                    </tr>';
            }
            echo '</table>';
        }

        echo '<br>';
        
        $sql = "SELECT * FROM images ";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();

        if (!$result) {
            echo '<p>No images were found.</p>';
        } else {
            echo '<table>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Car ID</th>
                        <th>Actions</th>
                        
                    </tr>';
            foreach ($result as $item) {
                echo '<tr>
                        <td>' . $item['id'] . '</td>
                        <td>' . $item['path_image'] . '</td>
                        <td>' . $item['car_listing_id'] . '</td>
                      
                        <td>
                            <form action="deletions/delete_image.php" method="post">
                                <input type="hidden" name="car_listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                            <form action="edit_listing.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="edit" value="Edit">
                            </form>
                        </td>
                    </tr>';
            }
            echo '</table>';
        }
        
        $sql = "SELECT * FROM contact ";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();

        if (!$result) {
            echo '<p>impossible de trouver les donnees.</p>';
        } else {
            echo '<table>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Numero</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>';
            foreach ($result as $item) {
                echo '<tr>
                        <td>' . $item['id'] . '</td>
                        <td>' . $item['nom'] . '</td>
                        <td>' . $item['prenom'] . '</td>
                        <td>' . $item['email'] . '</td>
                        <td>' . $item['numero'] . '</td>
                        <td>' . $item['message'] . '</td>
                        <td>
                            <form action="deletions/process_delete.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                            <form action="edit_listing.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="edit" value="Edit">
                            </form>
                        </td>
                    </tr>';
            }
            echo '</table>';
        }

        $sql = "SELECT * FROM avis";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();

        if (!$result) {
            echo '<p>impossible de trouver les donnees.</p>';
        } else {
            echo '<table>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Satisfaction</th>
                        <th>Comments</th>
                        <th>date</th>
                        <th>Action</th>
                    </tr>';
            foreach ($result as $item) {
                echo '<tr>
                        <td>' . $item['id'] . '</td>
                        <td>' . $item['name'] . '</td>
                        <td>' . $item['email'] . '</td>
                        <td>' . $item['satisfaction'] . '</td>
                        <td>' . $item['comments'] . '</td>
                        <td>' . $item['created_at'] . '</td>
                        <td>
                            <form action="deletions/process_delete.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                            <form action="edit_listing.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="edit" value="Edit">
                            </form>
                        </td>
                    </tr>';
            }
            echo '</table>';
        }
        $sql = "SELECT * FROM avis ";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();

            if (!$result) {
            echo '<p>impossible de trouver les donnees.</p>';
        } else {
            echo '<table>
                    <tr>
                        
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Satisfaction</th>
                        <th>Comments</th>
                        <th>date</th>
                        <th>Action</th>
                    
                    </tr>';
            foreach ($result as $item) {
                         echo '<tr>
                            <td>' . $item['id'] . '</td>
                        <td>' . $item['name'] . '</td>
                        <td>' . $item['email'] . '</td>
                        <td>' . $item['satisfaction'] . '</td>
                        <td>' . $item['comments'] . '</td>
                        <td>' . $item['created_at'] . '</td>
                        <td>
                            <form action="deletions/process_delete.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                            <form action="edit_listing.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="edit" value="Edit">
                            </form>
                        </td>
                    </tr>';
            }
            echo '</table>';
        }

        if ($isAdmin) {
            echo '<a href="register.php" class="button">Add User</a>';
            
            
        $sql = "SELECT * FROM users ";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();

        if (!$result) {
            echo '<p>impossible de trouver les donnees.</p>';
        } else {
            echo '<table>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Utilisateur</th>
                        <th>mdp</th>
                        <th>Action</th>
                    </tr>';
            foreach ($result as $item) {
                echo '<tr>
                        <td>' . $item['id'] . '</td>
                        <td>' . $item['email'] . '</td>
                        <td>' . $item['username'] . '</td>
                        <td>' . $item['password'] . '</td>
                        
                        <td>
                            <form action="deletions/delete_listing.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                            <form action="edit_users.php" method="post">
                                <input type="hidden" name="listing_id" value="' . $item['id'] . '">
                                <input type="submit" name="edit" value="Edit">
                            </form>
                        </td>
                    </tr>';
            }
            echo '</table>';
        }
    }

    


         ?>


    </div>
</main>
