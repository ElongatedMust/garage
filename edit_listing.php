<?php
require('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $listingId = $_POST['listing_id'];


    $sql = "SELECT * FROM contact WHERE id = :listingId";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':listingId', $listingId, PDO::PARAM_INT);
    $statement->execute();
    $contactData = $statement->fetch(PDO::FETCH_ASSOC);

    
    ?>
    <form action="process_edit.php" method="POST">
       
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" value="<?php echo $contactData['nom']; ?>" required>

        <label for="prenom">Prenom:</label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $contactData['prenom']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $contactData['email']; ?>" required>

        <label for="numero">Numero:</label>
        <input type="text" id="numero" name="numero" value="<?php echo $contactData['numero']; ?>" required>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="5" required><?php echo $contactData['message']; ?></textarea>

       
        <input type="hidden" name="listing_id" value="<?php echo $listingId; ?>">

        <button type="submit">Save Changes</button>
    </form>
    <?php
}
?>

<link rel="stylesheet" href="styling/edit.css">
