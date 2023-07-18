<?php
require ('header.php');
require ('connections/db.client.form.php');
?>

<!DOCTYPE html>
<html>
<head>
  <title>Client Review Form</title>
  <link rel="stylesheet" type="text/css" href="styling/clientformstyling.css">
</head>
<body>
  <h1>Client Review Form</h1>
  <form method="POST" action="submit.php">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="review">Review:</label>
    <textarea name="review" id="review" required></textarea>

    <input type="submit" value="Submit">
  </form>
</body>
</html>
