<?php 
	include("includes/db.php");
?>
<?php 
	include("header.php");
?>
<?php
		
		if(isset($_GET['go'])) {
		
		$user_query = $_GET['searchbox'];
		
		$get_products = "select * from products where product_keyword LIKE '%$user_query%'";
		$run_products = mysqli_query($con,$get_products);
		
		while($row_products = mysqli_fetch_array($run_products)) {
			
			$pro_id = $row_products['product_id'];
			$pro_title = $row_products['product_title'];
			$pro_cat = $row_products['cat_id'];
			$pro_brand = $row_products['brand_id'];
			$pro_small_desc = $row_products['product_small_desc'];
			$pro_price = $row_products['product_price'];
			$pro_image = $row_products['product_img3'];
			
			echo ' 
	<br><article class="img-thumbnail"> 
			<section> 
    			<a href="details.php?pro_id='.$pro_id.'"><h3>'.$pro_title.'</h3></a>
			</section>
			<section style="float:left;">
			<section style="float:left;">
		        <a href="details.php?pro_id='.$pro_id.'"><img id="disp_image" src="admin/product_images/'.$pro_image.'" class="img-rounded" alt="'.$pro_image.'"></a>
			</section><br>
			
			<section style="margin:10px; float:left;">
				<p class="button btn-success active" style="width:auto; height:auto;">Rs. '.$pro_price.'</p>
				<paper-ripple fit></paper-ripple>
			</section>
			</section>
			
			<section id="p_desc" style="float:right;">
    			<p class="img-thumbnail">'.$pro_small_desc.'</p>
				<paper-ripple fit></paper-ripple>
    		</section>

			<section  style="float:right;"><br><br><br>
				<form id="cart" name="cart" method="post" action="cart.php">
					<input type="hidden" name="pid" id="pid" value="'.$pro_id.'"/>
					<input type="image" value="submit" src="images/add_to_cart.png" alt="Add to Cart" name="button">
					<paper-toast id="toast" text="Item added to Cart."></paper-toast> 
				</form>
    		</section>
	</article>
	';
	if($pro_title == '') {
			echo "<h2>No such product found</h2>";
		}
		}
		}
	?>
</body>
</html>
