<?php
require ('connections/db.image.post.php');
require ('connections/db.carlisting.php')
?>

<!-- HTML form -->
<form method="post" enctype="multipart/form-data" class="images">
    <input type="file" name="image" accept="image/*">
    <input type="submit" value="Upload">
</form>


<form method="POST" class="car">
    <input type="int" name="price" placeholder="Prix"> <br>
    <input type="text" name="year" placeholder="Annee"><br>
    <input type="text" name="km" placeholder="Kilometrage">
    <input type="submit" value="Upload">

</form>