<?php
require_once '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ProductName = $_POST["product-name"];
    $SKU = $_POST["sku"];
    $category = $_POST["category"];
    $Quantity = $_POST["qty-in-stock"];
    $location = $_POST["LocationInshop"];
    $description = $_POST["product-description"];

    // Check if the product already exists in the database
    $check_sql = "SELECT * FROM products WHERE ProductName = '$ProductName'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Product already exists, display an alert
        echo "<script>
        alert('Product already exists in the database. You can edit the quantity.');
        window.location.href='../view/management_view.php'
        </script>";
    } else {
        // Product does not exist, insert a new record
        $sql = "INSERT INTO products (ProductName, SKU, Category, QuantityInStock, LocationInShop, ProductDescription) VALUES ('$ProductName', '$SKU', '$category', '$Quantity', '$location', '$description')";

        $insert_result = $conn->query($sql);
        if ($insert_result) {
            header('Location: ../view/management_view.php');
            exit();
        } else {
            echo "Error inserting new product: " . $conn->error;
        }
    }
} else {
    echo 'error';
    // header('Location: ../view/management_view.php');
    exit();
}
$conn->close();
