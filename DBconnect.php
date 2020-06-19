<?php
class DbCnct {
public function dbConnect() {
    $user = "root";
    $password = "root";
    $host = "localhost";
    $dbname = "anketoform";
    $dbtype = "mysql";
    $dsn = sprintf( //データベース接続文
        "%s:host=%s;dbname=%s;charset=utf8",
        $dbtype,
        $host,
        $dbname,
        );
        
        
        try {
            $pdo = new PDO($dsn, $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //接続時にエラーを検知してメッセージを表示できるようにする
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //エミュレートするかしないか決めるための設定
        } catch (PDOException $Exception) {
            die('エラー：' .$Exception->getMessage()); //エラーメッセージの表示
        }
        return $pdo;
    }
}
?>