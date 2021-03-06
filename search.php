<?php include 'includes/db.php';?>
<?php include "includes/header.php";?>   
<!-- Navigation -->

<?php include "includes/navigation.php";?>   

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Searching for: <?= $_POST['search']; ?>
            </h1>

            <?php
            $connectionPDO = getConnectionPDO();
            if (isset($_POST['submit'])) {
                $query = "select * from posts where post_tags like ".$connectionPDO->quote("%".$_POST['search']."%");
                if (!$query) {
                    die("QUERY FAILED ".$query->errorCode());
                }

                $result = $connectionPDO->query($query);
                if ($result->rowCount() == 0) {
                    echo "<h2>No results found </h2>";
                } else {
                    while ($row = $result->fetch()) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        ?>
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?= $post_title;?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?= $post_user;?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post_date;?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?= $post_image;?>" alt="">
                        <hr>
                        <p><?= $post_content;?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                        <?php
                    }
                }
            }
            ?>
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php";?>

    </div>
    <!-- /.row -->

    <hr>
    <!-- Footer -->
    <?php include "includes/footer.php";?>
