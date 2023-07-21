<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <?php
    require('header.php');
    require_once('connections/db.connect.php');
    
    $db = new Database;
    $pdo = $db->getPDO();
    
    
    $modelFilter = isset($_GET['model']) ? $_GET['model'] : '';
    $yearFilter = isset($_GET['year']) ? $_GET['year'] : '';
    $kmFilter = isset($_GET['km']) ? $_GET['km'] : '';
    $minPriceFilter = isset($_GET['min_price']) ? $_GET['min_price'] : '';
    $maxPriceFilter = isset($_GET['max_price']) ? $_GET['max_price'] : '';
    
    $sql = "SELECT DISTINCT car_listing.id, car_listing.model, car_listing.price, car_listing.year, car_listing.km, images.path_image
            FROM car_listing
            INNER JOIN images ON car_listing.id = images.car_listing_id";
    
    $whereClauses = array();
    $params = array();
    
    if (!empty($modelFilter)) {
        $whereClauses[] = "car_listing.model LIKE ?";
        $params[] = '%' . $modelFilter . '%';
    }
    
    if (!empty($yearFilter)) {
        $whereClauses[] = "car_listing.year = ?";
        $params[] = $yearFilter;
    }
    
    if (!empty($kmFilter)) {
        $whereClauses[] = "car_listing.km = ?";
        $params[] = $kmFilter;
    }
    
    if (!empty($minPriceFilter)) {
        $whereClauses[] = "car_listing.price >= ?";
        $params[] = $minPriceFilter;
    }
    
    if (!empty($maxPriceFilter)) {
        $whereClauses[] = "car_listing.price <= ?";
        $params[] = $maxPriceFilter;
    }
    
    if (!empty($whereClauses)) {
        $sql .= " WHERE " . implode(' AND ', $whereClauses);
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetchAll();
    
    $displayedCarIds = array(); 
    ?>
    
    <link rel="stylesheet" href="Styling/landingpage.css">
</head>
<body>
    <div>
        <div id="filter-container">
            <label for="model-filter">Model:</label>
            <input type="text" id="model-filter" placeholder="Enter model name" value="<?= $modelFilter ?>">
            <label for="year-filter">Year:</label>
            <input type="number" id="year-filter" placeholder="Enter year" value="<?= $yearFilter ?>">
            <label for="km-filter">Kilometers:</label>
            <input type="range" id="km-filter" min="0" max="100000" step="1000" value="<?= $kmFilter ?>">
            <span id="km-value"><?= $kmFilter ?></span> Km
            <label for="min-price-filter">Min Price:</label>
            <input type="number" id="min-price-filter" placeholder="Enter min price" value="<?= $minPriceFilter ?>">
            <label for="max-price-filter">Max Price:</label>
            <input type="number" id="max-price-filter" placeholder="Enter max price" value="<?= $maxPriceFilter ?>">
            <button id="apply-filter" onclick="applyFilters()">Apply Filters</button>
        </div>
    
        <div class="listing">
            <?php foreach ($result as $item) {
               
                if (!in_array($item['id'], $displayedCarIds)) {
                    echo '<div class="box">';
                    echo '<p>' . $item['model'] . '</p>';
                    echo '<img src=".' . $item['path_image'] . ' " class="image-size">';
                    echo '<p>$' . $item['price'] . '</p>';
                    echo '<p>' . $item['year'] . '</p>';
                    echo '<p>' . $item['km'] . ' Km</p>';
                    echo '<a href="image_gallery.php?id=' . $item['id'] . '" class="listing-button">View Image Gallery</a>';
    
                    echo '</div>';
                    
                    
                    $displayedCarIds[] = $item['id'];
                }
            }
            ?>
        </div>
    </div>

   <?php 
   require('footer.php')
   ?>

    <script>
        function applyFilters() {
            const modelFilter = document.getElementById('model-filter').value;
            const yearFilter = document.getElementById('year-filter').value;
            const kmFilter = document.getElementById('km-filter').value;
            const minPriceFilter = document.getElementById('min-price-filter').value;
            const maxPriceFilter = document.getElementById('max-price-filter').value;
    
            let urlParams = new URLSearchParams(window.location.search);
            urlParams.set('model', modelFilter);
            urlParams.set('year', yearFilter);
            urlParams.set('km', kmFilter);
            urlParams.set('min_price', minPriceFilter);
            urlParams.set('max_price', maxPriceFilter);
            window.location.search = urlParams.toString();
        }

        const kmFilter = document.getElementById('km-filter');
        const kmValue = document.getElementById('km-value');
        kmValue.textContent = kmFilter.value;
        kmFilter.addEventListener('input', () => {
            kmValue.textContent = kmFilter.value;
        });
    </script>
</body>
</html>
