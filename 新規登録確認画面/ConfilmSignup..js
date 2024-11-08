window.onload = function() {
    // localStorageからデータを取得
    const name = localStorage.getItem("name");
    const email = localStorage.getItem("email");
    const password = localStorage.getItem("password");
    const Zipcode = localStorage.getItem("Zipcode");
    const address = localStorage.getItem("address");
    const BNRN = localStorage.getItem("BNRN");
    // 各要素に値を表示
    document.getElementById("name").textContent = name || "未入力";
    document.getElementById("email").textContent = email || "未入力";
    document.getElementById("password").textContent = "********"; // パスワードは隠す
    document.getElementById("Zipcode").textContent = Zipcode || "未入力";
    document.getElementById("address").textContent = address || "未入力";
    document.getElementById("BNRN").textContent = BNRN || "未入力";
};
function redirectToFinish() {
    // 登録完了画面に遷移する場合
    window.location.href = 'finishSignup.html';
};
