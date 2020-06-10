<?php
	include("includes/db.php");
	$pid = "";
	$wasFound = "";
	$i = "";
	$emp= "";
	session_start();//start the session
?>
<?php
	if(isset($_POST['pid'])) {
		$pid = $_POST['pid'];
		$wasFound = false;
		$i = 0;
	}
	if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid,"quantity" => 1));
	}else {
		foreach($_SESSION["cart_array"] as $each_item) {
			$i++;
			while(list($key,$value) = each($each_item)) {
				if($key == "item_id" && $value == $pid) {
					array_splice($_SESSION["cart_array"],$i - 1,1,array(array("item_id" =>$pid ,"quantity" => $each_item['quantity'] + 1)));
					$wasFound = true;
				}
			}
		}
		if($wasFound == false) {
			array_push($_SESSION["cart_array"],array("item_id" => $pid,"quantity" => 1));
		}
		//header("location:cart.php");
		//exit();
	}
?>
<?php
	//To adjust the Item Quantity
	if(isset($_POST['item_to_adjust']) && $_POST['item_to_adjust'] != "") {
		$item_to_adjust = $_POST['item_to_adjust'];
		$quantity = $_POST['quantity'];
		$i = 0;
		foreach($_SESSION["cart_array"] as $each_item) {
			$i++;
			while(list($key,$value) = each($each_item)) {
				if($key == "item_id" && $value == $item_to_adjust) {
					array_splice($_SESSION["cart_array"],$i - 1,1,array(array("item_id" =>$item_to_adjust ,"quantity" => $quantity)));
				}
			}
		}
	}
?>
<?php
	//To remove an Item from the Cart
	if(isset($_POST['rem'])){
	if(isset($_POST['rem']) && $_POST['rem']!=""){
		$key_to_remove = $_POST['rem'];
		if(count($_SESSION["cart_array"]) <= 1) {
			unset($_SESSION["cart_array"]);
		}else {
			unset($_SESSION["cart_array"]["$key_to_remove"]);
			sort($_SESSION["cart_array"]);
			echo '<script>alert("Item Removed");</script>';
		}
	}
	}
?>
<?php
	//To empty the Shopping Cart
	if(isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
		unset($_SESSION["cart_array"]);
		$emp = "<h2 align = 'CENTER'>Your Cart is Empty now</h2>";
	}
?>
<?php 
	include_once("header.php");
?>
	<style>
		td {
			width:720px;
			height:auto;
			margin:15px;
		}
		.para {
			font-size:16px;
		}
		@media screen and (max-width: 600px) {
				td {
					width:480px;
					height:auto;
					margin:15px;
				}
		}
		 @media only screen and (max-width : 480px) {  
		 		td {
					width:380px;
					height:auto;
					margin:15px;
				}
				.para {
					font-size:14px;
				}
		 }
		 @media only screen and (max-width : 320px) {  
		 		td {
					width:180px;
					height:auto;
					margin:15px;
				}
				.para {
					font-size:12px;
				}
		 }
		 
	</style>
	<section align="center" id="mainWrapper">
    
        <section id="pageContent">
            <p>
            <?php
	//Render the cart for the user to view
	$cartOutput = "";
	$cartTotal = "";
	if(!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
		$cartOutput = "<h2 align = 'center'>Cart is Empty</h2>";
	}else {
		$i = 0;
		echo '<table class="table-striped table-bordered table-hover table-condensed" border="1px" style="width:auto;">
			  <tr> 
                <td  align="center">Product</td>
                <td  align="center">Unit Price</td>
                <td  align="center">Quantity</td>
                <td  align="center">Total</td>
                <td  align="center">Remove</td>
              </tr>';
		foreach($_SESSION["cart_array"] as $each_item) {
			
			$item_id = $each_item['item_id'];
					$get_products = "select * from products where product_id='$item_id' LIMIT 1";
				
				$run_products = mysqli_query($con,$get_products);
				
				while($row_products = mysqli_fetch_array($run_products)) {
					
					$pro_id = $row_products['product_id'];
					$pro_title = $row_products['product_title'];
					$pro_cat = $row_products['cat_id'];
					$pro_brand = $row_products['brand_id'];
					$pro_price = $row_products['product_price'];
					$pro_image = $row_products['product_img3'];
					
					$p_price = $pro_price * $each_item['quantity'];
					$cartTotal = $p_price + $cartTotal;
			
					echo ' 
				<tr>	
				<td align="center">'.$pro_title.'<br><img id="disp_image" src="admin/product_images/'.$pro_image.'" class="img-rounded" height="80" width="80" alt="'.$pro_image.'"></td>
				<td align="center">Rs. '.$pro_price.'</td>
				<td align="center"><form action="cart.php" method="post"><input name="item_to_adjust" type="hidden" value="'.$item_id.'" /><input name="quantity" type="text" value="'.$each_item['quantity'].'" size="1" maxlength="2" /><input class="btn btn-success" name="adjustBtn'.$item_id.'" type="submit" value="Change"  style="margin:5px;" /></form></td>
				<td align="center">Rs. '.$p_price.'</td>
				<td align="center"><form action="cart.php" method="post" name="remove"><input name="rem" type="hidden" value="'.$i.'" /><input name="deleteBtn" type="submit" class="btn btn-danger" value="X" style="margin:5px;"/></form></td>
			 </tr>
			';
			
			} $i++;
			//while(list($key,$value) = each($each_item)){
				//$cartOutput = "$key:$value<br>";
			//}
		}echo "</table>";
		 echo '<p class="para">Price to Pay is Rs. '.$cartTotal.'</p>';	
	}
	echo $emp;
?>
              <a href="cart.php?cmd=emptycart"><p class="para">Click Here to Empty your Shopping Cart</p></a>             
        </section>
    </section>
</core-header-panel>    
     <a href="index.php">Home</a>
</body>
</html>
