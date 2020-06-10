<?php
	include("includes/db.php");
	session_start();
	if (!isset($_SESSION["user"])) {
		header("location: admin_login.php"); 
		exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Electronics Store - Insert a Product</title>
<link href="../styles/bootstrap.min.css" rel="stylesheet" />
<link href="styles/admin_style.css" rel="stylesheet" />
<link type="text/css" href="../styles/style.css" rel="stylesheet" />
<link rel="import" href="elements.html">
<script src="../components/webcomponentsjs/webcomponents.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>

<body>
<body fullbleed layout vertical>
<core-header-panel mode="waterfall" flex>
<core-toolbar>
<div style="float:left;">		
 <a href="index.php"><img src="../images/logo.png" height="50px" width="80px" alt="Plastic Electronics"></a>
</div> 
<span flex></span>
<div>
		<core-icon-button icon="account-circle"><?php if(isset($_SESSION['user'])) {echo $_SESSION['user']; }?></core-icon-button>
</div>
</core-toolbar>
<center>
<!--create admin form-->
<form method="post" action="insert_product.php" enctype="multipart/form-data" role="form">
	
    <h2>Insert New Product</h2>
    <table align="center" style="margin:10px;">
    <tr><section class="form-group" id="title">
        <td><label for="product_title">Product Name:</label></td>
        <td><input id="pi_title" type="text" name="product_title" class="form-control" placeholder="Name"></td>
    </section></tr><br><br>
    
    <tr><section id="category">
    <td><label for="product_cat">Category:</label></td>
    <td><select name="product_cat" class="form-control" >
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
    </select></td>
    </section></tr><br><br>
    
    <tr><section id="brands">
    <td><label for="product_brand">Brand:</label></td>
    <td><select name="product_brand" class="form-control"
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
    </select></td><br><br>
    </section></tr>
    
    <section id="image">
    <tr>
    	<td><label for="product_img1">Image 1:</label></td>
    	<td><input type="file" name="product_img1" id="inputfile"></td>
   </tr><br><br>
    <tr>
    	<td> <label for="product_img2">Image 2:</label></td>
    	<td><input type="file" name="product_img2" id="inputfile"></td>
    </tr><br><br>
    <tr>
    	<td><label for="product_img3">Image 3:</label></td>
    	<td><input type="file" name="product_img3" id="inputfile"></td>
    </tr><br><br>
    </section>
    
   	<tr><section id="price" class="input-group">
    	  <td><label for="product_product_price">Price:</label></td>
          <td><span class="input-group-addon" style="width:auto; height:25px;">Rs.</span>
    	 <input type="text" name="product_price" placeholder="Price" class="form-control"></td>
    </section></tr><br><br>
    
    <tr><section id="small_description">
    <td><label for="product_area">Small Description:</label></td>
    <td><textarea name="product_small_area" cols="30" rows="5" placeholder="Description" class="form-control">
    
    </textarea></td>
    
    
    <!--    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
    <script>
    tinymce.init({selector:'textarea'});
    </script>
    -->    	
    </section><br><br></tr>
    
   	<tr><section id="description">
    	 <td><label for="product_area">Description:</label></td>
    	 <td><textarea name="product_area" cols="30" rows="5" placeholder="Description" class="form-control">
    
        </textarea></td>
    
    
<!--    <script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
	<script>
		tinymce.init({selector:'textarea'});
	</script>
-->    	
	</section></tr><br><br>
    
    <tr><section id="keywords">
    	<td><label for="product_keywords">Keywords:</label></td>
    	<td><input type="text" name="product_keywords" placeholder="keywords" class="form-control"></td>
    </section></tr><br><br>
   <tr>
	<td><input type="reset" id="clear" value="Clear" class="btn btn-default btn-sm"></td>
    <td><input type="submit" name="insert_product" class="btn btn-success btn-sm" id="submit" value="Submit Product"></td><br><br>
     </table>
</form>
</center>
</core-header-panel>

<?php
	
if(isset($_POST['insert_product'])) {
	
	//text data variables
	
		$product_title=$_POST['product_title'];
		$product_cat=$_POST['product_cat'];
		$product_brand=$_POST['product_brand'];
		$product_price=$_POST['product_price'];
		$product_small_desc=$_POST['product_small_area'];
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
		
		if($product_title == '' OR $product_price == '' OR $product_desc == ''  OR $product_small_desc == '' OR $product_keywords == '' OR $product_cat == '' OR $product_brand == '' OR $product_img1 == ''){
			echo "<script>alert('Please put everything') </script>";
			exit();
		}
		else{
	//uploading images to its folder
	
			move_uploaded_file($temp_name1,"product_images/$product_img1");
			move_uploaded_file($temp_name2,"product_images/$product_img2");
			move_uploaded_file($temp_name3,"product_images/$product_img3");
			
			$insert_product = "INSERT INTO products (cat_id,brand_id,date,product_title,product_img1,product_img2,product_img3,product_price,product_small_desc,product_desc,product_status,product_keyword) VALUES('$cat_id','$brand_id',NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_small_desc','$product_desc','$product_status','$product_keywords')";
			
			$run_product = mysqli_query($con,$insert_product);	

			if($run_product)
				echo "<script>alert('yahoo!Product inserted successfully') </script>";		
					
			}
}	
	
?>
<br><br>		
	<p><a href="index.php">Go Home</a></p>	
</body>
</html>