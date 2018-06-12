<?php require_once("config.php"); ?>
<?php

// if(isset($_GET['add'])) {
// 	$_SESSION['product_'.$GET['add']] += 1;
// } 
// 

if(isset($_GET['add'])) {
	$query = query("SELECT * FROM products WHERE pro_id=". escapeString($_GET['add'])." ");
	confirm($query);
	while($row = fetchArray($query)) {
		if($row['pro_quantity'] != $_SESSION['pro_'.$_GET['add']]) {
			$_SESSION['pro_'.$_GET['add']]+=1;
			redirect("../public/checkout.php");
		} else {
			setMessage("We have only ".$row['pro_quantity']. " available. ");
			redirect("../public/checkout.php");
		}
	}
}

if(isset($_GET['remove'])) {
	$_SESSION['pro_'.$_GET['remove']]--;
	redirect("../public/checkout.php");
	if($_SESSION['pro_'.$_GET['remove']] < 1) {
		unset($_SESSION['total']);
		unset($_SESSION['quantity']);
		redirect("../public/checkout.php");
	}
}


if(isset($_GET['delete'])) {
	$_SESSION['pro_'.$_GET['delete']] = 0;
	unset($_SESSION['total']);
	unset($_SESSION['quantity']);
	redirect("../public/checkout.php");
}

function cart() {
	$total = 0;
	$quantity = 1;
	$item_name = 1;
	$item_number = 1;
	$amount = 1;
	$number = 0;
	foreach ($_SESSION as $name => $value) {
		
		if($value > 0) {
			
			if(substr($name, 0, 4) == "pro_") {
				$id = substr($name, 4);
				$query = query("SELECT * FROM products WHERE pro_id =". escapeString($id) ." ");
				confirm($query);
				while($row = fetchArray($query)) {
					$sub = $row['pro_price']*$value;
					$total += $sub;
					$number += $value; 
					$product = <<<DELIMETER
						<tr>
			                <td>{$row['pro_name']}</td>
			                <td>&#36;{$row['pro_price']}</td>
			                <td>{$value}</td>
			                <td>&#36;{$sub}</td>
			                <td><a class='btn btn-warning' href="../resources/cart.php?remove={$row['pro_id']}"><span class='glyphicon glyphicon-minus'></span></a>  <a class='btn btn-success' href="../resources/cart.php?add={$row['pro_id']}"><span class='glyphicon glyphicon-plus'></span></a></td>
			                <td><a class='btn btn-danger' href="../resources/cart.php?delete={$row['pro_id']}"><span class='glyphicon glyphicon-remove'></a></td>
			            </tr>
			            <input type="hidden" name="item_name_{$item_name}" value="{$row['pro_name']}">
						<input type="hidden" name="item_number_{$item_number}" value="{$row['pro_id']}">
						<input type="hidden" name="amount_{$amount}" value="{$row['pro_price']}">
						<input type="hidden" name="quantitiy_{$quantity}" value="{$value}">
DELIMETER;
	echo $product;
	$item_name++;
	$item_number++;
	$quantity++;

				}
				$_SESSION['total']= $total;
				$_SESSION['quantity']= $number;			
			}
		}
	}	
}

function paypalButton() {
	if(isset($_SESSION['quantity'])){
		$product = <<<DELIMETER
			<input type="image" name="upload"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">
DELIMETER;
            return $product;
        }
}

function report() {
	$total = 0;
	$number = 0;
	foreach ($_SESSION as $name => $value) {
		
		if($value > 0) {
			
			if(substr($name, 0, 4) == "pro_") {
				$id = substr($name, 4);
				$query = query("SELECT * FROM products WHERE pro_id =". escapeString($id) ." ");
				confirm($query);
				while($row = fetchArray($query)) {
					$sub = $row['pro_price']*$value;
					$total += $sub;
					$number += $value;
					$query = query("INSERT INTO reports(product_id,,product_price,product_quantity)VALUES('{$amount}','{$transaction}','{$currency}','{$status}')");
					confirm($query); 
				}
				$total;
				$number;			
			}
		}
	}	
}
