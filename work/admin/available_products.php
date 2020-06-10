<?php 
	include("includes/db.php");
	session_start();
	if (!isset($_SESSION["user"])) {
    header("location: admin_login.php"); 
    exit();
}
?>
<?php
	//To remove an Item from the Database
	if(isset($_POST['rem'])){
	if(isset($_POST['rem']) && $_POST['rem']!=""){
		$key_to_remove = $_POST['rem'];
		$delete_product = "delete from products where product_id = '$key_to_remove'";
		$run_products = mysqli_query($con,$delete_product);
	}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel - Available Products</title>
</head>
<link href="../styles/bootstrap.min.css" rel="stylesheet" />
<link type="text/css" href="../styles/style.css" rel="stylesheet" />
<link rel="import" href="elements.html">
<script src="../components/webcomponentsjs/webcomponents.js"></script>
<body>
<body fullbleed layout vertical>
<core-header-panel mode="waterfall" flex>
<core-toolbar>
<!--<core-icon-button icon="menu"></core-icon-button>-->
<div style="float:left;">		
 <a href="index.php"><img src="../images/logo.png" height="50px" width="80px" alt="Plastic Electronics"></a>
</div> 
<span flex></span>
<div>
		<core-icon-button icon="account-circle"><br /><?php if(isset($_SESSION['user'])) {echo "  ".$_SESSION['user']; }?></core-icon-button>
</div>    
</div>
</core-toolbar>
<?php
		for($i=1;$i<4;$i++) {
		$get_products = "select * from products where cat_id = '$i'";
				
		$run_products = mysqli_query($con,$get_products);
		switch($i){
			case 1:echo "<h2>Laptops</h2>";
					break;
			case 2:echo "<h2>Mobiles</h2>";
					break;
			case 3:echo "<h2>Cameras</h2>";
					break;
			default:echo "";
					break;
		}
				echo '<table class="table table-striped table-bordered table-hover table-condensed" border="1px" width="338pxauto" align="center" style="margin:10px;">
				<thead>	<tr class="success">
				<td width="70px" align="center">Product ID</td>	
				<td align="center">Name</td>
				<td align="center">Brand</td>
				<td align="center">Available</td>
				<td align="center">Price</form></td>
			 </tr></thead><tbody>';
				while($row_products = mysqli_fetch_array($run_products)) {
					
					$pro_id = $row_products['product_id'];
					$pro_title = $row_products['product_title'];
					$pro_status = $row_products['product_status'];
					$pro_image = $row_products['product_img3'];
					$pro_price = $row_products['product_price'];
					$brand_id = $row_products['brand_id'];
					$get_brand = "select * from brands where brand_id = '$brand_id'";
					$run_products = mysqli_query($con,$get_brand);
					while($row_products = mysqli_fetch_array($run_products)) {
						$pro_brand = $row_products['brand_title'];
					}
					if($pro_status == 'on') {
					$pro_status	= "YES";
					}else {
					$pro_status	= "NO";
					}			
					echo ' 
				<tr>
				<td align="center">'.$pro_id.'</td>	
				<td align="center">'.$pro_title.'<br><img id="disp_image" src="product_images/'.$pro_image.'" class="img-rounded" height="80" width="80" alt="'.$pro_image.'"></td>
				<td align="center">'.$pro_brand.'</td>
				<td align="center">'.$pro_status.'</td>
				<td align="center">'.$pro_price.'</td>
			 </tr>';
			} 
			echo '</tbody></table>';
			}
?>
<br><br>		
	<p><a href="index.php">Go Home</a></p>	
</core-header-panel>
</body>
</html>
