<?php
session_start();
require('header.php');

$user_id = htmlspecialchars($_SESSION["user_id"], ENT_QUOTES);
$display_name = htmlspecialchars($_SESSION["display_name"], ENT_QUOTES);
?>
        <h1>ようこそ<u><?php echo $display_name; ?></u>さん</h1>
        <p>ユーザID：<?php echo $user_id; ?></p>
        <p>表示名：<?php echo $display_name; ?></p>

        <hr/>
        <h2>メニュー</h2>
        <ul>
            <li><a href="calendar.php">カレンダーへ</a></li>
            <li><a href="Logout.php">ログアウト</a></li>
        </ul>
<?php
require('footer.php');