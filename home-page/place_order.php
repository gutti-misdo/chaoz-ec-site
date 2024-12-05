<?php
session_start();

include 'home-head.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: checkout.php');
    exit;
}

include '../db-connect.php';
$customer_id = $_SESSION['customer']['id'] ?? null;
$guest = isset($_SESSION['guest_id']) && !$customer_id;

try {
    $pdo->beginTransaction();

    // ゲスト情報を保存
    if ($guest) {
        $guest_info = [
            'guest_name' => $_POST['guest_name'],
            'email' => $_POST['email'],
            'building_name' => $_POST['building_name'],
            'room_number' => $_POST['room_number'],
            'post_code' => $_POST['post_code'],
            'address' => $_POST['address']
        ];

        $stmt = $pdo->prepare('
            INSERT INTO guest (guest_name, email, building_name, room_number, post_code, address, session_create_time, session_update_time)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
        ');
        $stmt->execute(array_values($guest_info));
        $guest_id = $pdo->lastInsertId();
    }

    // カートID取得
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

    // カート内容取得
    $stmt = $pdo->prepare('
        SELECT product_id, quantity, price
        FROM cartitem
        JOIN product USING(product_id)
        WHERE cart_id = ?
    ');
    $stmt->execute([$cart_id]);
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 注文情報保存
    $total_amount = 0;
    foreach ($cart_items as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }
    $stmt = $pdo->prepare('
        INSERT INTO orders (customer_id, guest_id, order_date, total_amount)
        VALUES (?, ?, NOW(), ?)
    ');
    $stmt->execute([$customer_id, $guest_id ?? null, $total_amount]);
    $order_id = $pdo->lastInsertId();

    // 注文詳細保存
    $stmt = $pdo->prepare('INSERT INTO orderdetail (order_id, product_id, quantity, unit_price) VALUES (?, ?, ?, ?)');
    foreach ($cart_items as $item) {
        $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
    }

    // カートクリア
    $stmt = $pdo->prepare('DELETE FROM cartitem WHERE cart_id = ?');
    $stmt->execute([$cart_id]);

    $pdo->commit();

    echo '<p>購入が完了しました！</p>';
    echo '<p><a href="home-page.php">ホームに戻る</a></p>';
} catch (Exception $e) {
    $pdo->rollBack();
    echo '<p>エラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</p>';
}
?>
