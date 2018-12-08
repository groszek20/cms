<?php include 'includes/admin_header.php';?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php';?>

    <div id="page-wrapper">

        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Comments
                        <small><?php echo $_SESSION['username']?>;</small>
                    </h1>
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Post Title</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>UnApprove</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                global $connection;
                                $query = "SELECT * FROM `comments` WHERE comment_post_id = ".mysqli_real_escape_string($connection, $_GET['id']);
                                $select_comments = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($select_comments)) {
                                    $comment_id = $row['comment_id'];
                                    $comment_post_id = $row['comment_post_id'];
                                    $comment_author = $row['comment_author'];
                                    $comment_email = $row['comment_email'];
                                    $comment_content = $row['comment_content'];
                                    $comment_status = $row['comment_status'];
                                    $comment_date = $row['comment_date'];
                                    echo "<tr>";
                                    echo "<td>$comment_id</td>";
                                    echo "<td>$comment_author</td>";
                                    echo "<td>$comment_content</td>";
                                    $query_title = "SELECT * FROM `posts` WHERE `post_id` = $comment_post_id  ";
                                    $select_categories = mysqli_query($connection, $query_title);
                                    while ($row = mysqli_fetch_assoc($select_categories)) {
                                        $post_id = $row['post_id'];
                                        $post_title = $row['post_title'];
                                        echo "<td><a href='../post.php?p_id=$post_id'>$post_title</td>";
                                    }
                                    echo "<td>$comment_email</td>";
                                    echo "<td>$comment_status</td>";
                                    echo "<td>$comment_date</td>";
                                    echo "<td><a href='post_comments.php?approve={$comment_id}&id={$comment_post_id}'>Approve</a></td>";
                                    echo "<td><a href='post_comments.php?unapprove={$comment_id}&id={$comment_post_id}'>Unapprove</a></td>";
                                    echo "<td><a href='post_comments.php?delete={$comment_id}&id={$_GET['id']}'>Delete</a></td>";
                                    echo "<td><a href='post_comments.php?source=edit_post&p_id={$comment_post_id}'>Edit</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <?php
                    if (isset($_GET['delete'])) {
                        $the_comment_id = $_GET['delete'];
                        $query = "DELETE FROM comments WHERE comment_id={$the_comment_id}";
                        $delete_query = mysqli_query($connection, $query);
                        header("Location: post_comments.php?id=".$_GET['id']);
                    }

                    if (isset($_GET['approve'])) {
                        $the_comment_id = $_GET['approve'];
                        $query = "UPDATE `comments` SET comment_status = 'approved' WHERE comment_id = '{$the_comment_id}'";
                        $approve_query = mysqli_query($connection, $query);
                        header("Location: post_comments.php?id=".$_GET['id']);
                    }

                    if (isset($_GET['unapprove'])) {
                        $the_comment_id = $_GET['unapprove'];
                        $query = "UPDATE `comments` SET comment_status = 'unapproved' WHERE comment_id = '{$the_comment_id}'";
                        $delete_query = mysqli_query($connection, $query);
                        header("Location: post_comments.php?id=".$_GET['id']);
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<?php include 'includes/admin_footer.php';?>

