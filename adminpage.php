<?php
/*require ('connections/db.image.post.php');
require ('connections/db.carlisting.php')*/
require ('connections/db.admin.php');

?>

<head>
    <title>admin page</title>
</head>
<main> <!-- HTML form -->
<div class="listing">
    <form method="post" enctype="multipart/form-data" class="images">
        <!-- <input type="file" name="image" accept="image/*">--! -->
        <input type="text" name="model" placeholder="model">
        <input type="text" name="price" placeholder="Prix">
        <input type="text" name="year" placeholder="Annee">
        <input type="text" name="km" placeholder="Kilometrage">
        <input type="submit" value="Upload">
        <link rel="stylesheet" href="styling/adminpage.css">
    </form>
    <form method="post" enctype="multipart/form-data" class="images">
    <input type="text" name="car_listing_id" placeholder="Id of car">
    <input type="file" name="image" accept="image/*">
    <input type="submit" value="upload">
</div>
<div>
    <?php
        $sql = "SELECT * FROM car_listing ";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();
      
        
        foreach ($result as $item) {
            echo '<div class="dashboard">';
            echo '<p>' . $item['id'] . '</p>';
            echo '<p>' . $item['model'] . '</p>';
            echo '<p>' . $item['price'] . '</p>';
            echo '<p>' . $item['year'] . '</p>';
            echo '<p>' . $item['km'] . '</p>';
            echo '</div>';
            // echo '<img src=".' . $item['path_image'] . ' " class="image-size" >';
        }
    ?>
    <form ></form>
</div>
 </main>

 <a href="post.image.php">Image</a>
