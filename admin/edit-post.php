<?php
include 'partials/header.php';

// fetch categories from database
$category_query = "SELECT * FROM categories";
$stmt = $pdo->query($category_query);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// fetch post data from database if id is set
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail'] ?>">
            <input type="text" name="title" value="<?= $post['title'] ?>" placeholder="Title">
            <select name="category">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category['id'] ?>" <?= ($category['id'] == $post['category_id']) ? 'selected' : '' ?>><?= $category['title'] ?></option>
                <?php endforeach ?>
            </select>
            <textarea rows="10" name="body" placeholder="Body"><?= $post['body'] ?></textarea>
            <div class="form__control inline">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" <?= ($post['is_featured'] == 1) ? 'checked' : '' ?>>
                <label for="is_featured">Featured</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Change Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Update Post</button>
        </form>
    </div>
</section>

<?php
include '../partials/footer.php';
?>
