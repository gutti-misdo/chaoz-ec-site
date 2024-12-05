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
            <?php
            include 'hamburger.php'; 
            ?>
            <form action="home-page.php">
                <button class="site-title">チャオズ.com</button>
            </form>
            <form action="search-output.php" method="post">
                <input type="text" name="keyword" class="search-bar" placeholder="検索...">
                <button class="search-button">検索</button>
            </form>
                    <?php
                    if (isset($_SESSION['customer']['name'])) {
                            echo '<form action="my-page.php" method="post">';
                            echo '<button class="akaunt-btn" name="akaunt">👤</button>';
                            echo '</form>';
                    } else {
                        echo '<form action="../login-page/login.php" method="post">';
                        echo '<button class="login-btn">';
                        echo 'ログイン';
                        echo '</button>';
                        echo '</form>';
                    }
                    ?>
            <form action="cart-page.php">
            <button class="cart-btn">🛒</button>
            </form>
        </div>
    </div>
    <div class="product-list">
        <?php
        include '../db-connect.php';

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
    <?php
    include 'category-list.php'; 
    ?>
</body>

</html>