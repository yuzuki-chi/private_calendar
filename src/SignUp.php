<?php
// password_hash()はphp 5.5.0以降の関数のため、バージョンが古くて使えない場合に使用
require_once './common/dbconnect.php';
require_once './common/password.php';
// セッション開始
session_start();

// エラーメッセージ、登録完了メッセージの初期化
$errorMessage = "";
$signUpMessage = "";

// ログインボタンが押された場合
if (isset($_POST["signUp"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["user_id"])) {  // 値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    } else if (empty($_POST["password2"])) {
        $errorMessage = 'パスワードが未入力です。';
    }

    if (!empty($_POST["user_id"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {
        // 入力したユーザIDとパスワードを格納
        $user_id = $_POST["user_id"];
        $password = $_POST["password"];
        $display_name = $_POST["display_name"];

        try {
            $stmt = $pdo->prepare("INSERT INTO myHomeCalendar_user(user_id, password, display_name) VALUES (?, ?, ?)");
            $stmt->execute(array($user_id, password_hash($password, PASSWORD_DEFAULT), $display_name));
            $signUpMessage = "登録が完了しました。<a href='./index.php'>こちらから</a>再度ログインをお願いいたします。";  // ログイン時に使用するIDとパスワード
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            echo $e->getMessage();
        }
    } else if($_POST["password"] != $_POST["password2"]) {
        $errorMessage = 'パスワードに誤りがあります。';
    }
}
?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>新規登録</title>
    </head>
    <body>
        <h1>新規登録画面</h1>
        <form id="loginForm" name="loginForm" action="" method="POST">
            <fieldset>
                <legend>新規登録フォーム</legend>
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo $signUpMessage; ?></font></div>
                <label for="display_name">表示名</label><input type="text" id="display_name" name="display_name" placeholder="表示名" value="<?php if (!empty($_POST['diplay_name'])) {echo htmlspecialchars($_POST['display_name'], ENT_QUOTES);} ?>">（ログインするためのIDではなく、表示される名前です）
                <br/>
                <label for="user_id">ユーザーID</label><input type="text" id="user_id" name="user_id" placeholder="ユーザー名を入力" value="<?php if (!empty($_POST['username'])) {echo htmlspecialchars($_POST['username'], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <label for="password2">パスワード(確認用)</label><input type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
                <br>
                <input type="submit" id="signUp" name="signUp" value="新規登録">
            </fieldset>
        </form>
        <br>
        <form action="Login.php">
            <input type="submit" value="戻る">
        </form>
    </body>
</html>