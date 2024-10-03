<?php
require_once __DIR__ . '/logic/is_logged_in.php';
require_once  __DIR__ . '/tables/Task_Group.php';
if(isset($_GET['id'])) {
    $Task_Group = Task_Group::getTaskGroupByElement("id", $_GET['id']);
}
else {
    header('Location: /Project/Users.php?error=unverified');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Task Groups</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="main_body">
<?php
require __DIR__ . '/Menu.php';
?>
<div class="container" id="container">
    <h1 class="header1">Change User Type</h1>
    <form action="logic/changeTaskGroup.php?id= <?= $Task_Group->id ?>" method="post" id="changeType">
        <div class="form-group">
            <label for="user_type_id">User Type ID</label>
            <input type="text" id="user_type_id" name="id" disabled class="input" required value="<?= $Task_Group->id ?>">
            <input type="hidden" value="<?= $Task_Group->id!=null ? $Task_Group->id : "" ?>" name="task_id">
        </div>
        <div class="form-group">
            <label for="title">User Type</label>
            <input type="text" id="title" name="title" class="input" required value="<?= $Task_Group->title ?>">
        </div>

        <div class="form-group">
            <input type="submit" value="CHANGE" class="btn">
        </div>
        <?php
        if (isset($_GET['error'])) : ?>
            <p class="error">
                <?php if ($_GET['error'] === 'groupExists') : ?>
                    Task Group with this name already exists
                <?php elseif ($_GET['error'] === 'noChanges') : ?>
                    No changes were made
                <?php endif ?>
            </p>
        <?php endif ?>
    </form>
</div>
</body>
</html>
