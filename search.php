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
<html>  
    <h1>
    <?=$echo?>
    <h1>
</html>