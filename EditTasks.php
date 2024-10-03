<?php
require_once __DIR__ . '/logic/is_logged_in.php';
require_once __DIR__ . '/tables/Task.php';
require_once __DIR__ . '/tables/Task_Group.php';
if(isset($_GET['id'])) {
    $task = Task::getTask("id", $_GET['id']);
}
else {
    header('Location: /Project/Tasks.php?error=unverified');
    die();
}
$Task_Groups = Task_Group::getAllGroups();
$Managers = User::user_Type("Manager");
require_once __DIR__ . '/tables/User_Type.php';
$User_Types = User_Type::getUserTypes();
$statusOptions = ['completed', 'canceled', 'in progress'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="main_body">
<?php
require __DIR__ . '/Menu.php';
?>
<div class="container" id="container">
    <h1 class="header1">Edit Task</h1>
    <form action="logic/changeTask.php?id= <?= $task->id ?>" method="post" id="changeType">
        <div class="form-group">
            <label for="id">Task ID:</label>
            <input type="text" id="id" name="id" disabled class="input" required value="<?= $task->id ?>">
            <input type="hidden" value="<?= $task->id!=null ? $task->id : "" ?>" name="task_id">
        </div>
        <div class="form-group">
            <label for="task_group">Task Group</label>
            <select name="task_group" id="task_group" class="input">
                <?php
                foreach ($Task_Groups as $group) : ?>
                    <option value="<?= $group->id ?>" <?= ($group->id==$task->task_group_id) ? 'selected="selected"' : '' ?> > <?= $group->title ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="input" value="<?= $task->title ?>">
        </div>
        <div class="form-group">
            <label for="description1">Task Description</label>
            <textarea id="description1" name="description" class="input" > <?= $task->description ?></textarea>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="datetime-local" id="due_date" name="due_date" class="input" value="<?= $task->due_date ?>">
        </div>
        <div class="form-group">
            <label for="manager">Manager</label>
            <select name="manager" id="manager" class="input">
                <?php
                foreach ($Managers as $User) : ?>
                    <option value="<?= $User->id ?>" <?= ($User->id==$task->assignee_id) ? 'selected="selected"' : '' ?> ><?= $User->username ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Task Status</label>
            <select name="status" id="status" class="input">
                <?php
                foreach ($statusOptions as $status) : ?>
                    <option value="<?= $status ?>" <?= ($task->status == $status) ? 'selected="selected"' : '' ?> > <?= $status ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="priority">Task Priority</label>
            <input type="number" id="priority" name="priority" class="input" required value="<?= $task->priority ?>">
        </div>
<!--        <div class="form-group">-->
<!--            <label for="user_type">User Type</label>-->
<!--            <select name="user_type" class="input">-->
<!--                --><?php
//                foreach ($User_Types as $User_type) : ?>
<!--                    <option value="--><?php //= $User_type->id ?><!--" --><?php //= ($User_type->id==$user->user_type_id) ? 'selected="selected"' : '' ?><!-- > --><?php //= $User_type->type ?><!--</option>-->
<!--                --><?php //endforeach; ?>
<!--            </select>-->
<!--        </div>-->
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
