<?php
// Include the connection file
include_once '../settings/connection.php';

function display_search_tracking()
{
    global $conn;
    // Checking if the search query parameter is set
    if (isset($_GET['search'])) {
        // Sanitize the search query
        $search_query = $_GET['search'];

        // Constructing the SQL query to retrieve data from the inventory_tracking table
        $sql = "SELECT t.*, p.ProductName
                FROM inventorytracking t
                INNER JOIN products p ON t.product_id = p.ProductID
                WHERE p.ProductName LIKE '%$search_query%'
                OR t.product_id = '$search_query'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            while ($product = mysqli_fetch_assoc($result)) {
                // Return the product details in HTML format
                echo "
                <tr>
                    <td>" . $product['ProductName'] . " </td>
                    <td>" . $product['supplier_contact'] . " </td>
                    <td>" . $product['date_last_restock'] . " </td>
                    <td>" . $product['next_supply_date'] . " </td>
                    <td>
                        <a href='#' onclick='editProduct(\"{$product['product_id']}\", \"{$product['ProductName']}\", \"{$product['supplier_contact']}\", \"{$product['date_last_restock']}\", \"{$product['next_supply_date']}\")'><button class='edit-product-btn'>Edit</button></a>
                        <a href='../actions/delete_product_action.php?product_id={$product['product_id']}'><button class='delete-product-btn'>Delete</button></a>
                    </td>
                </tr>
                ";
            }
        } else {
            echo "Error executing search query";
        }
    }
}

