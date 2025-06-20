<?php
// Database configuration
$servername = "localhost"; 
$username = "root"; // Replace with your database usernam
$password = ""; 
$dbname = ""; 
try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch a single active ad (randomly)
    $stmt = $pdo->prepare("SELECT id, title, description, link FROM ads WHERE is_active = 1 ORDER BY RAND() LIMIT 1");
    $stmt->execute();

    // Fetch the ad
    $ad = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if an ad was fetched
    if ($ad) {
        echo '<div class="ad-item" id="ad-' . $ad['id'] . '">';
        echo '<button class="close-btn" onclick="closeAd(' . $ad['id'] . ')">&times;</button>';
        echo '<h3>' . htmlspecialchars($ad['title']) . '</h3>';
        echo '<p>' . htmlspecialchars($ad['description']) . '</p>';
        echo '<a href="' . htmlspecialchars($ad['link']) . '" target="_blank">Learn More</a>';
        echo '</div>';
    } else {
        echo '<p>No ads available.</p>';
    }
} catch (PDOException $e) {
    echo '<p>Error: ' . $e->getMessage() . '</p>';
}
?>
