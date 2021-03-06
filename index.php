<?php
include 'includes/db.php';?>
<?php include "includes/header.php";?>   
<!-- Navigation -->

<?php include "includes/navigation.php";?>   

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
            $connectionPDO = getConnectionPDO();
            $per_page = 5;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }

            if ($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }

            $post_query_count = "SELECT * FROM posts";
            $count = $connectionPDO->query($post_query_count)->rowCount();

            $count = ceil($count / $per_page);

            $query = "select * from posts LIMIT $page_1,$per_page";
            $result = $connectionPDO->query($query);

            while ($row = $result->fetch()) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_content = substr($row['post_content'], 0, 100);
                $post_image = $row['post_image'];
                $post_status = $row['post_status'];
                if ($post_status == 'published') {
                    ?>
                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?=$post_id;?>"><?=$post_title;?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?=$post_user;?>&p_id=<?=$post_id;?>"><?=$post_user;?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post_date;?></p>
                    <hr>
                    <a href="post.php?p_id=<?=$post_id;?>">
                        <img class="img-responsive" src="images/<?=$post_image;?>" alt=""></a>
                    <hr>
                    <p><?=$post_content;?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?=$post_id;?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                    <?php
                }
                ?>

                <?php
            }
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php";?>

    </div>
    <!-- /.row -->
    <ul class="pager">
        <?php
        for ($i = 1; $i <= $count; $i++) {
            if($i == $page) {
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            } else {
                 echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
            
        }
        ?>
    </ul>
    <hr>
    <!-- Footer -->
    <?php include "includes/footer.php";?>
