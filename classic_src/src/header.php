<?php
session_start();
// ログイン状態チェック
if (!isset($_SESSION["login_flag"])) {
    header("Location: Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <title>プライベートカレンダー</title>
    <meta http-equiv="content-type" charset="utf-8">
</head>
<link rel="stylesheet" type="text/css" href="./css/style.css">
<header class="Header">
    <div class="Header__title">
        Private Calendar
    </div>
</header>
<body>
