<?php

function redirect($location) {


    header("Location:".$location);
    exit;
}

function ifItIsMethod($method = null) {

    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {

        return true;
    }

    return false;
}

function isLoggedIn() {

    if (isset($_SESSION['user_role'])) {

        return true;
    }


    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation = null) {

    if (isLoggedIn()) {

        redirect($redirectLocation);
    }
}

function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));
}

function set_message($msg) {

    if (!$msg) {

        $_SESSION['message'] = $msg;
    } else {

        $msg = "";
    }
}

function display_message() {

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function users_online() {
    if (isset($_GET['onlineusers'])) {

        global $connection;

        if (!$connection) {
            session_start();
            include '../includes/db.php';
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 30;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session','$time')");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    }
}

users_online();

function insert_categories() {
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == '' || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query_inser_into = "INSERT INTO `category`(`cat_title`) VALUE('".$cat_title."')";
            $insert_categories = mysqli_query($connection, $query_inser_into);
            if (!$insert_categories) {
                die('QUERY FAILED'.mysqli_error($connection));
            }
        }
    }
}

function findAllCategories() {
    global $connection;
    $query = "SELECT * FROM `category` ";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<tr><td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete=".$cat_id."'>Delete</td>";
        echo "<td><a href='categories.php?edit=".$cat_id."'>Edit</td></tr>";
    }
}

function deleteCategories() {
    global $connection;
    if (isset($_GET['delete'])) {
        $delete_guery = "DELETE FROM `category` WHERE cat_id = '".$_GET["delete"]."'";
        $delete_categories = mysqli_query($connection, $delete_guery);
        header("Location: categories.php");
    }
}

function confirmQuery($result) {
    global $connection;
    if (!$result) {
        die("QUERY FAILED .".mysqli_error($connection));
    }
}

function username_exist($username) {
    $connectionPDO = getConnectionPDO();
    $query = "SELECT username FROM users WHERE username = '{$username}'";
    $result = $connectionPDO->query($post_query_count)->rowCount();
    confirmQuery($connectionPDO->query($post_query_count));
    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}

function email_exist($email) {
    $connectionPDO = getConnectionPDO();
    $query = "SELECT user_email FROM users WHERE user_email = '{$email}'";
    $result = $connectionPDO->query($post_query_count)->rowCount();
    confirmQuery($connectionPDO->query($post_query_count));
    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}

function login_user($username, $password) {
    global $connection;
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);
    if (!$select_user_query) {
        die("QUERY FAILED ".mysqli_error($connection));
    }

    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }

//    $password = crypt($password, $db_user_password);

    if (password_verify($password, $db_user_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        header("Location: /cms/admin/");
    } else {
        header("Location: /cms/index");
    }
}
