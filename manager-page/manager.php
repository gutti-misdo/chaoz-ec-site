<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品登録画面</title>
</head>
<body>
    <h1>商品登録画面</h1>
    <h2>商品情報の入力</h2>
    <form action="manager_out.php" method="post" enctype="multipart/form-data">
        商品名：
        <input type="text" name="product_name" required><br><br>
        説明：
        <textarea name="explanation" rows="6" cols="30" required></textarea><br><br>
        価格：
        <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>
        画像：
        <input type="file" name="file1" accept="image/*" required><br><br>
        <input type="submit" value="登録">
    </form>
</body>
</html>
