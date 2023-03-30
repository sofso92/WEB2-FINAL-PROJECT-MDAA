<?php
include 'partials/header.php';

// fetch posts if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    
    // fetch posts from database
    $query = "SELECT * FROM posts WHERE category_id=:category_id ORDER BY date_time DESC";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':category_id', $id);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header('location: ' . ROOT_URL . 'blog.php');
    die();
}
?>

<header class="category__title">
    <h2>
        <?php
        // fetch category from categories table using category_id of post
        $category_id = $id;
        $category_query = "SELECT * FROM categories WHERE id=:category_id";
        $stmt = $pdo->prepare($category_query);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $category['title']
        ?>
    </h2>
</header>
<!--====================== END OF CATEGORY TITLE ====================-->


<?php if (count($posts) > 0) : ?>
    <section class="posts">
        <div class="container posts__container">
            <?php foreach ($posts as $post) : ?>
                <article class="post">
                    <div class="post__thumbnail">
                        <img src="./images/<?= $post['thumbnail'] ?>">
                    </div>
                    <div class="post__info">
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
                            $author_query = "SELECT * FROM users WHERE id=:id";
                            $stmt = $pdo->prepare($author_query);
                            $stmt->execute(['id' => $author_id]);
                            $author = $stmt->fetch(PDO::FETCH_ASSOC);
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
            <?php endforeach; ?>
        </div>
    </section>
<?php else : ?>
    <div class="alert__message error lg">
        <p>No posts found for this category</p>
    </div>
<?php endif; ?>
<!--====================== END OF POSTS ====================-->

<section class="category__buttons">
    <div class="container category__buttons-container">
        <?php
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = $pdo->query($all_categories_query);
        ?>
        <?php while ($category = $all_categories->fetch(PDO::FETCH_ASSOC)) : ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button"><?= $category['title'] ?></a>
        <?php endwhile ?>
    </div>
</section>
<!--====================== END OF CATEGORY BUTTONS ====================-->
<?php
include 'partials/footer.php';
?>