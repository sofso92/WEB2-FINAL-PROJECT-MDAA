<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch post from database in order to delete thumbnail from images folder
    $query = "SELECT * FROM posts WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $post = $stmt->fetch();

    // make sure only 1 record/post was fetched
    if ($post) {
        $thumbnail_name = $post['thumbnail'];
        $thumbnail_path = '../images/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);

            // delete post from database
            $delete_post_query = "DELETE FROM posts WHERE id=:id LIMIT 1";
            $stmt = $pdo->prepare($delete_post_query);
            $stmt->execute(['id' => $id]);

            if (!$stmt->errorCode()) {
                $_SESSION['delete-post-success'] = "Post deleted successfully";
            }
        }
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();
