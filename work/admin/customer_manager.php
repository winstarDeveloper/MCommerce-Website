<?php 
	include("includes/db.php");
	session_start(); //Start the Session
	if (!isset($_SESSION["user"])) {
    header("location: admin_login.php"); 
    exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customer Manager</title>
<link href="../styles/bootstrap.min.css" rel="stylesheet">
<link href="../styles/style.css" rel="stylesheet">
<link rel="import" href="elements.html">
<script src="../components/webcomponentsjs/webcomponents.js"></script>
</head>


<body fullbleed layout vertical>
<core-header-panel mode="waterfall" flex>
<core-toolbar>
<!--<core-icon-button icon="menu"></core-icon-button>-->
<div style="float:left;">		
 <a href="index.php"><img src="../images/logo.png" height="50px" width="80px" alt="Plastic Electronics"></a>
</div> 
<span flex></span>
<div>
		<core-icon-button icon="account-circle"><?php if(isset($_SESSION['user'])) {echo $_SESSION['user']; }?></core-icon-button>
</div>
</core-toolbar>

<h2 align="center">  Delete Customer</h2><br /><br />
<?php
   		$get_customers = "select * from customers";
		$run = mysqli_query($con,$get_customers);
		echo '<table class="table table-striped table-bordered table-hover table-condensed" border="1px" width="330pxauto" align="center" style="margin:10px;">
				<thead>	<tr class="success">
				<td width="70px" align="center">Customer ID</td>	
				<td align="center">Name</td>
				<td align="center">Gender</td>
				<td align="center">Age</td>
				<td align="center">Remove</form></td>
			 </tr></thead><tbody>';
		while($row_products = mysqli_fetch_array($run)) {
					
					$cust_id = $row_products['cust_id'];
					$customer = $row_products['cust_name'];
					$gender = $row_products['cust_gender'];
					$age = $row_products['cust_age'];				
					echo ' 
				<tr>
				<td align="center">'.$cust_id.'</td>	
				<td align="center">'.$customer.'</td>
				<td align="center">'.$gender.'</td>
				<td align="center">'.$age.'</td>
				<td align="center"><form action="customer_manager.php" method="post" name="remove"><input name="rem" type="hidden" value="'.$cust_id.'" /><input name="deleteBtn" type="submit" class="btn btn-danger" value="X" style="margin:5px;"/></form></td>
			 </tr>';
			} 
			echo '</tbody></table>';
   ?>
   
<br><br>
<h2 align="center"> Create New Customer </h2><br /><p align="center"><a href="../customer/create_customer.php">Click Here</a></p>
<br /><br />		
	<p><a href="index.php">Go Home</a></p>	
</core-header-panel>
</body>
</html>
<?php
	//To remove customer from the Database
	if(isset($_POST['rem'])){
	if(isset($_POST['rem']) && $_POST['rem']!=""){
		$key_to_remove = $_POST['rem'];
		$delete_customer = "delete from customers where cust_id = '$key_to_remove'";
		$run_query = mysqli_query($con,$delete_customer);
	}
	}
?>