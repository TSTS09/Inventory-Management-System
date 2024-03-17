<?php
require_once '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ProductName = $_POST["product-name"];
    $SKU = $_POST["sku"];
    $category = $_POST["category"];
    $Quantity = $_POST["qty_in_stock"];
    $location = $_POST["LocationInshop"];
    $description = $_POST["product-description"];
    
    // SQL query to insert chore into database
    $sql = "INSERT INTO products (ProductName, SKU, Category, QuantityInStock, LocationInShop,ProductDescription) VALUES ('$productName', '$SKU', '$category', '$Quantity','$location', '$description')";
    
    $result = $conn->query($sql);
    if ($result) {
        header('Location: ../view2/chore_control_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo 'error';
    header('Location: ../chore_control_view.php');
    exit();
}
$conn->close();

?>
