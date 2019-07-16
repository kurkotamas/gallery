<?php include("includes/admin_header.php"); ?>
<?php
if(!isset($_SESSION['user_id'])) {
    redirect("../index.php");
}
?>

<?php

$comments = Comment::find_all();



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
                        Comments
                    </h1>

                    <div class="col-md-12">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Body</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($comments as $comment) :?>

                                <tr>
                                    <td><?php echo $comment->id; ?></td>
                                    <td><?php echo $comment->author; ?>
                                        <div class="pictures_link">
                                            <a href="delete_comment.php?id=<?php echo $comment->id;?>">Delete</a>
                                        </div></td>
                                    <td><?php echo $comment->body; ?></td>
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




