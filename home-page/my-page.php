<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>住所変更</title>
    <link rel="stylesheet" href="./css/my-page1.css">
    <link rel="stylesheet" href="./css/home-page.css">
    <link rel="stylesheet" href="./css/hamburger.css">
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <input type="checkbox" id="kaden-toggle">
            <label for="kaden-toggle" class="kaden_btn">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <nav class="kaden">
                <div class="kaden_inner">
                    <ul class="kaden_menu">
                        <li class="kaden_item">
                            <a class="kaden_link" href="#">
                                <span class="kaden_icon">🧺</span>洗濯機
                            </a>
                            <a class="kaden_link" href="#">
                                <span class="kaden_icon">🔥</span>コンロ
                            </a>
                            <a class="kaden_link" href="#">
                                <span class="kaden_icon">📱</span>スマートフォン
                            </a>
                            <a class="kaden_link" href="#">
                                <span class="kaden_icon">🧹</span>掃除機
                            </a>
                            <a class="kaden_link" href="#">
                                <span class="kaden_icon">❄️</span>冷蔵庫
                            </a>
                            <a class="kaden_link" href="#">
                                <span class="kaden_icon">🍲</span>電子レンジ
                            </a>
                            <a class="kaden_link" href="#">
                                <span class="kaden_icon">🌬️</span>扇風機
                            </a>
                            <a class="kaden_link" href="#">
                                <span class="kaden_icon">💨</span>ドライヤー
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <form action="home-page.php">
                <button class="site-title">チャオズ.com</button>
            </form>
            <form action="search-output.php" method="post">
                <input type="text" name="keyword" class="search-bar" placeholder="検索...">
                <button class="search-button">検索</button>
            </form>
            <form action="../login-page/login.php" method="post">
                <button class="login-btn">
                    <?php
                    if (isset($_SESSION['customer']['name'])) {
                        echo htmlspecialchars($_SESSION['customer']['name'], ENT_QUOTES, 'UTF-8');
                    } else {
                        echo 'ログイン';
                    }
                    ?>
                </button>
            </form>
            <form action="logout-output.php" method="post">
                <?php
                if (isset($_SESSION['customer'])) {
                    echo '<button class="login-btn" name="logout">ログアウト</button>';
                }
                ?>
            </form>
            <form action="cart-page.php">
                <button class="cart-btn">🛒</button>
            </form>
        </div>
    </div>
    <h1>マイページ</h1>

    <form action="logout-output.php" method="post">
        <?php
        if (isset($_SESSION['customer'])) {
            echo '<h2>ログアウト</h2>';
            echo '<button name="logout" class="login-out">サインアウト</button>';
        }
        ?>
    </form>
    <br><br>
    <div class="separator"></div>

    <div class="container2">
        <h1>住所変更</h1>
        <div class="current-address">
        <?php
        if (isset($_SESSION['customer'])) {
            echo'<h3>現在の住所</h3>';
            echo'<p>住所:' ;echo htmlspecialchars($_SESSION['customer']['address'], ENT_QUOTES, 'UTF-8'),'</p>';
            echo'<p>建物名:' ;echo htmlspecialchars($_SESSION['customer']['buliding_name'], ENT_QUOTES, 'UTF-8'), '</p>';
            echo'<p>部屋番号:' ;echo htmlspecialchars($_SESSION['customer']['room_number'], ENT_QUOTES, 'UTF-8'), '</p>';
            echo'<p>郵便番号:' ; echo htmlspecialchars($_SESSION['customer']['post_code'], ENT_QUOTES, 'UTF-8'),'</p>';
        }
        ?>
        </div>
        <form action="my-page-finish.php" method="post" class="address-form">
            <label for="new_address">新しい住所:</label>
            <input type="text" id="new_address" name="new_address" required>

            <label for="new_building_name">新しい建物名:</label>
            <input type="text" id="new_building_name" name="new_building_name" required>

            <label for="new_room_number">新しい部屋番号:</label>
            <input type="text" id="new_room_number" name="new_room_number" required>

            <label for="new_post_code">新しい郵便番号:</label>
            <input type="text" id="new_post_code" name="new_post_code" required>

            <input type="submit" value="住所を更新">
        </form>
        <form action="home-page.php">
            <button class="home-button">ホーム画面へ戻る</button>
        </form>
    </div>
</body>

</html>