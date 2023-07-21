<?php
require ('connections/db.process_form.php');
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
    <h1>Contactez nous</h1>
    <form  method="POST">
      <label for="name">Nom:</label>
      <input type="text" id="nom" name="nom" required>

      <label for="name">Prenom:</label>
      <input type="text" id="prenom" name="prenom" required>

      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="name">Numero:</label>
      <input type="text" id="numero" name="numero" required>
      
      <label for="message">Message:</label>
      <textarea id="message" name="message" rows="5" required></textarea>
      
      <button type="submit">Envoyer</button>
    </form>
  </div>
</body>
</html>
