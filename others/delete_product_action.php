<?php
// Include the connection file
include '../settings/connection.php';

// Check if product_id is set in the GET URL
if(isset($_GET['product_id'])) {
    // Retrieve product_id from the GET URL
    $productId = $_GET['product_id'];

    // Write your DELETE query
    $sql = "DELETE FROM inventorytracking WHERE product_id = $productId";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to chore display page if deletion was successful
        header('Location: ../view/tracking_view.php');
        exit();
    } else {
        // Display error message if deletion failed
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect to chore display page if product_id is not set in the GET URL
    header('Location: ../view/tracking_view.php');
    exit();
}

// Close the connection
$conn->close();