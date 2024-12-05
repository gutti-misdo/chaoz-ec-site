<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録完了画面</title>
    <link rel="stylesheet" href="./css/signup-finish-page.css">
</head>

<body>
    <?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $yubin = $_POST['yubin'];
    $address = $_POST['address'];
    $BN = $_POST['BN'];
    $RN = $_POST['RN'];
    try {
        include '../db-connect.php';
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $pdo->prepare('INSERT INTO customer(custormer_name, address, email, password, buliding_name, room_number, post_code)VALUES(?,?,?,?,?,?,?)');
        $sql->execute([$name, $address, $email, password_hash($password, PASSWORD_DEFAULT), $BN, $RN, $yubin]);
    } catch (PDOException $e) {
        echo '接続失敗: ' . $e->getMessage();
    }
    $pdo = null;
    ?>
    <div class="container">
        <h1>登録が完了しました</h1>
        <div class="input-field">ログイン画面からログインを行ってください</div>
        <form action="./../login-page/login.php">
            <button class="login-button" type="submit">ログイン画面へ</button>
        </form>
    </div>
</body>

</html>