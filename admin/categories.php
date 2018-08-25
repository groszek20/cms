<?php include 'includes/admin_header.php';?>

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



                    <div class="col-xs-6">
                        <?php
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
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                    </div>
                    <?php
                    $query = "SELECT * FROM `category` ";
                    $select_categories = mysqli_query($connection, $query);
                    ?>
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Categories</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($select_categories)) {
                                    $cat_title = $row['cat_title'];
                                    $cat_id = $row['cat_id'];
                                    echo "<tr><td>{$cat_id}</td>";
                                    echo "<td>{$cat_title}</td>";
                                    echo "<td><a href='../admin/categories.php?delete=".$cat_id."'>Delete</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    if (isset($_GET['delete'])) {
                        $delete_guery = "DELETE FROM `category` WHERE cat_id = '".$_GET["delete"]."'";
                        $delete_categories = mysqli_query($connection, $delete_guery);
                    }
                    ?>
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


