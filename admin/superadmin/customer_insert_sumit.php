<?php
require_once('dist/geoPlugin.php'); 
$geoplugin = new geoPlugin();
$geoplugin->locate();

session_start();
  $employeename = $_SESSION['username']; 
?>



<?php
if(isset($_POST['submit'])){
    // Include the database configuration file
    include_once 'bulkimageupload/pconfig.php';
    
    // File upload configuration
    $targetDir = "../media/customer/";
    $allowTypes = array('jpg','png','jpeg','gif','JPG','JPEG','PNG','mp4', 'avi', 'mov','pdf', 'docx', 'ppt', 'pptx', 'xls', 'xlsx');
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            // File upload path
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            $idd = $_POST['id'];
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                    // Image db insert sql
                    $insertValuesSQL .= "('".$idd."','".$fileName."', NOW()),";
                }else{
                    $errorUpload .= $_FILES['files']['name'][$key].', ';
                }
            }else{
                $errorUploadType .= $_FILES['files']['name'][$key].', ';
            }
        }
        
        if(!empty($insertValuesSQL)){
            $insertValuesSQL = trim($insertValuesSQL,',');


            // Insert image file name into database
            $insert = $db->query("INSERT INTO customerimages (idd, file_name, uploaded_on) VALUES $insertValuesSQL");
            if($insert){
                $errorUpload = !empty($errorUpload)?'Upload Error: '.$errorUpload:'';
                $errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
                $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
                $statusMsg = "Files are uploaded successfully.".$errorMsg;
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }
    }else{
        $statusMsg = 'Please select a file to upload.';
    }
    
    // Display status message
    echo $statusMsg;
}
?>


 


 <?php
include ("db.php");

if(isset($_POST["submit"]))
  {    $id = $_POST['id'];   
        $code = $_POST['code'];     
        $customername = $_POST['customername'];     
        $customername_ar = $_POST['customername_ar'];     
        $chqprintname = $_POST['chqprintname'];     
        $accounthead = $_POST['accounthead'];     
        $address = $_POST['address'];     
        $creditlimits = $_POST['creditlimits'];     
        $creditdays = $_POST['creditdays'];     
        $gracelimit = $_POST['gracelimit'];     
        $gracedays = $_POST['gracedays'];     
        $type = $_POST['type'];     
        $ctelephone = $_POST['ctelephone'];     
        $cmobile = $_POST['cmobile'];     
        $fax = $_POST['fax'];     
        $cemail = $_POST['cemail'];     
        $oldcode = $_POST['oldcode'];     
        $status = $_POST['status'];     
        $location = $_POST['location'];  
        $customergroup = $_POST['customergroup'];    
        $billingon = $_POST['billingon'];    
        $area = $_POST['area'];       
        $sector = $_POST['sector'];    
        $category = $_POST['category'];    
        $invoicetype = $_POST['invoicetype'];    
        $invoiceprice = $_POST['invoiceprice'];  
        $quotationvalidity = $_POST['quotationvalidity'];  


          
        //header 
        $insert = "INSERT INTO customer(`id`, `code`, `customername`, `customername_ar`, `chqprintname`, `accounthead`, `address`, `creditlimits`, `creditdays`, `gracelimit`, `gracedays`, `type`, `ctelephone`, `cmobile`, `fax`, `cemail`, `oldcode`, `status`, `location`, `customergroup`, `billingon`, `area`, `sector`, `category`, `invoicetype`, `invoiceprice` , `quotationvalidity`   ) VALUES ( '$id', '$code', '$customername','$customername_ar', '$chqprintname', '$accounthead', '$address', '$creditlimits', '$creditdays', '$gracelimit', '$gracedays', '$type', '$ctelephone', '$cmobile', '$fax', '$cemail','$oldcode','$status'  , '$location', '$customergroup','$billingon','$area', '$sector', '$category','$invoicetype','$invoiceprice','$quotationvalidity')";

       $query =  mysqli_query($con,$insert) or die(mysqli_error($con)); 

        //storinglogs
    
     $logslatitude = $geoplugin->latitude;
     $logslongitude = $geoplugin->longitude;   
     $logsip = $geoplugin->ip;
    
     $qurylogs = "INSERT INTO alllogs(idd,whichtable,updateon,latitude,longitude,nameofuser,ipaddress, comment) VALUES('$id','CUSTOMER',CURRENT_TIMESTAMP(),'$logslatitude', '$logslongitude', '$employeename', '$logsip', 'New Customer was Added')";
            $reqq = mysqli_query($con,$qurylogs);
    //storinglogs


        if ($query == 1) {
        $lastval =  mysqli_insert_id($con);

      for($count=0; $count<$_POST["customer_telephone_type"]; $count++)
      {
      $department = trim($_POST["department"][$count]);
      $name = trim($_POST["name"][$count]);
      $telephone = trim($_POST["telephone"][$count]);
      $mobile = trim($_POST["mobile"][$count]);
      $whatsapp = trim($_POST["whatsapp"][$count]); 
      $email = trim($_POST["email"][$count]);

        $qury = "INSERT INTO customer_telephone(customerid,department,name,telephone,mobile,whatsapp,email) VALUES('";
        $qury .= $id."','";
        $qury .= $department."','";
        $qury .= $name."','";
        $qury .= $telephone."','";
        $qury .= $mobile."','";
        $qury .= $whatsapp."','";
        $qury .= $email."')";
        $req = mysqli_query($con,$qury);
      }

      for($count=0; $count<$_POST["customer_bank_type"]; $count++)
      {
        $bankname = trim($_POST["bankname"][$count]);
        $bankbranch = trim($_POST["bankbranch"][$count]);
        $accountno = trim($_POST["accountno"][$count]);
        $ibanno = trim($_POST["ibanno"][$count]);
        $country = trim($_POST["country"][$count]);

          $qury = "INSERT INTO customer_bank(customerid,bankname,bankbranch,accountno,ibanno,country) VALUES('";
          $qury .= $id."','";
          $qury .= $bankname."','";
          $qury .= $bankbranch."','";
          $qury .= $accountno."','";
          $qury .= $ibanno."','";      
          $qury .= $country."')";
      
        $req = mysqli_query($con,$qury);
      
      }



        for($count=0; $count<$_POST["customer_addressinformation_type"]; $count++)
        {
          $contactperson = trim($_POST["contactperson"][$count]);
          $mobileno = trim($_POST["mobileno"][$count]);
          $branchaddress = trim($_POST["branchaddress"][$count]);
          $latitude = trim($_POST["latitude"][$count]);
          $longitude = trim($_POST["longitude"][$count]);
          $branchname = trim($_POST["branchname"][$count]);  
        
          $qury = "INSERT INTO customer_officeaddress(customerid,contactperson, mobileno,branchaddress,latitude, longitude,branchname) VALUES('";
            $qury .= $id."','";
            $qury .= $contactperson."','";
            $qury .= $mobileno."','";
            $qury .= $branchaddress."','";
            $qury .= $latitude."','";
            $qury .= $longitude."','";
            $qury .= $branchname."')";
        
          $req = mysqli_query($con,$qury);
        
        }






    
  }

 ?>               
 <script>
    alert('New Customer added successfully!');
   window.location.href='customermaster.php';
  </script>

<?php

}

?>