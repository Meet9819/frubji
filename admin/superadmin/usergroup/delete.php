<?php
	include('../conn.php');
 	$role_rolecode=$_GET['role_rolecode']; 
	mysqli_query($conn,"delete from role_rights where rr_rolecode='$role_rolecode'"); 
	mysqli_query($conn,"delete from role where role_rolecode='$role_rolecode'"); 


		
	header('location:../usergroup.php');

?>