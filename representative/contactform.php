

<?php
	include 'database.php';

	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$mobile=$_POST['mobile'];
	$email=$_POST['email'];
	$subject=$_POST['subject'];
	$message=$_POST['message'];



	$sql = "INSERT INTO `e_contact`( `firstname`,`lastname`, `mobile`,  `email`, `subject`, `message`) 
	VALUES ('$firstname','$lastname','$mobile', '$email', '$subject', '$message')";
	if (mysqli_query($conn, $sql)) {
		

		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
	mysqli_close($conn);
?>