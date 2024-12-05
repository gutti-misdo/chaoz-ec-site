<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カテゴリ別画面</title>
    <link rel="stylesheet" href="./css/product-card.css">
    <link rel="stylesheet" href="./css/category.css">
</head>

<body>
    <?php include 'home-head.php'; ?>
    <div class="product-list">
        <?php
        include '../db-connect.php';

        // GETパラメータからcategory_idを取得
        $category_id = filter_input(INPUT_GET, 'category_id', FILTER_SANITIZE_NUMBER_INT);

        // category_idが有効かどうか確認
        if ($category_id !== null && $category_id !== false) {
            // クエリを準備して実行
            $stmt = $pdo->prepare('SELECT * FROM product WHERE category_id = :category_id');
            $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->execute();

            // 商品データを出力
            foreach ($stmt as $row) {
                echo '<div class="l-wrapper">';
                echo '<a href="product-detail.php?id=', htmlspecialchars($row['product_id'], ENT_QUOTES, 'UTF-8'), '" class="card-link">';
                echo '<article class="card">';
                echo '<figure class="card__thumbnail">';
                echo '<img src="', htmlspecialchars($row['photograph'], ENT_QUOTES, 'UTF-8'), '" class="card__image">';
                echo '</figure>';
                echo '<h3 class="card__title">', htmlspecialchars($row['product_name'], ENT_QUOTES, 'UTF-8'), '</h3>';
                echo '<p class="card__text">', htmlspecialchars($row['explanation'], ENT_QUOTES, 'UTF-8'), '</p>';
                echo '<p class="card__text -number">¥', number_format($row['price']), '</p>';
                echo '</article>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            // category_idが無効な場合のメッセージ
            echo '<p>カテゴリが選択されていません。</p>';
        }
        ?>
    </div>
    <?php include 'category-list.php'; ?>
</body>

</html>
