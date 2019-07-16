<?php include("includes/admin_header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


        <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <?php include "includes/admin_navigation.php" ?>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php include "includes/admin_sidebar.php" ?>

    </nav>

        <div id="page-wrapper">

            <?php include "includes/admin_content.php" ?>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>




