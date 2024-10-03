<?php
session_start();
if (!isset($_SESSION['token'])) {
    header('Location: /Project/insertEmail.php?status=checkEmail');
    die();
}
    ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="form_body">
<div class="container">
    <h1 class="header1">Change Password</h1>
    <form action="logic/changePassword.php?token=<?= urlencode($_SESSION['token']) ?>" method="post">
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" class="input" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="input" required>
        </div>
        <input type="hidden" value="<?= $_SESSION['token'] ?>" name="token">
        <div class="form-group">
            <input type="submit" value="CHANGE PASSWORD" class="btn">
        </div>
        <?php
        if (isset($_GET['error'])) : ?>
            <p class="error">
                <?php if ($_GET['error'] === 'samePassword') : ?>
                    You can't change password to your current password
                <?php endif ?>
                <?php if ($_GET['error'] === 'passwordDoesntMatch') : ?>
                    Passwords don't match
                <?php endif ?>
                <?php if ($_GET['error'] === 'tokenExpired') : ?>
                    Token has expired
                <?php endif ?>
            </p>
        <?php endif ?>
    </form>
</div>
</body>
</html>
