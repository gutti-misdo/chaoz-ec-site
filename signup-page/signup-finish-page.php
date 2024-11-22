<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録完了画面</title>
</head>
<body>
    <h3>登録が完了しました</h3>
    ログイン画面からログインを行ってください
    <?php
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $yubin = $_POST['yubin'];
    $address = $_POST['address'];
    $BN = $_POST['BN'];
    $RN = $_POST['RN'];
    try {
        $pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;dbname=LAA1553900-chaoz;charset=utf8', 'LAA1553900', 'Pass1105');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql=$pdo->prepare('INSERT INTO customer(custormer_name, address, email, password, buliding_name, room_number, post_code)VALUES(?,?,?,?,?,?,?)');
        $sql->execute([$name,$address,$email,password_hash($password, PASSWORD_DEFAULT),$BN,$RN,$yubin]);
    } catch (PDOException $e) {
        echo '接続失敗: ' . $e->getMessage();
    }
        $pdo = null;
    ?>
    <form action="./../login-page/login.php">
        <button type="submit">ログイン画面へ</button>
    </form>
</body>
</html>