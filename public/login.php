<?php 
require_once("../resources/config.php");
include(TEMPLATE_FRONT.DS."header.php");
?>
    <!-- Page Content -->
    <div class="container">

        <header>
            <h1 class="text-center">Login</h1>
        </header>
        <hr>
        <h4 class="text-center alert-danger col-sm-4 col-sm-offset-5"><?php displayMessage(); ?> </h4>      
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="post" enctype="multipart/form-data">
                
                <?php loginUser(); ?>

                <div class="form-group"><label for="username">
                    username<input type="text" name="username" class="form-control"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="password" class="form-control"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >
                </div>
            </form>
        </div>  

    </div>

<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>    