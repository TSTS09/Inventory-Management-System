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
    echo "<a href='#' onclick='editProduct(\"{$product['ProductID']}\", \"{$product['ProductName']}\", \"{$product['SKU']}\", \"{$product['Category']}\", \"{$product['QuantityInStock']}\", \"{$product['LocationInShop']}\", \"{$product['ProductDescription']}\")'><button class='edit-product-btn'>Edit</button></a>";
    echo "<a href='../actions/delete_product_action.php?product_id={$product['ProductID']}'><button class='delete-product-btn'>Delete</button></a>";
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
        <form action="../actions/edit_a_product.php" method="post">
            <input type="hidden" id="edit-product-id" name="product_id" />
            <label for="edit-product-name">Product Name:</label>
            <input type="text" id="edit-product-name" name="product_name" required />
            <label for="edit-sku">SKU:</label>
            <input type="text" id="edit-sku" name="sku" required />
            <label for="edit-category">Category:</label>
            <select class="add-inventory-btn" name="category" id="edit-category" required>
              <option value="">Select</option>
              <?php
              include "../functions/select_category_fxn.php";
              echo $options;
              ?>
            </select>
            <label for="edit-quantity">Quantity in Stock:</label>
            <input type="number" id="edit-quantity" name="quantity_in_stock" required />
            <label for="edit-location">Location in Shop:</label>
            <input type="text" id="edit-location" name="location_in_shop" required />
            <label for="edit-description">Product Description:</label>
            <input type="text" id="edit-description" name="product_description" />
            <button class="add-inventory-btn" type="submit">Save Changes</button>
        </form>
    </div>
</div>
<script>
    function editProduct(id, name, sku, category, quantity, location, description) {
        document.getElementById('edit-product-id').value = id;
        document.getElementById('edit-product-name').value = name;
        document.getElementById('edit-sku').value = sku;
        document.getElementById('edit-category').value = category;
        document.getElementById('edit-quantity').value = quantity;
        document.getElementById('edit-location').value = location;
        document.getElementById('edit-description').value = description;
        document.getElementById('edit-modal').style.display = 'block';
    }

    document.querySelector('.modal .close').addEventListener('click', function() {
        document.getElementById('edit-modal').style.display = 'none';
    });
</script>
