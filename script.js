// script.js
function toggleMenu() {
    const menuOverlay = document.getElementById("menuOverlay");
    if (menuOverlay.style.display === "block") {
        menuOverlay.style.display = "none";
    } else {
        menuOverlay.style.display = "block";
    }
}


document.addEventListener('DOMContentLoaded', () => {
    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach((card) => {
        const stars = card.querySelectorAll('#star-rating span');
        const reviewsList = card.querySelector('#reviews-list');
        const submitButton = card.querySelector('#submit-review');
        const averageStars = card.querySelector('#average-stars');
        const averageScore = card.querySelector('.score');
        const ratingSelect = card.querySelector('.rating-select');

        let totalRating = 0;
        let reviewCount = 0;
        const ratingCounts = [0, 0, 0, 0, 0]; // 5つ星〜1つ星のカウント
        let selectedRating = 0;

        // 星のクリックイベントを設定
        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                selectedRating = index + 1;

                // 星の状態を更新
                stars.forEach((s, i) => {
                    s.style.color = i < selectedRating ? 'gold' : 'gray';
                });
            });
        });

        // レビュー投稿ボタンのイベントを設定
        submitButton.addEventListener('click', () => {
            if (selectedRating === 0) {
                alert('星評価を選択してください！');
                return;
            }

            // レビューをリストに追加
            const reviewDiv = document.createElement('div');
            reviewDiv.classList.add('review');
            reviewDiv.innerHTML = `
                <div class="stars">${'⭐'.repeat(selectedRating)}</div>
                <p>レビューを投稿しました (${new Date().toLocaleDateString()})</p>
            `;
            reviewsList.appendChild(reviewDiv);

            // 星評価データを更新
            totalRating += selectedRating;
            reviewCount++;
            ratingCounts[selectedRating - 1]++;

            // 平均評価を計算
            const average = (totalRating / reviewCount).toFixed(1);
            averageScore.textContent = `(${average}/5)`;
            averageStars.textContent = '⭐'.repeat(Math.round(average)) + '☆'.repeat(5 - Math.round(average));

            // リストボックスを更新
            updateRatingSelect(ratingCounts, reviewCount, ratingSelect);

            // 星選択をリセット
            selectedRating = 0;
            stars.forEach((s) => (s.style.color = 'gray'));
        });

        // リストボックスを更新する関数
        function updateRatingSelect(counts, total, selectElement) {
            const percentages = counts.map((count) => ((count / total) * 100).toFixed(1));
            selectElement.innerHTML = `
                <option value="5">5つ星: ${percentages[4]}%</option>
                <option value="4">4つ星: ${percentages[3]}%</option>
                <option value="3">3つ星: ${percentages[2]}%</option>
                <option value="2">2つ星: ${percentages[1]}%</option>
                <option value="1">1つ星: ${percentages[0]}%</option>
            `;
        }
    });
});
