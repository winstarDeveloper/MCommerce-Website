<?php 
	include("../includes/db.php");
?>
<html>
<head>
<meta charset="UTF-8">
<title>Electronic Shop - Customer Login</title>
<link href="cart.png" rel="icon" />
<link href="../styles/bootstrap.min.css" rel="stylesheet">
<link href="../styles/style.css" rel="stylesheet">
<link rel="import" href="elements.html">
<script src="../components/webcomponentsjs/webcomponents.js"></script>
<script src="../js/jquery.js"></script>
<style>

</style>
<script src="file:///J|/_js/jquery-1.7.2.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
	$('#login').submit(function() {
   var formData = $(this).serialize();
      $.get('login.php',formData,processData).error('ouch');
      function processData(data) {
		  console.log(data);
        if (data=='pass') {
           $('#content').html('<p>You have successfully logged in!</p>');
        } else {
           if (! $('#fail').length) {
             $('#formwrapper').prepend('<p id="fail">Incorrect login information. Please try again</p>');
           }
         }
       } // end processData
       return false;
   }); // end submit
   
    var pull        = $('#pull');  
            menu        = $('nav ul');  
            menuHeight  = menu.height();  
      
        $(pull).on('click', function(e) {  
            e.preventDefault();  
            menu.slideToggle();  
        }); 
		$(window).resize(function(){  
    var w = $(window).width();  
    if(w > 320 && menu.is(':hidden')) {  
        menu.removeAttr('style');  
    }  
		
}); // end ready
    });  
</script>
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
<div>
	<a href="customer/index.php"><core-icon-button icon="account-circle"><?php if(isset($_SESSION['customer'])) {echo $_SESSION['customer']; }?></core-icon-button></a>   
</div>
</core-toolbar>

<nav class="clearfix">  
    <ul class="clearfix">
    <?php
	
	/* Code to Display our Menu (Categories for Products) */
	
		$get_cats = "select * from categories";			//
		$run_cats = mysqli_query($con,$get_cats);		//
		
	//	$get_brands = "select * from brands where cat_id=1";
	//	$run_brands = mysqli_query($con,$get_brands);
				
		while($row_cats = mysqli_fetch_array($run_cats)) {
		
			$cat_id = $row_cats['cat_id'];
			$cat_title = $row_cats['cat_title'];
			
    //    echo "<li><a href='index.php?cat = $cat_id'>$cat_title</a></li>";cat = '.$cat_id.'
		echo ' <li><a href="../results.php?searchbox='.$cat_title.'&go=GO">'.$cat_title.' >></a></li>';
				
				/*	$get_brands = "select * from brands where cat_id=$cat_id";
					$run_brands = mysqli_query($con,$get_brands);	
					while($row_cats = mysqli_fetch_array($run_brands)) {
					
						$cat_id = $row_cats['cat_id'];
						$brand_id = $row_cats['brand_id'];
						$brand_title = $row_cats['brand_title'];
						
	//				echo "<li><a href='index.php?cat = $cat_id&brand = $brand_title'>$brand_title</a></li>";
					echo  '<li><a href="results.php?searchbox='.$brand_title.'&go=GO"">'.$brand_title.'</a></li>';
					}
					//echo '</ul>';
					*/
		}
	?>
</ul>
 <a href="#" id="pull">Categories</a> 
</nav>
<br>
<br>
<form id="search" action="../results.php" class="form-horizontal" name="search" method="get" role="form" enctype="multipart/form-data">
    <div class="col-lg-6"> <div class="input-group">
        <input id="s_search" type="text" name="searchbox" placeholder="Search" class="form-control" />
       <span class="input-group-btn"> 
       <button type="submit" name="search" id="go" class="btn btn-success"> Go! </button> 
       </span> 
       </div><!-- /input-group --> 
       </div><!-- /.col-lg-6 -->  
	</form>
<br>

<div class="wrapper">
	<div id="content">
		<div class="main">
			<h1><U>Customer Login</U></h1>
			<div id="formwrapper">
			<form method="post" action="customer_login.php" id="login">
	
	<div class="form-group">
    	<label for="user" class="col-sm-2 control-label">Customer Name: </label>
		<div class="col-sm-10">
			<input type="text" name="user" class="form-control" id="username" placeholder="Enter Name">
		</div>
	</div>

	<div class="form-group">
		<label for="pass" class="col-sm-2 control-label">Password: </label>
		<div class="col-sm-10">
			<input type="password" name="pass" class="form-control" id="password" placeholder="Enter Password">
		</div>
	</div>
	
    <button class="btn btn-default" type="reset" style="margin:5px;">Reset</button>
    <input type="submit" value="Submit" class="btn btn-success" style="margin:5px;"/>
   </form>
   
</div>
		</div>
	</div>
	
</div>
<?php

if(isset($_POST['user'])) {
	$pass_temp = "";
	$user = $_POST['user'];
	$password = $_POST['pass'];
	$_SESSION['user'] = $_POST['user'];
	$sql = "SELECT * FROM customers";
	
	$run = mysqli_query($con,$sql);	
	
	while($row = mysqli_fetch_array($run)) {
		
			$usr = $row['cust_name'];
			$pass = $row['cust_pass'];
			if($usr == $user) {
				$pass_temp = $pass;
			}
	}
	if($pass_temp == $password) {
		header("location:../index.php");
		session_start();
		$_SESSION['customer'] = $usr;
	} 
	else {
		echo '<p style="font-weight:bold font-size:22px;">--Incorrect Details. Please Enter Correct Credentials--</p>';
	}
}		
?>

<h5 align="right"><a href="create_customer.php">Create New Customer Account</a></h5>
</core-header-panel>
</body>
</html>
