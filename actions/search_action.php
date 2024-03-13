<?php
// Include the connection file
include '../settings/connection.php';

// Check if the search query parameter is set
if (isset($_GET['search'])) {
    // Sanitize the search query
    $search_query = $_GET['search'];

    $sql = "SELECT * FROM products WHERE ProductName = '$search_query'";

    $result = mysqli_query($conn, $sql);
     if ($result) {
         $product = mysqli_fetch_assoc($result);
         if ($product) {
             // Return the product details in HTML format
            echo "<div>";
             echo "Product Name: " . $product['ProductName'];
            echo "<br>";
             echo "SKU: " . $product['SKU'];
            // Add other product details here
            echo "</div>";
         } else {
             echo "Product not found";
         }
     } else {
        echo "Error executing search query";
     }
    }
