<?php
include '../settings/connection.php';

function getAllProducts()
{
    global $conn;
    $products = array();
    $sql = "SELECT * FROM products";
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