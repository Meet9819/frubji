<?php

$data = $_POST;
$mac_provided = $data['mac'];  
unset($data['mac']); 

$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];

if($major >= 5 and $minor >= 4){
     ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
     uksort($data, 'strcasecmp');
}

/* testing account 4242 4242 4242 4242

Date: Any valid future date

CVV: 111

Name: abc

3D-secure password: 1221

*/
    
  
// testing                                                   Private Salt
//$mac_calculated = hash_hmac("sha1", implode("|", $data), "3734fc97e7504489a4f0389fe6ace619");
//original
$mac_calculated = hash_hmac("sha1", implode("|", $data), "addeee535aa047bf96686d0c4de952a0");


if($mac_provided == $mac_calculated){
    echo "MAC is fine";
    // Do something here
    if($data['status'] == "Credit"){
       // Payment was successful, mark it as completed in your database  
                
                $to = 'meetshah9819@gmail.com';
                $subject = 'Website Payment Request ' .$data['buyer_name'].'';
                $message = "<h1>Payment Details</h1>";
                $message .= "<hr>";
                $message .= '<p><b>ID:</b> '.$data['payment_id'].'</p>';
                $message .= '<p><b>Amount:</b> '.$data['amount'].'</p>';
                $message .= "<hr>";
                $message .= '<p><b>Name:</b> '.$data['buyer_name'].'</p>';
                $message .= '<p><b>Email:</b> '.$data['buyer'].'</p>';
                $message .= '<p><b>Phone:</b> '.$data['buyer_phone'].'</p>';
                
                
                $message .= "<hr>";

              
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                // send email
                mail($to, $subject, $message, $headers);




    }
    else{
       // Payment was unsuccessful, mark it as failed in your database
    }
}
else{
    echo "Invalid MAC passed";
}
?>
