<?php 
require_once("../resources/config.php");
include(TEMPLATE_FRONT.DS."header.php");
?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <?php viewCatHead(); ?>
        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Features</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php viewCatProducts(); ?>

        </div>
        <!-- /.row -->

        <hr>
</div>
        <!-- Footer -->
<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>
