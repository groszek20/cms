<?php
include 'includes/admin_header.php';
include '../admin/functions.php';

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_from_users = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($select_from_users)) {
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
    ."user_email='$user_email', user_role='$user_role' WHERE username = '$username'";

    $update_user_query = mysqli_query($connection, $query);
    confirmQuery($update_user_query);
}

?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php';?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
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
                                <option value="<?php echo $user_role;?>"><?php
                                    $upf_user_role = ucfirst($user_role);
                                    echo $upf_user_role;
                                    ?></option>

                                <?php
                                if ($user_role == 'admin') {
                                    echo '<option value="subscriber">Subscriber</option>';
                                } else {
                                    echo '<option value="admin">Admin</option>';
                                }
                                ?>         
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input autocomplete="off" type="password" class="form-control" name="user_password">
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
