<?php include("includes/admin_header.php"); ?>

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
            //CREATE USER SUBMIT FORM BACK-END
            if(isset($_POST['create'])) {
                $user = new User();
                $user->username = $_POST['username'];
                $user->firstname = $_POST['firstname'];
                $user->lastname = $_POST['lastname'];
                $user->email = $_POST['email'];
                $user->password = $_POST['password'];
                $user->set_file($_FILES['user_image']);

                $user->save_user_and_image();
                $session->message("The user {$user->username} has been created");
                redirect("users.php");

            }

            ?>

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add User
                        <small>Subheading</small>
                    </h1>

                    <form class="form-group" action="add_user.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-6 col-md-offset-3">

                        <div class="form-group">
                        <label for="user_image">Image</label>
                        <input type="file" name="user_image">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" name="firstname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary pull-right" type="submit" name="create">
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
