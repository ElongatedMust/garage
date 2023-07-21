<?php
require('connections/db.connect.php');
require('header.php');
function generateCSRFToken() {
    return bin2hex(random_bytes(32));
}

function validateCSRFToken($token) {
    if (!isset($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

$error = ''; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    
    $token = $_POST['csrf_token'];
    if (!validateCSRFToken($token)) {
        die('CSRF token validation failed.');
    }

   
    if (empty($email) || empty($password)) {
        $error = 'Please provide both email and password.';
    } else {
        try {
            $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

           
            if ($user && password_verify($password, $user['password'])) {
                // Password is correct, set the session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = $user['is_admin'];

                
                if ($_SESSION['is_admin'] == 1) {
                    header('Location: adminpage.php');
                } else {
                    header('Location: landingpage.php');
                }
                exit;
            } else {
            
                $error = 'Invalid email or password.';
            }
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
}


$csrf_token = generateCSRFToken();
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styling/login.css">
    <meta>
    <title>Connexion</title>
</head>
<body>
    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            if (email.trim() === '' || password.trim() === '') {
                alert('Please fill in both email and password fields.');
                return false;
            }

            return true;
        }
    </script>
    
    <?php if (!empty($error)): ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>
    
    <div id="container">
        <form method="post" class="log" onsubmit="return validateForm();">
           
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div>
                <label>Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <br>
            <div>
                <label>Mot de passe:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <br>
            <button type="submit" name="submit" class="click">Connexion</button>
        </form>  
    </div>
</body>
</html>
