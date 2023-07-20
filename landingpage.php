<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <?php
require('header.php');


$db = new Database;
$pdo = $db->getPDO();

// Handle Filtering Parameters
$modelFilter = isset($_GET['model']) ? $_GET['model'] : '';
$yearFilter = isset($_GET['year']) ? $_GET['year'] : '';

$sql = "SELECT DISTINCT car_listing.id, car_listing.model, car_listing.price, car_listing.year, car_listing.km, images.path_image
        FROM car_listing
        INNER JOIN images ON car_listing.id = images.car_listing_id";

if (!empty($modelFilter) || !empty($yearFilter)) {
    $sql .= " WHERE";
}

if (!empty($modelFilter)) {
    $sql .= " car_listing.model LIKE '%$modelFilter%'";
}

if (!empty($modelFilter) && !empty($yearFilter)) {
    $sql .= " AND";
}

if (!empty($yearFilter)) {
    $sql .= " car_listing.year = $yearFilter";
}

$cars = $pdo->query($sql);
$result = $cars->fetchAll();

$displayedCarIds = array(); // Array to keep track of displayed car IDs

?>

    <link rel="stylesheet" href="Styling/landingpage.css">
</head>
<body>

<div>
    <div id="filter-container">
    <label for="model-filter">Model:</label>
    <input type="text" id="model-filter" placeholder="Enter model name">
    <label for="year-filter">Year:</label>
    <input type="number" id="year-filter" placeholder="Enter year">
    <button id="apply-filter" onclick="applyFilters()">Apply Filters</button>
    </div>

    <div class="listing">
    <?php foreach ($result as $item) {
        // Check if the car ID has already been displayed
        if (!in_array($item['id'], $displayedCarIds)) {
            echo '<div class="box">';
            echo '<p>' . $item['model'] . '</p>';
            echo '<img src=".' . $item['path_image'] . ' " class="image-size">';
            echo '<p>$' . $item['price'] . '</p>';
            echo '<p>' . $item['year'] . '</p>';
            echo '<p>$' . $item['km'] . '</p>';
            echo '<a href="image_gallery.php?id=' . $item['id'] . '" class="listing-button">View Image Gallery</a>';

            echo '</div>';
            
            // Add the car ID to the displayedCarIds array
            $displayedCarIds[] = $item['id'];
        }
    }
    ?>
</div>

</div>

<script>
    function applyFilters() {
        const modelFilter = document.getElementById('model-filter').value;
        const yearFilter = document.getElementById('year-filter').value;

        let urlParams = new URLSearchParams(window.location.search);
        urlParams.set('model', modelFilter);
        urlParams.set('year', yearFilter);
        window.location.search = urlParams.toString();
    }
</script>





</body>
</html>
