<?php
require_once __DIR__ . '/logic/is_logged_in.php';
require_once  __DIR__ . '/tables/User_Type.php';
if(isset($_GET['id'])) {
    $User_type = User_Type::getUserType("id", $_GET['id']);
}
else {
    header('Location: /Project/Users.php?error=unverified');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User Types</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="main_body">
<?php
require __DIR__ . '/Menu.php';
?>
<div class="container" id="container">
    <h1 class="header1">Change User Type</h1>
    <form action="logic/changeUserType.php?id= <?= $User_type->id ?>" method="post" id="changeType">
        <div class="form-group">
            <label for="user_type_id">User Type ID</label>
            <input type="text" id="user_type_id" name="user_type_id" disabled class="input" required value="<?= $User_type->id ?>">
            <input type="hidden" value="<?= $User_type->id!=null ? $User_type->id : "" ?>" name="user_Type_id">
        </div>
        <div class="form-group">
            <label for="user_type">User Type</label>
            <input type="text" id="user_type" name="user_type" class="input" required value="<?= $User_type->type ?>">
        </div>
        <div class="form-group">
            <label for="user_priority">User Priority</label>
            <input type="number" id="user_priority" name="user_priority" class="input" required value="<?= $User_type->priority ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="CHANGE" class="btn">
        </div>
        <?php
        if (isset($_GET['error'])) : ?>
            <p class="error">
                <?php if ($_GET['error'] === 'typeExists') : ?>
                    User Type with this name already exists
                <?php elseif ($_GET['error'] === 'noChanges') : ?>
                    No changes were made
                <?php endif ?>
            </p>
        <?php endif ?>
    </form>
</div>
</body>
</html>
