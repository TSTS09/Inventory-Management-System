<?php
include '../settings/connection.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>forgot password</title>
  <link rel="stylesheet" href="../css/style_forgot_password.css">
</head>

<body style=" background-image: url(../images/image2.jpg);">
  <div  class="right-section">
    <form style="width: 500px;" action="../actions/forgot_password_action.php" method="post" name="forgotpasswordForm" id="forgotpasswordForm">
      <h3 style="text-align: center;">Forgot password for SVEN</h3>
      <div class="line"></div><br>
      <label class="f-pws" for="emailInput">Enter your email:</label>
      <input class="textbox" type="text" placeholder="Email" name="emailInput" id="emailInput" required>

      <label class="f-pws" for="emailInput">Security Question: What is your favorite animal ?:</label>
      <input type="password" placeholder="Enter name of favorite animal" name="securityInput" id="securityInput" required>

      <label class="f-pws" for="PasswordInput">Enter new Password:</label>
      <input type="password" placeholder="Password" name="passwordInput" id="passwordInput" required><br>

      <input type="password" placeholder="Retype Password" name="passwordRetype" id="passwordRetype" required>

      <button type="submit" name="signInButton" id="signInButton" onclick="validateForm()">Submit</button>
      <div id="result"></div>
      <div id="error"></div>

      <a href="login_view.php" class="f-pws"> Remember Password? LogIn</a><br>
      <div id="message">
        <h3>Password must contain the following:</h3>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
      </div>
    </form>
    <div id="message">
      </div>
  </div>
  <div class="f-container">
        <a href="../index.php"> <img style="max-width: 70%;border-radius: 20%;margin-left: 200px;margin-top:-250px" src="../images/logo.jpg" alt="Company Logo"></a>
        <h2 style="width:45%; transition: color 5s ease-in-out;margin-left: 250px; "> Manage Less. Save More.</h2>
        <h2 style="width:45%; transition: color 5s ease-in-out;margin-left: 250px;"> Connect Everything.</h2>
    </div>


  <script>
    function validateEmail() {
      var emailInput = document.getElementById('emailInput').value;
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (emailRegex.test(emailInput)) {
        document.getElementById('error').innerHTML = '';
      } else {
        document.getElementById('error').innerHTML = 'Invalid email. Please enter a valid email.';
      }
    }

    function validatePassword() {
        var passwordInput = document.getElementById('passwordInput').value;
        var lowerCaseLetters = /[a-z]/g;
        var upperCaseLetters = /[A-Z]/g;
        var numbers = /\d/g;

        if (passwordInput.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {

            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        var upperCaseLetters = /[A-Z]/g;
        if (myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        var numbers = /\d/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }

        validatePasswordMatch();
    }

    function validatePasswordMatch() {
        if (myInput.value !== passwordRetype.value) {
            error.innerHTML = 'Passwords do not match.';
            registerButton.disabled = true;
        } else {
            error.innerHTML = '';
            registerButton.disabled = false;
        }
    }
    passwordRetype.addEventListener('input', validatePasswordMatch);

    function validateForm() {
        var emailInput = document.getElementById('emailInput').value;
        var passwordInput = document.getElementById('passwordInput').value;

        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email format check
        var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{8,}$/; // Improved password complexity check

        if (emailRegex.test(emailInput)) {
            document.getElementById('result').innerHTML = 'Valid email!';
            document.getElementById('error').innerHTML = '';
        } else {
            document.getElementById('result').innerHTML = '';
            document.getElementById('error').innerHTML = 'Invalid email. Please enter a valid email.';
            return; // Prevent form submission
        }

        if (passwordRegex.test(passwordInput)) {
            document.getElementById('result').innerHTML += ' Valid password!';
            document.getElementById('error').innerHTML = '';
        } else {
            document.getElementById('result').innerHTML = '';
            document.getElementById('error').innerHTML = 'Invalid password. Please enter a strong password that meets the requirements.';
            return; // Prevent form submission
        }
    }

    document.getElementById("forgotpasswordForm").addEventListener('submit', function(event) {
        validateEmail();
        validatePassword();
        if (!validatePhoneNumber()) {
            event.preventDefault();
            return;
        }

        var isValid = !error.innerHTML && !document.querySelector(".invalid");
        if (!isValid) {
            event.preventDefault();
        }

    });
    </script>

</body>

</html>
