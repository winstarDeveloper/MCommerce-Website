<?php 
	include('../includes/db.php');
	session_start(); //Start the Session
?>
<!DOCTYPE html><head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title>Electronics Store - Customer Details</title>

<link href="cart.png" rel="icon" />
<link href="../styles/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="../styles/style.css">
<link rel="import" href="elements.html">
<script src="../components/webcomponentsjs/webcomponents.js"></script>
</head>
<body>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
$(function() {  
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
});  
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
		echo ' <li><a href="results.php?searchbox='.$cat_title.'&go=GO">'.$cat_title.' >></a></li>';
				
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
<br><br>
<center>
<!-- form for adding search bar-->

	<form id="search" action="results.php" class="form-horizontal" name="search" method="get" role="form" enctype="multipart/form-data">
    <div class="col-lg-6"> <div class="input-group">
    	<span class="input-group-btn">
        <input id="s_search" type="text" name="searchbox" placeholder="Search" class="form-control" /> 
       <button type="submit" name="search" id="go" class="btn btn-success"> Go! </button> 
       </span> 
       </div><!-- /input-group --> 
       </div><!-- /.col-lg-6 -->  
	</form>
    
 <br><br>


<?php
	if(isset($_SESSION['customer'])) {
		$customer = (isset($_SESSION['customer'])) ? ($_SESSION['customer']):NULL;
   		$get_customers = "select * from customers where cust_name = '$customer'";
		$run = mysqli_query($con,$get_customers);
		echo '<table class="table table-striped table-bordered table-hover table-condensed" border="1px" width="330px align="center" style="margin:5px;"">
				<tbody>';
		while($row_products = mysqli_fetch_array($run)) {
					
					$cust_id = $row_products['cust_id'];
					$customer = $row_products['cust_name'];
					$address = $row_products['cust_address'];
					$gender = $row_products['cust_gender'];
					$age = $row_products['cust_age'];				
					echo ' 
				<tr>
				<td width="70px" align="center">Customer Name:</td>		
				<td align="center">'.$customer.'</td>
				</tr>
				<tr>
				<td align="center">Address:</td>
				<td align="center">'.$address.'</td>
				</tr>
				<tr>
				<td align="center">Gender:</td>
				<td align="center">'.$gender.'</td>
				</tr>
				<tr>
				<td align="center">Age:</td>
				<td align="center">'.$age.'</td>
				</tr>';
			} 
			echo '</tbody></table>';
			echo ' <br /><br />
   <form action="index.php" method="post"><input align="center" class="btn btn-warning" type="submit" value="logout" /></form><br />';
			}
			else {
			echo '<br><br><a href="customer_login.php"><button type="button" class="btn btn-success btn-lg" style="width:320px; margin:10px;">       Customer Login </button></a><br><br>';
			}
   ?>
   <a href="../index.php">Go Home</a>
</center>   
</core-header-panel>
</body>
</html>
   <?php
   	if(isset($_POST['logout'])){
		session_destroy(); //Stop the Session
   }
   ?>
