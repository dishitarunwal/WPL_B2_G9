<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['id'])) {
    die("Access denied. Please log in first.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id'];
    $vegetarian = isset($_POST['vegetarian']) ? 1 : 0;
    $lactose_intolerant = isset($_POST['lactose_intolerant']) ? 1 : 0;
    $allergies = trim($_POST['allergies']);
    $spice_level = $_POST['spice_level'];

    // Check if preferences already exist for the user
    $stmt = $mysqli->prepare("SELECT id FROM dietary_preferences WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0) {
        // Update existing preferences
        $stmt->close();
        $updateStmt = $mysqli->prepare("UPDATE dietary_preferences 
                                        SET vegetarian = ?, lactose_intolerant = ?, allergies = ?, spice_level = ?
                                        WHERE user_id = ?");
        $updateStmt->bind_param("iissi", $vegetarian, $lactose_intolerant, $allergies, $spice_level, $user_id);
        if($updateStmt->execute()){
            echo "Preferences updated successfully.";
        } else {
            echo "Error updating preferences.";
        }
        $updateStmt->close();
    } else {
        // Insert new preferences
        $stmt->close();
        $insertStmt = $mysqli->prepare("INSERT INTO dietary_preferences (user_id, vegetarian, lactose_intolerant, allergies, spice_level)
                                        VALUES (?, ?, ?, ?, ?)");
        $insertStmt->bind_param("iiiss", $user_id, $vegetarian, $lactose_intolerant, $allergies, $spice_level);
        if($insertStmt->execute()){
            echo "Preferences saved successfully.";
        } else {
            echo "Error saving preferences.";
        }
        $insertStmt->close();
    }
}
?>
<!-- Sample HTML form for updating dietary preferences -->
<form method="post" action="update_preferences.php">
  <label>
    <input type="checkbox" name="vegetarian" value="1"> Vegetarian
  </label>
  <br>
  <label>
    <input type="checkbox" name="lactose_intolerant" value="1"> Lactose Intolerant
  </label>
  <br>
  <label>Allergies (if any):</label>
  <input type="text" name="allergies">
  <br>
  <label>Spice Level:</label>
  <select name="spice_level">
    <option value="Low">Low</option>
    <option value="Medium" selected>Medium</option>
    <option value="High">High</option>
  </select>
  <br>
  <button type="submit">Save Preferences</button>
</form>
