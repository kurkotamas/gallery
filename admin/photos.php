<?php include("includes/admin_header.php"); ?>
<?php
if(!isset($_SESSION['user_id'])) {
    redirect("../index.php");
}
?>

<?php

$photos = Photo::find_all();



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
                        Photos
                    </h1>

                    <div class="col-md-12">

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Id</th>
                                <th>File Name</th>
                                <th>Title</th>
                                <th>Size</th>
                                <th>Comments</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($photos as $photo) :?>

                            <tr>
                                <td><img class="admin-photo-thumbnail" src="<?php echo $photo->picture_path(); ?>" alt="">
                                    <div class="action_link">
                                        <a class="delete_link" href="delete_photo.php?id=<?php echo $photo->id;?>">Delete</a>
                                        <a href="edit_photo.php?id=<?php echo $photo->id?>">Edit</a>
                                        <a href="../photos.php?id=<?php echo $photo->id; ?>">View</a>
                                    </div>
                                </td>
                                <td><?php echo $photo->id; ?></td>
                                <td><?php echo $photo->filename; ?></td>
                                <td><?php echo $photo->title; ?></td>
                                <td><?php echo $photo->size; ?></td>
                                <td><?php
                                    $comments = Comment::find_comments_by_photo_id($photo->id);

                                    echo "<a href='comment_photo.php?id=". $photo->id ."'>". count($comments) ."</a>";

                                    ?></td>
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


