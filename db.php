<?php

//DB接続
try {
    $pdo = new PDO('mysql:dbname=taville;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage());
}

?>