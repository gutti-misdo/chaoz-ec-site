<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カート画面</title>
</head>

<body>
    <h1>カートの内容</h1>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p style="color: green;">' . htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8') . '</p>';
        unset($_SESSION['message']); // メッセージを一度表示したら削除
    }
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlspecialchars($_SESSION['error'], ENT_QUOTES, 'UTF-8') . '</p>';
        unset($_SESSION['error']); // エラーを一度表示したら削除
    }

    try {
        include '../db-connect.php';

        $customer_id = $_SESSION['customer']['id'] ?? null;
        $guest_id = $_SESSION['guest_id'] ?? null;
        
        // ゲスト情報の確認と作成
        if (!$customer_id && !$guest_id) {
            $stmt = $pdo->prepare('INSERT INTO guest (session_id, session_create_time, session_update_time) VALUES (?, NOW(), NOW())');
            $stmt->execute([session_id()]);
            $guest_id = $pdo->lastInsertId();
            $_SESSION['guest_id'] = $guest_id;
        }

        $cart_id = null;

        if ($customer_id) {
            $stmt = $pdo->prepare('SELECT cart_id FROM shoppingcart WHERE customer_id = ?');
            $stmt->execute([$customer_id]);
            $cart_id = $stmt->fetchColumn();
        } elseif ($guest_id) {
            $stmt = $pdo->prepare('SELECT cart_id FROM shoppingcart WHERE guest_id = ?');
            $stmt->execute([$guest_id]);
            $cart_id = $stmt->fetchColumn();
        }

        // カートが見つからない場合、新しいカートを作成
        if (!$cart_id) {
            $stmt = $pdo->prepare('INSERT INTO shoppingcart (customer_id, guest_id) VALUES (?, ?)');
            $stmt->execute([$customer_id, $guest_id]);
            $cart_id = $pdo->lastInsertId();
        }

        // カートの内容を取得
        $stmt = $pdo->prepare('
            SELECT 
                ci.cart_item_id,
                p.product_name,
                p.photograph,
                p.price,
                ci.quantity
            FROM cartitem ci
            JOIN product p ON ci.product_id = p.product_id
            WHERE ci.cart_id = ?
        ');
        $stmt->execute([$cart_id]);
        $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($cart_items)) {
            echo '<p>カートに商品がありません。</p>';
            echo '<p><a href="home-page.php">ホームに戻る</a></p>';
        } else {
            echo '<table border="1">';
            echo '<tr>';
            echo '<th>商品画像</th>';
            echo '<th>商品名</th>';
            echo '<th>価格</th>';
            echo '<th>数量</th>';
            echo '<th>小計</th>';
            echo '<th>削除</th>';
            echo '</tr>';

            $total = 0;
            foreach ($cart_items as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;

                echo '<tr>';
                echo '<td><img src="' . htmlspecialchars($item['photograph'], ENT_QUOTES, 'UTF-8') . '" alt="商品画像" width="100"></td>';
                echo '<td>' . htmlspecialchars($item['product_name'], ENT_QUOTES, 'UTF-8') . '</td>';
                echo '<td>¥' . number_format($item['price']) . '</td>';
                echo '<td>' . htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8') . '</td>';
                echo '<td>¥' . number_format($subtotal) . '</td>';
                echo '<td>
                        <form action="remove-item.php" method="post">
                            <input type="hidden" name="cart_item_id" value="' . $item['cart_item_id'] . '">
                            <input type="number" name="remove_quantity" value="1" min="1" max="' . $item['quantity'] . '">
                            <button type="submit">削除</button>
                        </form>
                    </td>';
                echo '</tr>';
            }

            echo '<tr>';
            echo '<td colspan="4">合計</td>';
            echo '<td colspan="2">¥' . number_format($total) . '</td>';
            echo '</tr>';
            echo '</table>';

            echo '<form action="checkout.php" method="post">';
            echo '<button type="submit">購入手続きへ進む</button>';
            echo '<p><a href="home-page.php">ホームに戻る</a></p>';
            echo '</form>';
        }
    } catch (Exception $e) {
        echo '<p>エラーが発生しました: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
    }
    ?>
</body>

</html>