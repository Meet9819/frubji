     <?php 
	   include "../conn.php";

	 $_POST['status'];
	 $_POST['adminmessage'];
	 $_GET["order_id"];

	   $updatestatus = "UPDATE complaintbox SET status = '".$_POST['status']."', adminmessage = '".$_POST['adminmessage']."'
	    WHERE id= '" . $_GET["order_id"] . "' "; 



	   $query = mysqli_query($conn, $updatestatus) or die(mysqli_error($conn));

	       $errors = '';
                    
                    $myemail = 'meetshah9819@gmail.com';
                    
                    if (!preg_match(
                    "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
                    $email_address))
                    {
                        $errors .= "\n Error: Invalid email address";
                    }
                    
                    $to = $myemail;
                    $email_subject = "Complaint - FRUBJI";
                    $email_body = "You have received a new message.  ";
                    $headers = "From: $myemail\n";
                    
                    $headers .= "Reply-To: $email_address";
                    mail($to,$email_subject,$email_body,$headers);



	  header('location:../complaintbox.php');

	?> 
               