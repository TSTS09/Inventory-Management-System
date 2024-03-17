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
                    <a href="" class="logo">
                        <img src="../images/logo.jpg" />
                        <span class="nav-item">
                            <?php
                            // include_once '../settings/connection.php';
                            // include_once '../functions/display_name_fxn.php';
                            // echo display_name();
                            ?>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-item">Inventory Tracking</span>
                    </a>
                </li>
                <li>
                    <a href="management_view.php">
                        <i class="fas fa-database"></i>
                        <span class="nav-item">Inventory Management</span>
                    </a>
                </li>
                <li>
                    <a href="../actions/logout_user_action.php" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-item">Log out</span>
                    </a>
                </li>
            </ul>
        </nav>
        <section class="inventory">
            <div class="inventory-list">
                <h1>Inventory Tracking</h1>
                <button class="add-inventory-btn" id="add-inventory-btn">
                    Append product information
                </button>
                <button class="add-inventory-btn" id="generate-report">
                    Generate report
                </button>
                <div class="search-container">
                    <form>
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
                        <?php
                        if (isset($_GET['search'])) {
                            include '../actions/search_action_tracking.php';
                            display_search_tracking();
                        } else {
                            include '../functions/product_tracking_fxn.php';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal" id="add-inventory-modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Add Product information</h2>
                    <form action="../actions/add_product_action_tracking.php" method="POST" id="product-form">
                        <label for="product-name">Product Name:</label>
                        <select class="add-inventory-btn" name="product-name" id="product-id" required>
                            <option value="">Select</option>
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
                        <button type="submit" name="submit" class="add-inventory-btn" id="add-inventory-btn">
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

            function updateNextSupplyDateMin() {
                const lastRestockInput = document.getElementById("last-restock-input");
                const nextSupplyDateInput = document.getElementById("next-supply-date-input");

                // Calculate the minimum date for the next supply date as one day after the last restock
                const lastRestockDate = new Date(lastRestockInput.value);
                const nextSupplyDateMin = new Date(lastRestockDate);
                nextSupplyDateMin.setDate(lastRestockDate.getDate() + 1);

                // Format the minimum date as "YYYY-MM-DD" for the input value
                const nextSupplyDateMinFormatted = nextSupplyDateMin.toISOString().split('T')[0];

                // Set the minimum value of the next supply date input
                nextSupplyDateInput.min = nextSupplyDateMinFormatted;
                nextSupplyDateInput.value = nextSupplyDateMinFormatted;
            }
        });
        document.getElementById('generate-report').addEventListener('click', function() {
            window.location.href = '../actions/generate_report.php';
        });
    </script>
</body>

</html>


<?php
// include_once '../settings/connection.php';
// include_once '../functions/display_name_fxn.php';
// echo display_name();
?>