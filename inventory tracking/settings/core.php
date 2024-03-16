<?php

session_start();

function checkLogin() {
    // Check if user id session exists
    if (!isset($_SESSION['userId'])) {
        header('Location: ../view/login_view.php');    
        die();
    }
}