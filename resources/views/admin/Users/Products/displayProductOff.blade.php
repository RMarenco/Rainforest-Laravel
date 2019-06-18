<?php
session_start();	
	if(isset($_SESSION['email'])){
	include 'conn.php';
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	$id = checkInput($_GET['id']);
	mysqli_query($conn, "UPDATE products SET status = 'Off' WHERE idProduct = '$id'");	
	echo "<script>history.go(-1)</script>";
}
function checkInput($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;    
}
?>
