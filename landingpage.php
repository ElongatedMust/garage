<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require ('connections/db.connect.php') ?>
    <link rel="stylesheet" href="Styling/landingpage.css">
</head>
<body>
    <div>
    <?php
    try {
        $query = "SELECT id, image_path FROM image";
        $statement = $pdo->query($query);
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['id'];
            $imagePath = $row['image_path'];
            // Output the image on the page with the CSS class
            echo '<div class="image-container">';
            echo '<img src="' . $imagePath . '" alt="Image" class="image-size" />';
            echo '<a href="delete.php?id=' . $id . '">Delete</a>';
            echo '</div>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    ?>
    </div>
</body>
</html>
