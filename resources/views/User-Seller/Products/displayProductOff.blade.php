<<<<<<< HEAD

<?php

	session_start();
	if($_SESSION['activity']==0){
		header('location:login.php');
	}
	if(isset($_SESSION['email'])){
	include 'conn.php';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	$id = checkInput($_GET['id']);
	mysqli_query($conn, "UPDATE products SET status = 'Off' WHERE idProduct = '$id'");	
	echo "<script>window.location.href='/user-seller/products'</script>";
}
function checkInput($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;    
}
?>
=======

<?php

	session_start();
	if($_SESSION['activity']==0){
		header('location:login.php');
	}
	if(isset($_SESSION['email'])){
	include 'conn.php';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	$id = checkInput($_GET['id']);
	mysqli_query($conn, "UPDATE products SET status = 'Off' WHERE idProduct = '$id'");	
	echo "<script>window.location.href='/user-seller/products'</script>";
}
function checkInput($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;    
}
?>
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
