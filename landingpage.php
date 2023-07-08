<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <?php require ('connections/db.connect.php') ?>
    <link rel="stylesheet" href="Styling/landingpage.css">
</head>
<body>
    <div>
    <?php
        $sql = "SELECT * FROM car_listing INNER JOIN images ON car_listing.id = images.car_listing_id";
        $db = new Database;
        $pdo = $db->getPDO();
        $cars = $pdo->query($sql);
        $result = $cars->fetchAll();
        
    ?>
    
    
        <div>
            <?php
            foreach ($result as $item) {
                echo '<p>' . $item['model'] . '</p>';
                echo '<img src=".' . $item['path_image'] . ' " class="image-size" >';
                echo '<p>$' . $item['price'] . '</p>';
                echo '<p>' . $item['year'] . '</p>';
                echo '<p>$' . $item['km'] . '</p>';
            }?>
   
        </div>
    </div>
    
 

</body>
</html>
