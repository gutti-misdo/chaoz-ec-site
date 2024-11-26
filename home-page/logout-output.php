<?php
session_start();
?>
<link rel="stylesheet" href="./css/logout-output.css">
<body>
<div class="container">
<?php
unset($_SESSION['customer']);
echo '<div class="input-field">';
echo  '<h2>ログアウトしました。<h2>';
echo '</div>';
?>
<form action="home-page.php">
    <button class="home-button" type="submit">ホーム画面へ</button>
</form>
</div>
</body>