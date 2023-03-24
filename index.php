<?php
    include 'partials/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MDAA Blog Website</title>
    <!--CUSTOM STYLESHEET-->
    <link rel="stylesheet" href="./css/style.css">
    <!--ICON SCOUT CDN-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- GOOGLE FONT (MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <!--**************************NAVIGATION BAR************************************************************-->
    <nav>
        <div class="container nav__container">
            <a href="index.php" class="nav__logo">MDAA</a>
            <ul class="nav__items">
                <li><a href="blog.php">Blog</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="signin.php">Sign in</a></li>
                <li class="nav__profile">
                    <div class="avatar">
                        <img src="./images/avatar1.png">
                    </div>
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>

    <!--*****************************END OF NAVIGATION BAR**************************************************-->

    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/tray.jpg">
            </div>
            <div class="post__info">
                <a href="category-posts.php" class="category__button">Announcements</a>
                <h2 class="post__title"><a href="post.php">Welcome RDAs!</a></h2>
                <p class="post__body">
                    A space from assistants for assistants!
                </p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar1.png">
                    </div>
                    <div class="post__author-info">
                        <h5>By: Jane Doe</h5>
                        <small>June 10, 2022 - 07:23</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--*******************************************END OF FEATURED*******************************************************-->
    <section class="posts">
        <div class="container posts__container">
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog21.png">
                </div>
                <div class="post__info">
                    <a href="category-posts.html" class="category__button">Announcements</a>
                    <h3 class="post__title">
                        <a href="post.php">CE Lecture - Pediatric Oral Health</a>
                    </h3>
                    <p class="post__body">
                        You are invited to attend a continued education lecture happening on Zoom 
                        1 hour, equivalent to 3 CE Points
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar1.png">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Lily Downs</h5>
                            <small>Jan 13, 2023 - 10:34</small>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
</body>
</html>