<?php
include '../settings/connection.php';

function getAllProducts()
{
    global $conn;
    $products = array();
    $sql = "SELECT p.ProductID, p.ProductName, p.SKU, c.categoryname AS Category, p.QuantityInStock, p.LocationInShop, p.ProductDescription
    FROM products p
    INNER JOIN categories c ON p.Category = c.categoryid";
    $result = $conn->query("$sql");
    if (!$result) {
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            return $products;
        }
    }
    $conn->close();
}
