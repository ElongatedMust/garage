<?php
    require ('connections/db.connect.php');
    $isLoggedIn = isset($_SESSION['user_id']);
    $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
    
?>

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
            <a href="landingpage.php" class="logo">Parrot Auto</a>
        </div>

        <div id="SmallLogo">
            <a href="mainpage.php" class="logo">QA</a>
        </div>

        <div id="rightS">
            <ul id="rightNav">
                 <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="adminpage.php">Dashboard</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="car_upload.php">Voiture</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ($isAdmin): ?>
                        <a href="register.php">AAAAAAAAAA</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="post.image.php">Image</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="protected.php">compte</a>
                    <?php endif; ?>
                </li>
               
                <li>
                    <?php if ($isLoggedIn): ?>
                        <a href="logout.php">Deconnexion</a>
                    <?php else: ?>
                        <a href="login.php">Connexion</a>
                    <?php endif; ?>

                 <li>
                    
                    <a href="client.form.php">Contact</a>
                 
                 </li>
                
            </ul>
        </div>
    </div>

</body>
</html>
