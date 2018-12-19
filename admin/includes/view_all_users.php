<div class="col-lg-12">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit User</th>
                <th>Delete User</th>
                <th>Change role</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $connection;
            $query = "SELECT * FROM `users` ";
            $select_users = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];
                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";
                echo "<td><a href='users.php?source=edit_user&edit={$user_id}'>Edit User</a></td>";
                echo "<td><a href='users.php?delete={$user_id}'>Delete User</a></td>";
                if ($user_role === 'admin') {
                    echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
                } else {
                    echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                }
                echo "</tr>";
            }

            ?>

        </tbody>
    </table>
</div>

<?php
            if (isset($_GET['delete'])) {
                if (isset($_SESSION['user_role'])) {
                    if ($_SESSION['user_role'] == 'admin') {
                        $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
                        $query = "DELETE FROM users WHERE user_id={$the_user_id}";
                        $delete_query = mysqli_query($connection, $query);
                        header("Location: ../admin/users.php");
                    }
                }
            }

if (isset($_GET['change_to_subscriber'])) {
    $the_user_id = $_GET['change_to_subscriber'];
    $query = "UPDATE `users` SET user_role = 'subscriber' WHERE user_id = {$the_user_id} ";
    $update_query = mysqli_query($connection, $query);
    header("Location: ../admin/users.php");
}

if (isset($_GET['change_to_admin'])) {
    $the_user_id = $_GET['change_to_admin'];
    $query = "UPDATE `users` SET user_role = 'admin' WHERE user_id = {$the_user_id} ";
    $update_query = mysqli_query($connection, $query);
    header("Location: ../admin/users.php");
}
?>
