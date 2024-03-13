<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ProductName = $_POST["product-name"];
    $SKU = $_POST["sku"];
    $category = $_POST["category"];
    $Quantity = $_POST["qty-in-stock"];
    $location = $_POST["LocationInshop"];
    $description = $_POST["product-description"];

    // SQL query to insert product into database
    $sql = "INSERT INTO products (ProductName, SKU, Category, QuantityInStock, LocationInShop,ProductDescription) VALUES ('$ProductName', '$SKU', '$category', '$Quantity','$location', '$description')";
    echo "aspidnqfkn";
    $result = $conn->query($sql);
    if ($result) {
        header('Location: ../view/management_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo 'error';
    header('Location: ../view/management_view.php');
    exit();
}
$conn->close();