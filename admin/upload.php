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

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Upload
                        <small>Subheading</small>
                    </h1>
                    <?php
                    $message = "";
                    if(isset($_FILES['file'])) {
                        $photo = new Photo();
                        $photo->title = $_POST['title'];
                        $photo->date = date("Y-m-d");
                        $photo->set_file($_FILES['file']);

                        if($photo->save()) {
                            $message = "Photo uploaded Successfully";
                        } else {
                            $message = join("<br>", $photo->errors);
                        }

                    }

                    ?>
                    <div class="row">
                    <div class="col-md-6">
                        <?php echo $message; ?>
                    <form action="upload.php" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="file" name="file">
                        </div>
                        <input type="submit" name="submit">

                    </form>
                    </div>
                        <div class="col-lg-12">
                            <form action="upload.php" class="dropzone"></form>
                        </div>
                    </div><!-- End of Row -->



                </div>
            </div>
            <!-- /.row -->

        </div>
    </div>
    <!-- /#wrapper -->
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>



