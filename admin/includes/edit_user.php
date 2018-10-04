<?php
include '../admin/functions.php';

if (isset($_GET['edit'])) {
    $the_user_id = $_GET['edit'];
}
if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_password = $_POST['user_password'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

//    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "UPDATE users SET username={$username}, user_password={$user_password}, "
    . "user_firstname={$user_firstname}, user_lastname={$user_lastname}, "
    . "user_email={$user_email} WHERE user_id = {$the_user_id}";

    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">E-Mail</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <!--    <div class="form-group">
            <label for="user_image">User Image</label>
            <input type="file" name="user_image">
        </div>-->

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update">
    </div>
</form>


