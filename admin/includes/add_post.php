<?php
include '../admin/functions.php';

if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_user = $_POST['post_user'];
    $post_category_id = $_POST['post_category_id'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) "
    ."VALUE({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}','{$post_status}')";

    $create_post_query = mysqli_query($connection, $query);
    confirmQuery($create_post_query);
    
    $the_post_id = mysqli_insert_id($connection);
    
        Echo "<p class='bg-success'><b>Post Created</b>. <a href='../post.php?p_id={$the_post_id}'>View Post</a>"
    . " | <a href='../admin/posts.php'>View more posts</a> </p>";
}
?>
        
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select name="post_category_id" id="post_category">

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
                echo "<option value='{$user_id}'>{$username}</option>";
            }
            ?>     
        </select>
    </div>
    
<!--    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>-->

    <div class="form-group">
        <select name="post_status" id="post_status">
            <option value='draft'>draft</option>
            <option value='published'>publish</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10">
        </textarea>

    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>

</head>
</form>


