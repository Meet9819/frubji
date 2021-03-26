<?php
	include('../conn.php');
	$id=$_GET['id'];
	mysqli_query($conn,"delete from branch where id='$id'");
	mysqli_query($conn,"delete from branch_telephone where branchid='$id'");
	mysqli_query($conn,"delete from branchpincode where branchid='$id'");
	mysqli_query($conn,"delete from branchimages where idd='$id'"); 
	header('location:../branchmaster.php');

?>