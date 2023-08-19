<?php
// Include config file
require_once "../config.php";

// Check if the item_id parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the table_id from the URL and sanitize it
    $table_id = intval($_GET['id']);

    // Construct the DELETE query
    $deleteSQL = "DELETE FROM reservations WHERE reservation_id = '" . $_GET['id'] . "';";

    // Execute the DELETE query
    if (mysqli_query($link, $deleteSQL)) {
        // Item successfully deleted, redirect back to the main page
        header("location: ../panel/reservation-panel.php");
        exit();
    } else {
        // Error occurred during execution, display an error message
        echo "Error: " . mysqli_error($link);
    }

    // Close the connection
    mysqli_close($link);
}
?>
