<?php
include '../actions/get_all_products.php';

$products = getAllProducts();

// Display the Products in a table
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
    echo "<a href='../admin/edit_product_view.php?product_id={$product['ProductID']}'><button class='edit-product-btn'>Edit</button></a>";
    echo "<a href='../actions/delete_product_action.php?product_id={$product['ProductID']}'><button class='delete-product-btn'>Delete</button></a>";
    echo "</td>";
    echo "</tr>";
}

echo '</tbody>';
echo '</table>';