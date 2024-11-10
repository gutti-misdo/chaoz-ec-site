function savedata(event) {
    event.preventDefault(); // フォーム送信を防止
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const Zipcode = document.getElementById("Zipcode").value;
    const address = document.getElementById("address").value;
    const BNRN = document.getElementById("BNRN").value;

    // localStorageに保存
    localStorage.setItem("name", name);
    localStorage.setItem("email", email);
    localStorage.setItem("password", password);
    localStorage.setItem("Zipcode", Zipcode);
    localStorage.setItem("address", address);
    localStorage.setItem("BNRN", BNRN);

    // 確認ページにリダイレクト
    window.location.href = "ConfirmSignup.html";
}
