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
