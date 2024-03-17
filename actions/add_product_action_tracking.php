<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $ProductID = $_POST["product-name"];
    $contact = $_POST["supplier-contact"];
    $lastRestock = $_POST["last-restock"]; 
    $NextSupply = $_POST["next-supply-date"];
  
    // SQL query to insert product into database
    $sql = "INSERT INTO inventorytracking (product_id,supplier_contact,date_last_restock,next_supply_date) VALUES ('$ProductID', '$contact', '$lastRestock', '$NextSupply')";
    $result = $conn->query($sql);

    
    if ($result) {
        header('Location:../view/tracking_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo 'error';
 
    header('Location:../view/tracking_view.php');
    exit();
}


$conn->close();
