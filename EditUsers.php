<?php
require_once __DIR__ . '/logic/is_logged_in.php';
require_once __DIR__ . '/tables/User.php';
if(isset($_GET['id'])) {
    $user = User::getUser("id", $_GET['id']);
}
else {
    header('Location: /Project/Users.php?error=unverified');
    die();
}

require_once __DIR__ . '/tables/User_Type.php';
$User_Types = User_Type::getUserTypes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="main_body">
<?php
require __DIR__ . '/Menu.php';
?>
<div class="container" id="container">
    <h1 class="header1">Edit Users</h1>
    <form action="logic/changeUser.php?id= <?= $user->id ?>" method="post" id="changeType">
        <div class="form-group">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" disabled class="input" required value="<?= $user->id ?>">
            <input type="hidden" value="<?= $user->id!=null ? $user->id : "" ?>" name="user_id">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="input" required value="<?= $user->username ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="input" required value="<?= $user->password ?>">
        </div>
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" class="input" required value="<?= $user->full_name ?>">
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" class="input" value="<?= $user->phone_number ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="input" required value="<?= $user->email ?>">
        </div>
        <div class="form-group">
            <label for="birth_date">Date of Birth</label>
            <input type="date" id="birth_date" name="birth_date" class="input" value="<?= $user->birth_date ?>">
        </div>
        <div class="form-group">
            <label for="user_type">User Type</label>
            <select name="user_type" class="input">
                <?php
                foreach ($User_Types as $User_type) : ?>
                    <option value="<?= $User_type->id ?>" <?= ($User_type->id==$user->user_type_id) ? 'selected="selected"' : '' ?> > <?= $User_type->type ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="CHANGE" class="btn">
        </div>
        <?php
        if (isset($_GET['error'])) : ?>
            <p class="error">
                <?php if ($_GET['error'] === 'userExists') : ?>
                    Username already exists
                <?php elseif ($_GET['error'] === 'emailExists') : ?>
                    Email already exists
                <?php elseif ($_GET['error'] === 'noChanges') : ?>
                    You didn't make any changes
                <?php endif ?>
            </p>
        <?php endif ?>
    </form>
</div>
</body>
</html>
