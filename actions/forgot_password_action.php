<?php
include '../settings/connection.php';



if ((isset($_SERVER['REQUEST_METHOD']) == "POST") && isset($_POST['signInButton'])) {

    $email = $_POST['emailInput'];
    $passwordInput = $_POST['passwordInput'];
    $securityInput = $_POST['securityInput'];
  
   
    $hashedPassword = password_hash($passwordInput, PASSWORD_DEFAULT);
  

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $sql2 = "UPDATE users SET password = ? WHERE email = ?";
    $stmt2 = $conn->prepare($sql2);
  
    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
  
      
      if ($securityInput === $row['securityInput']) {
     
        
        $stmt2->bind_param('ss', $hashedPassword, $email);
        $stmt2->execute();
  
        if ($stmt2) {
          echo "Password reset successful.";
          header('Location:../view/login_view.php?msg=password_reset');
          exit();
        } else {
          echo "<script>
          alert('Error updating password. Please try again.');
          window.location.href='../view/forgot_password.php'
          </script>";
          error_log("Error updating password: " . $conn->error);
        }
      } else {
        echo "<script>
        alert('Incorrect security answer. Please try again.');
        window.location.href='../view/forgot_password.php'
        </script>";
      }
    } else {
      echo "<script>
        alert('Email not found. Please try again.');
        window.location.href='../view/forgot_password.php'
      </script>";
    }
  
    // Close prepared statements
    if (isset($stmt2)) {
      $stmt2->close();
    }
    $stmt->close();
  } else {
    // Redirect for other scenarios (not submitted form)
    echo 'error';
    header('Location:../view/forgot_password.php?msg=error');
    exit();
}
?>