<?php 
	include("includes/db.php");
?>
<!DOCTYPE html><head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>E - Commerce on Mobile</title>

<link href="cart.png" rel="icon" />
<link href="styles/bootstrap.min.css" rel="stylesheet" />

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
$('document').ready(function() {

});
</script>


<link type="text/css" href="styles/style.css" rel="stylesheet" />
<style>

</style>
</head>

<body class="container">

<header>
		<img src="images/logo.png" height="50px" width="80px" alt="Plastic Electronics">
         <a href=""> <img id="user" src="images/log_user.png" height="30px" width="50px" alt="MyAccount" align="right"> </a>
       <a href=""> <img id="cart" src="images/shopping_cart.png" height="30px" width="50px" alt="MyCart" align="right"> </a>
        
</header>

<!-- form for adding search bar-->
<section >		
	<form id="search" class="form-horizontal" name="search" method="get" role="form">
        <input id="s_search" type="text" name="searchbox" placeholder="Search" class="form-control" />
        <input type="submit" value="GO"  id="go" class="btn btn-success"/>
	</form>
</section>


<nav class="navbar">


	<button type="button" class="btn btn-toggle" id="dropdownMenu1" data-toggle="collapse"> Categories <span class="caret"></span> </button>
	
    <ul class="collapse" role="menu" aria-labelledby="dropdownMenu1">

	
    <?php
	
	/* Code to Display our Menu (Categories for Products) */
	
		$get_cats = "select * from categories";			//
		$run_cats = mysqli_query($con,$get_cats);		//
		
	//	$get_brands = "select * from brands where cat_id=1";
	//	$run_brands = mysqli_query($con,$get_brands);
				
		while($row_cats = mysqli_fetch_array($run_cats)) {
		
			$cat_id = $row_cats['cat_id'];
			$cat_title = $row_cats['cat_title'];
			
    //    echo "<li><a href='index.php?cat = $cat_id'>$cat_title</a></li>";
		echo '<li role="presentation" class="dropdown"><a role="menuitem" href="index.php?cat = $cat_id">$cat_title</a>';
				
					$get_brands = "select * from brands where cat_id=$cat_id";
					$run_brands = mysqli_query($con,$get_brands);	
					while($row_cats = mysqli_fetch_array($run_brands)) {
					
						$cat_id = $row_cats['cat_id'];
						$brand_id = $row_cats['brand_id'];
						$brand_title = $row_cats['brand_title'];
						
	//				echo "<li><a href='index.php?cat = $cat_id&brand = $brand_title'>$brand_title</a></li>";
					echo '<li role="presentation" class="dropdown"><a role="menuitem" href="index.php?cat = $cat_id&brand = $brand_title">$brand_title</a>';
					}
		}
	?>
    </ul>
</nav>
		
	<?php
		$get_products = "select * from products order by rand() LIMIT 0,6";
		
		$run_products = mysqli_query($con,$get_products);
		
		while($row_products = mysqli_fetch_array($run_products)) {
			
			$pro_id = $row_products['product_id'];
			$pro_title = $row_products['product_title'];
			$pro_cat = $row_products['cat_id'];
			$pro_brand = $row_products['brand_id'];
			$pro_desc = $row_products['product_desc'];
			$pro_price = $row_products['product_price'];
			$pro_image = $row_products['product_img3'];
			
			
			echo ' 
	<article class="img-thumbnail" id="product_box"> 
			<section> 
    	<h3>'.$pro_title.'</h3>
	</section>
	<section>
		        <a href="details.php?pro_id='.$pro_id.'"><img id="disp_image" src="admin/product_images/'.$pro_image.'" class="img-rounded" height="160" width="140" alt="'.$pro_image.'"></a>
	</section>
	<section>
    <p>'.$pro_desc.'</p>
    </section>
    <section>
		<a href="index.php?product_title='.$pro_title.'&add_cart='.$pro_id.'"><img src="images/add_to_cart.png" alt="Add to Cart"></a>
		<p>Rs. '.$pro_price.'</p>
    </section> 
	</article>
	';
	
		}
	?>

	
<!--	<section> 
    	<h3>Mobiles </h3>
	</section>
	<section>
        <img src="images/content/nexus-5.png" class="img-rounded" height="160" width="140" alt="Mobile 1">
	</section>
	<section>
    <p>Data inside our post</p>
    </section>
    <section>
		<a href=""><img src="images/add_to_cart.png" alt="Add to Cart"></a>
		<p>Rs. 24,340</p>
    </section> 
</article>
-->
<article class="img-thumbnail"> 		
	<section> 
    	<h3>Mobiles </h3>
	</section>
	<section>
        <img src="images/content/nexus-5.png" class="img-rounded" height="160" width="140" alt="Mobile 1">
	</section>
	<section>
    <p>Data inside our post</p>
    </section>
    <section>
		<a href=""><img src="images/add_to_cart.png" alt="Add to Cart"></a>
		<p>Rs. 24,340</p>
    </section> 
</article>

<article class="img-thumbnail"> 		
	<section id="a_head"> 
    	<h3>Laptops</h3>
	</section>
	<section id="a_image">
        <img src="images/content/lappy.jpg" class="img-rounded" height="160" width="140" alt="Mobile 1">
	</section>
	<section id="a_description">
    <p>Data inside our post</p>
    </section>
    <section id="a_cart">
		<a href=""><img src="images/add_to_cart.png" alt="Add to Cart"></a>
		<p>Rs. 1,74,000</p>
    </section> 
</article>

<article class="img-thumbnail"> 		
	<section> 
    	<h3>PC </h3>
	</section>
	<section>
        <img src="images/content/pc.jpg" class="img-rounded" height="160" width="140" alt="Mobile 1">
	</section>
	<section>
    <p>Data inside our post</p>
    </section>
    <section>
		<a href=""><img src="images/add_to_cart.png" alt="Add to Cart"></a>
		<p>Rs. 12,320</p>
    </section> 
</article>

<footer>
	<ul>
    	<li><a href="">Home</a></li>
        <li><a href="">Shopping Cart</a></li>
        <li><a href="">Support</a></li>
        <li><a href="">About Us</a></li>
    </ul>
</footer>
 
</body>
</html>
<?php
/*<nav>			
    <ul>
        <li class="btn btn-warning active"><a href="../Home">Home</a>
        <li class="btn btn-info"><a href="">Products</a>
        <li class="btn btn-danger"><a href="">About Us</a>
        <li class="btn btn-default"><a href="">Support</a>
    </ul>
</nav>
*/
?>