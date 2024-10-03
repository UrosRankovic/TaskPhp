<?php
require_once __DIR__ . '/logic/isExecutor.php';
require_once __DIR__ . '/tables/Comment.php';
require_once __DIR__ . '/tables/User.php';
require_once __DIR__ . '/tables/User_Type.php';
require_once __DIR__ . '/tables/Task.php';
if (!isset($_GET['id'])) {
    header("Location: /Project/Tasks.php");
    die();
}
$comments = Comment::listCommentsByTask($_GET['id']);
$user = User::getUser("id",$_SESSION['user_id']);
$Admin = $user->userType()->type;
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
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script>
        function commentUpdate(form) {
            $('#commentForm>input[name="title"]')
                .val(form.find('input[name="title"]').val());
            $('#commentForm>[name="content"]')
                .val(form.find('input[name="content"]').val());
            $('#commentForm>input[name="comment_id"]')
                .val(form.find('input[name="comment_id"]').val());
            $('#commentForm').attr('action', form.attr('action'));
        }
        $(function () {
            $('#commentForm').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data:
                    form.serialize(),
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.new === 'true') {
                            $('.comments_container').after(
                                '<div class="comments">' +
                                '<h2>' + response.title + '</h2>' +
                                '<p>' + response.content + '</p>' +
                                '<h3>' + response.user.username + '</h3>' +
                                '<h4>' + response.created_at + '</h4>' +
                                '<form action="UpdateComment.php?id=' + response.task_id + '&commentId=' + response.id + '" method="post" class="updateComment">' +
                                '<input type="hidden" name="title" value="' + response.title + '">' +
                                '<input type="hidden" name="content" value="' + response.content +'">' +
                                '<input type="hidden" name="task_id" value="' + response.task_id +'">' +
                                '<input type="hidden" name="comment_id" value="' + response.id +'">' +
                                '<input type="submit" id="updateButton" value="Update">'+
                                '</form>' +
                                '</div>'
                            )
                        }
                        $('#title, #description1').val('');
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });

            })
            $('.deleteComment').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data:
                        form.serialize()
                    ,
                    success: function(response) {
                        console.log(response);
                        form.parent().remove();
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            })

        });

    </script>
</head>
<body class="main_body">
<?php
require 'Menu.php';
?>

<div class="container" id="container">
    <div class="comments-section">
    <h1 class="header1">Leave a Comment</h1>
        <form method="post" action="logic/commenting.php" id="commentForm">
            <div class="form-group">
                <label for="id">Task:</label>
                <input type="text" id="id" name="task" disabled class="input" required value="<?= $Tasks->title ?>">
                <input type="hidden" value="<?= $Tasks->id ?>" name="task_id">
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="input" required value="">
            </div>
            <div class="form-group">
                <label for="description1">Comment</label>
                <textarea id="description1" name="content" class="input" ></textarea>
            </div>
            <input type="hidden" name="user_id" class="input" value="<?= $_SESSION['user_id']?>">
            <input type="hidden" name="comment_id">
            <input type="hidden" name="task_id" value="<?= $Tasks->id ?>">
            <div class="form-group">
                <input type="submit" value="Submit" class="btn">
            </div>
        </form>
    </div>
</div>
<div class="comments_container">
<?php
foreach ($comments as $comment) : ?>
    <div class="comments">
        <h2><?= $comment->title ?></h2>
        <p><?= $comment->content ?></p>
        <h3><?= $comment->user()->username ?></h3>
        <h4><?= date('d.m.Y H:i', strtotime($comment->created_at)) ?></h4>
        <?php if ($_SESSION['user_id'] == $comment->user_id || $Admin =="Admin") : ?>
            <form action="UpdateComment.php?id=<?= $Tasks->id ?>&commentId=<?= $comment->id ?>" method="post" class="updateComment">
                <input type="hidden" name="comment_id" value="<?= $comment->id?>">
                <input type="hidden" name="title" value="<?= $comment->title?>">
                <input type="hidden" name="content" value="<?= $comment->content?>">
                <input type="hidden" name="task_id" value="<?= $Tasks->id ?>">
                <input type="submit" id="updateButton" value="Update">
            </form>
        <?php endif ?>
        <?php if ($user->userType()->type == 'Admin') : ?>
            <form action="logic/deleteComment.php" method="post" class="deleteComment">
                <input type="hidden" name="comment_id" value="<?= $comment->id?>">
                <input type="hidden" name="task_id" value="<?= $Tasks->id?>">
                <input type="submit" id="deleteButton" value="Delete">
            </form>
        <?php endif ?>
    </div>
<?php endforeach ?>
</div>
</body>
</html>
