
<?php
// Include the connection file
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $companyName = $_POST['companyName'];
    $CompanyRole = $_POST['CompanyRole'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email is already in use
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();
        header('Location: ../view/login_view.php?error=Email already exists. Please use another one.');
        exit();
    }

    $stmt->close();

    $sql = "INSERT INTO users (roleid, first_name, last_name, company_name, phone_number, email, password) VALUES ('$CompanyRole','$firstName', '$lastName', '$companyName','$phoneNumber', '$email', '$hashedPassword')";

    $result = $conn->query($sql);


    if ($result) {
        echo "Sucessful Registration";
        header('Location:../view/login_view.php?msg=sucess');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If form is not submitted, redirect to register view page or take appropriate action
    echo 'error';
    header('Location:../view/register_view.php?msg=error');
    exit();
}

// Close the connection
$conn->close();
?>