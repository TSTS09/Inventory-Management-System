<?php

session_start();

include '../settings/connection.php';

if ((isset($_SERVER['REQUEST_METHOD']) == "POST") && isset($_POST['signInButton'])) {

    $email = $_POST['emailInput'];
    $passwordInput = $_POST['passwordInput'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($passwordInput, $row['password'])) {
            $_SESSION['userId'] = $row['userid'];
            header('Location: ../view/management_view.php?msg=sucess');
            exit();
        } else {
            echo "Incorrect username or password. Please try again.";
            header('Location: ../view/login_view.php?msg=Incorrect username or password. Please try again.');
            exit;
        }
    } else {
        echo "User not registered or incorrect username or password, Please try again.";
        header('Location: ../view/login_view.php?msg=User not registered or incorrect username or password, Please try again.');
        exit();
    }
} else {
    header('Location: ../view/login_view.php');
    exit();
}

?>

