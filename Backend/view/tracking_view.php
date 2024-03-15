<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Inventory Management</title>
    <link rel="stylesheet" href="../css/style_tracking.css" />
    <!-- Font Awesome Cdn Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li>
                    <a href="/home(admin)/home.html" class="logo">
                        <img src="../Chorus.png" />
                        <span class="nav-item">Admin 1</span>
                    </a>
                </li>
                <li>
                    <a href="../Inventory_Tracking/page.html">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-item">Inventory Tracking</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-database"></i>
                        <span class="nav-item">Inventory Management</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-item">Log out</span>
                    </a>
                </li>
            </ul>
        </nav>
        <section class="inventory">
            <div class="inventory-list">
                <h1>Inventory Management</h1>
                <button class="add-inventory-btn" id="add-inventory-btn">
                    Append product information
                </button>
                <button class="add-inventory-btn" id="generate-report">
                    Generate report
                </button>
                <div class="search-container">
                    <form action="/action_page.php">
                        <input type="text" placeholder="Search coundown or product" name="search" id="search-input" />
                        <button class="add-inventory-btn" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product name</th>
                            <th>Supplier contact</th>
                            <th>Last restock</th>
                            <th>Next supply date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="product-list">
                        <?php include '../functions/product_tracking_fxn.php'; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal" id="add-inventory-modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Add Product information</h2>
                    <form action="../actions/inventory_tracking_action/add_product_action.php" method="post" id="product-form">
                        <label for="product-name">Product Name:</label>
                        <select class="add-inventory-btn" name="product-name" id="product-name" required>
                            <option value=" 0">Select</option>
                            <?php
                            include "../functions/select_product_fxn.php";
                            echo $options;
                            ?>
                        </select>
                        <label for="supplier-contact">Supplier Contact:</label>
                        <input type="text" name="supplier-contact" id="supplier-contact-input" placeholder="Enter supplier contact" required />
                        <label for="last-restock">Last Restock:</label>
                        <input type="date" name="last-restock" id="last-restock-input" required />
                        <label for="next-supply-date">Next Supply Date:</label>
                        <input type="date" name="next-supply-date" id="next-supply-date-input" required />
                        <label for="countdown">Countdown:</label>
                        <input type="text" name="countdown" id="countdown-input" placeholder="Enter countdown" required />
                        <button type="submit" name="submit" class="add-product-btn" id="add-product-btn">
                            Add Product
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addInventorybtn = document.getElementById("add-inventory-btn");
            const modal = document.getElementById("add-inventory-modal");
            const closeModalBtn = document.querySelector(".modal .close");

            // Add event listener to the add product button
            addInventorybtn.addEventListener("click", () => {
                modal.style.display = "block";
            });

            // Add event listener to the close button of add product modal
            closeModalBtn.addEventListener("click", () => {
                modal.style.display = "none";
            });

            // Close modal if clicked outside of it
            window.addEventListener("click", function(event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
    </script>
</body>

</html>
</section>
</section>