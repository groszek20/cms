<?php
include '../admin/functions.php';

if (isset($_GET['edit'])) {
    $the_user_id = $_GET['edit'];
    $user_query = "SELECT * FROM `users` WHERE user_id = {$the_user_id} ";
    $select_users_by_id = mysqli_query($connection, $user_query);
    while ($row = mysqli_fetch_assoc($select_users_by_id)) {
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_password = $row['user_password'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
    }
}

if (isset($_POST['edit_user'])) {
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_password = $_POST['user_password'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    $query = "UPDATE users SET username='$username', user_password='$user_password', "
    ."user_firstname='$user_firstname', user_lastname='$user_lastname', "
    ."user_email='$user_email', user_role='$user_role' WHERE user_id = '$the_user_id'";

    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname;?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname;?>">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php 
            $upf_user_role = ucfirst ($user_role);
            echo $upf_user_role; ?></option>
            
            <?php 
            if($user_role == 'admin'){
                echo '<option value="subscriber">Subscriber</option>';
            } else {
                 echo '<option value="admin">Admin</option>';
            }
            ?>         
        </select>
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php echo $user_password;?>">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username;?>">
    </div>

    <div class="form-group">
        <label for="user_email">E-Mail</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email;?>">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update">
    </div>
</form>


