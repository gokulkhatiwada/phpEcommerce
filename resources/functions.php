<?php

function setMessage($message) {
	if(!empty($message)) {
		$_SESSION['message'] = $message;
	} else {
		$_SESSION['message'] = "";
	}
}

function displayMessage() {
	if(isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function redirect($location) {
	header("Location: $location");
}

function query($sql) {
	global $connection;
	return mysqli_query($connection,$sql);
}

function confirm($result) {
	global $connection;
	if(!$result) {
		die("Query Failed  ".mysqli_error($connection));
	}
}

function escapeString($string) {
	global $connection;
	return mysqli_real_escape_string($connection,$string);
}

function fetchArray($result) {
	return mysqli_fetch_array($result);
}


function viewIndexProducts() {
	$query = query("SELECT * FROM products");
	confirm($query);
	while($row = fetchArray($query)) {

		$product = <<<DELIMETER
			<div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <a href="item.php?id={$row['pro_id']}"><img src="{$row['pro_img']}" alt=""></a> 
                    <div class="caption">
                        <h4 class="pull-right">&#36;{$row['pro_price']}</h4>
                        <h4><a href="item.php?id={$row['pro_id']}">{$row['pro_name']} <span class="badge">{$row['pro_quantity']} left </span></a>
                        </h4>
                        <p> {$row['pro_short_desc']}</p>
                        <a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['pro_id']}">Add to Cart</a>
                    </div>                    
                </div>
            </div>
DELIMETER;
            echo $product;

	}
}


function getCategories() {
	$query = query('SELECT * FROM categories');
    confirm($query);
    	
    	while($row = fetchArray($query)) {     		        
    		echo "<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>";
    	 }
}

function viewCatProducts() {
	$query = query("SELECT * FROM products WHERE pro_cat_id = ". escapeString($_GET['id']) ." ");
	confirm($query);
	while($row = fetchArray($query)) {

		$product = <<<DELIMETER
			<div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src= "{$row['pro_img']}" alt=" ">
                <div class="caption">
                    <h3> {$row['pro_name']} <span class="badge">{$row['pro_quantity']} left </span></h3>
                    <p> {$row['pro_short_desc']} </p>
                    <p>
                        <a href="../resources/cart.php?add={$row['pro_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['pro_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>
DELIMETER;
            echo $product;
	}
}

function viewCatHead() {
	$query = query("SELECT * FROM categories WHERE cat_id = ". escapeString($_GET['id']) ." ");
	confirm($query);
	while($row = fetchArray($query)) {

		$product = <<<DELIMETER
			<header class="jumbotron hero-spacer">
            <h1> {$row['cat_title']} </h1>
            <p> {$row['cat_desc']} </p>
            <p><a class="btn btn-primary btn-large">Call to action!</a>
            </p>
        </header>

DELIMETER;
            echo $product;
	}

}

function viewShopProducts() {
	$query = query("SELECT * FROM products");
	confirm($query);
	while($row = fetchArray($query)) {

		$product = <<<DELIMETER
			<div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src= "{$row['pro_img']}" alt=" ">
                <div class="caption">
                    <h3><a href="item.php?id={$row['pro_id']}"> {$row['pro_name']} <span class="badge">{$row['pro_quantity']} left </span></h3></a>
                    <p> {$row['pro_short_desc']} </p>
                    <p>
                        <a href="../resources/cart.php?add={$row['pro_id']}" class="btn btn-primary">Buy Now! </a> <a href="item.php?id={$row['pro_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>
DELIMETER;
            echo $product;
	}
}

function loginUser() {
	if(isset($_POST['submit'])){
		$username = escapeString($_POST['username']);
		$password = escapeString($_POST['password']);

		$query = query("SELECT * FROM users WHERE user_name = '{$username}' AND user_password = '{$password}' ");
		confirm($query);
		if(mysqli_num_rows($query) == 0) {
			setMessage("Username or Password do not match.");
			redirect('login.php');
		} else {
			$_SESSION['username'] = $username;
			setMessage("Welcome  {$username}");
			redirect('admin');
		}
	}
}

function sendMessage() {
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		$headers = "From: {$name} {$email}";
		$to = "gokulkhatiwada91@gmail.com";
		$result = mail($to, $subject, $message, $headers);

		if(!$result) {
			setMessage("Message not Sent.");
			redirect("contact.php");
		} else {
			setMessage("Message Sent");
			redirect("contact.php");
		}
	}
}

?>