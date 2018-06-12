<?php 
require_once("../resources/config.php");
include(TEMPLATE_FRONT.DS."header.php");
require_once("../resources/cart.php");
?>
<div class="container">

    <div class="row">
        <h1>Checkout</h1>
        <h4 class="text-center bg-warning"> <?php displayMessage(); ?></h4>

        
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="business" value="localhost@business.com">
            <input type="hidden" name="currency_code" value="US">    
            <table class="table table-striped">
                <thead>
                  <tr>
                   <th>Product</th>
                   <th>Price</th>
                   <th>Quantity</th>
                   <th>Sub-total</th>
             
                  </tr>
                </thead>
                <tbody>
                    <?php cart(); ?>
                </tbody>
            </table>
            <?php echo paypalButton(); ?>
        </form>



<!--  ***********CART TOTALS*************-->
            
        <div class="col-xs-4 pull-right ">
            <h2>Cart Totals</h2>

            <table class="table table-bordered" cellspacing="0">

                <tr class="cart-subtotal">
                    <th>Items:</th>
                    <td><span class="amount"><?php echo isset($_SESSION['quantity']) ? $_SESSION['quantity'] : $_SESSION['quantity'] = ""; ?></span></td>
                    </tr>
                    <tr class="shipping">
                    <th>Shipping and Handling</th>
                    <td>Free Shipping</td>
                </tr>

                <tr class="order-total">
                    <th>Order Total</th>
                    <td><strong><span class="amount">$<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : $_SESSION['total'] = ""; ?></span></strong> </td>
                </tr>

            </table>

        </div>

    </div>

</div>

<hr>

<!-- Footer -->
<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>