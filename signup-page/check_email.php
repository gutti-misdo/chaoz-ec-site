<?php
// データベース接続情報

header("Content-Type: application/json");

try {
    include '../db-connect.php';
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // リクエストボディを取得
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data['email'];

    // メールアドレスの存在チェック
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM customer WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo json_encode([
            "success" => false,
            "message" => "このメールアドレスは既に登録されています。"
        ]);
    } else {
        echo json_encode([
            "success" => true,
            "message" => "このメールアドレスは使用可能です。"
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        "success" => false,
        "message" => "エラーが発生しました: " . $e->getMessage()
    ]);
}
