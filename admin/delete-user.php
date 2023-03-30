<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // fetch user from database
    $query = "SELECT * FROM users WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch();

    // make sure we got back only one user
    if ($stmt->rowCount() == 1) {
        $avatar_name = $user['avatar'];
        $avatar_path = '../images/' . $avatar_name;
        // delete image if available
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }

    // FOR LATER
    // fetch all thumbnails of user's posts and delete them
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=:id";
    $thumbnails_stmt = $pdo->prepare($thumbnails_query);
    $thumbnails_stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $thumbnails_stmt->execute();
    if ($thumbnails_stmt->rowCount() > 0) {
        while ($thumbnail = $thumbnails_stmt->fetch()) {
            $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
            // delete thumbnail from images folder is exist
            if ($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }
    }

    // delete user from database
    $delete_user_query = "DELETE FROM users WHERE id=:id";
    $delete_user_stmt = $pdo->prepare($delete_user_query);
    $delete_user_stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $delete_user_stmt->execute();
    if ($delete_user_stmt->errorCode() !== '00000') {
        $_SESSION['delete-user'] = "Couldn't delete '{$user['firstname']} '{$user['lastname']}'";
    } else {
        $_SESSION['delete-user-success'] = "{$user['firstname']} {$user['lastname']} deleted successfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();

?>