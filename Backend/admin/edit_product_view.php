<?php
// Check if the user is logged in
include '../settings/core.php';

// Include the get_a_product.php file
include '../actions/get_a_product.php';

// Check if product_id is provided in the GET URL
if (isset($_GET['product_id'])) {
    // Retrieve Product ID from GET URL
    $ProductID = $_GET['product_id'];

    // Call getProductById() function to retrieve Product details
    $Product = getProductById($ProductID);

    // Check if Product details are found
    if ($Product) {
        // Display edit form
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Product</title>
            <link rel="stylesheet" href="../css/style_management.css">
            <script>
                window.onload = function() {
                    document.getElementById('edit-product-id').value = '<?php echo $ProductID; ?>';
                    document.getElementById('edit-product-name').value = '<?php echo $Product['ProductName']; ?>';
                    document.getElementById('edit-sku').value = '<?php echo $Product['SKU']; ?>';
                    document.getElementById('category').value = '<?php echo $Product['Category']; ?>';
                    document.getElementById('edit-qty-in-stock').value = '<?php echo $Product['QuantityInStock']; ?>';
                    document.getElementById('edit-LocationInshop').value = '<?php echo $Product['LocationInShop']; ?>';
                    document.getElementById('edit-product-description').value = '<?php echo $Product['ProductDescription']; ?>';
                }
            </script>
        </head>

        <body>
            <div class="modal" id="edit-inventory-modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Edit Product</h2>
                    <?php
                    // Check if product_id is provided in the GET URL
                    if (isset($_GET['product_id'])) {
                        // Retrieve Product ID from GET URL
                        $ProductID = $_GET['product_id'];

                        // Call getProductById() function to retrieve Product details
                        $Product = getProductById($ProductID);

                        // Check if Product details are found
                        if ($Product) {
                            // Display edit form
                    ?>
                            <form action="../actions/edit_a_product_action.php" method="post" id="edit-product-form">
                                <input type="hidden" name="product-id" id="edit-product-id" />
                                <label for="edit-product-name">Product Name:</label>
                                <input type="text" name="edit-product-name" id="edit-product-name" required />
                                <label for="edit-sku">SKU:</label>
                                <input type="text" name="edit-sku" id="edit-sku" required />
                                <label for="category">Category:</label>
                                <select name="category" id="category" required>
                                    <option value="0">Select</option>
                                    <?php
                                    include "../functions/select_category_fxn.php";
                                    echo $options;
                                    ?>
                                </select>
                                <label for="edit-qty-in-stock">Quantity in Stock:</label>
                                <input type="number" name="edit-qty-in-stock" id="edit-qty-in-stock" required />
                                <label for="edit-LocationInshop">Location in shop:</label>
                                <input type="text" name="edit-LocationInshop" id="edit-LocationInshop" required />
                                <label for="edit-product-description">Product Description(optional):</label>
                                <input type="text" name="edit-product-description" id="edit-product-description" />
                                <button type="submit" name="submit" class="add-inventory-btn" id="save-changes-btn">
                                    Save Changes
                                </button>
                            </form>
                    <?php
                        } else {
                            // Product not found, redirect to Product display page
                            header("Location: ../view/management_view.php");
                            exit();
                        }
                    } else {
                        // Product ID not provided, redirect to Product display page
                        header("Location: ../view/management_view.php");
                        exit();
                    }
                    ?>
                </div>
            </div>
        </body>

        </html>
<?php
    } else {
        // Product not found, redirect to Product display page
        header("Location: ../view/management_view.php");
        exit();
    }
} else {
    // Product ID not provided, redirect to Product display page
    header("Location: ../view/management_view.php");
    exit();
}
?>