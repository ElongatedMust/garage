<?php
require ('connections/db.connect.php');

$errors = [];

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Password must contain at least one uppercase letter.';
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = 'Password must contain at least one lowercase letter.';
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = 'Password must contain at least one number.';
    }

    if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
        $errors[] = 'Password must contain at least one special character.';
    }

    if (!empty($errors)) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }
        echo '</div>';
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        try {
          
            $statement = $pdo->prepare('INSERT INTO users(email, username, password) VALUES (:email, :username, :password)');
            $statement->bindValue(':email', $email);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':password', $password_hash);
            $statement->execute();        
            echo 'User registered successfully.';
            header("Location: login.php");
           // header("location:login.php");//
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}


//require 'header.php'//
?>