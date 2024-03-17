<?php

// Include the connection file
include_once '../settings/connection.php';

// Function to retrieve the user's first name based on their email
function display_name() {
    global $conn;

    // Check if the user is logged in
    if (isset($_SESSION['email'])) {
        // Retrieve the email from the session
        $email = $_SESSION['email'];

        // Query to fetch the first name based on the email
        $sql = "SELECT first_name FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        // Check if the query was successful
        if ($result && $result->num_rows > 0) {
            // Fetch the first name
            $row = $result->fetch_assoc();
            return $row['first_name'];
        } else {
            // Error handling if user not found
            return "Error fetching user information";
        }
    } else {
        // Redirect the user to the login page if not logged in
        header("Location: ../view/login_view.php");
        exit();
    }
}
