<?php

session_start();
require('../library.php');

// 各種項目設定
$dbn ='mysql:dbname=min_bbs;charset=utf8mb4;port=3306;host=localhost';
$user = 'root';
$pwd = '';
 
if(isset($_SESSION['form'])) {
    $form = $_SESSION['form'];
} else {
    header('Location:index.php');
    exit();
}
$form = $_SESSION['form'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = dbconnect();
    // $db = new mysqli ('localhost', 'root', '', 'min_bbs');
        // $db = dbconnect();
        // if(!$db){
        //     die($db->error);
        // }
    

//  $sql = 'INSERT INTO members (id, name, email, password, picture, created, modified) VALUES (NULL, :name, :email, :password, :picture, now(), now())';

$stmt = $db ->prepare('insert into members (name, email, password, picture) VALUES (?,?,?,?)');

// バインド変数を設定
// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->bindValue(':email', $email, PDO::PARAM_STR);
// $stmt->bindValue(':password', $password, PDO::PARAM_STR);
// $stmt->bindValue(':picture', $picture, PDO::PARAM_STR);

//Sはstringのこと
$password = password_hash($form['passwowrd'],PASSWORD_DEFAULT);
$stmt->bind_param('ssss', $form['name'], $form['email'], $password, $form['image']);
$success = $stmt->execute();
if (!$stmt){
    die ($db->error);
    }

    unset($_SESSION['form']);
    header('Location: thanks.php');
 
}

// `id`, `name`, `email`, `password`, `picture`, `created`, `modified`

// SQL実行（実行に失敗すると `sql error ...` が出力される）
// try {
//   $status = $stmt->execute();
// } catch (PDOException $e) {
//   echo json_encode(["sql error" => "{$e->getMessage()}"]);
//   exit();
// }

?>
<!DOCTYPE html>
<html lang="ja">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会員登録</title>
 
    <link rel="stylesheet" href="../style.css" />
</head>
 
<body>
    <div id="wrap">
        <div id="head">
            <h1>会員登録</h1>
        </div>
 
        <div id="content">
            <p>記入した内容を確認して、「登録する」ボタンをクリックしてください</p>
            <form action="" method="post">
                <dl>
                    <dt>ニックネーム</dt>
                    <dd><?php echo h($form['name']); ?></dd>
                    <dt>メールアドレス</dt>
                    <dd><?php echo h($form['email']); ?></dd>
                    <dt>パスワード</dt>
                    <dd>
                        【表示されません】
                    </dd>
                    <dt>写真など</dt>
                    <dd>
                            <img src="../member_picture/<?php echo h($form['image']); ?>" width="100" alt="" />
                    </dd>
                </dl>
                <div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する" /></div>
            </form>
        </div>
 
    </div>
</body>
 
</html>