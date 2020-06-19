<?php
//form.htmlで登録したデータを表示(確認用に)
require_once "DBconnect.php"; //データベース接続

$fname = $_POST['first_name']; //from.htmlの入力データを取得
$lname = $_POST['last_name'];
$age = $_POST['age'];
$message = $_POST['message'];
try {
    $pdo->beginTransaction(); //トランザクション開始
    $sql = "INSERT INTO users (first_name, last_name, age, message) VALUES (:first_name, :last_name, :age, :message)"; //SQL文
    $stmh = $pdo->prepare($sql); //SQL文を解析
    $stmh->bindValue('first_name', $_POST['first_name'], PDO::PARAM_STR);
    $stmh->bindValue('last_name', $_POST['last_name'], PDO::PARAM_STR);
    $stmh->bindValue('age', $_POST['age'], PDO::PARAM_INT);
    $stmh->bindValue('message', $_POST['message'], PDO::PARAM_STR);
    $stmh->execute(); //SQL文を実行
    $pdo->commit(); //変更を確定
    print 'あなたのデータ<br>';
    print '『' .$fname. ' ' .$lname.'』'. '様';
    print '<br>';
    print '年齢';
    print '<br>';
    print '『' .$age. '』';
    print '<br>';
    print 'ご意見';
    print '<br>';
    print '『' .$message. '』';
    print '<br>';
    print '<br>';
    print 'こちらの内容で登録しました';
    ?>
    <br>
    <a href="list.php">登録者一覧</a>
    <?php
} catch (PDOException $Exception) {
    $pdo->rollBack(); //元の状態に戻す
    print 'エラー：' .$Exception->getMessage();
}
?>