<?php
session_start();
// Move session_start() to the top of the file if not included in db.connect.php
// require ('connections/db.connect.php');
require_once('connections/db.connect.php'); // Use require_once to avoid multiple inclusions

$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="Styling/header_styling.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>
<body>

    <div id="navbar">
    
        <div id="leftS">
            <a href="landingpage.php" class="logo">P.A</a>
        </div>

        <div id="SmallLogo">
            <a href="landingpage.php" class="logo">Parrot Auto</a>
        </div>

        <div id="rightS">
            <ul id="rightNav">
                <li><a href="heure.php">Nos Horaires</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="adminpage.php">Dashboard</a></li>
                    <li><a href="car_upload.php">Voiture</a></li>
                    
                    <li><a href="post.image.php">Image</a></li>
                    <!-- <li><a href="protected.php">compte</a></li> -->
                    <li><a href="logout.php">Deconnexion</a></li>
                <?php else: ?>
                    <li><a href="login.php">Connexion</a></li>
                   
                    
                <?php endif; ?>
                <li><a href="client.form.php">Contact</a></li>
            </ul>
        </div><div id="menuIcon">&#9776;</div>
    </div>
    <script>
 
  document.addEventListener("DOMContentLoaded", function() {
    const menuIcon = document.getElementById("menuIcon");
    const navbar = document.getElementById("navbar");

   
    menuIcon.addEventListener("click", function() {
      navbar.classList.toggle("active");
    });
  });
</script>

</body>
</html>
