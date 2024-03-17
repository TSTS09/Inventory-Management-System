<?php
session_unset(); // Unset all session variables

if (ini_get('session.use_cookies')) {
  $params = session_get_cookie_params();
  setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], $params['httponly']); // Expire cookie immediately
}

session_destroy(); // Destroy the session
header("location: ../view/login_view.php"); // Redirect to login page

