<?php
session_start();
if($_SESSION['UserType']=="Admin"){
	include '../../conn.php';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(!empty($_GET['id'])) 
	{
		$id = checkInput($_GET['id']);
	}
	if(!empty($_POST)) 
	{
		$id = checkInput($_POST['id']);
		mysqli_query($conn, "DELETE FROM categories WHERE idCategory = '$id'");	
		header("Location: categories.php"); 
	}
}else{
	header('location:../../logout.html');
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
	<link href="../../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="../../bootstrap-4.1.3-dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="../../bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/w3.css">
	<script type="text/javascript" src="../../js/java.js"></script>
	<title>Delete Categories</title>
</head>

<body>
	<div class="container" style="position: absolute;top: 25%;bottom: 25%;left: 0;right: 0;margin: auto; background-color: #e67e22!important; border-radius: 50px">
		<center>
			<br/>
			<br/>	
			<h1><strong>Delete element</strong></h1>
			<br/>
			<form class="form-horizontal" action="deleteCategories.php" role="form" method="post">

				<div class="form-group">					
					<input type="hidden" name="id" value="<?php echo $id;?>"/>
					<p class="alert alert-warning col-lg-12">Are you sure you want to delete this category?</p>
					<br/>
					<br/>
					<br/>
					<div class="form-actions">
						<button type="submit" class="btn btn-warning">Accept</button>
						<a class="btn btn-default" href="categories.php">Cancel</a>
					</div>
				</div>		
			</form>				
		</center>
	</div>   
</body>
</html>
