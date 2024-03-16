<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $ProductID = $_POST["product-id"];
    $contact = $_POST["supplier-contact-input"];

    $lastRestock = $_POST["last-restock-input"];
    $dateObj = DateTime::createFromFormat('m-d-Y', $lastRestock);
    $convertedDate = $dateObj->format('Y-m-d');

    $NextSupply = $_POST["next-supply-date-input"];
    $dateObj2 = DateTime::createFromFormat('m-d-Y', $NextSupply);
    $convertedDate2 = $dateObj->format('Y-m-d');

    // SQL query to insert product into database
    $sql = "INSERT INTO inventorytracking (product_id,supplier_contact,date_last_restock,next_supply_date) VALUES ('$ProductID', '$contact', '$convertedDate', '$convertedDate2')";

    $result = $conn->query($sql);
    if ($result) {
        // header('Location:../view/tracking_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo 'error';
    // header('Location:../view/tracking_view.php');
    exit();
}

$conn->close();
