<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="main">
        <h1>CREATE ACCOUNT</h1>
        <form action="" method="POST" >
            <div class="input">
                <input type="text" placeholder="Your name" name="name" id="name" required>
                <span id="name-error" class="error-message"></span>

                <input type="email" placeholder="Enter email" name="email" id="email" required>
                <span id="email-error" class="error-message"></span>

                <input type="Password" placeholder="Enter Password" name="password" id="current-password" required>
                <span id="password-error" class="error-message"></span>
            </div>
            <div class="radiobtn">
                <input type="radio" required> 
                <label>I agree with all the statements in <u>Terms of service</u></label>
            </div>
            <div class="btn">
                <input type="submit" value="Sign Up" class="submit" id="signup">
            </div>
            <div class="login">
                <p>Already have an account? <a href="http://localhost/task/login.php">Login here</a></p>
                <p id="response"></p>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
