<?php
require_once __DIR__ . '/logic/isAdmin.php';
require_once __DIR__ . '/tables/User.php';
require_once __DIR__ . '/tables/User_Type.php';
$User_Types = User_Type::getUserTypes();
$users = User::getAllUsers();
$sortedUsers = $users; // Initialize sortedUsers variable

if (isset($_GET['sort'])) {
    $sortBy = $_GET['sort'];
    $sortedUsers = User::sortUser($sortBy);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="main_body">
<?php
require 'Menu.php';

?>
<div class="container_form">
    <h1 class="user_header">Add a new User</h1>
    <form action="logic/addUser.php" method="post" class="form_b">
        <input type="text" id="username" name="username" class="input2" placeholder="Insert Username" required>
        <input type="password" id="password" name="password" class="input2" placeholder="Insert Password" required>
        <input type="text" id="full_name" name="full_name" class="input2" placeholder="Insert Full Name" required>
        <input type="tel" id="phone_number" name="phone_number" class="input2" placeholder="Insert Phone">
        <input type="email" id="email" name="email" class="input2" placeholder="Insert Email" required>
        <select name="user_type" class="input2">
            <?php
            foreach ($User_Types as $User_type) : ?>
            <option value="<?= $User_type->id ?>"><?= $User_type->type ?></option>
            <?php endforeach; ?>
        </select>
        <input type="date" id="birth_date" name="birth_date" class="input2" placeholder="Insert Date of Birth">
        <input type="submit" value="ADD USER" class="button">
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
<form action="logic/sortingUsers.php" method="post" class="form_b">
    <select name="sort_users" class="input1">
        <option value="id">ID</option>
        <option value="username">Username</option>
        <option value="full_name">Full Name</option>
        <option value="phone_number">Phone</option>
        <option value="email">E-mail</option>
        <option value="user_type_id">User Type</option>
        <option value="birth_date">Date of Birth</option>
    </select>
    <input type="submit" name="sort_submit" value="Sort" class="button">
</form>
</div>
<div class="container_table">
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Full name</th>
        <th>Phone</th>
        <th>E-mail</th>
        <th>User Type</th>
        <th>Date of birth</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php

     foreach ($sortedUsers as $user) : ?>
        <tr>
            <td><?= $user->id ?></td>
            <td><?= $user->username ?></td>
<!--            <td>--><?php //= $user->password ?><!--</td>-->
            <td><?= $user->full_name ?></td>
            <td><?= $user->phone_number ?></td>
            <td><?= $user->email ?></td>
            <td><?= $user->userType($user->user_type_id)->type ?></td>
            <td><?= $user->birth_date ?></td>
            <td>
                <form action="EditUsers.php?id= <?= $user->id ?>" method="post">
                    <input type="hidden" value="<?= $user->id ?>" name="user_id">
                    <input type="hidden" value="<?= $user->username ?>" name="username">
                    <input type="hidden" value="<?= $user->password ?>" name="password">
                    <input type="hidden" value="<?= $user->full_name ?>" name="full_name">
                    <input type="hidden" value="<?= $user->phone_number ?>" name="phone">
                    <input type="hidden" value="<?= $user->email ?>" name="email">
                    <input type="hidden" value="<?= $user->userType($user->user_type_id)->type ?>" name="user_type">
                    <input type="hidden" value="<?= $user->userType($user->user_type_id)->id ?>" name="user_type_id">
                    <input type="hidden" value="<?= $user->birth_date ?>" name="birth_date">
                    <button>Change</button>
                </form>
                <form action="logic/deleteUsers.php" method="post">
                    <input type="hidden" value="<?= $user->id ?>" name="user_id">
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

