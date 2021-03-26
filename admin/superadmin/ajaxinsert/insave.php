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
		 $insuranceid=$_POST['insuranceid'];    
         $insurancepatientscompanyid=$_POST['insurancepatientscompanyid']; 		
		 $policyno=$_POST['policyno']; 
         $expiry=$_POST['expiry']; 
		$sql = "INSERT INTO `insurance_customer`(`patientname`,`address`, `patientemail`,`gender`, `dob`, `marriagedate`,`firstname`,`lastname`,`whatsappno`,`patientmobile`,`patientqatarid`,`qidexpiry`,`insuranceid`,`insurancepatientscompanyid`,`policyno`,`expiry`) 
		VALUES ('$patientname','$address','$patientemail','$gender','$dob','$marriagedate','$firstname','$lastname','$whatsappno','$patientmobile','$patientqatarid','$qidexpiry','$insuranceid','$insurancepatientscompanyid','$policyno','$expiry')";

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