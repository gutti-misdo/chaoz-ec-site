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
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=vu', 'root', '');
        foreach ($pdo->query('select * from product where product_id =1') as $row) {
    echo '<div class="product-list">';
        echo '<div class="product-card">';
            echo '<a href="salonia.html">';
            echo '<img src=';echo $row['photograph'];echo ' alt="商品画像" class="product-image">';
            echo '</a>';
            echo '<hr class="divider">';
            echo '<div class="product-title">';
            echo $row['product_name'];
            echo $row['explanation'], '</div>';
            echo '<div><span class="star-rating">★★★★☆</span><span class="review-count">(35,356)</span></div>
                 <div class="sale-label">タイムセール</div>
                 <div class="price"> ¥';
            echo $row['price'];
            echo  '<span class="original-price">¥5,918</span>
                 </div>
                   <div class="coupon">10% OFF クーポンあり</div>
                   <div class="add-to-cart">カートに入れる</div>
        </div>';
        }
        foreach ($pdo->query('select * from product where product_id =2') as $row) {
        echo '<div class="product-card">';
            echo '<a href="fanheater.html">';
             echo '<img src=';echo $row['photograph'];echo ' alt="商品画像" class="product-image">';
            echo '</a>';
            echo '<hr class="divider">';
            echo '<div class="product-title">';
            echo $row['product_name'];
            echo $row['explanation'], '</div>';
            echo '<div><span class="star-rating">★★★★☆</span><span class="review-count">(1,468)</span></div>
                 <div class="sale-label">タイムセール</div>
                 <div class="price">¥';
            echo $row['price'];
            echo '<span class="original-price">¥16,999</span>
                 </div>
                   <div class="coupon">10% OFF クーポンあり</div>
                   <div class="add-to-cart">カートに入れる</div>
        </div>';
        }
        foreach ($pdo->query('select * from product where product_id =3') as $row) {
            echo '<div class="product-card">';
                echo '<a href="yakitori.html">';
                 echo '<img src=';echo $row['photograph'];echo ' alt="商品画像" class="product-image">';
                echo '</a>';
                echo '<hr class="divider">';
                echo '<div class="product-title">';
                echo $row['product_name'];
                echo $row['explanation'], '</div>';
                echo '<div><span class="star-rating">★★★★☆</span><span class="review-count">(608)</span></div>
                     <div class="sale-label">タイムセール</div>
                     <div class="price">¥';
                echo $row['price'];
                echo '<span class="original-price">¥3,580</span>
                     </div>
                       <div class="coupon">10% OFF クーポンあり</div>
                       <div class="add-to-cart">カートに入れる</div>
            </div>';
            }
        foreach ($pdo->query('select * from product where product_id =4') as $row) {
            echo '<div class="product-card">';
                echo '<a href="suihanki.html">';
                     echo '<img src=';echo $row['photograph'];echo ' alt="商品画像" class="product-image">';
                    echo '</a>';
                    echo '<hr class="divider">';
                    echo '<div class="product-title">';
                    echo $row['product_name'];
                    echo $row['explanation'], '</div>';
                    echo '<div><span class="star-rating">★★★★☆</span><span class="review-count">(53)</span></div>
                         <div class="sale-label">タイムセール</div>
                         <div class="price">¥';
                    echo $row['price'];
                    echo '<span class="original-price">¥8,980</span>
                         </div>
                           <div class="coupon">10% OFF クーポンあり</div>
                           <div class="add-to-cart">カートに入れる</div>
                </div>';
                } 
        foreach ($pdo->query('select * from product where product_id =5') as $row) {
            echo '<div class="product-card">';
                        echo '<a href="blanket.html">';
                             echo '<img src=';echo $row['photograph'];echo ' alt="商品画像" class="product-image">';
                            echo '</a>';
                            echo '<hr class="divider">';
                            echo '<div class="product-title">';
                            echo $row['product_name'];
                            echo $row['explanation'], '</div>';
                            echo '<div><span class="star-rating">★★★★☆</span><span class="review-count">(330)</span></div>
                                 <div class="sale-label">タイムセール</div>
                                 <div class="price">¥';
                            echo $row['price'];
                            echo '<span class="original-price">¥7,759</span>
                                 </div>
                                   <div class="coupon">10% OFF クーポンあり</div>
                                   <div class="add-to-cart">カートに入れる</div>
                        </div>';
                        }   
        foreach ($pdo->query('select * from product where product_id =6') as $row) {
                            echo '<div class="product-card">';
                                        echo '<a href="blanket.html">';
                                             echo '<img src=';echo $row['photograph'];echo ' alt="商品画像" class="product-image">';
                                            echo '</a>';
                                            echo '<hr class="divider">';
                                            echo '<div class="product-title">';
                                            echo $row['product_name'];
                                            echo $row['explanation'], '</div>';
                                            echo '<div><span class="star-rating">★★★★☆</span><span class="review-count">(330)</span></div>
                                                 <div class="sale-label">タイムセール</div>
                                                 <div class="price">¥';
                                            echo $row['price'];
                                            echo '<span class="original-price">¥3,580</span>
                                                 </div>
                                                   <div class="coupon">10% OFF クーポンあり</div>
                                                   <div class="add-to-cart">カートに入れる</div>
                                        </div>';
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
    </div>

</body>

</html>