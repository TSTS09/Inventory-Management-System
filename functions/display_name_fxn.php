<?php
// Include the connection file
include_once '../settings/connection.php';
function display_name()
{
    global $conn;
    // Check if the search query parameter is set
    if (isset($_GET['firstName'])) {
        // Sanitize the search query
        $search_query = $_GET['firstName'];

        $sql = "SELECT * FROM users WHERE first_name = '$search_query'";

        $result = mysqli_query($conn, $sql);
        if ($result) {
            $name = mysqli_fetch_assoc($result);
            if ($name) {
                return $name['first_name'];
            } else {
                return "User not found";
             }
            }
       else{
                return "Error executing search query";
            }
        }
    }
                   