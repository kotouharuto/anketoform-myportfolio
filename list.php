<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録者一覧</title>
    <!-- bootstrapの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
      body {
        text-align: center;
        margin: 0;
        background: black;
        color: white;
      }
      td {
        color: white;
      }

      a {
        background: white;
      }
    </style>
</head>
<body>
<div class="p-3 mb-2 bg-primary text-white">
  <h2 style="text-align: center;">登録者一覧</h2>
</div>
    
    <?php
    require_once "DBconnect.php"; //データベース接続
    $connect = new DbCnct();
    $pdo=$connect->dbConnect();
    
    //search.htmlでデータを検索された場合
    try {
      if(isset($_POST['search_key']) != "") { //search_keyの中身が空文字ではなかったら
        $search_key = '%' .$_POST['search_key']. '%'; //中間一致検索
        $sql = "SELECT * FROM users WHERE first_name like :first_name OR last_name like :last_name";
        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':first_name', $search_key, PDO::PARAM_STR);
        $stmh->bindValue(':last_name', $search_key, PDO::PARAM_STR);
        $stmh->execute();
        $count = $stmh->rowCount();
        print "検索結果は" .$count. "件です。<br>";
      //検索結果が見つからない場合
      if($count < 1) { 
        print "検索結果は０件です。";
      }
    } else {
      $sql = "SELECT * FROM users WHERE 1";
      $stmh = $pdo->query($sql);
    }
  } catch (PDOException $Exception) {
    print "エラー：" .$Exception->getMessage();
  }
  ?>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">登録番号</th>
          <th scope="col">姓</th>
          <th scope="col">名</th>
          <th scope="col">年齢</th>
          <th scope="col">ご意見</th>
        </tr>
      </thead>
      <tbody>
        
        <?php
        // 検索件数の分、行を表示
        while($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
          ?>
    <tr>
      <td><?=htmlspecialchars($row['id'], ENT_QUOTES)?></td>
      <td><?=htmlspecialchars($row['first_name'], ENT_QUOTES)?></td>
      <td><?=htmlspecialchars($row['last_name'], ENT_QUOTES)?></td>
      <td><?=htmlspecialchars($row['age'], ENT_QUOTES)?></td>
      <td><?=htmlspecialchars($row['message'], ENT_QUOTES)?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<a href="messagelist.php">ご意見一覧</a><br><br>
<a href="form.html">登録はこちらから</a><br><br>
<a href="search.html">登録者検索はこちらから</a><br><br>
</body>
</html>