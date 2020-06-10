<?php 
	include("includes/db.php");
	session_start(); //Start the Session
?>
<html>
<head>
<meta charset="UTF-8">
<title>Electronic Shop - Admin Login</title>
<link href="../styles/bootstrap.min.css" rel="stylesheet">
<link href="../styles/style.css" rel="stylesheet">
<link rel="import" href="elements.html">
<link rel="import" href="../components/polymer/polymer.html">
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="components/webcomponentsjs/webcomponents.js"></script>
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
		
}); // end ready
</script>
</head>

<body fullbleed layout vertical>
<core-header-panel mode="waterfall-tall" flex>
<core-toolbar>
<!--<core-icon-button icon="menu"></core-icon-button>-->
<div flex>		
 <a href="index.php"><img src="../images/logo.png" height="50px" width="80px" alt="Plastic Electronics"></a>
</div> 
<span flex></span>
</core-toolbar>

<div class="wrapper">
	<div id="content">
		<div class="main">
			<h1><U>Admin Login</U></h1>
			<div id="formwrapper">
			<form method="post" action="admin_login.php" id="login">
	<p>
	<div class="form-group">
    	<label for="user" class="col-sm-2 control-label">UserName: </label>
		<div class="col-sm-10">
			<input type="text" name="user" class="form-control" id="username"
			placeholder="Enter UserName">
		</div>
	</div><br>
    <div class="form-group">
		<label for="pass" class="col-sm-2 control-label">Password: </label>
		<div class="col-sm-10">
			<input type="password" name="pass" class="form-control" id="password"
			placeholder="Enter Password">
		</div>
	</div>
	<br>
    <input type="submit" value="Submit" class="btn btn-success" style="margin:5px;">
    <button class="btn btn-default" type="reset" style="margin:5px;">Reset</button>
    <br>
   </form>
</div>
		</div>
	</div>
	
</div>
<?php

if(isset($_POST['user'])  && isset($_POST['pass'])) {
	$user = $_POST['user'];
	$password = $_POST['pass'];
	$_SESSION['user'] = $_POST['user'];
	$sql = "SELECT * FROM myadmin";
	
	$run = mysqli_query($con,$sql);	
	
	while($row = mysqli_fetch_array($run)) {
		
			$usr = $row['admin_user'];
			$pass = $row['admin_pass'];
			if($usr == $user) {
				$pass_temp = $pass;
			}
	}
	if($pass_temp == $password) {
		header("location:index.php");
	} 
	else {
		echo '<p style="font-weight:bold font-size:22px;">--Incorrect Details. Please Enter Correct Credentials--</p>';
	}
}		
?>
</core-header-panel>
</body>
</html>
