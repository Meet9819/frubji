<?php
	include('../conn.php');
	$id=$_GET['id'];
	mysqli_query($conn,"DELETE from company where id='$id'"); 
	mysqli_query($conn,"DELETE from company_telephone where companyid='$id'"); 
	mysqli_query($conn,"DELETE from companyimages where idd='$id'"); 
	mysqli_query($conn,"DELETE from alllogs where idd='$id' and whichtable = 'COMPANY'"); 

	header('location:../companymaster.php');

?>