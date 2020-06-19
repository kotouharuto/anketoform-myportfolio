<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ご意見一覧</title>
    <!-- bootstrapの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<style>
    body {
        text-align: center;
    }

    .usermessage {
        text-align: center;
    }

    .border {
        width: 100%;
        height: 1px;
        margin: 0 auto;
    }

    body {
        background: black;
        color: white;
    }

    a {
            background: white;
        }
</style>
<body>
<div class="p-3 mb-2 bg-info text-white">
    <h2 class="mb-4 mt-3" style="text-align:center;">ご意見一覧</h2>
</div>
<div class="main">
    <?php
    require_once "DBconnect.php"; //データベース接続
    $connect = new DbCnct();
    $pdo=$connect->dbConnect();
    $sql = "SELECT * FROM users WHERE 1";
    $stmh = $pdo->prepare($sql);
    $stmh->execute();
    $pdo->query("SET NAMES utf8");
    while(1) 
    {
        $row = $stmh->fetch(PDO::FETCH_ASSOC); //１レコード取り出し
        if($row == false) //データがもうない場合
        {
        break; //ループから脱出
    }
    ?>
    <div class="usermessage">
        <?php
            //リストの表示
            print $row['first_name'].' ';
            print $row['last_name'].'　';
            print $row['message'];
            print "<br>";
        ?>
    </div>
    <?php
    }
    $pdo = null;
    ?>
    <br>
    <a href="list.php">登録者一覧</a><br><br>
    <a href="form.html">登録はこちらから</a><br><br>
    <a href="search.html">登録者検索はこちらから</a><br><br>
</div>
</body>
</html>