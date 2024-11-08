// script.js

// サムネイル画像を取得
const thumbnails = document.querySelectorAll('.thumbnail');

// メイン画像を取得
const mainImage = document.getElementById('main-image');

// 各サムネイルにマウスオーバーイベントを追加
thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('mouseover', () => {
        // メイン画像のsrcをサムネイルのsrcに変更
        mainImage.src = thumbnail.src;
    });
});
