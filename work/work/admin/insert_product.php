<?php
	include("includes/db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Electronics Store - Insert a Product</title>


<link href="../styles/bootstrap.min.css" rel="stylesheet" />
<link href="styles/admin_style.css" rel="stylesheet" />

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>

<body>
<header>
<center>
<!--create admin form-->
<form method="post" action="insert_product.php" enctype="multipart/form-data" role="form">
	
    <h2>Insert New Product</h2>
    <br><br>
    
    <section class="form-group" id="title">
        <label for="product_title">Product Name:</label>
        <input type="text" name="product_title" class="form-control" placeholder="Name"><br><br>
    </section>
    
    <section id="category">
    <label for="product_cat">Category:</label>
    <select name="product_cat" class="form-control" >
    	<option>Select a Category</option>
          <?php
	
	/* Code to Display our Categories in Form */
	
		$get_cats = "select * from categories";			//
		$run_cats = mysqli_query($con,$get_cats);		//
		
		while($row_cats = mysqli_fetch_array($run_cats)) {
		
			$cat_id = $row_cats['cat_id'];
			$cat_title = $row_cats['cat_title'];
			
        echo "<option value='$cat_id'>$cat_title</option>";
		}
	?>
    </select><br><br>
    </section>
    
    <section id="brands">
    <label for="product_brand">Brand:</label>
    <select name="product_brand" class="form-control">
    				<option>Select a Brand</option>
    				<?php
                    $get_brands = "select * from brands where cat_id=$cat_id";
					$run_brands = mysqli_query($con,$get_brands);	
					while($row_cats = mysqli_fetch_array($run_brands)) {
					
						$brand_id = $row_cats['brand_id'];
						$brand_title = $row_cats['brand_title'];
						
					echo "<option value='$brand_id'>$brand_title</option>";
					}
					?>
    </select><br><br>
    </section>
    
    <section id="image">
    	<label for="product_img1">Image 1:</label>
    	<input type="file" name="product_img1" id="inputfile"><br><br>
   
    
    
    	 <label for="product_img2">Image 2:</label>
    	<input type="file" name="product_img2" id="inputfile"><br><br>
    
    
    
    	 <label for="product_img3">Image 3:</label>
    	<input type="file" name="product_img3" id="inputfile"><br><br>
    </section>
    
   	<section id="price" class="input-group">
    	  <label for="product_product_price">Price:</label>
          <span class="input-group-addon" style="width:auto; height:auto;">Rs.</span>
    	 <input type="text" name="product_price" placeholder="Price" class="form-control"><br><br>
    </section>
    
   	<section id="description">
    	 <label for="product_area">Description:</label>
    	 <textarea name="product_area" cols="30" rows="5" placeholder="Description" class="form-control">
    
        </textarea><br><br>
    
    
<!--    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script>
		tinymce.init({selector:'textarea'});
	</script>
-->    	
	</section>
    
    <section id="keywords">
    	<label for="product_keywords">Keywords:</label>
    	<input type="text" name="product_keywords" placeholder="keywords" class="form-control"><br><br>
    </section>
    
	<input type="reset" value="Clear" class="btn btn-default btn-lg" id="clear">  
    <input type="submit" value="Submit Product" name="insert_product" class="btn btn-default btn-lg" id="submit"><br><br>
    
    
</form>
</center>
</header>
</body>
</html>

<?php
	
	if(isset($_POST['insert_product'])) {
	
	//text data variaables
	
		$product_title=$_POST['product_title'];
		$product_cat=$_POST['product_cat'];
		$product_brand=$_POST['product_brand'];
		$product_price=$_POST['product_price'];
		$product_desc=$_POST['product_area'];
		$product_status='on';
		$product_keywords=$_POST['product_keywords'];
		
		
	//images names
	
		$product_img1 = $_FILES['product_img1']['name'];
		$product_img2 = $_FILES['product_img2']['name'];
		$product_img3 = $_FILES['product_img3']['name'];
		
	//Image temp names
	
		$temp_name1 = $_FILES['product_img1']['tmp_name'];
		$temp_name2 = $_FILES['product_img2']['tmp_name'];
		$temp_name3 = $_FILES['product_img3']['tmp_name'];
		
		if($product_title == '' OR $product_price == '' OR $product_desc == ''   OR $product_keywords == '' OR $product_cat == '' OR $product_brand == '' OR $product_img1 == '')
		{
			echo "<script>alert('Please put everything') </script>";
			exit();
		}
		else
		{
	//uploading images to its folder
	
			move_uploaded_file($temp_name1,"product_images/$product_img1");
			move_uploaded_file($temp_name2,"product_images/$product_img2");
			move_uploaded_file($temp_name3,"product_images/$product_img3");
			
			$insert_product = "insert into products (cat_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_desc,product_status) 						values('$cat_id','$brand_id',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_desc','$product_status')";
			
			$run_product = mysqli_query($con,$insert_product);
			
			if($run_product)
				echo "<script>alert('yahoo!Product inserted successfully') </script>";		
		}		
}	
	
?>