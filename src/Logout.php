<?php
session_start();

if (isset($_SESSION["login_flag"])) { //ログイン状態
    $errorMessage = "ログアウトしました。";
} else { //タイムアウト状態
    $errorMessage = "セッションがタイムアウトしました。";
}

// セッションの変数のクリア
$_SESSION = array();

// セッションクリア
@session_destroy();

require('header.php');
?>
        <h1>ログアウトしました</h1>
        <div><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></div>
        <ul>
            <li><a href="Login.php">ログイン画面に戻る</a></li>
        </ul>
<?php
require('footer.php');