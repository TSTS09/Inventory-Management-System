<?php

// Include the connection file
include_once '../settings/connection.php';

// Function to retrieve the user's first name based on their email
function display_name($email) {
        global $conn;
        // Query to fetch the first name based on the email
        $sql = "SELECT first_name FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        // var_dump($result);
        // exit();
        // Check if the query was successful
        if ($result) {
            // Fetch the first name
            $row = $result->fetch_assoc();
            return $row['first_name'];
        } else {
            // Error handling if user not found
            return "Error fetching user information";
        }
    }

