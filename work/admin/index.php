<?php 
	include_once("header.php");
	session_start(); //Start the Session
	if (!isset($_SESSION["user"])) {
    header("location: admin_login.php"); 
    exit();
}
?>
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
<section align='center'>
<ul>
	<li><a href="admin_manager.php"><button type="button" class="btn btn-success btn-lg" data-toggle="dropdown" style="width:280px; margin:10px;">       Admin Manager </button></a></li>
	<li><a href="insert_product.php"><button type="button" class="btn btn-success btn-lg" data-toggle="dropdown" style="width:280px; margin:10px;">       Insert a Product </button></a></li>
	<li><a href="change_product.php"><button type="button" class="btn btn-success btn-lg" data-toggle="dropdown" style="width:280px; margin:10px;">       Change a Product </button></a></li>
	<li><a href="delete_products.php"><button type="button" class="btn btn-success btn-lg" data-toggle="dropdown" style="width:280px; margin:10px;">       Delete a Product </button></a></li>
	<li><a href="available_products.php"><button type="button" class="btn btn-success btn-lg" data-toggle="dropdown" style="width:280px; margin:10px;">       View Available Products </button></a></li>
    <li><a href="customer_manager.php"><button type="button" class="btn btn-success btn-lg" data-toggle="dropdown" style="width:280px; margin:10px;">       Customer Manager </button></a></li>
</ul>
</section>
</core-header-panel>
</body>
</html>
