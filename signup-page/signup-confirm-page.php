<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録確認画面</title>
    <link rel="stylesheet" href="./css/signup-confirm-page.css">
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <span class="site-title">チャオズEC - 登録確認</span>
            <div class="battery-icon">
                <div class="battery-body"></div>
                <div class="battery-tip"></div>
            </div>
        </div>

        <div class="content">
            <h3 class="text">登録内容確認</h3>
            <form action="signup-finish-page.php" method="post">
                <label for="name">氏名</label>
                <div id="name" class="display-info">
                    <?php echo $_POST['name']; ?>
                    <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                </div>

                <label for="email">メールアドレス</label>
                <div id="email" class="display-info">
                    <?php echo $_POST['email']; ?>
                    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
                </div>

                <label for="password">パスワード</label>
                <div id="password" class="display-info">
                    <?php echo $_POST['password']; ?>
                    <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>">
                </div>

                <label for="Zipcode">郵便番号</label>
                <div id="Zipcode" class="display-info">
                    <?php echo $_POST['yubin'] ?>
                    <input type="hidden" name="yubin" value="<?php echo $_POST['yubin']; ?>">
                </div>

                <label for="address">住所</label>
                <div id="address" class="display-info">
                    <?php echo $_POST['address']; ?>
                    <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
                </div>

                <label for="BN">建物名</label>
                <div id="BN" class="display-info">
                    <?php echo $_POST['BN']; ?>
                    <input type="hidden" name="BN" value="<?php echo $_POST['BN']; ?>">
                </div>

                <label for="RN">部屋番号</label>
                <div id="RN" class="display-info">
                    <?php echo $_POST['RN']; ?>
                    <input type="hidden" name="RN" value="<?php echo $_POST['RN']; ?>">
                </div>


                <button type="submit" class="login-button">登録</button>
            </form>
        </div>
    </div>
</body>

</html>