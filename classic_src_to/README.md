# classic_src (old ver, not practical)

"classic_src" is a "naked PHP" that I created without any framework when I first started learning development techniques.
Therefore, this is not a practical code.
If you are looking for practical code, I suggest you check out "practical_src" which employs Laravel.
The main difference is that "classic_src" uses "bare PHP" and "pracitcal_src" uses "Laravel Sail".

-- Following lines are descriptions from the time of development. --

----

# プライベートカレンダー

## Webサイトの概要
以前、いろいろあって[myHomeCalendar](https://github.com/yuzuki-chi/myhomeCalendar)というものを作りました。しかしこちらは私の家族限定（名前とかが固定）なため、汎用性があるカレンダーになるようリメイクしました。

具体的には、データベースの指定だけをユーザが行えば、その先のテーブル作成/ユーザ作成・管理等を自動化またはWebから変更できるようにします。

## 実装に当たって
.gitignoreにデータベース接続を行うためのPHPを入れています。こちらは各自でご用意お願いします。例は次のとおり。
### dbconnect.php
```php:dbconnect.php
<?php
try{
    $dsn = "mysql:dbname=【データベース名】;
            host=【ホスト名】;
            charset=utf8";
    $dbusername = "【データベースユーザ名】";
    $dbpassword = "【データベースパスワード】";
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
} catch(PDOException $e) {
    echo "<h1>DB接続エラー： " . $e->getMessage() . "</h1>"; 
    if($e->getCode()=='1049') { //Unknown database 'myhomecaledndar'
        echo "データベースの指定が間違えているか、作成されていません。<br/>" .
             "考えられる原因は次の通りです。".
             "<h2>1. データベースが作成されていない</h2>".
             "<p><a href='https://github.com/yuzuki-chi/private_calendar/blob/master/README.md'>README</a>を参考に、dbconnect.phpを作成した後、phpmyadmin等から指定のデータベースを作成してください。</p>".
             "<h2>2. 正しいデータベースが指定されていない</h2>".
             "<p><a href='https://github.com/yuzuki-chi/private_calendar/blob/master/README.md'>README</a>を参考に、dbconnect.phpに誤りがないか確認してください。</p>";
    }
}
```
## 著者
[yuzuki-chi](https://github.com/yuzuki-chi)