<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ProductName = $_POST["product-name"];
    $contact = $_POST["supplier-contact-input"];
    $lastRestock = $_POST["last-restock-input"];
    $NextSupply = $_POST["next-supply-date-input"];
    $Countdown = $_POST["countdown-input"];

    // SQL query to insert product into database
    $sql = "INSERT INTO inventorytracking (product_name, supplier_contact, date_last_restock, next_supply_date, countdown_till_next_supply) VALUES ('$ProductName', '$contact', '$lastRestock', '$NextSupply','$Countdown')";
   
    $result = $conn->query($sql);
    if ($result) {
        header('Location: ../view/tracking_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo 'error';
    header('Location: ../view/management_view.php');
    exit();
}
$conn->close();
