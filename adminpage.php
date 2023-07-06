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
        <input type="file" name="image" accept="image/*">
        <input type="text" name="price" placeholder="Prix">
        <input type="text" name="year" placeholder="Annee">
        <input type="text" name="km" placeholder="Kilometrage">
        <input type="submit" value="Upload">
    </form>
</div>
 </main>
