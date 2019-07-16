<?php include("includes/admin_header.php"); ?>
<?php include("includes/photo_library_modal.php"); ?>

<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <?php include "includes/admin_navigation.php" ?>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include "includes/admin_sidebar.php" ?>



</nav>

<div id="page-wrapper">

    <body>

    <div id="wrapper">
        <div class="container-fluid">
            <?php

            if(empty($_GET['id'])) {
                redirect('users.php');
            }
            $user = User::find_by_id($_GET['id']);
            if(isset($_POST['update'])) {
                if($user) {
                    $user->username = $_POST['username'];
                    $user->firstname = $_POST['firstname'];
                    $user->lastname = $_POST['lastname'];
                    $user->email = $_POST['email'];
                    $user->password = $_POST['password'];

                    if(empty($_FILE['user_image'])) {
                        $user->save();
                        $session->message("The user has been updated");
                    } else {
                        $user->set_file($_FILES['user_image']);
                        echo $user->user_image;
                        $user->save_user_and_image();
                        $user->save();
                        $session->message("The user has been updated");
                    }
                    redirect("users.php");

                }
            }

            ?>



            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit User
                        <small>Subheading</small>
                    </h1>

                    <div class="col-md-6 user_image_box">
                        <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="<?php echo $user->image_path_and_placeholder(); ?>"></a>

                    </div>
                    <form class="form-group" action="" method="post" enctype="multipart/form-data">

                        <div class="col-md-6">

                        <div class="form-group">
                        <label for="user_image">Image</label>
                        <input type="file" name="user_image" value="">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo $user->firstname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" class="form-control" value="<?php echo $user->lastname; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $user->email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user->password; ?>">
                        </div>
                            <div class="form-group">
                                <input class="btn btn-primary pull-right" type="submit" name="update">
                            </div>
                            <div class="form-group">
                                <a id="user_id" href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger pull-left" name="delete">Delete</a>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
            <!-- /.row -->

        </div>
    </div>
    <!-- /#wrapper -->
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->




