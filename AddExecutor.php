<?php
require_once __DIR__ . '/logic/is_logged_in.php';
require_once  __DIR__ . '/tables/Task.php';
require_once  __DIR__ . '/tables/User.php';
require_once  __DIR__ . '/tables/User_Type.php';
if(isset($_GET['id'])) {
    $Tasks = Task::getTask("id", $_GET['id']);
}
else {
    header('Location: /Project/Users.php?error=unverified');
    die();
}
$type = User_Type::checkType("Executor");
$User = User::getTest("user_type_id", $type->id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Type Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="main_body">
<?php
require __DIR__ . '/Menu.php';
?>
<div class="container" id="container">
    <h1 class="header1">Change User Type</h1>
    <form action="logic/addExecutor.php?id= <?= $Tasks->id ?>" method="post" id="changeType">
        <div class="form-group">
            <label for="id">User Type ID</label>
            <input type="text" id="id" name="id" disabled class="input" required value="<?= $Tasks->id ?>">
            <input type="hidden" value="<?= $Tasks->id!=null ? $Tasks->id : "" ?>" name="task_id">
        </div>
        <div class="form-group">
            <label for="executor">Executor</label>
            <select name="executor" id="executor" class="input">
                <?php
                foreach ($User as $user): ?>
                <option value="<?= $user->id ?>"><?= $user->username ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="ADD" class="btn">
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
