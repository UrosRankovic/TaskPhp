<?php
require_once __DIR__ . '/logic/isExecutor.php';
require_once __DIR__ . '/tables/User.php';
require_once __DIR__ . '/tables/User_Type.php';
require_once __DIR__ . '/tables/Task.php';
require_once __DIR__ . '/tables/Executor.php';
require_once __DIR__ . '/tables/Task_Group.php';
$tasks = Task::getAllTasks();
//$User_Types = User_Type::getUserTypes();
//$users = User::getAllUsers();
//$sortedUsers = $users; // Initialize sortedUsers variable
//
$Task_Groups = Task_Group::getAllGroups();
$Users = User::user_Type("Manager");

$current_user = User::getUser("id", $_SESSION["user_id"]);
$user_type1 = $current_user->userType()->type;

$sortBy = $_GET['sort'] ?? null;
$filterBy = $_GET['filter'] ?? '';
$fromDate = $_GET['from_date'] ?? null;
$toDate = $_GET['to_date'] ?? null;
$executor = $_GET['executor'] ?? null;
$ses_id = $_SESSION['user_id'];
if (!empty($sortBy)) {
    $tasks = Task::sortTask($sortBy);
} else {
    $tasks = Task::getAllTasks();
    $tasks = Task::getTaskB4($tasks, $filterBy, $fromDate, $toDate, $executor);
}
if ($user_type1 == 'Executor') {
    $tasks = Task::getTasksByExecutor($_SESSION['user_id']);
    if (!empty($sortBy)) {
        $tasks = Task::sortTask2($sortBy, $tasks);
    }
    else if (isset($filterBy) || isset($fromDate) || isset($toDate)||isset($executor)){
        $tasks = Task::getTaskB4($tasks, $filterBy, $fromDate, $toDate, $executor);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tasks</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body class="main_body">
<?php
require 'Menu.php';
?>
<?php if ($user_type1 != 'Executor') : ?>
<div class="container_form">
    <h1 class="user_header">Add a new Task</h1>
    <form action="logic/addTask.php" method="post" class="form_b">
        <select name="group_title" class="input2" required>
            <?php
            foreach ($Task_Groups as $Task_Group) : ?>
                <option value="<?= $Task_Group->id ?>"><?= $Task_Group->title ?></option>
            <?php endforeach; ?>
        </select>
        <select name="assignee_id" class="input2" required>
            <?php
            foreach ($Users as $User) : ?>
                <option value="<?= $User->id ?>"><?= $User->username ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" id="title" name="title" class="input2" placeholder="Task Title" required>
        <input type="text" id="description" name="description" class="input2" placeholder="Description">
        <input type="date" id="due_date" name="due_date" class="input2" placeholder="Task Due Date">
        <input type="number" id="priority" name="priority" class="input2" placeholder="Task Priority" >
        <select name="status" class="input2">
            <option value="<?= null ?>">Select Status</option>
            <option value="completed">Completed</option>
            <option value="canceled">Canceled</option>
            <option value="in progress">In Progress</option>
        </select>
        <input type="submit" value="ADD TASK" class="button">
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
<?php endif ?>
<div class="selection">
    <form action="logic/filterTasks.php" method="post" class="form_b">
        <input type="text" name="search" placeholder="Search tasks" class="input1">
        <select name="executor" id="select">
            <option value="" selected>Select executor</option>
            <?php $executors = Executor::getAllUniqueExecutors(); foreach ($executors as $executor): ?>
                <?php $user = User::getUser("id", $executor->executor_id); ?>
                <option value="<?= $user->id ?>"><?= $user->username ?></option>
            <?php endforeach; ?>
        </select>
        <label for="from_date"></label>
        <input type="datetime-local" name="from_date" id="from_date" class="input2">
        <label for="to_date"></label>
        <input type="datetime-local" name="to_date" id="to_date" class="input2">

        <input type="submit" name="search_submit" value="SEARCH" class="button">
        <button type="reset" class="button" onclick="window.location.href = 'Tasks.php';">CLEAR FILTERS</button>
    </form>
</div>
<div class="selection">
    <form action="logic/sortingTasks.php" method="post" class="form_b">
        <select name="sort_tasks" class="input1">
            <option value="id">ID</option>
            <option value="task_group_id">Task Group</option>
            <option value="title">Task Title</option>
            <option value="priority">Priority</option>
            <option value="due_date">Due date</option>
            <option value="status">Status</option>
            <option value="assignee_id">Manager</option>
        </select>
        <input type="submit" name="sort_submit" value="Sort" class="button" ">
    </form>
</div>
<div class="container_table">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Task Group</th>
            <th>Task Name</th>
            <th>Task Description</th>
            <th>Due date</th>
            <th>Manager</th>
            <th>Priority</th>
            <th>Executors list</th>
            <th>Status</th>
            <?php  if($user_type1 != 'Executor') : ?>
            <th>Edit</th>
            <?php endif ?>
            <th>Comment</th>
        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($tasks as $group) : ?>
        <?php
            $executors = Executor::checkExecutor($group->id);
            $user = User::getUser("id", $_SESSION['user_id']);
            ?>
            <tr>
                <td><?= $group->id ?></td>
                <td><?= $group->taskGroup()->title ?></td>
                <td><?= $group->title ?></td>
                <td><?= $group->description ?></td>
                <td><?= $group->due_date ?></td>
                <td><?= $group->userName()->username ?></td>
                <td><?= $group->priority ?></td>
                <td>
                    <?php if (empty($executors)): ?>
                        <form action="AddExecutor.php?id= <?= $group->id ?>" method="post">
                        <button>Add Executors</button>
                        </form>
                    <?php else: ?>
                        <select name="user_type" id="select">
                            <?php foreach ($executors as $executor): ?>
                                <?php $user = User::getUser("id", $executor->executor_id); ?>
                                <option value="<?= $user->id ?>"><?= $user->username ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>

                </td>
                <td>
                    <?php if ($group->status == null): ?>
                        <form action="logic/completeTask.php" method="post">
                            <select name="status" id="select">
                                <option value="" >Status</option>
                                <option value="in progress">In Progress</option>
                                <?php  if($user_type1 != 'Executor') : ?>
                                <option value="completed">Completed</option>
                                <option value="canceled">Canceled</option>
                                     <?php endif; ?>
                            </select>
                            <button type="submit" value="<?= $group->id ?>" name="id">Change Status</button>
                        </form>
                    <?php else: ?>
                        <?= $group->status ?>
                    <?php endif; ?>
                </td>
                <?php  if($user_type1 != 'Executor') : ?>
                <td>
                <form action="EditTasks.php?id= <?= $group->id ?>" method="post">
                        <input type="hidden" value="<?= $group->id ?>" name="group_id">
                        <input type="hidden" value="<?= $group->title ?>" name="group_title">
                        <button>Change</button>
                    </form>
                    <form action="logic/deleteTask.php" method="post" onsubmit="return confirmDelete()">
                        <input type="hidden" value="<?= $group->id ?>" name="id" >
                        <button>Delete</button>
                    </form>
                </td>
                <?php endif ?>
                <td>
                    <form action="Comments.php?id= <?= $group->id ?>" method="post">
                        <input type="hidden" value="<?= $group->id ?>" name="group_id">
                        <input type="hidden" value="<?= $group->title ?>" name="group_title">
                        <button>Leave a Comment</button>
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
        return confirm("Are you sure you want to delete this Task?"); // Display the confirmation dialog
    }
</script>
