<?php include("includes/admin_header.php"); ?>
<?php
if(!isset($_SESSION['user_id'])) {
    redirect("../index.php");
}
?>

<?php

$users = User::find_all();



?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

    <?php include "includes/admin_navigation.php" ?>

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include "includes/admin_sidebar.php" ?>

</nav>

<div id="page-wrapper">
    <div id="wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users
                    </h1>
                    <p class="bg-success"><?php echo $message;?></p>
                    <div class="col-md-12">

                        <a class="btn btn-primary" href="add_user.php" role="button">Add User</a>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Photo</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>E-Mail</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($users as $user) :?>

                                <tr>
                                    <td><?php echo $user->id; ?></td>
                                    <td><img class="user_image" src="<?php echo $user->image_path_and_placeholder(); ?>"></td>
                                    <td><?php echo $user->username; ?>
                                    <div class="pictures_link">
                                        <a href="delete_user.php?id=<?php echo $user->id;?>">Delete</a>
                                        <a href="edit_user.php?id=<?php echo $user->id?>">Edit</a>
                                        <a href="view_photo.php">View</a>
                                    </div></td>
                                    <td><?php echo $user->firstname; ?></td>
                                    <td><?php echo $user->lastname; ?></td>
                                    <td><?php echo $user->email; ?></td>
                                </tr>

                            <?php  endforeach; ?>
                            </tbody>
                        </table><!--End of table-->




                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
    </div>
    <!-- /.container-fluid -->


</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>



