<?php
	include("includes/db.php");
	session_start();
	if (!isset($_SESSION["user"])) {
    header("location: admin_login.php"); 
    exit();
}
	$pro_id = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Electronics Store - Change a Product</title>
<link href="../styles/bootstrap.min.css" rel="stylesheet" />
<link href="styles/admin_style.css" rel="stylesheet" />
<link type="text/css" href="../styles/style.css" rel="stylesheet" />
<link rel="import" href="elements.html">
<script src="../components/webcomponentsjs/webcomponents.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/tinymce.min.js"></script>
	<script>
		tinymce.init({selector:"textarea"});
	</script>
</head>

<body>
<body fullbleed layout vertical>
<core-header-panel mode="waterfall" flex>
<core-toolbar>
<div>		
 <a href="index.php"><img src="../images/logo.png" height="50px" width="80px" alt="Plastic Electronics"></a>
</div> 
<span flex></span>
<div>
		<core-icon-button icon="account-circle"><?php if(isset($_SESSION['user'])) {echo $_SESSION['user']; }?></core-icon-button>
</div>
</core-toolbar>
<center><br />
<?php
$get_product = "select * from products where product_id = $pro_id";
		
$run_product = mysqli_query($con,$get_product);

while($row_product = mysqli_fetch_array($run_product)) {
			
			$pro_title = $row_product['product_title'];
			$pro_small_desc = $row_product['product_small_desc'];
			$pro_desc = $row_product['product_desc'];
			$pro_price = $row_product['product_price'];
			$pro_image1 = $row_product['product_img1'];
			$pro_image2 = $row_product['product_img2'];
			$pro_image3 = $row_product['product_img3'];
			$keywords = $row_product['product_keyword'];

echo '<h2>Change Product</h2>
<form method="post" action="edit_product.php" enctype="multipart/form-data" role="form">
    <table align="center" style="margin:10px;">
	
    <tr><section class="form-group" id="title">
        <td><label for="product_title">Product Name:</label></td>
        <td><input id="pi_title" type="text" name="product_title" class="form-control" value="'.$pro_title.'"></td>
    </section></tr><br><br>
    
    <section id="image">
    <tr>
    	<td><label for="product_img1">Change Image 1:</label></td>
		<td> <a href="product_images/'.$pro_image1.'" title="'.$pro_title.'"><img class="tin_image" src="product_images/'.$pro_image1.'"  height="60" width="40" alt="'.$pro_image1.'"></a>	
    	<input type="file" name="product_img1" id="inputfile"></td>
   </tr><br><br>
    <tr>
    	<td> <label for="product_img2">Change Image 2:</label></td>
    	<td> <a href="product_images/'.$pro_image2.'" title="'.$pro_title.'"><img class="tin_image" src="product_images/'.$pro_image2.'"  height="160" width="140" alt="'.$pro_image2.'"></a> 
		<input type="file" name="product_img2" id="inputfile"></td>
    </tr><br><br>
    <tr>
    	<td><label for="product_img3">Change Image 3:</label></td>
    	<td> <a href="product_images/'.$pro_image3.'" title="'.$pro_title.'"><img class="tin_image" src="product_images/'.$pro_image3.'"  height="160" width="140" alt="'.$pro_image3.'"></a>
		<input type="file" name="product_img3" id="inputfile"></td>
    </tr><br><br>
    </section>
    
   	<tr><section id="price" class="input-group">
    	  <td><label for="product_product_price">Price:</label></td>
          <td><input type="text" name="product_price" value="'.$pro_price.'" class="form-control"></td>
    </section></tr><br><br>
    
    <tr><section id="small_description">
    <td><label for="product_area">Small Description:</label></td>
    <td><input type="text" name="product_keywords" value="'.$pro_small_desc.'" maxlength="100" class="form-control"></td>
    </section><br><br></tr>
    
   	<tr><section id="description">
    	 <td><label for="product_area">Description:</label></td>
    	 <td><input type="text" name="product_keywords" value="'.$pro_desc.'" maxlength="500" class="form-control"></td>   	
	</section></tr><br><br>
    
    <tr><section id="keywords">
    	<td><label for="product_keywords">Keywords:</label></td>
    	<td><input type="text" name="product_keywords" value="'.$keywords.'" class="form-control"></td>
    </section></tr><br><br>
   <tr>
	<td><input type="reset" id="clear" value="Clear" class="btn btn-default btn-sm"></td>
    <td><input type="submit" name="edit_product" class="btn btn-success btn-sm" id="submit" value="Save Changes"></td><br><br>
     </table>
</form>';
}
?>
</center>
</core-header-panel>
<br><br>		
	<p><a href="index.php">Go Home</a></p>	
</body>
</html>

<?php
	
	if(isset($_POST['edit_product'])) {
	
	//text data variaables
	
		$product_title=$_POST['product_title'];
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
			
			$insert_product = "insert into products (date,product_title,product_img1,product_img2,product_img3,product_price,product_small_desc,product_desc,product_status) 						values(NOW(),'$product_title','$product_img1','$product_img2','$product_img3','$product_price','$product_small_desc','$product_desc','$product_status') where product_id = $pro_id";
			
			$run_product = mysqli_query($con,$insert_product);
			
			if($run_product)
				echo "<script>alert('yahoo!Changes done successfully') </script>";		
		}		
}	
	
?>
