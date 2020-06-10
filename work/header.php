<!DOCTYPE html><head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 

<title>E - Commerce on Mobile</title>

<link href="cart.png" rel="icon" />
<link href="styles/bootstrap.min.css" rel="stylesheet" />
<link href="fancybox/jquery.fancybox-1.3.4.css" rel="stylesheet" />
<link rel="import" href="elements.html">
<link rel="stylesheet" type="text/css" href="Swipe-master/style.css" />
<link href="styles/style.css" rel="stylesheet" />
<script type="text/javascript" src="Swipe-master/swipe.js"></script>
<script type="text/javascript" src="Swipe-master/Gruntfile.js"></script>
<script src="components/webcomponentsjs/webcomponents.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="fancybox/jquery.fancybox-1.3.4.min.js"></script>
<script src="js/app.js"></script>
<script>
$('document').ready(function() {
		$('#t_image a').fancybox();
});
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

<core-drawer-panel id="drawerPanel">
    <core-header-panel drawer>
    	<core-toolbar>Menu<paper-ripple fit></paper-ripple></core-toolbar><paper-ripple fit></paper-ripple>
        	<core-menu>
            	<core-item label="Home"><a href="index.php"></a></core-item>
                <core-item label="Shopping Cart"><a href="cart.php"></a></core-item>
                <core-item label="About Us"><a href="about_us.php"></a></core-item>
                <core-item label="Help"><a href="help.php"></a></core-item>
            </core-menu>
    </core-header-panel>
    
<core-header-panel main mode="waterfall-tall" ><paper-ripple fit></paper-ripple>
<core-toolbar>
<core-icon-button id="navicon" icon="menu"></core-icon-button>
<div><a href="index.php"><img id="logo" src="images/logo.png" alt="Plastic Electronics" style="margin:0;"></a>
</div>
<span flex></span>
<div>
	<a href="cart.php"><core-icon-button icon="shopping-cart" ></core-icon-button></a>
</div>
<div>
	<a href="customer/index.php"><core-icon-button icon="account-circle"><?php if(isset($_SESSION['customer'])) {echo $_SESSION['customer']; }?></core-icon-button></a>   
</div>
     <!-- <div style="float:left;  margin:10px;"><a href="cart.php"> <img id="cart" src="images/shopping_cart.jpeg" height="20px" width="30px" alt="MyCart" align="right"> </a> </div>
        <div  style="float:right; margin:10px;">
            <a href="customer/index.php"> <img id="user" src="images/log_user.png" height="20px" width="30px" alt="MyAccount" align="right"></a><br><br><p style="color:#333333;">-->

<div class="middle">
<!-- form for adding search bar-->
	<form  align="center" id="search" action="results.php" name="search" method="get" role="form" enctype="multipart/form-data" style="margin:10px;">
    <div class="col-lg-6"> <div class="input-group">
       <input id="s_search" type="text" name="searchbox" placeholder="Search" class="form-control" />
       <span class="input-group-btn"> 
       <input type="submit" name="go" id="go" class="btn btn-success" value="GO" />
       </span> 
       </div><!-- /input-group --> 
       </div><!-- /.col-lg-6 -->  
	</form>
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
 