<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="form_body">
<header class="testing">

</header>
<div class="container">
    <h1 class="header1">Registration</h1>
    <form action="logic/signingUp.php" method="post" id="#formRegister">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" class="input3" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="input3" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" class="input3" required>
        </div>
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" class="input3">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" class="input3">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="input3" required>
        </div>
        <div class="form-group">
            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" class="input3">
        </div>
        <div class="form-group">
            <input type="submit" value="SIGN UP" class="btn1">
        </div>
            <div class="form-group">
                <input type="button" value="LOG IN" class="btn1" onclick="window.location.href = 'LoginPage.php';">
            </div>
        <?php
        if (isset($_GET['error'])) : ?>
            <p class="error">
                <?php if ($_GET['error'] === 'required_fields') : ?>
                    You have not entered all required fields.
                <?php elseif ($_GET['error'] === 'registerEmailAndUsername') : ?>
                    Email address and Username already exist
                <?php elseif ($_GET['error'] === 'registerEmail') : ?>
                    Email address already exists
                <?php elseif ($_GET['error'] === 'registerUsername') : ?>
                    Username already exists
                <?php endif ?>
            </p>
        <?php endif ?>
    </form>
</div>
</body>
</html>