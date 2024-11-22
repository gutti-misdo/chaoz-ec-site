<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録画面</title>
    <link rel="stylesheet" href="./css/signup-page.css">
</head>
<body>
<div class="container">
        <h3 class="form-title">新規登録</h3>
        <form action="signup-confirm-page.php" method="post">
            <label class="form-label" for="name">氏名</label>
            <input type="text" class="form-field" id="name" name="name" placeholder="例：チャオズ・太郎" required>

            <label class="form-label" for="email">メールアドレス</label>
            <input type="email" class="form-field" id="email" name="email" placeholder="example@example.com" required>

            <label class="form-label" for="password">パスワード</label>
            <input type="password" class="form-field" id="password" name="password" placeholder="********" required>

            <label class="form-label" for="yubin">郵便番号</label>
            <input type="text" class="form-field" id="yubin" name="yubin" placeholder="〇〇〇-〇〇〇〇" required>

            <label class="form-label" for="address">住所</label>
            <input type="text" class="form-field" id="address" name="address" placeholder="住所" required>

            <label class="form-label" for="BN">建物名</label>
            <input type="text" class="form-field" id="BN" name="BN" placeholder="〇〇〇マンション" required>

            <label class="form-label" for="RN">部屋番号</label>
            <input type="text" class="form-field" id="RN" name="RN" placeholder="〇〇〇号室" required>
            <div class="button-container">
                <button type="submit" class="submit-button">登録内容の確認</button>
            </div>
        </form>
    </div>
</body>
</html>