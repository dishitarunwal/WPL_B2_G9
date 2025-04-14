<?php
require_once 'config.php';

$query = "SELECT r.id, r.title, r.image, r.rating, r.prep_time, r.difficulty, c.name AS cuisine 
          FROM recipes r 
          LEFT JOIN cuisines c ON r.cuisine_id = c.id
          ORDER BY r.created_at DESC
          LIMIT 10";

$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    while($recipe = $result->fetch_assoc()) {
        echo "<div class='recipe-card'>";
        echo "<img src='" . htmlspecialchars($recipe['image']) . "' alt='" . htmlspecialchars($recipe['title']) . "'>";
        echo "<h3>" . htmlspecialchars($recipe['title']) . "</h3>";
        echo "<p>Cuisine: " . htmlspecialchars($recipe['cuisine']) . "</p>";
        echo "<p>Rating: " . htmlspecialchars($recipe['rating']) . " / 5</p>";
        echo "<p>Time: " . htmlspecialchars($recipe['prep_time']) . " mins</p>";
        echo "<p>Difficulty: " . htmlspecialchars($recipe['difficulty']) . "</p>";
        echo "<button>View Recipe</button>";
        echo "</div>";
    }
} else {
    echo "No recipes available.";
}
?>
