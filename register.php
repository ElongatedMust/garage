
<?php 
require ('connections/db.register.php');
require ('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styling/register.css">

</head>
<body>
    <form method="post" action="register.php">
        <div id="container">
            <div class="log">
                <div>
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <br>
                <div>
                    <label>Nom:</label>
                    <input type="text" name="username" required>
                </div>
                <br>
                <div>
                    <label>Mot de passe:</label>
                    <input type="password" name="password" required>
                </div>
                <br>
                <button type="submit" name="submit" class="click">Inscription</button>
            </div>
        </div>
    </form>
</body>
</html>