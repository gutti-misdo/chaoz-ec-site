<link rel="stylesheet" href="./css/my-page-finish.css">
<?php
session_start();
if (!isset($_SESSION['customer'])) {/*ログインしていないユーザーが住所変更ページにアクセスしようとした場合、自動的にログインページに移動し*/
    header("login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_address = $_POST['new_address'];
    $new_building_name = $_POST['new_building_name'];
    $new_room_number = $_POST['new_room_number'];
    $new_post_code = $_POST['new_post_code'];
    $customer_id = $_SESSION['customer']['id'];

    try {
        include '../db-connect.php';
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE customer SET address=?, buliding_name=?, room_number=?, post_code=? WHERE customer_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$new_address, $new_building_name, $new_room_number, $new_post_code, $customer_id]);

        $result_message = "住所が更新されました";
    } catch (PDOException $e) {
        echo '接続失敗: ' . $e->getMessage();
    }
    $pdo = null;
}
?>

<body>
    <div class="container">
        <div id="result">
            <?php if ($result_message) {
                echo "<h1>$result_message</h1>";
                echo "<p><span class='label'>新しい住所:</span> $new_address</p>";
                echo "<p><span class='label'>新しい建物名:</span> $new_building_name</p>";
                echo "<p><span class='label'>新しい部屋番号:</span> $new_room_number</p>";
                echo "<p><span class='label'>新しい郵便番号:</span> $new_post_code</p>";
            } ?>
            <form action="home-page.php">
                <button class="home-button">ホーム画面へ</button>
            </form>
        </div>

    </div>
</body>