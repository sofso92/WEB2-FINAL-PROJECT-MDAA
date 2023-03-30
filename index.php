<?php
include 'partials/header.php';

// fetch featured post from database
$featured_query = "SELECT * FROM posts WHERE is_featured=1";
$featured_result = $pdo->query($featured_query);
$featured = $featured_result->fetch();

// fetch 4 posts from posts table
$query = "SELECT * FROM posts ORDER BY date_time DESC LIMIT 4";
$posts = $pdo->query($query);
?>

<!-- show featured post if there's any -->
<section class="featured">
    <div class="container featured__container">
        <div class="post__thumbnail">
            <img src="./images/<?= $featured['thumbnail'] ?>">
        </div>
        <div class="post__info">
            <?php
            // fetch category from categories table using category_id of post
            $category_id = $featured['category_id'];
            $category_query = "SELECT * FROM categories WHERE id=:id";
            $category_statement = $pdo->prepare($category_query);
            $category_statement->bindParam(':id', $category_id);
            $category_statement->execute();
            $category = $category_statement->fetch();
            ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $featured['category_id'] ?>" class="category__button"><?= $category['title'] ?></a>
            <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><?= $featured['title'] ?></a></h2>
            <p class="post__body">
                <?= substr($featured['body'], 0, 300) ?>...
            </p>
            <div class="post__author">
                <?php
                // fetch author from users table using author_id
                $author_id = $featured['author_id'];
                $author_query = "SELECT * FROM users WHERE id=:id";
                $author_statement = $pdo->prepare($author_query);
                $author_statement->bindParam(':id', $author_id);
                $author_statement->execute();
                $author = $author_statement->fetch();

                ?>
                <div class="post__author-avatar">
                    <img src="./images/<?= $author['avatar'] ?>">
                </div>
                <div class="post__author-info">
                    <h5>By: <?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                    <small>
                        <?= date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====================== END OF FEATURED ====================-->
<!-- 
<section class="posts <?= $featured ? '' : 'section__extra-margin' ?>">
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
                    $category_stmt->execute(['category_id' => $category_id]);
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
                        $author_stmt->execute(['author_id' => $author_id]);
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
</section> -->
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

