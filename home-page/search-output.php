<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索結果画面</title>
    <link rel="stylesheet" href="./css/home-page.css">
    <link rel="stylesheet" href="./css/product-card.css">
</head>

<body>
    <div class="container">
        <div class="top-bar">
            <form action="home-page.php">
                <button class="site-title">チャオズ.com</button>
            </form>
            <input type="text" class="search-bar" placeholder="検索...">
            <button class="search-button">検索</button>
            <form action="../login-page/login.php" method="post">
                <button class="login-btn">ログイン</button>
            </form>
            <button class="cart-btn">🛒</button>
        </div>
    </div>
    <div class="product-list">
        <?php
        $pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;dbname=LAA1553900-chaoz;charset=utf8', 'LAA1553900', 'Pass1105');
        $sql = $pdo->prepare('select * from product where product_name like ? || explanation like ?');
        $sql->execute(['%' . $_POST['keyword'] . '%', '%' . $_POST['keyword'] . '%']);
        foreach ($sql as $row) {
            echo '<div class="l-wrapper">';
            echo '<article class="card">';
            echo '<figure class="card__thumbnail">';
            echo '<img src="', $row['photograph'], '" class="card__image">';
            echo '</figure>';
            echo '<h3 class="card__title">', $row['product_name'], '</h3>';
            echo '<p class="card__text">', $row['explanation'], '</p>';
            echo '<p class="card__text -number">¥', number_format($row['price']), '</p>';
            echo '</article>';
            echo '</div>';
        }

        ?>
    </div>
</body>

</html>