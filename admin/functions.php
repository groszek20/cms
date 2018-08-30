<?php

function insert_categories() {
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == '' || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO `category`(`cat_title`) VALUE('".$cat_title."')";
            $insert_categories = mysqli_query($connection, $query);
            if (!$insert_categories) {
                die('QUERY FAILED'.mysqli_error($connection));
            }
        }
    }
}
