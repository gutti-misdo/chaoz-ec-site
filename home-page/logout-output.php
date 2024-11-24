<?php
session_start();
?>
<?php
unset($_SESSION['customer']);
echo 'ログアウトしました。';
?>
<form action="home-page.php">
    <button type="submit">ホーム画面へ</button>
</form>