document.getElementById("email").addEventListener("blur", function() {
    const email = this.value;
    const feedback = document.createElement("div");
    feedback.id = "email-feedback";
    const existingFeedback = document.getElementById("email-feedback");

    // 過去のエラーメッセージを削除
    if (existingFeedback) {
        existingFeedback.remove();
    }

    if (email) {
        fetch("check_email.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ email })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                feedback.textContent = data.message;
                feedback.style.color = "red";
                document.getElementById("email").after(feedback);
            } else {
                feedback.textContent = "使用可能なメールアドレスです。";
                feedback.style.color = "green";
                document.getElementById("email").after(feedback);
            }
        })
        .catch(error => console.error("エラー:", error));
    }
});
