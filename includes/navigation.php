<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/cms/index.php">Start Page</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                 <?php 
            session_start();
            $query = "SELECT * FROM `category` ";
            $select_categories = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                
                $registration_class = '';
                $registration = "registration.php";
                $category_class = '';
                
                $pageName = basename($_SERVER['PHP_SELF']);
                if(isset($_GET['category']) && $_GET['category']==$cat_id ){
                    $category_class = 'active';
                } else if ($pageName == $registration) {
                    $registration_class = "active";
                }
                
                echo "<li class={$category_class}><a href='/cms/category/{$cat_id}'>{$cat_title}</a></li>";
            }
            ?>
                <li>
                    <a href="/cms/admin">Admin</a>
                </li>
                <li class="<?=$registration_class?>">
                    <a href="/cms/registration.php">Registration</a>
                </li>
                <?php 
                if (isset($_SESSION['user_role'])){
                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];
                        echo "<li> <a href='/cms/admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
