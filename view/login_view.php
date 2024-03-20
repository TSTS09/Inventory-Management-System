<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SVEN Login</title>
    <link rel="stylesheet" href="../css/style_login.css">
</head>

<body>
    <form action="../actions/login_user_action.php" method="post" name="loginForm" id="loginForm">
        <h3 style="text-align: center;">Sign in to SVEN</h3>
        <div class="line"></div><br>
        <label class="f-pws" for="emailInput">Enter your email:</label>
        <input class="textbox" type="text" placeholder="Email or Phone Number" name="emailInput" id="emailInput" required>

        <label class="f-pws" for="PasswordInput">Enter your Password:</label>
        <input type="password" placeholder="Password" name="passwordInput" id="passwordInput" required><br>
        <button type="submit" name="signInButton" id="signInButton" onclick="validateForm()">Submit</button>
        <div id="result"></div>
        <div id="error"></div>

        <a href="forgot_password.php" class="f-pws"> Forgot Password</a><br>
    </form>

    <script>
        function validateForm() {
            var emailInput = document.getElementById('emailInput').value;
            var passwordInput = document.getElementById('passwordInput').value;

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            //Minimum length of 8 characters
            var passwordRegex = /^.{8,}$/;

            if (emailRegex.test(emailInput)) {
                document.getElementById('result').innerHTML = 'Valid email!';
                document.getElementById('error').innerHTML = '';
            } else {
                document.getElementById('result').innerHTML = '';
                document.getElementById('error').innerHTML = 'Invalid email. Please enter a valid email.';
                return;
            }

            if (passwordRegex.test(passwordInput)) {
                document.getElementById('result').innerHTML += ' Valid password!';
                document.getElementById('error').innerHTML = '';

                // If both email and password are valid, redirect to home.html
                // window.location.href = '../home(user)/home.html';
            } else {
                document.getElementById('result').innerHTML = '';
                document.getElementById('error').innerHTML = 'Invalid password. Please enter a valid password.';
            }
        }
    </script>

    <div class="f-container">
        <a href="../index.php"> <img class="logo" src="../images/logo.jpg" alt="Company Logo"></a>
        <p style="color: rgb(225, 207, 211);">Find all products at all times in Real-time</p>
    </div>
    <div class="sub-link">
        <h3 style="color: rgb(225, 207, 211);"> Don't have an account yet? <a href="../view/register_view.php" style="color:blue;"> Create an account here </a>
        </h3>
    </div>

</body>

</html>