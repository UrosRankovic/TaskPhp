<?php
require_once __DIR__ . '/logic/isAdmin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Type Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="main_body">
<?php
require 'Menu.php';
$userTypes = User_Type::getUserTypes();
$sortedTypes = $userTypes;
if (isset($_GET['sort'])) {
    $sortBy = $_GET['sort'];
    $sortedTypes = User_Type::sortUserTypes($sortBy);
}
?>
<div class="container_form">
    <h1 class="user_header">User Types</h1>
    <form action="logic/addUserType.php" method="post" class="form_b">
            <input type="text" id="user_type" name="user_type" class="input1" required placeholder="Insert a new user type title">
            <input type="number" id="user_priority" name="user_priority" class="input1" placeholder="Insert a new user type priority" required>

            <input type="submit" value="ADD USER TYPE" class="button">

    </form>
</div>
<div class="selection">
    <form action="logic/sortingUserTypes.php?" method="post" class="form_b">
        <select name="sort_users" class="input1">
            <option value="id">ID</option>
            <option value="type">Type</option>
            <option value="priority">Priority</option>
        </select>
        <input type="submit" name="sort_submit" value="Sort" class="button">
    </form>
</div>
<div class="container_table">
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Priority</th>
        <th>Edit</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($sortedTypes as $userType) : ?>
        <tr>
            <td><?= $userType->id ?></td>
            <td><?= $userType->type ?></td>
            <td><?= $userType->priority ?></td>
            <td>
                <form action="EditUserTypes.php?id= <?= $userType->id ?>" method="post">
                    <input type="hidden" value="<?= $userType->id ?>" name="user_type_id">
                    <input type="hidden" value="<?= $userType->type ?>" name="user_type">
                    <input type="hidden" value="<?= $userType->priority ?>" name="user_priority">
                    <button>Change</button>
                </form>
                <form action="logic/deleteUserType.php" method="post">
                    <input type="hidden" value="<?= $userType->id ?>" name="user_type_id">
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
