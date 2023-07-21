<?php require('connections/db.admin.php'); ?>

<link rel="stylesheet" href="Styling/car_styling.css">

<div class="container">
    <div class="form-container">
        <form method="post" enctype="multipart/form-data" class="images">
            
            <input type="text" name="model" placeholder="Model">
            <input type="text" name="price" placeholder="Price">
            <input type="text" name="year" placeholder="Year">
            <input type="text" name="km" placeholder="Kilometrage">
            <input type="submit" value="Upload">
        </form>
        <?php
        
        if (!empty($errors)) {
            echo '<ul class="error-messages">';
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';
        }
        ?>
    </div>
</div>
