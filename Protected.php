<?php
require ('header.php');
$correctPassword = "123";
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($password === $correctPassword) {
        // Password is correct, grant access to the protected content
        echo "Access granted! This is the protected content.";
        header('Location: register.php');
        
    } else {
        // Password is incorrect, display an error message
        echo "Incorrect password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected Page</title>
    <link rel="stylesheet" href="Styling/protected.css">
</head>
<body>
    <h1>Protected Page</h1>
    <form method="POST" action="">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
