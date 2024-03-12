<?php

$errors = array();
$success = "";

$query = "SELECT productName FROM products WHERE productName NOT IN (SELECT product_name FROM inventorytracking) ";
$result = $conn->query($query);

$productNames = array();
while ($row = $result->fetch_assoc()) {
    $productNames[] = $row['productName'];
}
$options = '';
foreach ($productNames as $productName) {
    $options .= '<option value="' . strtolower(str_replace(' ', '', $productName)) . '">' . htmlspecialchars($productName) . '</option>';
}



$query = "SELECT product_name FROM inventorytracking ";
$result = $conn->query($query);

$INproductNames = array();
while ($row = $result->fetch_assoc()) {
    $INproductNames[] = $row['product_name'];
}
$editOptions = '';
foreach ($INproductNames as $INproductName) {
    $editOptions .= '<option value="' . strtolower(str_replace(' ', '', $INproductName)) . '">' . htmlspecialchars($INproductName) . '</option>';
}






function getInventoryTrackingData($conn) {
  $inventoryTrackingData = [];

  $result = $conn->query("SELECT * FROM inventorytracking");

  if ($result === false) {
      die("Error fetching data from inventorytracking: " . $conn->error);
  }

  while ($row = $result->fetch_assoc()) {
      $inventoryTrackingData[] = $row;
  }

  return $inventoryTrackingData;
}

function addInventoryTrackingdata($conn){
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $productName = trim($_POST["product_name"]);
    $supplier_contact = trim($_POST["supplier_contact"]);
    $date_last_restock = $_POST["date_last_restock"];
    $next_supply_date = $_POST["next_supply_date"];
    $countdown_till_next_supply = $_POST[Math.round(diffInDays)]
   
    if (empty($errors)) {
        
        include 'connection.php';
  
        
        $stmt = $conn->prepare("INSERT INTO inventorytracking ( product_name, supplier_contact, date_last_restock, next_supply_date, countdown_till_next_supply) 
        VALUES ('$productName', '$supplier_contact', '$date_last_restock',  '$next_supply_date','$countdown_till_next_supply')");
  
      
        if ($stmt->execute()) {
            $success = "inventory added successfully!";
        } else {
            $errors[] = "Error adding inventory: " . $stmt->error;
        }
  
        $stmt->close();
        
    
        $conn->close();
    }
  }

}

function deleteInventoryTrackingData($conn, $productName) {
  $stmt = $conn->prepare("DELETE FROM inventorytracking WHERE product_name = ?");
  $stmt->bind_param("s", $productName);

  if ($stmt->execute()) {
      $success = "Inventory deleted successfully!";
  } else {
      $errors[] = "Error deleting inventory: " . $stmt->error;
  }

  $stmt->close();
}


function updateInventoryTrackingData($conn, $productName) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $supplier_contact = trim($_POST["supplier-contact"]);
      $date_last_restock = $_POST["edit-last-restock"];
      $next_supply_date = $_POST["edit-next-supply-date"];
      $countdown_till_next_supply = $_POST["edit-countdown"];

      if (empty($errors)) {
          include 'connection.php';

          $update = $conn->prepare("UPDATE inventorytracking SET supplier_contact = ?, date_last_restock = ?, next_supply_date = ? WHERE product_name = ?");
          $update->bind_param("ssss", $supplier_contact, $date_last_restock, $next_supply_date, $productName);

          if ($update->execute()) {
              $success = "Inventory updated successfully!";
          } else {
              $errors[] = "Error updating inventory: " . $update->error;
          }

          $update->close();
          $conn->close();
      }
  }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Inventory tracking</title>
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
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
            <a href="#">
              <i class="fas fa-chart-bar"></i>
              <span class="nav-item">Inventory Tracking</span>
            </a>
          </li>
          <li>
            <a href="../Inventory_Management/page.html">
              <i class="fas fa-database"></i>
              <span class="nav-item">Inventory Managemenet</span>
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
          <?php
            if (!empty($errors)) {
                echo '<div class="error-message">' . implode('<br>', $errors) . '</div>';
            } elseif (!empty($success)) {
                echo '<div class="success-message">' . $success . '</div>';
            }
          ?>
          <h1>Inventory Tracking</h1>
          <button class="add-inventory-btn" id="add-inventory-btn">
            Add inventory
          </button>
          <button class="add-inventory-btn" id="generate-report">
            Generate report
          </button>
          <div class="search-container">
            <form action="/action_page.php">
              <input type="text" placeholder="Search coundown or product" name="search" id="search-input">
              <button class="add-inventory-btn" type="submit"><i class="fa fa-search"></i></button>
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
                <?php
                  include 'connection.php';
                  $inventoryTrackingData = getInventoryTrackingData($conn);

                  foreach ($inventoryTrackingData as $row) {
                      echo '<tr>';
                      echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
                      echo '<td>' . htmlspecialchars($row['supplier_contact']) . '</td>';
                      echo '<td>' . htmlspecialchars($row['date_last_restock']) . '</td>';
                      echo '<td>' . htmlspecialchars($row['next_supply_date']) . '</td>';
                      echo '<td>' . htmlspecialchars($row['countdown_till_next_supply']) . '</td>';
                      echo '<td><a href="#" class="edit-btn" onclick="editInventory(\'' . htmlspecialchars($row['product_name']) . '\')">Edit</a>';
                      echo ' | <a href="#" class="delete-btn" onclick="deleteInventory(\'' . htmlspecialchars($row['product_name']) . '\')">Delete</a></td>';
                      echo '</tr>';
                  }

                  $conn->close();
                ?>
              </tr>
            </thead>
            <tbody id="inventory-list"></tbody>
          </table>
        </div>
        <div class="modal" id="add-inventory-modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Add product Information</h2>
            <form action="" method="post" id="inventory-form">
              <label for="product-name">Product Name:</label>
              <select name="product-name" id="product-name" required>
                <option value="" selected disabled>Select a product</option>

                <?php echo $options; ?>

              </select>
              <label for="supplier-contact">Supplier Contact:</label>
              <input
                type="text"
                name="supplier-contact"
                id="supplier-contact"
                placeholder="Enter supplier contact"
                required
              />
              <label for="last-restock">Last Restock:</label>
              <input
                type="date"
                name="last-restock"
                id="last-restock"
                required
              />
              <label for="next-supply-date">Next Supply Date:</label>
              <input
                type="date"
                name="next-supply-date"
                id="next-supply-date"
                required
              />
              <label for="countdown">Countdown:</label>
              <input type="text" name="countdown" id="countdown" readonly />
              <button
                type="submit"
                name="submit"
                class="add-inventory-btn"
                id="add-inventory-btn"
              >
                Add Product
              </button>
            </form>
            <?php
                addInventoryTrackingdata($conn);
            ?>
          </div>
        </div>
        <div class="modal" id="edit-inventory-modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Edit Product</h2>
            <form action="" method="post" id="edit-inventory-form">
              <!-- <input type="hidden" name="inventory-id" id="edit-inventory-id" /> -->
              <label for="edit-inventory-name">Product Name:</label>
              <select name="product-name" id="product-name" required>
                <option value="" selected disabled>Select a product</option>

                <?php echo $editOptions; ?>
              </select>
              <label for="edit-quantity-in-stock">Quantity in Stock:</label>
              <input
                type="text"
                name="edit-quantity-in-stock"
                id="edit-quantity-in-stock"
                required
                readonly
              />
              <label for="edit-supplier-contact">Supplier Contact:</label>
              <input
                type="text"
                name="edit-supplier-contact"
                id="edit-supplier-contact"
                required
              />
              <label for="edit-last-restock">Last Restock:</label>
              <input
                type="date"
                name="edit-last-restock"
                id="edit-last-restock"
                required
              />
              <label for="edit-next-supply-date">Next Supply Date:</label>
              <input
                type="date"
                name="edit-next-supply-date"
                id="edit-next-supply-date"
                required
              />
              <input type="hidden" name="countdown" id="edit-countdown" />
              <button
                type="submit"
                name="submit"
                class="add-inventory-btn"
                id="add-inventory-btn"
              >
                Save Changes
              </button>
            </form>
            <?php
              updateInventoryTrackingData($conn);
            ?>
          </div>
        </div>
      </section>
    </div>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const addinventoryBtn = document.getElementById("add-inventory-btn");
        const modal = document.getElementById("add-inventory-modal");
        const closeModalBtn = document.querySelector(".modal .close");

        // Add event listener to the add inventory button
        addinventoryBtn.addEventListener("click", () => {
          modal.style.display = "block";
        });

        // Add event listener to the close button of add inventory modal
        closeModalBtn.addEventListener("click", () => {
          modal.style.display = "none";
        });

        // Calculate and display the countdownadd-Inventory-btn
        var lastRestock = new Date();
        var nextSupplyDate = new Date(inventoryDetails.nextSupplyDate);
        var diffInTime = nextSupplyDate.getTime() - lastRestock.getTime();
        var diffInDays = diffInTime / (1000 * 3600 * 24);
        document.getElementById("edit-countdown").value =
          Math.round(diffInDays);
      });
    </script>
  </body>
</html>
