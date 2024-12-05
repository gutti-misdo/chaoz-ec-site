<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/home-page.css">
    <link rel="stylesheet" href="./css/hamburger.css">
</head>
<body>
<div class="container">
    <div class="top-bar">
        <?php
        include 'hamburger.php';
        ?>
        <form action="home-page.php">
            <button class="site-title">チャオズ.com</button>
        </form>
        <form action="search-output.php" method="post">
            <input type="text" name="keyword" class="search-bar" placeholder="検索...">
            <button class="search-button">検索</button>
        </form>
        <?php
        if (isset($_SESSION['customer']['name'])) {
            echo '<form action="my-page.php" method="post">';
            echo '<button class="akaunt-btn" name="akaunt">👤</button>';
            echo '</form>';
        } else {
            echo '<form action="../login-page/login.php" method="post">';
            echo '<button class="login-btn">';
            echo 'ログイン';
            echo '</button>';
            echo '</form>';
        }
        ?>
        <form action="cart-page.php">
            <button class="cart-btn">🛒</button>
        </form>
    </div>
</div>
</body>
</html>

