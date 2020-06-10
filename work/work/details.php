<?php 
	include("includes/db.php");
?>
<!DOCTYPE html><head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>E - Commerce on Mobile</title>

<link href="cart.png" rel="icon" />
<link href="styles/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="styles/anythingslider.css">

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.anythingslider.min.js"></script>

<script>
$('document').ready(function() {
	$('#image').anythingSlider();
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
		$pid = $_GET['pro_id'];

		$get_product = "select * from products where product_id = $pid";
		
		$run_product = mysqli_query($con,$get_product);
		
		while($row_product = mysqli_fetch_array($run_product)) {
			
			$pro_title = $row_product['product_title'];
			$pro_desc = $row_product['product_desc'];
			$pro_price = $row_product['product_price'];
			$pro_image1 = $row_product['product_img1'];
			$pro_image2 = $row_product['product_img2'];
			$pro_image3 = $row_product['product_img3'];
			
			echo ' 
	<article id="article_post"> 
			<section> 
    	<h3>'.$pro_title.'</h3>
	</section>
	<div id="p_image">
			  <img id="tin_image" src="admin/product_images/'.$pro_image1.'" class="img-rounded" height="160" width="140" alt="'.$pro_image1.'">	
			  <img id="tin_image" src="admin/product_images/'.$pro_image2.'" class="img-rounded" height="160" width="140" alt="'.$pro_image2.'">
		      <img id="disp_image" src="admin/product_images/'.$pro_image3.'" class="img-rounded" height="160" width="140" alt="'.$pro_image3.'">	  
	</div><br>
	<section id="t_image">
		      <img id="tin_image" src="admin/product_images/'.$pro_image1.'" class="img-rounded" height="160" width="140" alt="'.$pro_image1.'">	
			  <img id="tin_image" src="admin/product_images/'.$pro_image2.'" class="img-rounded" height="160" width="140" alt="'.$pro_image2.'">
			  <img id="tin_image" src="admin/product_images/'.$pro_image3.'" class="img-rounded" height="160" width="140" alt="'.$pro_image3.'">  
	</section><br><br>
	<section id="p_desc">
    <p>'.$pro_desc.'</p>
    </section>
	<br><br>
	<p id="p_price">Rs. '.$pro_price.'</p>
	<br><br>
    <section id="p_cart">
		<a href="index.php?product_title='.$pro_title.'&add_cart='.$pro_id.'"><img src="images/add_to_cart.png" alt="Add to Cart"></a>
    </section> <br><br>
	</article>
	';
	
		}
?>	

<footer >
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