<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body class="form_body">
<div class="container">
    <h1 class="header1">Login</h1>
    <form action="logic/loggingIn.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="input" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="input" required>
        </div>
        <div class="form-group">
            <input type="submit" value="LOG IN" class="btn">
        </div>
        <div class="form-group">
            <input type="button" value="SIGN IN" class="btn" onclick="window.location.href = 'SignUpPage.php';">
        </div>
        <a id="forgot_password" href="InsertEmail.php">Forgot Password?</a>
        <?php
        if (isset($_GET['status'])) : ?>
        <p class="error">
            <?php if ($_GET['status'] === 'verificationSent') : ?>
                Verification email has been sent
            <?php elseif ($_GET['status'] === 'verified') : ?>
                Account has been verified
            <?php elseif ($_GET['status'] === 'passwordChanged') : ?>
                Password has been changed
            <?php endif?>
        </p>
        <?php endif?>
        <?php
        if (isset($_GET['error'])) : ?>
        <p class="error">
            <?php if ($_GET['error'] === 'required_fields') : ?>
                You have not entered all required fields.
            <?php elseif ($_GET['error'] === 'login') : ?>
                Incorrect login information.
            <?php elseif ($_GET['error'] === 'unverified') : ?>
                Your account is not verified. Please check your email and verify your account.
            <?php endif ?>
        </p>
        <?php endif ?>
    </form>
</div>
</body>
</html>
