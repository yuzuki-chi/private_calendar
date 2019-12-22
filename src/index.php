<?php
session_start();
require('dbconnect.php');

//初回アクセスの確認処理
if(!($sql = $pdo->query("SELECT * FROM myHomeCalendar_user"))) {
    echo "完全初回アクセスです<br/>";
    //ここに新しいテーブル作成の設定を入れます
    //DBの作成からしてあげたら親切なのでは

    // テーブル作成のSQLを作成
    $create_sql = "CREATE TABLE myHomeCalendar_user (
    	id INT(11) AUTO_INCREMENT PRIMARY KEY,
	    display_name VARCHAR(20),
	    user_id VARCHAR(16),
        password VARCHAR(255)
    ) engine=innodb default charset=utf8";
    // SQLを実行
    if(!($res = $pdo->query($create_sql))) echo "<a href='/phpmyadmin'>こちら</a>からデータベースを作成してください。<br/>";
    else echo "テーブル'myHomeCalendar_userを作成しました。<br/><a href='./index.php'>再読み込みする</a>";

    exit;
}
//テーブルはあるが、ユーザ情報が登録されていない場合
if (empty($results = $sql->fetchAll())) { 
    header("Location: SignUp.php");
    exit;
} else {
    header("Location: MainPage.php");
}