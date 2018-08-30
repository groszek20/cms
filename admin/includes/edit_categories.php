
<?php
if (isset($_GET['edit'])) {
    $cat_id = $_GET['edit'];
    $query = "SELECT * FROM `category` WHERE `cat_id` = $cat_id  ";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
    }
    ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="cat_title">Edit Category</label>
            <input value="<?php
            if (isset($_GET['edit'])) {
                echo $cat_title;
            }
            ?>" type="text" class="form-control" name="cat_title">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
        </div>
    </form>
    <?php
}

if (isset($_POST['update_category'])) {
    $updated_cat_title = $_POST['cat_title'];
    $edit_guery = "UPDATE `category` SET `cat_title`='{$updated_cat_title}' WHERE `cat_id`={$cat_id}";
    $edit_categories = mysqli_query($connection, $edit_guery);
    if (!$edit_categories) {
        die("QUERY FAILED".mysqli_errno($connection));
    }
    header("Location: categories.php?edit=".$cat_id);
}
?>