<?php
require('db.avis.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $dayOfWeek = $_POST['day_of_week'];
    $openingTime = $_POST['opening_time'];
    $closingTime = $_POST['closing_time'];

    
    $updateQuery = "UPDATE opening_hours SET day_of_week = :dayOfWeek, opening_time = :openingTime, closing_time = :closingTime WHERE id = :id";
    $stmt = $pdo->prepare($updateQuery);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':dayOfWeek', $dayOfWeek);
    $stmt->bindParam(':openingTime', $openingTime);
    $stmt->bindParam(':closingTime', $closingTime);
    $stmt->execute();

    
    header('Location: heure.php');
    exit;
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM opening_hours WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $hours = $stmt->fetch();
} else {
   
    header('Location: heure.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Opening Hours</title>
    <link rel="stylesheet" href="styling/avis.css">
</head>
<body>
    <h1>Edit Opening Hours</h1>
    <form action="edit_hours.php" method="post">
        <input type="hidden" name="id" value="<?php echo $hours['id']; ?>">
        <label for="day_of_week">Day of Week:</label>
        <select id="day_of_week" name="day_of_week" required>
            <option value="Monday" <?php echo ($hours['day_of_week'] === 'Monday') ? 'selected' : ''; ?>>Monday</option>
            <option value="Tuesday" <?php echo ($hours['day_of_week'] === 'Tuesday') ? 'selected' : ''; ?>>Tuesday</option>
            <option value="Wednesday" <?php echo ($hours['day_of_week'] === 'Wednesday') ? 'selected' : ''; ?>>Wednesday</option>
            <option value="Thursday" <?php echo ($hours['day_of_week'] === 'Thursday') ? 'selected' : ''; ?>>Thursday</option>
            <option value="Friday" <?php echo ($hours['day_of_week'] === 'Friday') ? 'selected' : ''; ?>>Friday</option>
            <option value="Saturday" <?php echo ($hours['day_of_week'] === 'Saturday') ? 'selected' : ''; ?>>Saturday</option>
            <option value="Sunday" <?php echo ($hours['day_of_week'] === 'Sunday') ? 'selected' : ''; ?>>Sunday</option>
        </select><br>

        <label for="opening_time">Opening Time:</label>
        <input type="time" id="opening_time" name="opening_time" value="<?php echo $hours['opening_time']; ?>" required><br>

        <label for="closing_time">Closing Time:</label>
        <input type="time" id="closing_time" name="closing_time" value="<?php echo $hours['closing_time']; ?>" required><br>

        <input type="submit" value="Update">
    </form>
</body>
</html>
