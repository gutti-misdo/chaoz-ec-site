<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細画面</title>
    <link rel="stylesheet" href="./css/home-page.css">
    <link rel="stylesheet" href="./css/product-card.css">
    <link rel="stylesheet" href="./css/product-detail.css">
</head>
    <?php
    include 'home-head.php';

    include '../db-connect.php';
echo'<body>';
echo '<div class="container2">';
    if (isset($_GET['id'])) {
        $id = (int)$_GET['id']; // IDを整数として取得（セキュリティ対策）
        $stmt = $pdo->prepare('SELECT * FROM product WHERE product_id = ?');
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            echo '<div class="image-container">';
            echo '<img src="', $product['photograph'], '" alt="Product Image">';
            echo '<div class="magnifier"></div>';/*これは拡大鏡の！*/ 
            echo '<div class="image-caption">※画像触れると一部拡大されます</div>';
            echo '</div>';
            echo '<div class="details-container">';
            echo '<h1>', $product['product_name'], '</h1>';
            echo '<p>説明: ', $product['explanation'], '</p>';
            echo '<p class="price">価格: ¥', number_format($product['price']), '</p>';
            echo '<form action="cart-add.php" method="post">';
            echo '<input type="hidden" name="product_id" value="', $product['product_id'], '">';
            echo '<p class="quantity">個数:<select name="count">';
            for ($i = 1; $i < 10; $i++) {
                echo '<option value="', $i, '">', $i, '</option>';
            }
            echo '</select></p>';
            echo '<p><input type="submit" value="カートに追加" class="add-to-cart"></p>';
            echo '</form>';
            echo '</div>';
        } else {
            echo '指定された商品は見つかりませんでした。';
        }
    } else {
        echo '商品IDが指定されていません。';
    }

    ?>
     <!--拡大鏡js!-->
     <script src="./js/product-detail.js"></script>

</div>
</body>

</html>