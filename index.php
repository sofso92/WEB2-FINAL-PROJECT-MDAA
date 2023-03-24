<?php
    include 'partials/header.php';
?>
<!--*******************************************FEATURED*******************************************************-->
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

    <?php
        include 'partials/footer.php';
    ?>
</body>
</html>