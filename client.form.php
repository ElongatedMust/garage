<?php
require ('header.php');
require ('connections/db.client.form.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client Support Form</title>
  <link rel="stylesheet" href="styling/client_form.css">
</head>
<body>
  <div class="container">
    <h1>Contact Us</h1>
    <form action="process_form.php" method="POST">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      
      <label for="message">Message:</label>
      <textarea id="message" name="message" rows="5" required></textarea>
      
      <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>
