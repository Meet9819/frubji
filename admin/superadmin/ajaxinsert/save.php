<?php
	include '../conn.php'; 
         $patientname=$_POST['patientname'];
		 $address=$_POST['address'];  
		 $patientemail=$_POST['patientemail'];
  		 $gender=$_POST['gender'];
         $dob=$_POST['dob'];
         $marriagedate=$_POST['marriagedate'];
		 $firstname=$_POST['firstname'];
         $lastname=$_POST['lastname'];
         $whatsappno=$_POST['whatsappno'];    
         $patientmobile=$_POST['patientmobile']; 		
		 $patientqatarid=$_POST['patientqatarid']; 
         $qidexpiry=$_POST['qidexpiry'];
     	 $sql = "INSERT INTO `walkin_customer`(`patientname`,`address`, `patientemail`,`gender`, `dob`, `marriagedate`,`firstname`,`lastname`,`whatsappno`,`patientmobile`,`patientqatarid`,`qidexpiry`) 
		VALUES ('$patientname','$address','$patientemail','$gender','$dob','$marriagedate','$firstname','$lastname','$whatsappno','$patientmobile','$patientqatarid','$qidexpiry')";

		if (mysqli_query($conn, $sql)) 
		{
			echo json_encode(array("statusCode"=>200));
		} 
		else 
		{
			echo json_encode(array("statusCode"=>201));
		}
		mysqli_close($conn);
?>