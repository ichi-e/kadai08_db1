<?php

include('header.php');
require_once('funcs.php');

$id = $_GET['id'];

//DB接続
require_once('db.php');

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM taville_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
if ($status === false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
}

// 全データ取得
$values  = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($values);

// array_table取得
$stmt = $pdo->prepare("SELECT * FROM array_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
}

$points = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pointArray = [];
foreach ($points as $point) {
    $pointArray[] = $point['point'];
}
// var_dump($pointArray);

?>

<main>
    <section class="single">
        <p class="pref"><?php echo h($values['pref']); ?></p>
        <h1><?php echo h($values['name']); ?></h1>

        <figure>
            <img src="img/<?php echo h($values['images']); ?>" alt="<?php echo h($values['name']); ?>">
        </figure>

        <?php if (!empty($pointArray)): ?>
            <ul class="point">
                <?php foreach ($pointArray as $point): ?>
                    <li><?php echo h($point); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="stars" data-rec="<?php echo h($values['stars']); ?>"></div>

        <p class="memo"><?php echo nl2br(h($values['comment'])); ?></p>
        <p class="url"><a href="<?php echo h($values['url']); ?>" target="_blank"><?php echo h($values['url']); ?></a></p>

        <p class="back"><a href="index.php">戻る</a></p>
    </section>
</main>

<?php include('footer.php'); ?>