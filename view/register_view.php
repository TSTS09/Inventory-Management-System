<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="../css/style_register.css">
</head>

<body style="background-image:url('../images/image.jpg');">
    <div class="container">
        <div class="left-section"></div>
        <div class="right-section">
            <div class="logo-container">
                <img class="logo" src="../images/Chorus.png" alt="Company Logo">
                <h3 class="color-changing" style="width:45%"> All you need to focus on saving lifes</h3>
            </div>
            <form class="form" action="../actions/register_user_action.php" method="post" name="registrationForm" id="registrationForm">
                <h2>Register here</h2>
                <input type="text" placeholder="First Name" name="firstName" id="firstName" required>
                <input type="text" placeholder="Last Name" name="lastName" id="lastName" required>
                <input type="text" placeholder="Company Name" name="companyName" id="companyName" required>


                <label for="CompanyRole">Company Role:</label>
                <select name="CompanyRole" id="CompanyRole" required>
                    <option value="0">Select</option>
                    <?php
                    include "../functions/select_role_fxn.php";
                    echo $options;
                    ?>
                </select>

                <input type="tel" placeholder="Phone Number" name="phoneNumber" id="phoneNumber" required>
                <input type="email" placeholder="Email" name="email" id="email" required>

                <input type="password" placeholder="Password" name="password" id="password" required>
                <input type="password" placeholder="Retype Password" name="passwordRetype" id="passwordRetype" required>

                <button type="submit" name="registerButton" id="registerButton">Register</button>
                <div id="error"></div>
            </form>
            <div id="message">
                <h3>Password must contain the following:</h3>
                <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                <p id="number" class="invalid">A <b>number</b></p>
                <p id="length" class="invalid">Minimum <b>8 characters</b></p>
            </div>
            <div style="color:39c170; text-align: center; margin-top: 10px; margin-left: 320px;">
                Already have an account? <a href="login_view.php">Login here</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var email = document.getElementById("email");
            var myInput = document.getElementById("password");
            var passwordRetype = document.getElementById("passwordRetype");
            var letter = document.getElementById("letter");
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");
            var error = document.getElementById("error");
            var registerButton = document.getElementById("registerButton");

            myInput.addEventListener('focus', function() {
                document.getElementById("message").style.display = "block";
            });

            myInput.addEventListener('blur', function() {
                document.getElementById("message").style.display = "none";
            });

            myInput.addEventListener('input', function() {
                validatePassword();
            });

            function validatePhoneNumber() {
                var phoneNumberInput = document.getElementById("phoneNumber");
                var phoneNumber = phoneNumberInput.value;
                var phoneNumberRegex = new RegExp(/^((\+\d{1,2}(-| )?)?(\d{3})(-| )?(\d{3})(-| )?(\d{4}))$/); // Assumes a 10-digit phone number(Us or North American Format)

                if (!phoneNumberRegex.test(phoneNumber)) {
                    document.getElementById('error').innerHTML = 'Invalid phone number. Please enter a 10-digit number.';
                    return false;
                } else {
                    document.getElementById('error').innerHTML = '';
                    return true;
                }
            }

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

            document.getElementById("registrationForm").addEventListener('submit', function(event) {
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
                // else{
                //   window.location.href = '../../home(user)/home.html';
                //}
            });
        });
    </script>
</body>

</html>