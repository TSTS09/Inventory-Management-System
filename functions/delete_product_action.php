<?php
// Include the connection file
include '../settings/connection.php';

// Check if chore_id is set in the GET URL
if(isset($_GET['product_id'])) {
    // Retrieve chore_id from the GET URL
    $productId = $_GET['product_id'];

    // Write your DELETE query
    $sql = "DELETE FROM products WHERE ProductID = $productId";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to chore display page if deletion was successful
        header('Location: ../view/management_view.php');
        exit();
    } else {
        // Display error message if deletion failed
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect to chore display page if chore_id is not set in the GET URL
    header('Location: ../view/management_view.php');
    exit();
}

// Close the connection
$conn->close();