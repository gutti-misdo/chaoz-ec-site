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
</head>

<body>
    <div class="container">
        <div class="top-bar">
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
    <?php
    $pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;dbname=LAA1553900-chaoz;charset=utf8', 'LAA1553900', 'Pass1105');

    if (isset($_GET['id'])) {
        $id = (int)$_GET['id']; // IDを整数として取得（セキュリティ対策）
        $stmt = $pdo->prepare('SELECT * FROM product WHERE product_id = ?');
        $stmt->execute([$id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            echo '<h1>', $product['product_name'], '</h1>';
            echo '<img src="', $product['photograph'], '" alt="Product Image">';
            echo '<p>説明: ', $product['explanation'], '</p>';
            echo '<p>価格: ¥', number_format($product['price']), '</p>';
            echo '<form action="cart-add.php" method="post">';
            echo '<input type="hidden" name="product_id" value="', $product['product_id'], '">';
            echo '<p>個数:<select name="quantity">';
            for ($i = 1; $i < 10; $i++) {
                echo '<option value="', $i, '">', $i, '</option>';
            }
            echo '</select></p>';
            echo '<p><input type=submit value="カートに追加"></p>';
            echo '</form>';
        } else {
            echo '指定された商品は見つかりませんでした。';
        }
    } else {
        echo '商品IDが指定されていません。';
    }

    ?>
</body>

</html>