<?php
   
    require('connections/db.image.post.php')
?>


<div class="listing">
    <form method="post" enctype="multipart/form-data" class="images">
    <input type="text" name="car_listing_id" placeholder="Id of car">
    <input type="file" name="image" accept="image/*">
    <input type="submit" value="upload">
    </form>
</div>