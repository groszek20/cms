<?php include 'includes/db.php';?>
<?php include "includes/header.php";?>   
<!-- Navigation -->

<?php include "includes/navigation.php";?>   
<?php if(isset($_POST['liked'])){
    echo "<h1>IT WORKS</h1>";
}
    
    ?>
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
                $view_query = "UPDATE posts SET post_view_counts = post_view_counts + 1 WHERE post_id = $the_post_id";
                $send_query = mysqli_query($connection, $view_query);

                $query = "select * from posts WHERE post_id = ".$the_post_id;
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
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
                        <a href="post.php?p_id=<?php echo $post_id;?>"><?php echo $post_title;?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_user;?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date;?></p>
                    <hr>
                    <img class="img-responsive" src="/cms/images/<?php echo $post_image;?>" alt="">
                    <hr>
                    <p><?php echo $post_content;?></p>

                    <hr>
                    <div class="row">

                        <p class="pull-right"><a class="like" href="#"><span class="glyphicon glyphicon-thumbs-up"> Like</span></a></p>

                    </div>

                    <div class="row">

                        <p class="pull-right">Like: 10</p>

                    </div>
                    <div class="clearfix">

                    </div>
                    <?php
                }
            } else {
                header("Location: index.php");
            };
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
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" name="comment_author" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" name="comment_email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="Comment">Your Comment</label>
                        <textarea class="form-control" name="comment" rows="3"></textarea>
                    </div>

                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->
            <?php
            $query = "SELECT * FROM `comments` WHERE comment_post_id = {$the_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";

            $select_comment_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_array($select_comment_query)) {
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];
                $comment_author = $row['comment_author'];
                ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;?>
                            <small><?php echo $comment_date;?></small>
                        </h4>
                        <?php echo $comment_content;?>
                    </div>
                </div>
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


    <script>
        $(document).ready(function(){
            $('.like').click(function(){
                var post_id = <?php echo $the_post_id; ?>;
                var user_id = 1;
                $.ajax({
                    url: "/cms/post.php?p_id=<?php echo $the_post_id; ?>"
                    type: 'post'
                    data {
                        liked: 1,
                        'post_id': post_id,
                        'user_id': user_id
                    }
                })
            });
        });
    </script>
