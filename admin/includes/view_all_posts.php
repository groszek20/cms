<div class="col-lg-12">
<?php 
include 'functions.php';
if(isset($_POST['checkBoxArray']))
    foreach ($_POST['checkBoxArray'] as $post_id ){
        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options){
            case 'published';
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= {$post_id}";
                $update_to_published_status = mysqli_query($connection, $query);
                confirmQuery($update_to_published_status);
                break;
            case 'draft';
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id= {$post_id}";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirmQuery($update_to_draft_status);
                break;
            case 'delete';
                $query = "DELETE FROM posts WHERE post_id={$post_id}";
                $update_to_delete_status = mysqli_query($connection, $query);
                confirmQuery($update_to_delete_status);
                break;
        }
    }
?>
    <form action="" method='post'>
        <table class="table table-bordered table-hover">

            <div id="bulkOptionsContainer" class="col-xs-4">

                <select class="form-control" name="bulk_options" id="">
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <div class="col-xs-4">
                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a class="btn btn-primary" a href="posts.php?source=add_post">Add New</a>
            </div>
            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox" value='<?php echo $post_id; ?>'></th>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Delete</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $connection;
                $query = "SELECT * FROM `posts` ";
                $select_posts = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_posts)) {
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_status = $row['post_status'];
                    $post_content = $row['post_content'];
                    $post_category_id = $row['post_category_id'];
                    $post_comment_count = $row['post_comment_count'];
                    echo "<tr>";
                    ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
                    <?php
                    echo "<td>$post_id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</a></td>";

                    $query_title = "SELECT * FROM `category` WHERE `cat_id` = $post_category_id  ";
                    $select_categories = mysqli_query($connection, $query_title);
                    while ($row = mysqli_fetch_assoc($select_categories)) {
                        $cat_title = $row['cat_title'];
                        echo "<td>$cat_title</td>";
                    }

                    echo "<td>$post_status</td>";
                    echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
                    echo "<td>$post_tags</td>";
                    echo "<td>$post_comment_count</td>";
                    echo "<td>$post_date</td>";
                    echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </form>
</div>

<?php
if (isset($_GET['delete'])) {
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id={$the_post_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: ../admin/posts.php");
}
?>

