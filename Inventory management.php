<?php

function connectToDatabase() {
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "sven";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Function to fetch data from the inventorytracking table
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

// Function to fetch data from the inventorymanagement table
function getInventoryManagementData($conn) {
    $inventoryManagementData = [];

    $result = $conn->query("SELECT * FROM inventorymanagement");

    if ($result === false) {
        die("Error fetching data from inventorymanagement: " . $conn->error);
    }

    while ($row = $result->fetch_assoc()) {
        $inventoryManagementData[] = $row;
    }

    return $inventoryManagementData;
}

// Main script

// Validate the action parameter
$action = isset($_GET['action']) ? sanitize($_GET['action']) : null;

if ($action !== null && $action !== 'getInventoryTracking' && $action !== 'getInventoryManagement') {
    die("Invalid action requested");
}

// Connect to the database
$conn = connectToDatabase();

// Fetch data based on the action parameter
if ($action === 'getInventoryTracking') {
    $data = getInventoryTrackingData($conn);
} elseif ($action === 'getInventoryManagement') {
    $data = getInventoryManagementData($conn);
} else {
    die("Invalid action requested");
}

// Close the database connection
$conn->close();

// Output data as JSON
header('Content-Type: application/json');
echo json_encode($data);

