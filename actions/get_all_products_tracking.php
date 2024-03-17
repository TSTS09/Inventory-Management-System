<?php
include '../settings/connection.php';

function getAllProducts()
{
    global $conn;
    $products = array();
    $sql = "SELECT i.product_id, p.ProductName, i.supplier_contact, i.date_last_restock, i.next_supply_date 
        FROM inventorytracking i 
        INNER JOIN products p ON i.product_id = p.ProductID";
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
