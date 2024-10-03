<?php
require_once __DIR__ . '/logic/is_logged_in.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Main Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="main_body">
<?php
require 'Menu.php';
$userTypes = User_Type::getUserTypes();
?>
</body>
</html>
