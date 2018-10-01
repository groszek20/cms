<?php
include '../admin/functions.php';

if (isset($_POST['create_post'])) {
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category_id'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_status = $_POST['post_status'];
    $post_tags = $_POST['post_tags'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) "
    ."VALUE({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}','{$post_status}')";

    $create_post_query = mysqli_query($connection, $query);
    confirmQuery($create_post_query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_author">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="post_category_id" id="post_category">

            <?php
            $query = "SELECT * FROM `users`";
            $select_users = mysqli_query($connection, $query);
            confirmQuery($select_users);
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $user_role = $row['user_role'];
                echo "<option value='{$user_id}'>{$user_role}</option>";
            }
            ?>     
        </select>
    </div>

    <div class="form-group">
        <label for="post_status">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="post_tags">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_tags">E-Mail</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_image">User Image</label>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>


