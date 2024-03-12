<?php
include '../actions/get_all_products_action.php';

$products = getAllProducts();

// Display the chores in a table
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
    echo "<a href='../admin/edit_chore_view.php?chore_id={$chore['cid']}'><button class='edit-chore-btn'>Edit</button></a>";
    echo "<a href='../actions/delete_chore_action.php?chore_id={$chore['cid']}'><button class='delete-chore-btn'>Delete</button></a>";
    echo "</td>";
    echo "</tr>";
}

echo '</tbody>';
echo '</table>';