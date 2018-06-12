<?php
    require_once("../../resources/config.php");
    include(TEMPLATE_BACK.DS."header.php");

    if(!isset($_SESSION['username'])) {
        redirect("../../public");
    }
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   <h3> <?php displayMessage(); ?> </h3>
                    Dashboard <small>Statistics Overview</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
         
        <!--admin content -->
        <?php if($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php") {
            include(TEMPLATE_BACK.DS."admin-content.php");
        }

        if(isset($_GET['orders'])) {
            include(TEMPLATE_BACK.DS."orders.php");
        }

        if(isset($_GET['products'])) {
            include(TEMPLATE_BACK.DS."products.php");
        }

        if(isset($_GET['add_product'])) {
            include(TEMPLATE_BACK.DS."add_product.php");
        }

        if(isset($_GET['edit_product'])) {
            include(TEMPLATE_BACK.DS."edit_product.php");
        }

        if(isset($_GET['categories'])) {
            include(TEMPLATE_BACK.DS."categories.php");
        }

        if(isset($_GET['users'])) {
            include(TEMPLATE_BACK.DS."users.php");
        }

         ?>
    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK.DS."footer.php"); ?>
    