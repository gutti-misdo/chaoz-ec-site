<input type="checkbox" id="kaden-toggle">
<label for="kaden-toggle" class="kaden_btn">
    <span></span>
    <span></span>
    <span></span>
</label>
<nav class="kaden">
    <div class="kaden_inner">
        <?php
        include '../db-connect.php';

        echo '<ul class="kaden_menu">';
        foreach ($pdo->query('SELECT * FROM category') as $category) {
            echo '<li class="kaden_item">';
            echo '<a class="kaden_link" href="category-out.php?category_id=' . $category['category_id'] . '">';
            echo htmlspecialchars($category['category_name'], ENT_QUOTES, 'UTF-8');
            echo '</a>';
            echo '</li>';
        }
        echo '</ul>';
        ?>
    </div>
</nav>