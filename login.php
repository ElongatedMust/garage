<?php
require ('header.php'); 
require('connections/db.login.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database to find a matching user based on the email
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set the session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['is_admin'] = $user['is_admin'];

        // Redirect the user to the appropriate page based on their role
        if ($_SESSION['is_admin'] == 1) {
            header('Location: adminpage.php');
        } else {
            header('Location: landingpage.php');
        }
        exit;
    } else {
        // Password is incorrect, display an error message
        $error = 'Invalid email or password.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styling/login.css">
    <meta>
    <title>Connexion</title>
</head>
<body>
    
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
            
        </form>  
    </div>
</body>
</html>
