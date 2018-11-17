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
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php
            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];
            }
            $query = "select * from posts WHERE post_author = '{$the_post_author}'";
            $result = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_content = $row['post_content'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                ?>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                </h2>
                <p class="lead">
                    All posts by <?php echo $post_author;?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content;?></p>

                <hr>
                <?php
            }
            ?>
            <!-- Blog Comments -->

            <?php
            if (isset($_POST['create_comment'])) {

                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment'];

                if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                    $query_comment = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)"
                    ."VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                    $create_comment_query = mysqli_query($connection, $query_comment);
                    if (!$create_comment_query) {
                        die('QUERY FAILED'.mysqli_error($connection));
                    }
                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";
                    $update_query_count = mysqli_query($connection, $query);
                } else {
                    echo "<script>alert('Fields cannot be empty')</script>";
                }
            }
            ?>
         

            <!-- Posted Comments -->
<?php
$query = "SELECT * FROM `comments` WHERE comment_post_id = {$the_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";

$select_comment_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($select_comment_query)) {
    $comment_date = $row['comment_date'];
    $comment_content = $row['comment_content'];
    $comment_author = $row['comment_author'];
    ?>
    <?php
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
