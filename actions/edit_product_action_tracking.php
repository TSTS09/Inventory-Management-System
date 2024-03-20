<?php
// Include the connection file
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ProductID = $_POST["product_id"];
    $contact = $_POST["supplier-contact"];
    $lastRestock = $_POST["last-restock"]; 
    $NextSupply = $_POST["next-supply-date"];
    
    // SQL query to update product in database
    $sql = "UPDATE inventorytracking SET supplier_contact=?, date_last_restock=?, next_supply_date=? WHERE product_id=?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $contact, $lastRestock, $NextSupply, $ProductID);
    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the product display page after successful update
        header('Location: ../view/tracking_view.php');
        echo "$ProductID";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If the request method is not POST, redirect to the product display page
    header('Location: ../view/tracking_view.php');
    exit();
}

// Close the connection
$conn->close();
