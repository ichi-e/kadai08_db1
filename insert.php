<?php
$name  = $_POST["name"];
$pref  = $_POST["pref"];
$url   = $_POST["url"];
$stars = $_POST["stars"];
$comment  = $_POST["comment"];

// ファイル
$file = $_FILES["img"];
$filename = basename($file["name"]);
$tmp_path = $file["tmp_name"];
$file_err = $file["error"];
$filesize = $file["size"];
$upload_dir = __DIR__ . "/img/";
$sava_filename = date("YmdHis") . $filename;

if (is_uploaded_file($tmp_path)) {
    move_uploaded_file($tmp_path, $upload_dir . $sava_filename);
}

//DB接続
require_once('db.php');

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO taville_table(id, name, pref, url, stars, images, comment, date) 
VALUES(NULL, :name, :pref, :url, :stars, :images, :comment, now())");

//  2. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':pref', $pref, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':stars', $stars, PDO::PARAM_INT);
$stmt->bindValue(':images', $sava_filename, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit('ErrorMessage:' . $error[2]);
}

$hotel_id = $pdo->lastInsertId();

// ポイントを別テーブルに格納
$point = $_POST["point"];

$stmt = $pdo->prepare("INSERT INTO array_table(id, point) 
VALUES(:id, :point)");

foreach ($point as $p) {
    $status = $stmt->execute([
        ':id' => $hotel_id,
        ':point' => $p
    ]);

    if ($status === false) {
        $error = $stmt->errorInfo();
        exit('ErrorMessage:' . $error[2]);
    }

}

// 登録完了後、リダイレクト
header('Location: input.php');