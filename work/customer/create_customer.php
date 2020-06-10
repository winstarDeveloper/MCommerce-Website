<?php
	include("../includes/db.php");
	$cust_img = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Electronics Shop - Create New Customer</title>
<link href="../styles/bootstrap.min.css" rel="stylesheet">
<link href="../styles/style.css" rel="stylesheet">
<link rel="import" href="elements.html">
<script src="../components/webcomponentsjs/webcomponents.js"></script>
<style>
	table,button,input {
		margin:10px;
	}
</style>
</head>

<body fullbleed layout vertical>
<core-header-panel mode="waterfall" flex>
<core-toolbar>
<!--<core-icon-button icon="menu"></core-icon-button>-->
<div style="float:left;">		
 <a href="../index.php"><img src="../images/logo.png" height="50px" width="80px" alt="Plastic Electronics"></a>
</div> 
<span flex></span>
<div>
	<a href="cart.php"><core-icon-button icon="shopping-cart" ></core-icon-button></a>
</div>
</core-toolbar>
<br />
<div class="wrapper">
	<div id="content">
		<div class="main">
			<h1><U>Create Customer</U></h1>
            <br />
			<div id="formwrapper">
            
			<form method="post" action="create_customer.php" id="create_customer">
	<p>
	<div class="form-group">
    	<label for="username" class="col-sm-2 control-label">Customer Name: </label>
		<div class="col-sm-10">
			<input type="text" name="user" class="form-control" id="username"
			placeholder="Enter Name">
		</div>
	</div>
	<br />
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label">Set Password: </label>
		<div class="col-sm-10">
			<input type="password" name="pass" class="form-control" id="password"
			placeholder="Enter Password">
		</div>
	</div>
	<br />
    <div class="form-group">
    	<label for="address" class="col-sm-2 control-label">Address: </label>
		<div class="col-sm-10">
			<input type="text" name="address" class="form-control" id="address"
			placeholder="Address">
		</div>
	</div>
    <br />
    <div class="form-group">
    	<label for="age" class="col-sm-2 control-label">Age: </label>
		<div class="col-sm-10">
			<input type="text" name="age" class="form-control" id="age"
			placeholder="Should be Above 18">
		</div>
	</div>
    </br> 
    <div class="form-group">
    	<label for="gender" class="col-sm-2 control-label">Gender: </label>
		<div class="col-sm-10">
			<input type="radio" name="gender" id="gender" value="Male">		Male	
            <input type="radio" name="gender"  id="gender" value="Female">		Female
		</div>
	</div>
    <br><br>
    <table><tr>
    <td><input type="submit" name="insert_customer" value="Submit" class="btn btn-success" style="margin:5px;"></td>
    <td><button class="btn btn-default" type="reset" style="margin:5px;">Reset</button></td>
    </tr></table>
   </form>
</div>
		</div>
	</div>
</div>	
</core-header-panel>
<br />
<a href="customer_login.php">Go to Customer Login Page</a>
<br /><br />
</body>
</html>
<?php
	
	if(isset($_POST['insert_customer'])) {
	
	//text data variaables
	
		$cust_name = $_POST['user'];
		$cust_pass = $_POST['pass'];
		$cust_address = $_POST['address'];
		$cust_gender = $_POST['gender'];
		$cust_age = $_POST['age'];
		
		if($cust_name == '' OR $cust_pass == '' OR $cust_address == ''   OR $cust_gender == '' OR $cust_age == '')
		{
			echo "<script>alert('Please put everything') </script>";
			exit();
		}
		else
		{
			$insert_customer = "INSERT INTO customers (cust_name,cust_pass,cust_address,cust_gender,cust_age) 						VALUES('$cust_name','$cust_pass','$cust_address','$cust_gender','$cust_age')";
			
			$run_customer = mysqli_query($con,$insert_customer);
			
			if($run_customer) {
				echo "<script>alert('yahoo!Customer inserted successfully'); </script>";		
			}	
			if($run_customer) {
				header("location:customer_login.php");
			}
		}		
}	
	
?>
