<?php
include 'functions.php';
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}



$query = "SELECT * FROM `posts` where post_id=$the_post_id";
$select_posts_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];
    $post_content = $row['post_content'];
    $post_category_id = $row['post_category_id'];
    $post_comment_count = $row['post_comment_count'];
}

if (isset($_POST['update_post'])) {
    $post_category_id = $_POST['post_category'];
    $post_user = $_POST['post_user'];
    $post_title = $_POST['title'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_status = $_POST['post_status'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $update_post_query = "UPDATE `posts` SET "
    ."post_category_id = '{$post_category_id}', post_title = '{$post_title}', post_user = '{$post_user}', post_date = now(), "
    ."post_image = '{$post_image}', post_content = '{$post_content}', post_tags = '{$post_tags}', "
    ."post_status = '{$post_status}' WHERE post_id = '{$the_post_id}'";

    $update_post = mysqli_query($connection, $update_post_query);
    confirmQuery($update_post);

    Echo "<p class='bg-success'><b>Post updated</b>. <a href='../post.php?p_id={$the_post_id}'>View Post</a>"
    ." | <a href='../admin/posts.php'>View more posts</a> </p>";
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title;?>" type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="categories">Category</label>
        <select name="post_category" id="post_category">

            <?php
            $query = "SELECT * FROM `category`";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);
            while ($row = mysqli_fetch_assoc($select_categories)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>     
        </select>
    </div>
    <div class="form-group">
        <label for="users">Users</label>
        <select name="post_user" id="">
            <?php
            $query = "SELECT * FROM `users`";
            $select_users = mysqli_query($connection, $query);
            confirmQuery($select_users);
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo "<option value='{$username}'>{$username}</option>";
            }
            ?>     
        </select>

        <div class="form-group">
            <select name="post_status" id="post_status">
                <option value="<?php echo $post_status;?>"><?php echo $post_status;?></option>
                <?php
                if ($post_status == 'published') {
                    echo '<option value="draft">draft</option>';
                } else {
                    echo '<option value="published">publish</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <img  width="100" src="../images/<?php echo $post_image;?>" alt="">
            <input type="file" name="image">
        </div>

        <div class="form-group">
            <label for="post_tags">Post Tags</label>
            <input value="<?php echo $post_tags;?>" type="text" class="form-control" name="post_tags">
        </div>

        <div class="form-group">
            <label for="post_content">Post Content</label>
            <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
                <?php echo $post_content;?>"
            </textarea>
        </div>

        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
        </div>
</form>


