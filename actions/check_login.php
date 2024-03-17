<?php

$login_technology = 'sessions';

// Function to check login based on technology (replace with your implementation)
function is_user_logged_in($technology) {
  if ($technology === 'sessions') {
    session_start();
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
  } else {
    throw new Exception('Unsupported login technology: ' . $technology);
  }
}

// Check if user is logged in
if (is_user_logged_in($login_technology)) {
  
} else {
  // User is not logged in, redirect or display error
  $login_page = 'login.php'; // Replace with your actual login page path
  header("Location: $login_page");
  exit;  // Stop script execution
}
