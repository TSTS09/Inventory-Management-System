<?php
// Include the connection file
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ProductID = $_POST["product-id"];
    $ProductName = $_POST["edit-product-name"];
    $SKU = $_POST["edit-sku"];
    $category = $_POST["category"];
    $Quantity = $_POST["edit-qty-in-stock"];
    $location = $_POST["edit-LocationInshop"];
    $description = $_POST["edit-product-description"];

    // SQL query to update product in database
    $sql = "UPDATE products SET ProductName='$ProductName', SKU='$SKU', Category='$category', QuantityInStock='$Quantity', LocationInShop='$location', ProductDescription='$description' WHERE ProductID='$ProductID'";

    // Execute the query
    $result = $conn->query($sql);
    if ($result) {
        // Redirect to the product display page after successful update
        header('Location: ../view/management_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If the request method is not POST, redirect to the product display page
    header('Location: ../view/management_view.php');
    exit();
}

// Close the connection
$conn->close();
