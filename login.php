<?php
require('connections/db.login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform your login authentication logic here

    // Assuming successful login, set the session variables
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['is_admin'] = $user['is_admin'];

    // Redirect the user to the appropriate page based on their role
    if ($_SESSION['is_admin'] == 1) {
        header('Location: adminpage.php');
    } else {
        header('Location: landingpage.php');
    }
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../styling/login.css">
    <meta>
    <title>Connexion</title>
</head>
<body>
    <?php require 'header.php'; ?>
    <?php if (isset($error)): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>
    <div id="container">
        <form method="post" class="log">
            <div>
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <br>
            <div>
                <label>Mot de passe:</label>
                <input type="password" name="password" required>
            </div>
            <br>
            <button type="submit" name="submit" class="click">Connexion</button>
            <button class="click"> <a href="register.php" class="register">Inscription</a></button>
        </form>  
    </div>
</body>
</html>
