<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン完了</title>
    <link rel="stylesheet" href="./css/login-output.css">
</head>

<body>
    <div class="container">
        <h1>ようこそ！</h1>
        <?php
        try {
            include '../db-connect.php';
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $pdo->prepare('select * from customer where email=?');
            $sql->execute([$_POST['email']]);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if (password_verify($_POST['pass'], $result['password'])) {
                $_SESSION['customer'] = [
                    'id' => $result['customer_id'],
                    'name' => $result['custormer_name'],
                    'address' => $result['address'],
                    'email' => $result['email'],
                    'buliding_name' => $result['buliding_name'],
                    'room_number' => $result['room_number'],
                    'post_code' => $result['post_code']
                ];
                echo ' <div class="input-field">', 'いらっしゃいませ、', $_SESSION['customer']['name'], 'さん。', '</div>';
            } else {
                echo "ログイン認証に失敗しました。";
                echo 'EmailかPasswordが違います';
            }
        } catch (PDOException $e) {
            echo '接続失敗: ' . $e->getMessage();
        }
        $pdo = null;
        ?>
        <form action="../home-page/home-page.php" method="post">
            <button class="home-button">ホーム画面へ</button>
        </form>
    </div>

</body>

</html>