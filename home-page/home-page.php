<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム画面(ゲスト)</title>
    <link rel="stylesheet" href="home-page.css">

</head>

<body>
    <div class="container">
        <div class="top-bar">
            <span class="site-title">チャオズ.com</span>
            <div class="search-bar-container">
                <input type="text" class="search-bar" placeholder="検索...">
                <button class="search-button">検索</button>
            </div>
            <button class="login-btn">ログイン</button>
            <button class="cart-btn">🛒</button>
        </div>

        <!-- 商品リストを表示 -->
<div class="product-list">
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=vu', 'root', '');
        $sql = $pdo->query('SELECT * FROM product WHERE product_id IN (1, 2, 3, 4, 5,6)'); 
        foreach ($sql as $row) {
          echo '<div class="product-card">';
            echo '<a href="product' . $row['product_id'] . '.html">';
             echo '<img src="' . $row['photograph'] . '" alt="商品画像" class="product-image">';
            echo '</a>';
            echo '<hr class="divider">';
            echo '<div class="product-title">' . $row['product_name'] . $row['explanation'] . '</div>';
            echo '<div><span class="star-rating">★★★★☆</span><span class="review-count">(35,356)</span></div>';
            echo '<div class="sale-label">タイムセール</div>';
            echo '<div class="price">¥' . $row['price'] . ' <span class="original-price">¥5,918</span></div>';
            echo '<div class="coupon">10% OFF クーポンあり</div>';
            echo '<div class="add-to-cart">カートに入れる</div>';
          
          echo '</div>';
        }
        $pdo = null; ?>

        <div class="product-card">
            <img src="https://via.placeholder.com/150" alt="商品画像" class="product-image">
            <hr class="divider">
            <div class="product-title">【2024年登場】 毛穴吸引器 毛穴洗浄 毛穴ケア 6種類吸引ヘッド 5段階吸引力空気</div>
            <div><span class="star-rating">★★★★☆</span><span class="review-count">(330)</span></div>
            <div class="sale-label">タイムセール</div>
            <div class="price">¥2,780 <span class="original-price">¥3,580</span></div>
            <div class="coupon">10% OFF クーポンあり</div>
            <div class="add-to-cart">カートに入れる</div>
        </div>
        <div class="product-card">
            <img src="https://via.placeholder.com/150" alt="商品画像" class="product-image">
            <hr class="divider">
            <div class="product-title">【2024年登場】 毛穴吸引器 毛穴洗浄 毛穴ケア 6種類吸引ヘッド 5段階吸引力空気</div>
            <div><span class="star-rating">★★★★☆</span><span class="review-count">(330)</span></div>
            <div class="sale-label">タイムセール</div>
            <div class="price">¥2,780 <span class="original-price">¥3,580</span></div>
            <div class="coupon">10% OFF クーポンあり</div>
            <div class="add-to-cart">カートに入れる</div>
        </div>
</div>
    
</body>
</html>