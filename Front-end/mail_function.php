<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Construct the email message
    $msg = "First Name: $first_name\n";
    $msg .= "Last Name: $last_name\n";
    $msg .= "Email: $email\n\n";
    $msg .= "Message:\n$message";

    // Send email
    $result = mail("tiffanydegbotse123@gmail.com", "New Message from Contact Form", $msg);

    // Check if email sent successfully
    if ($result) {
        echo "Your message has been sent successfully.";
    } else {
        echo "Failed to send the message. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}




