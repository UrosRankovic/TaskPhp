<?php
require_once __DIR__ . '/logic/is_logged_in.php';
require_once __DIR__ . '/logic/isManager.php';
require_once __DIR__ . '/tables/User.php';
require_once __DIR__ . '/tables/User_Type.php';
require_once __DIR__ . '/tables/Task_Group.php';
$task_groups = Task_Group::getAllGroups();
//$User_Types = User_Type::getUserTypes();
//$users = User::getAllUsers();
//$sortedUsers = $users; // Initialize sortedUsers variable
//
if (isset($_GET['sort'])) {
    $sortBy = $_GET['sort'];
    $task_groups = Task_Group::sortTaskGroup($sortBy);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Task Groups</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="main_body">
<?php
require 'Menu.php';

?>
<div class="container_form">
    <h1 class="user_header">Add a new Task Group</h1>
    <form action="logic/addTaskGroup.php" method="post" class="form_b">
        <input type="text" id="group_title" name="group_title" class="input2" placeholder="Insert a title for the new Task Group" required>
        <input type="submit" value="ADD TASK GROUP" class="button">
    </form>
    <?php
    if (isset($_GET['error'])) : ?>
        <p class="error">
            <?php if ($_GET['error'] === 'UsernameOrEmail') : ?>
                Username or Email already exist
            <?php endif?>
        </p>

    <?php endif ?>
</div>
<div class="selection">
    <form action="logic/sortingTaskGroups.php" method="post" class="form_b">
        <select name="sort_users" class="input1">
            <option value="id">ID</option>
            <option value="title">Task Group Title</option>
            <option value="created_at">Created</option>
        </select>
        <input type="submit" name="sort_submit" value="Sort" class="button" ">
    </form>
</div>
<div class="container_table">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Task Group Name</th>
            <th>Created</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($task_groups as $group) : ?>
            <tr>
                <td><?= $group->id ?></td>
                <td><?= $group->title ?></td>
                <td><?= $group->created_at ?></td>

                <td>
                    <form action="EditTaskGroups.php?id= <?= $group->id ?>" method="post">
                        <input type="hidden" value="<?= $group->id ?>" name="group_id">
                        <input type="hidden" value="<?= $group->title ?>" name="group_title">
                        <button>Change</button>
                    </form>
                    <form action="logic/deleteTaskGroup.php" method="post" onsubmit="return confirmDelete()">
                        <input type="hidden" value="<?= $group->id ?>" name="id" >
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
</body>
</html>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this task group?"); // Display the confirmation dialog
    }
</script>
