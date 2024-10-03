<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert email</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="form_body">
<div class="container">
    <h1 class="header1">Reset Password</h1>
    <form action="logic/checkEmail.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="input" required>
        </div>
        <div class="form-group">
            <input type="submit" value="RESET PASSWORD" class="btn">
        </div>
        <?php
        if (isset($_GET['status'])) : ?>
        <p class="error">
            <?php if ($_GET['status'] === 'noEmail') : ?>
                There is no account created under this email.
            <?php elseif ($_GET['status'] === 'emailSent') : ?>
                Reset email has been sent
            <?php elseif ($_GET['status'] === 'checkEmail') : ?>
                Insert Email address and after that you will receive an email with further instructions
            <?php endif ?>
        </p>
        <?php endif ?>
    </form>
</div>
</body>
</html>
