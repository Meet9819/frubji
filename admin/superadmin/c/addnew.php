<?php
require_once('../dist/geoPlugin.php'); 
$geoplugin = new geoPlugin();
$geoplugin->locate();

session_start();
  $employeename = $_SESSION['username']; 

?>


<?php 
if(isset($_POST['submit'])){
   
    include_once '../bulkimageupload/pconfig.php';

    $targetDir = "../../media/company/";
    $allowTypes = array('jpg','png','jpeg','gif','JPG','JPEG','PNG','mp4', 'avi', 'mov','pdf', 'docx', 'ppt', 'pptx', 'xls', 'xlsx');

    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
    if(!empty(array_filter($_FILES['files']['name']))){
        foreach($_FILES['files']['name'] as $key=>$val){
            
            $fileName = basename($_FILES['files']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            $idd = $_POST['id'];
            
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
              
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
                   
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

          
            $insert = $db->query("INSERT INTO companyimages (idd, file_name, uploaded_on) VALUES $insertValuesSQL");
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
    
    echo $statusMsg;
}
?>





<?php
include ("../db.php");

if(isset($_POST["submit"]))
  { 
    
                  
          $id=$_POST['id'];

          $imgFile = $_FILES['image']['name'];
          $tmp_dir = $_FILES['image']['tmp_name'];
          $imgSize = $_FILES['image']['size'];
                    
          if($imgFile)
          {
              $upload_dir = '../../media/company/'; 
              $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
              $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'PNG', 'JPG', 'JPEG'); 
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
          $companycode=$_POST['companycode'];
          $companyname_english=$_POST['companyname_english']; 

          $prifix=$_POST['prifix'];

       
          $address=$_POST['address'];
         


          $locationlatitude=$_POST['locationlatitude'];
          $locationlongitude=$_POST['locationlongitude'];

          $status=$_POST['status'];  


               
          $insert = "INSERT INTO company(id, img, companycode, prifix, companyname_english, address, locationlatitude, locationlongitude, status) 

          VALUES ('$id','$img', '$companycode','$prifix','$companyname_english','$address','$locationlatitude','$locationlongitude','$status')"; 
           $query =  mysqli_query($con,$insert) or die(mysqli_error($con)); 

       



    //storinglogs
   
     $logslatitude = $geoplugin->latitude;
     $logslongitude = $geoplugin->longitude;   
     $logsip = $geoplugin->ip;
    
     $qurylogs = "INSERT INTO alllogs(idd,whichtable,updateon,latitude,longitude,nameofuser,ipaddress,comment) VALUES('$id','COMPANY',CURRENT_TIMESTAMP(),'$logslatitude', '$logslongitude', '$employeename', '$logsip', 'New Company was Added')";
            $reqq = mysqli_query($con,$qurylogs);
    //storinglogs

 //  $insertt = "INSERT INTO companylogs(companyid, img, companycode, prifix,shortname,companyname_english, companyname_arabic,street,zone,streetname,zonename, area,landmark,buildingno, pobox,city,country,sponsorname,authorizedperson,locationlatitude,locationlongitude,costingstatus,status,datee,addedby) VALUES ('$id','$img', '$companycode','$prifix','$shortname','$companyname_english','$companyname_arabic','$street','$zone','$streetname','$zonename','$area','$landmark','$buildingno','$pobox','$city','$country','$sponsorname','$authorizedperson','$locationlatitude','$locationlongitude','$costingstatus','$status',CURRENT_TIMESTAMP(),  '$employeename')"; 



           //$query =  mysqli_query($con,$insertt) or die(mysqli_error($con)); 

          


            if ($query == 1)         {
            $lastval =  mysqli_insert_id($con);

              for($count=0; $count<$_POST["company_telephone_type"]; $count++)
              {              
                  $type = trim($_POST["type"][$count]);
                  $details = trim($_POST["details"][$count]);
                  $display = trim($_POST["display"][$count]);

                  $qury = "INSERT INTO company_telephone(companyid,type,details,display) VALUES('";
                  $qury .= $id."','";
                  $qury .= $type."','";
                  $qury .= $details."','";
                  $qury .= $display."')";

              $req = mysqli_query($con,$qury);
              $lastval =  mysqli_insert_id($con);
              } 

    }
  header('location:../companymaster.php');

}

?>