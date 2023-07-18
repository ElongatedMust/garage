<?php require ('connections/db.admin.php');
require ('header.php') ?>
<link rel="stylesheet" href="Styling/car_styling.css">

<div class="container">
    <div class="form-container">    
        <form method="post" enctype="multipart/form-data" class="images">
            <!-- <input type="file" name="image" accept="image/*">--! -->
            <input type="text" name="model" placeholder="model">
            <input type="text" name="price" placeholder="Prix">
            <input type="text" name="year" placeholder="Annee">
            <input type="text" name="km" placeholder="Kilometrage">
            <input type="submit" value="Upload">
        </form>    
    </div>
</div>
