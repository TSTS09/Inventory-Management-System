<?php
include '../actions/get_all_products_tracking.php';
$products = getAllProducts();

// print_r($products);
// exit();

// Display the Products in a table
foreach ($products as $product) {
    echo "<tr>";
    echo "<td>{$product['ProductName']}</td>";
    echo "<td>{$product['supplier_contact']}</td>";
    echo "<td>{$product['date_last_restock']}</td>";
    echo "<td>{$product['next_supply_date']}</td>";
    echo "<td>";
    echo "<a href='#' onclick='return editProduct(\"{$product['product_id']}\", \"{$product['supplier_contact']}\", \"{$product['date_last_restock']}\", \"{$product['next_supply_date']}\")'><button class='edit-product-btn'>Edit</button></a>";
    echo "<a href='../actions/delete_action_tracking.php?product_id={$product['product_id']}'><button class='delete-product-btn'>Delete</button></a>";
    echo "</td>";
    echo "</tr>";
}
echo '</tbody>';
echo '</table>';
?>

<!-- Hidden modal for editing -->
<div class="modal" id="edit-modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Product</h2>
        <form action="../actions/edit_product_action_tracking.php" method="post">
            <input type="hidden" id="edit-product-id" name="product_id"/>
            <label for="edit-product-name">Product Name:</label>
            <select class="add-inventory-btn" name="product-name" id="edit-product-name" disabled>
                <option value="">Select</option>
                <?php
                $sql = "SELECT i.product_id, p.ProductName FROM inventorytracking i 
            INNER JOIN products p ON i.product_id = p.ProductID";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=\"{$row['product_id']}\" selected>{$row['ProductName']}</option>";
                    }
                }
                ?>
            </select>
            <label for="edit-supplier-contact">Supplier Contact:</label>
            <input type="text" id="edit-supplier-contact" name="supplier-contact" placeholder="Enter supplier contact" required />
            <label for="edit-last-restock">Last Restock:</label>
            <input type="date" id="edit-last-restock" name="last-restock" required />
            <label for="edit-next-supply-date">Next Supply Date:</label>
            <input type="date" id="edit-next-supply-date" name="next-supply-date" required />
            <button type="submit" name="submit" class="add-inventory-btn" id="edit-inventory-btn">
                Save Changes
            </button>
        </form>
    </div>
</div>
<script>
    function editProduct(id, contact, lastRestock, nextSupply) {
        document.getElementById('edit-product-id').value = id;
        document.getElementById('edit-supplier-contact').value = contact;
        document.getElementById('edit-last-restock').value = lastRestock;
        document.getElementById('edit-next-supply-date').value = nextSupply;
        document.getElementById('edit-modal').style.display = 'block';
        console.log({id})
        return false; // Prevent the default link behavior
    }

    document.querySelector('.modal .close').addEventListener('click', function() {
        document.getElementById('edit-modal').style.display = 'none';
    });
</script>