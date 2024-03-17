<?php
include '../settings/connection.php';


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chorus forgot password</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow: initial;
        }

        body {
            width: 100%;
            background-color: #0c1523;
            font-family: "Segoe UI", system-ui, -apple-system, 'Segoe UI';
            display: flex;
            height: 100vh;
            align-items: center;
        }

        form {
            background-color: #fff;
            width: 320px;
            padding: 30px;
            border-radius: 50px;
            box-shadow: 5px 5px 6px -7px;
            position: absolute;
            line-height: 30px;
            margin-left: 850px;
        }

        input[type='text'],
        input[type='password'] {
            display: block;
            background-color: #fff;
            margin: auto;
            border: 1.5px solid rgb(200, 200, 200);
            width: 200px;
            padding: 10px 40px;
            border-radius: 5px;
            text-align: center;
            color: black;
            font-family: "Segoe UI", system-ui, -apple-system, 'Segoe UI';
            font-size: 15px;
        }

        button {
            border: none;
            background-color: #01070f;
            color: white;
            margin: auto;
            width: 283px;
            display: block;
            border-radius: 5px;
            padding: 10px 0;
            font-weight: bold;
            font-size: 15px;
        }

        .page {
            width: 100%;
            height: 100vh;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .f-pws {
            display: block;
            width: 200px;
            margin: auto;
            color: #04142a;
            padding-left: 80px;
            font-family: "Segoe UI", system-ui, -apple-system, 'Segoe UI';
            font-weight: 400px;
            margin-bottom: 10px;
            padding-top: -100px;
        }

        .line {
            border-top: 1px solid #222;
            opacity: 0.2;
            margin: 20px 0;
        }

        .bnt2 {
            width: 180px;
            font-size: 14px;
            background-color: #42b72a;
            text-align: center;
        }

        .textbox {
            margin-bottom: 13px;
        }

        .sub-link h3 {
            width: 250px;
            position: relative;
            color: black;
            font-family: "Segoe UI", system-ui, -apple-system, 'Segoe UI';
            margin-bottom: -5000px;
            margin-left: 280px;
            margin-top: 270px;
            font-size: 15px;
        }

        .sub-link h3 a {
            color: black;
            font-weight: bold;
            font-size: 13px;
        }

        .f-container {
            width: 350px;
            margin-left: 300px;
            margin-top: 30vh;
            font-family: "Segoe UI", system-ui, -apple-system, 'Segoe UI';
        }

        .f-container img {
            width: 250px;
        }

        p {
            font-size: 20px;
            font-weight: 600;
            word-spacing: 3px;
        }

        #result {
            color: green;
        }

        #error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="right-section">
        <form action="../actions/forgot_password_action.php" method="post" name="forgotpasswordForm" id="forgotpasswordForm">
            <h3 style="text-align: center;">Forgot password for SVEN</h3>
            <div class="line"></div><br>
            <label class="f-pws" for="emailInput">Enter your email:</label>
            <input class="textbox" type="text" placeholder="Email" name="emailInput" id="emailInput"required>

            <label class="f-pws" for="emailInput">Enter Favorite animal?:</label>
            <input  type="password" placeholder="Enter name of favorite animal" name="securityInput" id="securityInput"required>       

            <label class="f-pws" for="PasswordInput">Enter new Password:</label>
            <input type="password" placeholder="Password" name="passwordInput" id="passwordInput" required><br>

            <input type="password" placeholder="Retype Password" name="passwordRetype" id="passwordRetype" required>

        

            <button type="submit" name="signInButton" id="signInButton" onclick="validateForm()">Submit</button>
            <div id="result"></div>
            <div id="error"></div>

            <a href="login_view.php" class="f-pws"> Remember Password? LogIn</a><br>
            <div id="error"></div>
        </form>
        <div id="message">
        <h3>Password must contain the following:</h3>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        </div>
    </div>    
  

    <script>
       
        function validateEmail() {
            var emailInput = email.value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailRegex.test(emailInput)) {
                error.innerHTML = '';
            } else {
                error.innerHTML = 'Invalid email. Please enter a valid email.';
            }
        }

        function validatePassword() {
            var lowerCaseLetters = /[a-z]/g;
            if (myInput.value.match(lowerCaseLetters)) {
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

        document.getElementById("forgotpasswordForm").addEventListener('submit', function(event)) {
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

        }
    </script>

</body>

</html>