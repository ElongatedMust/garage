<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Gather form data and sanitize it
  $name = sanitizeInput($_POST['name']);
  $prenom = sanitizeInput($_POST['prenom']);
  $email = sanitizeInput($_POST['email']);
  $numero = sanitizeInput($_POST['numero']);
  $message = sanitizeInput($_POST['message']);

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
  }

  
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "projectgarage";

  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL query with placeholders
    $sql = "INSERT INTO your_table_name (name, prenom, email, numero, message) VALUES (:name, :prenom, :email, :numero, :message)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters with values
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':message', $message);

    // Execute the statement
    $stmt->execute();

    // Success message
    echo "Form data has been successfully submitted!";
  } catch (PDOException $e) {
    // Error handling
    die("Error: " . $e->getMessage());
  }

  // Close the connection
  $conn = null;
}

// Function to sanitize user input
function sanitizeInput($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}
?>
