<?php
include('header.php');
require_once('funcs.php');

//DB接続
require_once('db.php');

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM taville_table;");
$status = $stmt->execute();

//３．データ表示
if ($status === false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
}

// 全データ取得
$values  = $stmt->fetchAll(PDO::FETCH_ASSOC);

// array_table取得
$stmt = $pdo->prepare("SELECT * FROM array_table");
$status = $stmt->execute();

if ($status === false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
}

$points = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 子テーブルのデータをIDごとにまとめる
$pointsByID = [];
foreach ($points as $point) {
    $pointsByID[$point['id']][] = $point['point'];
}

?>

<main>
    <section class="search">
        <form action="search.php" method="post">
            <div>
                <h2>都道府県から検索</h2>
                <select name="pref">
                    <option value="" selected>選択してください</option>
                    <option value="北海道">北海道</option>
                    <option value="青森県">青森県</option>
                    <option value="岩手県">岩手県</option>
                    <option value="宮城県">宮城県</option>
                    <option value="秋田県">秋田県</option>
                    <option value="山形県">山形県</option>
                    <option value="福島県">福島県</option>
                    <option value="茨城県">茨城県</option>
                    <option value="栃木県">栃木県</option>
                    <option value="群馬県">群馬県</option>
                    <option value="埼玉県">埼玉県</option>
                    <option value="千葉県">千葉県</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川県">神奈川県</option>
                    <option value="新潟県">新潟県</option>
                    <option value="富山県">富山県</option>
                    <option value="石川県">石川県</option>
                    <option value="福井県">福井県</option>
                    <option value="山梨県">山梨県</option>
                    <option value="長野県">長野県</option>
                    <option value="岐阜県">岐阜県</option>
                    <option value="静岡県">静岡県</option>
                    <option value="愛知県">愛知県</option>
                    <option value="三重県">三重県</option>
                    <option value="滋賀県">滋賀県</option>
                    <option value="京都府">京都府</option>
                    <option value="大阪府">大阪府</option>
                    <option value="兵庫県">兵庫県</option>
                    <option value="奈良県">奈良県</option>
                    <option value="和歌山県">和歌山県</option>
                    <option value="鳥取県">鳥取県</option>
                    <option value="島根県">島根県</option>
                    <option value="岡山県">岡山県</option>
                    <option value="広島県">広島県</option>
                    <option value="山口県">山口県</option>
                    <option value="徳島県">徳島県</option>
                    <option value="香川県">香川県</option>
                    <option value="愛媛県">愛媛県</option>
                    <option value="高知県">高知県</option>
                    <option value="福岡県">福岡県</option>
                    <option value="佐賀県">佐賀県</option>
                    <option value="長崎県">長崎県</option>
                    <option value="熊本県">熊本県</option>
                    <option value="大分県">大分県</option>
                    <option value="宮崎県">宮崎県</option>
                    <option value="鹿児島県">鹿児島県</option>
                    <option value="沖縄県">沖縄県</option>
                </select>
            </div>
            <div>
                <h2>こだわり条件を選ぶ</h2>
                <div class="check_area">
                    <label><input type="checkbox" name="point[]" value="バス・トイレ別">バス・トイレ別</label>
                    <label><input type="checkbox" name="point[]" value="小学生まで添い寝OK">小学生まで添い寝OK</label>
                    <label><input type="checkbox" name="point[]" value="ベット幅110cm以上">ベット幅110cm以上</label>
                    <label><input type="checkbox" name="point[]" value="靴を脱ぐお部屋">靴を脱ぐお部屋</label>
                    <label><input type="checkbox" name="point[]" value="駅近">駅近</label>
                    <label><input type="checkbox" name="point[]" value="ショッピングセンター併設">ショッピングセンター併設</label>
                </div>
            </div>

            <div class="submit">
                <button type="submit">検索</button>
            </div>
        </form>

    </section>

    <section class="archive">
        <?php foreach ($values as $data): ?>
            <a href="detail.php?id=<?php echo $data['id']; ?>">
                <div class="container">
                    <figure>
                        <img src="img/<?php echo h($data['images']); ?>" alt="<?php echo h($data['name']); ?>">
                    </figure>
                    <h2><?php echo h($data['name']); ?></h2>
                    <?php if (!empty($pointsByID[$data['id']])): ?>
                        <ul class="point">
                            <?php foreach ($pointsByID[$data['id']] as $point): ?>
                                <li><?php echo h($point); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </a>
        <?php endforeach; ?>
    </section>
</main>

<?php include('footer.php'); ?>