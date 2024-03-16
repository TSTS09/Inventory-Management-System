<?php
include_once '../actions/get_all_products_action.php';

$products = getAllProducts();

// print_r($products);
// exit();
// Display the Products in a table
if (empty($products)) {
    return;
} else {
    foreach ($products as $product) {
        echo "<tr>";
        echo "<td>{$product['ProductID']}</td>";
        echo "<td>{$product['ProductName']}</td>";
        echo "<td>{$product['SKU']}</td>";
        echo "<td>{$product['Category']}</td>";
        echo "<td>{$product['QuantityInStock']}</td>";
        echo "<td>{$product['LocationInShop']}</td>";
        echo "<td>{$product['ProductDescription']}</td>";
        echo "<td>";
        echo "<a href='#' onclick='editProduct(\"{$product['ProductID']}\", \"{$product['ProductName']}\", \"{$product['SKU']}\", \"{$product['Category']}\", \"{$product['QuantityInStock']}\", \"{$product['LocationInShop']}\", \"{$product['ProductDescription']}\")'><button class='edit-product-btn'>Edit</button></a>";
        echo "<a href='../actions/delete_product_action.php?product_id={$product['ProductID']}'><button class='delete-product-btn'>Delete</button></a>";
        echo "</td>";
        echo "</tr>";
    }
}

?>