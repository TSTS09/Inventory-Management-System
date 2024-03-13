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
        <section class="main">
            <div class="main-top">
                <h1>Chores Dashboard</h1>
                <h2 style="margin-left: 880; margin-top: 4px; color: rgb(121, 112, 112);font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;width: 50%;">
                    <b>Mr, John Paul</b>
                </h2>
            </div>
            <div class="users">
                <div onclick="redirectToChorePage()" class="card">
                    <img src="pic1.webp">
                    <h4>Work In-Progress</h4>
                    <h4><i>50</i></h4>
                    <p> Last activity</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>85%</span></td>
                                <td><span>87%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>More Infos</button>
                </div>
                <div onclick="redirectToChorePage()" class="card">
                    <img src="pic2.webp">
                    <h4>Pending Tasks</h4>
                    <h4><i>50</i></h4>
                    <p> Last activity</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>82%</span></td>
                                <td><span>85%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>More Infos</button>
                </div>
                <div onclick="redirectToChorePage()" class="card">
                    <img src="pic4.png">
                    <h4>Incomplete Tasks</h4>
                    <h4><i>50</i></h4>
                    <p> Last activity</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>94%</span></td>
                                <td><span>92%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>More Infos</button>
                </div>
                <div onclick="redirectToChorePage()" class="card">
                    <img src="pic3.jpg">
                    <h4>Completed Tasks</h4>
                    <h4><i>50</i></h4>
                    <p> Last activity</p>
                    <div class="per">
                        <table>
                            <tr>
                                <td><span>85%</span></td>
                                <td><span>82%</span></td>
                            </tr>
                            <tr>
                                <td>Month</td>
                                <td>Year</td>
                            </tr>
                        </table>
                    </div>
                    <button>More Infos</button>
                </div>
            </div>
            <section class="attendance">
                <div class="attendance-list">
                    <h1>Inventory Tracking</h1><br>
                    <button class="add-inventory-btn" id="add-inventory-btn">
                        Add Product
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
                                <th>Countdown</th>
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

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const addProductBtn = document.getElementById("add-product-btn");
                        const modal = document.getElementById("add-inventory-modal");
                        const closeModalBtn = document.querySelector(".modal .close");

                        // Add event listener to the add product button
                        addProductBtn.addEventListener("click", () => {
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