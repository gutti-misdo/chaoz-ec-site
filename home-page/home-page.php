<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面</title>
    <link rel="stylesheet" href="./css/home-page.css">
    <link rel="stylesheet" href="./css/product-card.css">
</head>
<body>
    <div class="container">
        <div class="top-bar">
        <span class="site-title">チャオズ.com</span>
            <input type="text" class="search-bar" placeholder="検索...">
            <button class="search-button">検索</button>
            <button class="login-btn">ログイン</button>
            <button class="cart-btn">🛒</button>
        </div>
    </div>
    <div class="product-list">
    <?php
    $pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;dbname=LAA1553900-chaoz;charset=utf8', 'LAA1553900', 'Pass1105');

    foreach ($pdo->query('select * from product') as $row) {
        echo '<div class="l-wrapper">';
        echo '<article class="card">';
        echo '<figure class="card__thumbnail">';
        echo '<img src="',$row['photograph'],'" class="card__image">';
        echo '</figure>';
        echo '<h3 class="card__title">',$row['product_name'],'</h3>';
        echo '<p class="card__text">',$row['explanation'],'</p>';
        echo '<p class="card__text -number">¥',number_format($row['price']),'</p>';
        echo '</article>';
        echo '</div>';
    }

    ?>
    </div>
</body>
</html>