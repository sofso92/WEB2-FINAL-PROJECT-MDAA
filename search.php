<?php
require 'partials/header.php';

if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search = filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query = "SELECT * FROM posts WHERE title LIKE :search ORDER BY date_time DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $stmt->execute();

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>

<?php if (!empty($posts)) : ?>
    <section class="posts section__extra-margin">
        <div class="container posts__container">
            <?php foreach ($posts as $post) : ?>
                <article class="post">
                    <div class="post__thumbnail">
                        <img src="./images/<?= $post['thumbnail'] ?>">
                    </div>
                    <div class="post__info">
                        <?php
                        // fetch category from categories table using category_id of post
                        $category_id = $post['category_id'];
                        $category_query = "SELECT * FROM categories WHERE id=:category_id";
                        $category_stmt = $pdo->prepare($category_query);
                        $category_stmt->execute(array(':category_id' => $category_id));
                        $category = $category_stmt->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
                        <h3 class="post__title">
                            <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                        </h3>
                        <p class="post__body">
                            <?= substr($post['body'], 0, 150) ?>...
                        </p>
                        <div class="post__author">
                            <?php
                            // fetch author from users table using author_id
                            $author_id = $post['author_id'];
                            $author_query = "SELECT * FROM users WHERE id=:author_id";
                            $author_stmt = $pdo->prepare($author_query);
                            $author_stmt->execute(array(':author_id' => $author_id));
                            $author = $author_stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="post__author-avatar">
                                <img src="./images/<?= $author['avatar'] ?>">
                            </div>
                            <div class="post__author-info">
                                <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                                <small>
                                    <?= date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                                </small>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach ?>
        </div>
    </section>
<?php else : ?>
    <div class="alert__message error lg section__extra-margin">
        <p>No posts found for this search</p>
    </div>
<?php endif ?>


<section class="category__buttons">
    <div class="container category__buttons-container">
        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories_stmt = $pdo->query($all_categories_query);
        while ($category = $all_categories_stmt->fetch(PDO::FETCH_ASSOC)) :
            ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>

<?php include 'partials/footer.php' ?>


