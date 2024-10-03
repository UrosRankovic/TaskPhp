<?php
require_once __DIR__ . '/tables/Menu.php';
require_once __DIR__ . '/tables/User.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: /Project/MainPage.php");
    die();
}
$user1 = User::getUser("id", $_SESSION["user_id"]);
$user_type = $user1->userType();
$menu = Menu::getMenu();
?>

<header class="header">
    <h1><a class="header_items" href="MainPage.php">Main Page</a></h1>
    <div class="header_content">
        <ul class="header_menu">
            <?php
            foreach ($menu as $m) {
                if ($m->priority <= $user_type->priority) {
                    echo '<li><a class="header_items" href="' . $m->url . '">' . $m->title . '</a></li>';
                }
            }
            ?>
        </ul>
    </div>
    <footer>
        <nav>
            <ul class="header_menu" id="logout">
                <li><a class="header_items" href="logic/logout.php">Logout</a></li>
            </ul>
        </nav>
    </footer>
</header>
