<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Service</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css">
</head>
<body>
    <h1>Add New Service</h1>
    <form action="insert_service.php" method="post">
        <label for="service_name">Service Name:</label>
        <input type="text" id="service_name" name="service_name" required><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required><br>

        <label for="duration">Duration (in minutes or hours):</label>
        <input type="number" id="duration" name="duration" required><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category"><br>

        <input type="submit" value="Add Service">
    </form>
</body>
</html>
