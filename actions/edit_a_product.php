<?php
// Include the connection file
require_once '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ProductID = $_POST["product_id"];
    $ProductName = $_POST["product_name"];
    $SKU = $_POST["sku"];
    $category = $_POST["category"];
    $Quantity = $_POST["quantity_in_stock"];
    $location = $_POST["location_in_shop"];
    $description = $_POST["product_description"];

    // SQL query to update product in database
    $sql = "UPDATE products SET ProductName=?, SKU=?, Category=?, QuantityInStock=?, LocationInShop=?, ProductDescription=? WHERE ProductID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssissi", $ProductName, $SKU, $category, $Quantity, $location, $description, $ProductID);

    // Execute the query
    if ($stmt->execute()) {
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
?>