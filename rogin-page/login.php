<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="./login.css">

</head>

<body>
    <div class="container">
        <div class="header">チャオズECログイン</div>
        <form action="login-test.php" method="post">
            <label for="email">メールアドレス</label>
            <input type="text" class="input-field" name='email' placeholder="example@example.com">

            <label for="password">パスワード</label>
            <input type="password" class="input-field" name='pass' placeholder="********">
            <button class="login-button">ログイン</button>
        </form>
        <form action="signup-page" method="post">
            <button class="signup-button">新規作成</button>
        </form>
        <div class="footer">
            © 2024 チャオズEC
        </div>
    </div>
</body>

</html>