<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    // get form data
    $username_email = filter_var($_POST['username_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) 
    {
        $_SESSION['signin'] = "Username or Email required";
    } 
    elseif (!$password) 
    {
        $_SESSION['signin'] = "Password Required";
    } 
    else 
    {
       // Fetch user from database
        $fetch_user_query = "SELECT * FROM users WHERE username=:username_email OR email=:username_email";
        $stmt = $pdo->prepare($fetch_user_query);
        $stmt->bindParam(':username_email', $username_email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) 
        {
            // Convert the record into an associative array
            $user_record = $stmt->fetch(PDO::FETCH_ASSOC);
            $db_password = $user_record['password'];
            // Compare form password with database password
            if (password_verify($password, $db_password)) 
            {
                // Set session for access control
                $_SESSION['user-id'] = $user_record['id'];
                // Set session if user is an admin
                if ($user_record['is_admin'] == 1) {
                    $_SESSION['user_is_admin'] = true;
                }
                // Log user in
                header('location: ' . ROOT_URL . 'admin/');
            } 
            else
            {
                $_SESSION['signin'] = "Please check your input";
            }
        } else {
            $_SESSION['signin'] = "User not found";
        }
    }

    // if any problem, redirect back to signin page with login data
    if (isset($_SESSION['signin'])) 
    {
        $_SESSION['signin-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signin.php');~
        die();
    }
}
else
{
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
