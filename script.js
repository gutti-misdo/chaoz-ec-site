window.addEventListener('scroll', function () {
    const fixedImage = document.querySelector('fixed-image');
    const scrollPosition = window.scrollY;

    if (scrollPosition > 300) {
        fixedImage.computedStyleMap.opacity = '0.5';
    } else {
        fixedImage.style.opacity = '1';
    }
});

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

// カラーオプションのボタンを取得
const colorOptions = document.querySelectorAll('.color-option');

// カラーオプションのクリックイベントを追加
colorOptions.forEach(option => {
    option.addEventListener('click', () => {
        // 現在選択されているカラーオプションから.selectedクラスを削除
        document.querySelector('.color-option.selected')?.classList.remove('selected');

        // クリックしたオプションに.selectedクラスを追加
        option.classList.add('selected');

        // カラーに応じたメイン画像を設定（色ごとの画像URLを設定）
        const color = option.dataset.color;
        mainImage.src = `https://example.com/images/${color}-image.jpg`; // 画像URLは色ごとに適切に設定してください
    });
});
function handleLogin() {
    window.location.href = 'loginpc.html'; // login.htmlに遷移
}


document.addEventListener('DOMContentLoaded', () => {
    const stickyElement = document.getElementById('sticky-element');
    const stopper = document.querySelector('.stopper');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                stickyElement.classList.add('stopped'); // 止める
            } else {
                stickyElement.classList.remove('stopped'); // スクロール再開
            }
        });
    }, { threshold: 1.0 });

    observer.observe(stopper);
});
