<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // FOR LATER
    // udpate category_id of posts that belong to this category to id of uncategorized category
    $update_query = "UPDATE posts SET category_id=:uncategorized_id WHERE category_id=:id";
    $stmt = $pdo->prepare($update_query);
    $stmt->bindValue(':uncategorized_id', 5, PDO::PARAM_INT);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // delete category
    $query = "DELETE FROM categories WHERE id=:id LIMIT 1";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $_SESSION['delete-category-success'] = "Category deleted successfully";
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
