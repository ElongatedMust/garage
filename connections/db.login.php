<?php

session_start();
if (isset($_POST['submit'])) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=projectgarage', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$_POST['email']]);
        $user = $stmt->fetch();

        /*if ($user && password_verify($_POST['password'], $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            
            header('Location: mainpage.php');
            exit;
        } else {
            $error = 'Invalid email or password.';
        }*/

        if ($user && $user['is_admin']) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: adminpage.php');
            exit;
        } elseif ($user) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: landingpage.php');
            exit;
        } else {
            $error_message = 'Email ou mot de passe invalide.';
        }
    } catch(PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
}
?>