<?php 
	include("includes/db.php");
?>
<?php 
	include("header.php");
?>	
<?php
		$pid = $_GET['pro_id'];

		$get_product = "select * from products where product_id = $pid";
		
		$run_product = mysqli_query($con,$get_product);
		
		while($row_product = mysqli_fetch_array($run_product)) {
			$pro_id = $row_product['product_id'];
			$pro_title = $row_product['product_title'];
			$pro_desc = $row_product['product_desc'];
			$pro_price = $row_product['product_price'];
			$pro_image1 = $row_product['product_img1'];
			$pro_image2 = $row_product['product_img2'];
			$pro_image3 = $row_product['product_img3'];
			
			echo '
	<article id="article_post" style="width:auto;"> <paper-ripple fit></paper-ripple>
			<section> 
    	<h3 id="article_h3">'.$pro_title.'</h3>
	</section>
	
	<section style="border:#000000 thin solid;"><center>	
		       <a href="admin/product_images/'.$pro_image3.'" rel="gallery" title="'.$pro_title.'" class="t_image"><img class="pd_image" id="slider"   src="admin/product_images/'.$pro_image3.'" alt="'.$pro_image3.'"><paper-ripple fit></paper-ripple></a></center>	  
	</section><br>
	<section id="t_image">
		      <a href="admin/product_images/'.$pro_image1.'" rel="gallery" title="'.$pro_title.'" class="t_image"><img class="tin_image" id="slider" src="admin/product_images/'.$pro_image1.'"  height="160" width="140" alt="'.$pro_image1.'"></a>	
			  <a href="admin/product_images/'.$pro_image2.'" rel="gallery" title="'.$pro_title.'" class="t_image"><img class="tin_image"  id="slider" src="admin/product_images/'.$pro_image2.'"  height="160" width="140" alt="'.$pro_image2.'"></a> 
			  <a href="admin/product_images/'.$pro_image3.'" rel="gallery" title="'.$pro_title.'"><img class="tin_image"  id="slider" src="admin/product_images/'.$pro_image3.'"  height="160" width="140" alt="'.$pro_image3.'"></a>  
	</section><br><br>
	
	<section id="pd_desc" class="img-thumbnail">
    	<p class="img-thumbnail">'.$pro_desc.'</p><paper-ripple fit></paper-ripple>
    </section>
	
	
	<section style="float:left;">
		<p id="pd_price">Rs. '.$pro_price.'</p><paper-ripple fit></paper-ripple>
	</section>
	
	<br><br>
	 <section id="p_cart"  style="float:right;">
		<form id="cart" name="cart" method="post" action="cart.php">
			<input type="hidden" name="pid" id="pid" value="'.$pro_id.'"/>
			<input type="image" value="submit"  height="40px" width="100px" src="images/add_to_cart.png" alt="Add to Cart">
		</form>
    </section>
	</article>
	';
	
		}
?>	
</div>
</core-header-panel>
</core-drawer-panel>
</body>
</html>