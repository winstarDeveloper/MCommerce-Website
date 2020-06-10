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
<title>Admin Manager</title>
<link href="../styles/bootstrap.min.css" rel="stylesheet">
<link href="../styles/style.css" rel="stylesheet">
<link rel="import" href="elements.html">
<script src="../components/webcomponentsjs/webcomponents.js"></script>
</head>


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
			<h1 align="center">  Add New Admin</h1><br /><br />
			<div id="formwrapper">
			<form method="post" action="admin_manager.php" action="index.php" id="login">
	<p>
	<div class="form-group">
    	<label for="username" class="col-sm-2 control-label">New Administrator: </label>
		<div class="col-sm-10">
			<input type="text" name="user" class="form-control" id="username"
			placeholder="Enter AdminName">
		</div>
	</div>
	<br />
	<div class="form-group">
		<label for="password" class="col-sm-2 control-label"> Set Password: </label>
		<div class="col-sm-10">
			<input type="password" name="pass" class="form-control" id="password"
			placeholder="Password">
		</div>
	</div>
    <input type="submit" value="Submit" class="btn btn-success" style="margin:5px;">
    <button class="btn btn-default" type="reset" style="margin:5px;">Reset</button>
   </form>
   
   <h1 align="center">  Delete Admin</h1><br />
   <?php
   		$get_admins = "select * from myadmin";
		$run = mysqli_query($con,$get_admins);
		echo '<table class="table table-striped table-bordered table-hover table-condensed" border="1px" align="center" style="margin:10px;">
				<thead>	<tr class="success">
				<td width="70px" align="center">Admin ID</td>	
				<td align="center">Name</td>
				<td align="center">Created by</td>
				<td align="center">Remove</form></td>
			 </tr></thead><tbody>';
		while($row_products = mysqli_fetch_array($run)) {
					
					$admin_id = $row_products['admin_id'];
					$admin = $row_products['admin_user'];
					$creator = $row_products['created_by'];
								
					echo ' 
				<tr>
				<td align="center">'.$admin_id.'</td>	
				<td align="center">'.$admin.'</td>
				<td align="center">'.$creator.'</td>
				<td align="center"><form action="admin_manager.php" method="post" name="remove"><input name="rem" type="hidden" value="'.$admin_id.'" /><input name="deleteBtn" type="submit" class="btn btn-danger" value="X" style="margin:5px;"/></form></td>
			 </tr>';
			} 
			echo '</tbody></table>';
   ?>
<br><br>		
	<p><a href="index.php">Go Home</a></p>	
</core-header-panel>
</body>
</html>
<?php
	//To remove admin from the Database
	if(isset($_POST['rem'])){
	if(isset($_POST['rem']) && $_POST['rem']!=""){
		$key_to_remove = $_POST['rem'];
		$delete_admin = "delete from myadmin where admin_id = '$key_to_remove'";
		$run_query = mysqli_query($con,$delete_admin);
	}
	}
?>
<?php
if(isset($_POST['user']) && isset($_POST['pass'])){
	$admin_name = $_POST['user'];
	$admin_pass = $_POST['pass'];
	$creator = $_SESSION['user'];
	$insert_admin = "INSERT INTO myadmin (admin_user,admin_pass,created_by) values('$admin_name','$admin_pass','$creator')";
	$run_products = mysqli_query($con,$insert_admin);
	//if(mysqli_error()) {
		//echo "<p>Error Inserting Admin</p>";
	//}else {
		echo "<br><br><p>Admin Successfully Inserted.</p>";
	//}	
	}
	
?>
