<?php
$product_name = $_POST['product_name'];
$explanation = $_POST['explanation'];
$price = $_POST['price'];
$image = $_FILES['file1'];


$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$photograph = $target_dir . basename($image["name"]);
    if (move_uploaded_file($image["tmp_name"], $photograph)) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=vu;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = $pdo->prepare('INSERT INTO product (product_name, explanation, price, photograph) VALUES (?, ?, ?, ?)');
            $sql->execute([$product_name, $explanation, $price, $photograph]);

            echo 'データが正常に挿入されました。';
        } catch (PDOException $e) {
            echo 'エラーが発生しました: ' . $e->getMessage();
        } finally {
            $pdo = null;
        }
    } else {
        echo '画像のアップロードに失敗しました。';
    }
?>
