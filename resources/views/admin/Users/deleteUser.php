<?php
session_start();
if($_SESSION['UserType']=="Admin"){
	include '../../conn.php';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(!empty($_GET['Id'])) 
	{
		$Id = checkInput($_GET['Id']);
	}
	if(!empty($_POST)) 
	{
		$Id = checkInput($_POST['Id']);
		mysqli_query($conn, "DELETE FROM users WHERE Id = '$Id'");	
		echo "<script type='text/javascript'>";
		echo "window.history.go(-2)";
		echo "</script>";
		
	}
}else{
	header("Location:../../logout.php");
}
function checkInput($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;    
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="text/css" href="../../Gallery/Icon/settings-admin.ico">	
  	<script type="text/javascript" src="../../js/jquery.min.js"></script>
  	<link href="../../bootstrap-4.1.3-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  	<script src="../../bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
  	<link rel="stylesheet" type="text/css" href="../../css/MultiLevelMenu.css">
	<link rel="stylesheet" type="text/css" href="../../css/Menu.css">
	<link rel="stylesheet" type="text/css" href="../../css/Fonts.css">
	<link rel="stylesheet" type="text/css" href="../../css/Products.css">
  	<script type="text/javascript" src="../../js/java.js"></script>	
  	<script src="../../js/modernizr.custom.js"></script>
	<title>Delete User</title>
</head>
<body>
	<div class="container" style="height:50%;position: absolute;top: 25%;bottom: 25%;left: 0;right: 0;margin: auto; background-color: #0f0f0f!important; border-radius: 50px; padding: 0">
		<center>
			<br/>
			<br/>	
			<h1><strong>Delete element</strong></h1>
			<br/>
			<form class="form-horizontal" action="deleteUser.php" role="form" method="post">

				<div class="form-group">					
					<input type="hidden" name="Id" value="<?php echo $Id;?>"/>
					<p class="alert alert-warning col-lg-12">Are you sure you want to delete this user?</p>
					<br/>
					<br/>
					<br/>
					<div class="form-actions">
						<input type="submit" class="btn btn-warning" value="Accept">
						<?php echo "<a href='javascript:history.back(1)'>Cancel</a>"; ?>
					</div>
				</div>		
			</form>				
		</center>
	</div>   
</body>
</html>
