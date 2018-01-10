<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>サンプル掲示板</title>
    <link rel="stylesheet" href="common.css">
  </head>
  <body>

    <div class="contents">
      <h1>サンプル掲示板</h1>

      <hr>

      <form method="post" action="upload.php">
        <h2>名前</h2>
        <input type="text" name="n" />
        <h2>コメント</h2>
        <textarea name="c"></textarea>
        <p><button type="submit">送信</button></p>
      </form>

      <hr>

      <h2>登録データ</h2>

      <ul>

<?php
require_once "db_setting.php";

try {
  // データベース読み込み
  $dbh = new PDO('mysql:host='.$host.';dbname='.$database, $user, $pass);
  foreach($dbh->query('SELECT * from '.$table) as $row) {
      // print_r($row);
      echo "<li class='sentence'>";
      echo "<span class='id'>".$row["UserID"]."</span> : ";
      echo "<span class='name'>".$row["name"]."</span>";
      echo "<p class='comment'>".$row["comment"]."</p>";

      echo "<div class='del-btn'>";
      echo "<form method='post' action='delete.php'>";
      echo "<input type='hidden' name='UserID' value='".$row["UserID"]."'>";
      echo "<button type='submit'>削除</button>";
      echo "</div>";

      echo "</form>";
      echo "</li>";
  }
  $dbh = null;
} catch (PDOException $e) {
  print "エラー!: " . $e->getMessage() . "<br/>";
  die();
}
?>

      </ul>
    </div>

  </body>
</html>
