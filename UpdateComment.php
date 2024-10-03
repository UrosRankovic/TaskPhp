<?php
require_once __DIR__ . '/logic/is_logged_in.php';
require_once __DIR__ . '/tables/Comment.php';
require_once __DIR__ . '/tables/User.php';
require_once __DIR__ . '/tables/User_Type.php';
require_once __DIR__ . '/tables/Task.php';
if (!isset($_GET['id'])) {
    header("Location: /Project/Tasks.php");
    die();
}
$comments = Comment::listCommentsByTask($_GET['id']);
if (isset($_GET['commentId'])) {
    $comments = Comment::commentID($_GET['commentId']);
}

$user = User::getUser("id",$_SESSION['user_id']);
$Tasks = Task::getTask("id" ,$_GET['id']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave a Comment</title>
    <link rel="stylesheet" href="style.css">

</head>
<body class="main_body">
<?php
require 'Menu.php';
?>

<div class="container" id="container">
    <h1 class="header1">Update Comment</h1>
    <form method="post" action="logic/updateComment.php" id="changeType">
        <div class="form-group">
            <label for="task">Task:</label>
            <input type="text" id="id" name="task" disabled class="input" required value="<?= $Tasks->title ?>">
            <input type="hidden" value="<?= $Tasks->id ?>" name="task_id">
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="input" required value="<?= $comments->title ?>">
        </div>
        <div class="form-group">
            <label for="description1">Comment</label>
            <textarea id="description1" name="content" class="input" ><?= $comments->content ?></textarea>
        </div>
        <input type="hidden" name="user_id" class="input" value="<?= $comments->user_id ?>">
        <input type="hidden" name="comment_id" value="<?= $comments->id ?>">
        <input type="hidden" name="task_id" value="<?= $Tasks->id ?>">
        <div class="form-group">
            <input type="submit" value="UPDATE" class="btn">
        </div>
    </form>
</div>
</body>
</html>
