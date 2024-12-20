<?php
session_start();

include('header.php');
require_once('funcs.php');

// エラーと入力データの取得
$errors = $_SESSION['errors'];
$inputData = $_SESSION['input_data'];
$success = $_SESSION['success'];

// セッションをリセット
unset($_SESSION['errors'], $_SESSION['input_data'], $_SESSION['success']);
?>

<main>
    <!-- エラーメッセージ表示 -->
    <?php if (!empty($errors)): ?>
        <div class="message">
            <p>未入力の項目があります。</p>
            <ul style="color: red;">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo h($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- 成功メッセージ表示 -->
    <?php if (isset($success)): ?>
        <div class="message">
            <p style="color: green;"><?php echo h($success); ?></p>
        </div>
    <?php endif; ?>



    <form enctype="multipart/form-data" action="insert.php" method="post">
        <p>＊は必須項目です</p>
        <div>
            <h2>ホテル名＊</h2>
            <input type="text" name="name" value="<?php echo h($inputData['name'] ?? '') ?>">
        </div>
        <div>
            <h2>都道府県＊</h2>
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
            <h2>URL</h2>
            <input type="text" name="url" value="<?php echo h($inputData['url'] ?? '') ?>">
        </div>
        <div class="range-group">
            <h2>オススメ度＊</h2>
            <input type="range" min="0" max="5" value="0" class="input-range" name="stars" />
            <div class="stars"></div>
        </div>
        <div>
            <h2>うれしいポイント＊</h2>
            <div>
                <label><input type="checkbox" name="point[]" value="バス・トイレ別">バス・トイレ別</label>
                <label><input type="checkbox" name="point[]" value="小学生まで添い寝OK">小学生まで添い寝OK</label>
                <label><input type="checkbox" name="point[]" value="ベット幅110cm以上">ベット幅110cm以上</label>
                <label><input type="checkbox" name="point[]" value="靴を脱ぐお部屋">靴を脱ぐお部屋</label>
                <label><input type="checkbox" name="point[]" value="駅近">駅近</label>
                <label><input type="checkbox" name="point[]" value="ショッピングセンター併設">ショッピングセンター併設</label>
            </div>
        </div>
        <div>
            <h2>写真＊</h2>
            <input type="file" name="img" accept="image/*" multiple>
        </div>
        <div>
            <h2>コメント＊</h2>
            <textarea name="comment" cols="30" rows="10"><?php echo h($inputData['comment'] ?? '') ?></textarea>
        </div>

        <div class="submit">
            <button type="submit">登 録</button>
        </div>

    </form>
</main>

<?php include('footer.php'); ?>