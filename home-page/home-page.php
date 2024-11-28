<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面</title>
    <link rel="stylesheet" href="./css/home-page.css">
    <link rel="stylesheet" href="./css/product-card.css">
    <link rel="stylesheet" href="./css/hamburger.css">
    <link rel="stylesheet" href="./css/category.css">
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
            <button class="cart-btn">🛒</button>
        </div>
    </div>
    <div class="product-list">
        <?php
        $pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;dbname=LAA1553900-chaoz;charset=utf8', 'LAA1553900', 'Pass1105');

        foreach ($pdo->query('select * from product') as $row) {
            echo '<div class="l-wrapper">';
            echo '<a href="product-detail.php?id=', $row['product_id'], '"class="card-link">';
            echo '<article class="card">';
            echo '<figure class="card__thumbnail">';
            echo '<img src="', $row['photograph'], '" class="card__image">';
            echo '</figure>';
            echo '<h3 class="card__title">', $row['product_name'], '</h3>';
            echo '<p class="card__text">', $row['explanation'], '</p>';
            echo '<p class="card__text -number">¥', number_format($row['price']), '</p>';
            echo '</article>';
            echo '</a>';
            echo '</div>';
        }
        ?>
    </div>
    <div class="category-list">
        <h2>CATEGORY</h2>
        <ul class="category-menu">
            <li class="category-item"> <a class="category-link" href="#"> <span class="category-icon">🧺</span> <span>洗濯機</span> </a> </li>
            <li class="category-item"> <a class="category-link" href="#"> <span class="category-icon">🔥</span> <span>コンロ</span> </a> </li>
            <li class="category-item"> <a class="category-link" href="#"> <span class="category-icon">📱</span> <span>スマートフォン</span> </a> </li>
            <li class="category-item"> <a class="category-link" href="#"> <span class="category-icon">🧹</span> <span>掃除機</span> </a> </li>
            <li class="category-item"> <a class="category-link" href="#"> <span class="category-icon">❄️</span> <span>冷蔵庫</span> </a> </li>
            <li class="category-item"> <a class="category-link" href="#"> <span class="category-icon">🍲</span> <span>電子レンジ</span> </a> </li>
            <li class="category-item"> <a class="category-link" href="#"> <span class="category-icon">🌬️</span> <span>扇風機</span> </a> </li>
            <li class="category-item"> <a class="category-link" href="#"> <span class="category-icon">💨</span> <span>ドライヤー</span> </a> </li>
        </ul>
    </div>
</body>

</html>