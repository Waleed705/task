<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Login</title>
</head>
<body>
    <div class="main">
        <form action="" method="POST">
            <h1>Login Form</h1>
        <div class="input">
            <input type="email" placeholder="Enter email" name="email" id="email">
            <span id="email-error" class="error-message"></span>

            <input type="Password" placeholder="Enter Password" name="password" id="current-password">
            <span id="password-error" class="error-message"></span>

        </div>
        <div class="btn2">
            <input type="submit" Value="login" class="submit" name="submit" id="login">
            <input type="submit" Value="Sigh up" class="submit" name="submit" id="signup2">
            <p id="response"></p>
    </div>
    </div>
    </form>
<script src="script.js"></script>

</body>
</html>