<?php
require_once('dist/geoPlugin.php'); 
$geoplugin = new geoPlugin();
$geoplugin->locate();

session_start();
  $logsemployeename = $_SESSION['username']; 
?>

 

 <?php
if(isset($_POST['submit'])){
    // Include the database configuration file
    include_once 'bulkimageupload/pconfig.php';
    
    // File upload configuration
    $targetDir = "../media/employee/";
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
            $insert = $db->query("INSERT INTO employeeimages (idd, file_name, uploaded_on) VALUES $insertValuesSQL");
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
  {   

       

        $imgFile = $_FILES['image']['name'];
        $tmp_dir = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
                    
        if($imgFile)
        {
            $upload_dir = '../media/employee/'; // upload directory 
            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'PNG', 'JPG', 'JPEG'); // valid extensions
            $img = rand(1000,1000000).".".$imgExt;
            if(in_array($imgExt, $valid_extensions))
            {           
                if($imgSize < 5000000)
                {  
                    move_uploaded_file($tmp_dir,$upload_dir.$img);
                }
                else
                {
                    $errMSG = "Sorry, your file is too large it should be less then 5MB";
                }
            }
            else
            {
                $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";        
            }   
        }
        else
        {
          
        }   

                     
          $id = $_POST['id'];   
          $employeename = $_POST['employeename'];  
          $employeecode = $_POST['employeecode'];           
          $u_rolecode = $_POST['u_rolecode']; 
          $username = $_POST['username'];    
          $password = $_POST['password']; 
          $workingin = $_POST['workingin'];   
          $gender = $_POST['gender'];        
          $qualification = $_POST['qualification'];    
          $dob = $_POST['dob'];    
          $bloodgroup = $_POST['bloodgroup'];           
                          
          $status = $_POST['status'];            
       
        //header 
        $insert = "INSERT INTO employee(id,img, employeename,employeecode,gender,qualification,workingin,dob,bloodgroup,status,u_rolecode,password,username) VALUES ( '$id', '$img', '$employeename' ,'$employeecode','$gender','$qualification','$workingin','$dob','$bloodgroup','$status','$u_rolecode','$password','$username')";

       $query =  mysqli_query($con,$insert) or die(mysqli_error($con)); 

          //storinglogs
   
     $logslatitude = $geoplugin->latitude;
     $logslongitude = $geoplugin->longitude;   
     $logsip = $geoplugin->ip;
    
     $qurylogs = "INSERT INTO alllogs(idd,whichtable,updateon,latitude,longitude,nameofuser,ipaddress, comment) VALUES('$id','EMPLOYEE',CURRENT_TIMESTAMP(),'$logslatitude', '$logslongitude', '$logsemployeename', '$logsip', 'Employee was Updated')";
            $reqq = mysqli_query($con,$qurylogs);
    //storinglogs


            
        if ($query == 1) {
        $lastval =  mysqli_insert_id($con);

     
 for($count=0; $count<$_POST["employee_bank_type"]; $count++)
      {
          $bankname = trim($_POST["bankname"][$count]);
  $bankbranch = trim($_POST["bankbranch"][$count]);
  $accountno = trim($_POST["accountno"][$count]);
  $ibanno = trim($_POST["ibanno"][$count]);

   $country = trim($_POST["country"][$count]);



        $qury = "INSERT INTO employee_bank(employeeid,bankname,bankbranch,accountno,ibanno,country) VALUES('";
          $qury .= $id."','";
          $qury .= $bankname."','";
          $qury .= $bankbranch."','";
          $qury .= $accountno."','";
          $qury .= $ibanno."','";
        

          $qury .= $country."')";
      $req = mysqli_query($con,$qury);
      }





 for($count=0; $count<$_POST["employee_address_type"]; $count++)
      {
          $typeofaddress = trim($_POST["typeofaddress"][$count]);

  $ecountry = trim($_POST["ecountry"][$count]);

  $eaddress = trim($_POST["eaddress"][$count]);



        $qury = "INSERT INTO employee_address(employeeid,typeofaddress,eaddress,ecountry) VALUES('";
          $qury .= $id."','";
            $qury .= $typeofaddress."','";
          $qury .= $eaddress."','";
        

          $qury .= $ecountry."')";
      $req = mysqli_query($con,$qury);
      }




      for($count=0; $count<$_POST["employee_telephone_type"]; $count++)
      {
          $type = trim($_POST["type"][$count]);
           $details = trim($_POST["details"][$count]);
            $display = trim($_POST["display"][$count]);



        $qury = "INSERT INTO employee_telephone(employeeid,type,details,display) VALUES('";
          $qury .= $id."','";
           $qury .= $type."','";
            $qury .= $details."','";

              $qury .= $display."')";
      $req = mysqli_query($con,$qury);
      } 


  


      for($count=0; $count<$_POST["employee_salary_type"]; $count++)
      {
          $startfrom = trim($_POST["startfrom"][$count]);
           $stype = trim($_POST["stype"][$count]);
          
   
         $total = trim($_POST["total"][$count]);


        $qury = "INSERT INTO employee_salary(employeeid,startfrom,stype,total) VALUES('";
          $qury .= $id."','";
          $qury .= $startfrom."','";   
                $qury .= $stype."','";

                    
         $qury .= $total."')";
      $req = mysqli_query($con,$qury);
      } 









      
  }

 ?>               
 <script>
    alert('New Employee added successfully!');
    window.location.href='employeemaster.php';
  </script>

<?php

}

?>