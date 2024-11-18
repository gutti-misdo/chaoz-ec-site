<!-- <?php
        session_start();
        ?> -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン完了</title>
</head>

<body>
    <h1>ログインテスト</h1>
    <?php
    try {
        $pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;dbname=LAA1553900-chaoz;charset=utf8', 'LAA1553900', 'Pass1105');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $pdo->prepare('select * from customer where email=?');
        $sql->execute([$_POST['email']]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        print_r($result['password']);
        print($_POST['pass']);
        if (password_verify($_POST['pass'], $result['password'])) {
            echo "ログイン認証に成功しました。";
            // $_SESSION['email'] = $row['email'];
            // $_SESSION['name'] = $row['customer_name'];
        } else {
            echo "ログイン認証に失敗しました。";
            echo 'EmailかPasswordが違います';
        }
    } catch (PDOException $e) {
        echo '接続失敗: ' . $e->getMessage();
    }
    $pdo = null;
    ?>
</body>

</html>