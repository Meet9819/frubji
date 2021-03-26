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
    $targetDir = "../../media/products/";
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
            $insert = $db->query("INSERT INTO productimages (idd, file_name, uploaded_on) VALUES $insertValuesSQL");
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
        $id = $_POST['id'];   
        $name = $_POST['name'];     
        $maincat = $_POST['maincat'];   
        $categoryid = $_POST['categoryid'];   
        $productcode = $_POST['productcode'];  
        $description = $_POST['description'];
        $shortdescription = $_POST['shortdescription'];
        $hsncode = $_POST['hsncode'];   
        $newold = $_POST['newold'];  
        $status = $_POST['status'];  
        $sale = $_POST['sale'];  
        $gst = $_POST['gst'];  
        $pr = $_POST['pr'];  
        $stock = $_POST['stock'];  
       
        $imgFile = $_FILES['image']['name'];
        $tmp_dir = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
                    
        if($imgFile)
        {
            $upload_dir = '../../media/products/'; // upload directory 
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
        
        $insert = "INSERT INTO products(`id`,`img`,`maincat`,`categoryid`,`name`, `description`, `shortdescription`, `hsncode` , `newold`, `productcode`, `status`, `sale`, `gst`, `pr`,`stock`) VALUES ('$id','$img','$maincat','$categoryid', '$name',   '$description','$shortdescription', '$hsncode' , '$newold', '$productcode', '$status', '$sale', '$gst', '$pr', '$stock')";

       $query =  mysqli_query($con,$insert) or die(mysqli_error($con)); 

    //storinglogs
    
     $logslatitude = $geoplugin->latitude;
     $logslongitude = $geoplugin->longitude;   
     $logsip = $geoplugin->ip;
    
     $qurylogs = "INSERT INTO alllogs(idd,whichtable,updateon,latitude,longitude,nameofuser,ipaddress, comment) VALUES('$id','ITEM',CURRENT_TIMESTAMP(),'$logslatitude', '$logslongitude', '$employeename', '$logsip', 'New Item was Added')";
            $reqq = mysqli_query($con,$qurylogs);
    //storinglogs         

            if ($query == 1) {

            $lastval =  mysqli_insert_id($con);        

                      for($gen=0; $gen<$_POST["total_unit"]; $gen++)
                          {
                            $qty = trim($_POST["qty"][$gen]);
                            $units = trim($_POST["units"][$gen]);
                          
                           // echo $gennm.'/'.$genst;
                            $stm =  "INSERT INTO productvariant(productid,qty,units) VALUES('";
                            $stm .= $id."','";
                            $stm .= $qty."','";
                            $stm .= $units."')";
                            $state = mysqli_query($con,$stm);
                          } 



                        /*   for($gen=0; $gen<$_POST["total_allotment"]; $gen++)
                          {
                            
                            $branch = trim($_POST["branch"][$gen]);
                          
                           // echo $gennm.'/'.$genst;
                            $stm =  "INSERT INTO productsallotment(productid,branch) VALUES('";
                            $stm .= $id."','";                            
                            $stm .= $branch."')";
                            $state = mysqli_query($con,$stm);
                          } 
*/
       
          }

           ?>               
           <script>
              alert('New Item Successfully Added ...');
             window.location.href='itemmaster.php';
            </script>

<?php
}
?>