<?php 
require_once("../resources/config.php");
include(TEMPLATE_FRONT.DS."header.php");
?>
<div class="container">
	 
	 <header>
	 	<h1>Shop</h1>	
	 </header><!-- /header -->
	 
	 <hr>

	 <?php viewShopProducts(); ?>
</div>

<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>