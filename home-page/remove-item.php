<?php
session_start();

try {
    // データベース接続
    $pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;dbname=LAA1553900-chaoz;charset=utf8', 'LAA1553900', 'Pass1105');

    // POSTデータから削除対象のカートアイテムIDと削除する数量を取得
    $cart_item_id = isset($_POST['cart_item_id']) ? (int)$_POST['cart_item_id'] : 0;
    $remove_quantity = isset($_POST['remove_quantity']) ? (int)$_POST['remove_quantity'] : 0;

    if ($cart_item_id <= 0 || $remove_quantity <= 0) {
        throw new Exception('不正なリクエストです。');
    }

    // 現在の数量を取得
    $stmt = $pdo->prepare('SELECT quantity FROM cartitem WHERE cart_item_id = ?');
    $stmt->execute([$cart_item_id]);
    $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cart_item) {
        throw new Exception('指定された商品が見つかりません。');
    }

    $current_quantity = $cart_item['quantity'];

    if ($remove_quantity >= $current_quantity) {
        // 削除数量が現在の数量以上なら、アイテムを完全に削除
        $stmt = $pdo->prepare('DELETE FROM cartitem WHERE cart_item_id = ?');
        $stmt->execute([$cart_item_id]);
        $_SESSION['message'] = '商品をカートから削除しました。';
    } else {
        // 削除数量が現在の数量より少ない場合は、数量を減らす
        $new_quantity = $current_quantity - $remove_quantity;
        $stmt = $pdo->prepare('UPDATE cartitem SET quantity = ? WHERE cart_item_id = ?');
        $stmt->execute([$new_quantity, $cart_item_id]);
        $_SESSION['message'] = 'カート内の数量を更新しました。';
    }

    // カートページにリダイレクト
    header('Location: cart-page.php');
    exit;

} catch (Exception $e) {
    // エラー発生時の処理
    $_SESSION['error'] = 'エラーが発生しました: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    header('Location: cart-page.php');
    exit;
}
