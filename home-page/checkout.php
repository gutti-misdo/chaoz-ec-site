<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購入確認</title>
</head>

<body>
    <h1>購入確認</h1>

    <?php
    $pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;dbname=LAA1553900-chaoz;charset=utf8', 'LAA1553900', 'Pass1105');

    $customer_id = $_SESSION['customer']['id'] ?? null; // ログイン済み顧客のID
    $guest = !$customer_id; // ゲストかどうかを判定

    // カート情報を取得
    try {
        $cart_id = null;

        if ($customer_id) {
            // 顧客のカートIDを取得
            $stmt = $pdo->prepare('SELECT cart_id FROM shoppingcart WHERE customer_id = ?');
            $stmt->execute([$customer_id]);
            $cart_id = $stmt->fetchColumn();
        } elseif (isset($_SESSION['guest_id'])) {
            // ゲストのカートIDを取得
            $stmt = $pdo->prepare('SELECT cart_id FROM shoppingcart WHERE guest_id = ?');
            $stmt->execute([$_SESSION['guest_id']]);
            $cart_id = $stmt->fetchColumn();
        }

        if (!$cart_id) {
            throw new Exception('カートが空です。');
        }

        // カートアイテムを取得
        $stmt = $pdo->prepare('
            SELECT 
                p.product_id,
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

    // POST処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $guest_info = [];
        if ($guest) {
            // ゲストの情報を収集
            $guest_info = [
                'email' => $_POST['email'] ?? null,
                'building_name' => $_POST['building_name'] ?? null,
                'room_number' => $_POST['room_number'] ?? null,
                'post_code' => $_POST['post_code'] ?? null,
                'address' => $_POST['address'] ?? null
            ];

            foreach ($guest_info as $key => $value) {
                if (empty($value)) {
                    echo '<p style="color: red;">' . htmlspecialchars($key) . ' は必須です。</p>';
                    exit;
                }
            }
        } else {
            // ログイン済み顧客情報はセッションから取得
            $guest_info = [
                'email' => $_SESSION['customer']['email'] ?? null,
                'buliding_name' => $_SESSION['customer']['buliding_name'] ?? null,
                'room_number' => $_SESSION['customer']['room_number'] ?? null,
                'post_code' => $_SESSION['customer']['post_code'] ?? null,
                'address' => $_SESSION['customer']['address'] ?? null
            ];
        }

        try {
            $pdo->beginTransaction();

            // `orders` テーブルに注文情報を保存
            $stmt = $pdo->prepare('
                INSERT INTO orders (customer_id, guest_id, order_dete, total_amount, email, building_name, room_number, post_code, address)
                VALUES (?, ?, NOW(), ?, ?, ?, ?, ?, ?)
            ');

            $total_amount = 0;
            foreach ($cart_items as $item) {
                $total_amount += $item['price'] * $item['quantity'];
            }

            $stmt->execute([
                $customer_id,
                $guest ? $_SESSION['guest_id'] : null,
                $total_amount,
                $guest_info['email'],
                $guest_info['buliding_name'],
                $guest_info['room_number'],
                $guest_info['post_code'],
                $guest_info['address']
            ]);

            $order_id = $pdo->lastInsertId();

            // `orderdetail` テーブルに商品明細を保存
            $stmt = $pdo->prepare('
                INSERT INTO orderdetail (order_id, product_id, quantity, unit_price)
                VALUES (?, ?, ?, ?)
            ');
            foreach ($cart_items as $item) {
                $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
            }

            // カートを初期化
            $stmt = $pdo->prepare('DELETE FROM cartitem WHERE cart_id = ?');
            $stmt->execute([$cart_id]);

            $pdo->commit();

            echo '<p>購入が完了しました！</p>';
            echo '<p><a href="home-page">ホームに戻る</a></p>';
            exit;
        } catch (Exception $e) {
            $pdo->rollBack();
            echo '<p>エラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
        }
    }
    ?>

    <!-- ゲスト情報入力フォーム -->
    <?php if ($guest): ?>
        <form method="post">
            <p>メールアドレス: <input type="email" name="email" required></p>
            <p>建物名: <input type="text" name="building_name" required></p>
            <p>部屋番号: <input type="text" name="room_number" required></p>
            <p>郵便番号: <input type="text" name="post_code" required></p>
            <p>住所: <textarea name="address" required></textarea></p>
            <button type="submit">購入を確定</button>
        </form>
    <?php else: ?>
        <form method="post">
            <button type="submit">購入を確定</button>
        </form>
    <?php endif; ?>
</body>

</html>
