<?php
include 'includes/admin_header.php';
include 'functions.php';
ob_start();
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
                    <div class="col-xs-6">

                        <?php
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
                        ?>
                        <form action="categories.php" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

<?php include 'includes/edit_categories.php';?> 
                

                    </div>

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
                                findAllCategories();
                                deleteCategories();
                                ?>
                            </tbody>
                        </table>
                    </div>
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


