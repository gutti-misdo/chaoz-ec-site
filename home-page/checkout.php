<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注文確認</title>
</head>

<body>
    <?php include 'home-head.php' ?>
    <h1>注文内容の確認</h1>
    <?php
    include '../db-connect.php';

    $customer_id = $_SESSION['customer']['id'] ?? null; // ログイン済み顧客のID
    $guest = isset($_SESSION['guest_id']) && !$customer_id; // ゲストかどうかを判定

    try {
        $cart_id = null;

        if ($customer_id) {
            $stmt = $pdo->prepare('SELECT cart_id FROM shoppingcart WHERE customer_id = ?');
            $stmt->execute([$customer_id]);
            $cart_id = $stmt->fetchColumn();
        } elseif (isset($_SESSION['guest_id'])) {
            $stmt = $pdo->prepare('SELECT cart_id FROM shoppingcart WHERE guest_id = ?');
            $stmt->execute([$_SESSION['guest_id']]);
            $cart_id = $stmt->fetchColumn();
        }

        if (!$cart_id) {
            throw new Exception('カートが空です。');
        }

        $stmt = $pdo->prepare('
            SELECT 
                p.product_name, 
                p.price, 
                ci.quantity
            FROM cartitem ci
            JOIN product p ON ci.product_id = p.product_id
            WHERE ci.cart_id = ?
        ');
        $stmt->execute([$cart_id]);
        $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($cart_items)) {
            throw new Exception('カートが空です。');
        }
    } catch (Exception $e) {
        echo '<p>エラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p><a href="cart-page.php">カートに戻る</a></p>';
        exit;
    }
    ?>

    <h2>注文内容</h2>
    <ul>
        <?php foreach ($cart_items as $item): ?>
            <li>
                <?php echo htmlspecialchars($item['product_name'], ENT_QUOTES, 'UTF-8'); ?>:
                <?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>個
                （¥<?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?>）
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>購入者情報</h2>
    <form action="place_order.php" method="post">
        <?php if ($guest): ?>
            <p>氏名: <input type="text" name="guest_name" required></p>
            <p>メールアドレス: <input type="email" name="email" required></p>
            <p>建物名: <input type="text" name="building_name" required></p>
            <p>部屋番号: <input type="text" name="room_number" required></p>
            <p>郵便番号: <input type="text" name="post_code" required></p>
            <p>住所: <textarea name="address" required></textarea></p>
        <?php else: ?>
            <?php
            // ログインユーザー情報をセッションから取得
            $customer_info = $_SESSION['customer'] ?? [];
            ?>
            <p>氏名: <?php echo htmlspecialchars($customer_info['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
            <p>メールアドレス: <?php echo htmlspecialchars($customer_info['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
            <p>建物名: <input type="text" name="building_name" value="<?php echo htmlspecialchars($customer_info['buliding_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></p>
            <p>部屋番号: <input type="text" name="room_number" value="<?php echo htmlspecialchars($customer_info['room_number'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></p>
            <p>郵便番号: <input type="text" name="post_code" value="<?php echo htmlspecialchars($customer_info['post_code'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required></p>
            <p>住所: <textarea name="address" required><?php echo htmlspecialchars($customer_info['address'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea></p>
        <?php endif; ?>
        <button type="submit">購入を確定</button>
        <p><a href="home-page.php">ホームに戻る</a></p>
    </form>
</body>

</html>