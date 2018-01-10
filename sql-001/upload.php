<?php

$UserID      = time();
$name    = $_REQUEST["n"];
$comment = $_REQUEST["c"];

require_once "db_setting.php";

// データベース書き込み
$dbh = new PDO('mysql:host='.$host.';dbname='.$database, $user, $pass);
$stmt = $dbh -> prepare("INSERT INTO ".$table." (UserID,name,comment) VALUES (:UserID, :name, :comment)");
$stmt->bindValue(':UserID', $UserID, PDO::PARAM_INT);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
$stmt->execute();

// index.phpにリダイレクト
header("Location: index.php");
