   // ラジオボタンで選択された支払い方法に応じて、クレジットカード情報を表示する
   document.getElementById('bank-transfer').addEventListener('change', function () {
    if (this.checked) {
        document.querySelector('.credit-card-info').style.display = 'block';
    }
});

document.getElementById('credit-card').addEventListener('change', function () {
    if (this.checked) {
        document.querySelector('.credit-card-info').style.display = 'none';
    }
});
function handleLogin() {
    window.location.href = 'loginpc.html';
}