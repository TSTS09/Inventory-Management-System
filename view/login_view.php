<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chorus Login</title>
    
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
    <form action="../actions/login_user_action.php" method="post" name="loginForm" id="loginForm">
        <h3 style="text-align: center;">Sign in to SVEN</h3>
        <div class="line"></div><br>
        <label class="f-pws" for="emailInput">Enter your email:</label>
        <input class="textbox" type="text" placeholder="Email or Phone Number" name="emailInput" id="emailInput"
            required>

        <label class="f-pws" for="PasswordInput">Enter your Password:</label>
        <input type="password" placeholder="Password" name="passwordInput" id="passwordInput" required><br>
        <button type="submit" name="signInButton" id="signInButton" onclick="validateForm()">Submit</button>
        <div id="result"></div>
        <div id="error"></div>

        <a href="" class="f-pws"> Forgot Password</a><br>
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
        <img src="Chorus.png" alt="Chorus Logo">
        <p style="color: rgb(225, 207, 211);">Find all products at all times in Real-time</p>
    </div>
    <div class="sub-link">
        <h3 style="color: rgb(225, 207, 211);"> Don't have an account yet? <a href="../view/register_view.php"
                style="color:blue;"> Create an account here </a>
        </h3>
    </div>

</body>

</html>