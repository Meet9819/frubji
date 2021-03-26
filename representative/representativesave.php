

<?php
	include 'database.php';

	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$mobileno=$_POST['mobileno'];
	$emailid=$_POST['emailid'];
	$password=$_POST['password'];
	$address=$_POST['address'];

	$city=$_POST['city'];
	$state=$_POST['state'];
	$pincode=$_POST['pincode'];


	$sql = "INSERT INTO `representative`( `firstname`, `lastname`, `mobileno`, `emailid`,  `password`, `address`, `city`,  `state`, `pincode`) 
	VALUES ('$firstname', '$lastname', '$mobileno', '$emailid', '$password', '$address', '$city', '$state', '$pincode')";
	if (mysqli_query($conn, $sql)) {
		

		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>