<?php
require_once('../dist/geoPlugin.php'); 
$geoplugin = new geoPlugin();
$geoplugin->locate();

session_start();
$employeename = $_SESSION['username']; 

?>

<?php 
  include "../dbconfig.php";
  $id = $_GET['id'];
  $result = $DB_con->prepare('SELECT img FROM branch WHERE id =:id');
  $result->execute(array(':id'=>$id));
  $displayinsert = $result->fetch(PDO::FETCH_ASSOC);
  extract($displayinsert);
?>
<?php
include "../db.php";

if (isset($_POST["submit"])) {
    $id = $_GET['id'];
    if (is_null($id) or empty($id)) {
        return;
    }
        $id = trim($id); 
      	$companyid=$_POST['companyid'];
      	$branchcode=$_POST['branchcode'];
        $prifix=$_POST['prifix'];
        $branchname_english=$_POST['branchname_english'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $locationlatitude=$_POST['locationlatitude'];
        $locationlongitude=$_POST['locationlongitude'];
        $status=$_POST['status']; 
        $channelpartnerid=$_POST['channelpartnerid'];  

        $imgFile = $_FILES['user_image']['name'];
        $tmp_dir = $_FILES['user_image']['tmp_name'];
        $imgSize = $_FILES['user_image']['size'];
                    
        if($imgFile)
        {
            $upload_dir = '../../media/branch/'; // upload directory 
            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'PNG', 'JPG', 'JPEG'); // valid extensions
            $img = rand(1000,1000000).".".$imgExt;
            if(in_array($imgExt, $valid_extensions))
            {           
                if($imgSize < 5000000)
                {   //unlink function deletes the old image
                    unlink($upload_dir.$displayinsert['img']);
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
            // if no image selected the old image remain as it is.
            $img = $displayinsert['img']; // old image from database
        }   
                        
       

  
    $update = "UPDATE branch SET `img`=\"" . trim($img) . "\", `companyid`=\"" . trim($companyid) . "\", `branchname_english`=\"" . trim($branchname_english) . "\", `prifix`=\"" . trim($prifix) . "\", `locationlatitude`=\"" . trim($locationlatitude) . "\", `locationlongitude`=\"" . trim($locationlongitude) . "\", `address`=\"" . trim($address) . "\", `email`=\"" . trim($email) . "\",`mobile`=\"" . trim($mobile) . "\",  `status`=\"" . trim($status) . "\",  `branchcode`=\"" . trim($branchcode) . "\",  `channelpartnerid`=\"" . trim($channelpartnerid) . "\" WHERE `id`=" . $id . ";";

    $query = mysqli_query($con, $update) or die(mysqli_error($con)); 

     //storinglogs   
     $logslatitude = $geoplugin->latitude;
     $logslongitude = $geoplugin->longitude;   
     $logsip = $geoplugin->ip;    
     $qurylogs = "INSERT INTO alllogs(idd,whichtable,updateon,latitude,longitude,nameofuser,ipaddress, comment) VALUES('$id','BRANCH',CURRENT_TIMESTAMP(),'$logslatitude', '$logslongitude', '$employeename', '$logsip', 'Branch was Updated')";
            $reqq = mysqli_query($con,$qurylogs);
    //storinglogs

    if ($query == 1) {
        $lastval = mysqli_insert_id($con);
    
            for ($count = 0; $count < $_POST["branch_telephone_type"]; $count++) {
            // new change start
            $addr_id = empty($_POST["telephone_id"][$count]) || is_null($_POST["telephone_id"][$count]) ? null : $_POST["telephone_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `branch_telephone`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
                $type = empty($_POST["type"][$count]) ? "" : trim($_POST["type"][$count]);
                $details = empty($_POST["details"][$count]) ? "" : trim($_POST["details"][$count]);
                $display = empty($_POST["display"][$count]) ? "" : trim($_POST["display"][$count]);
                if (empty($details) && empty($type) && empty($display)) {
                    continue;
                }
                $qury = "INSERT INTO `branch_telephone`(`id`, `branchid`, `type`, `details`, `display`) VALUES (" . $addressid . ", " . $id . ", \"" . $type . "\", \"" . $details . "\", \"" . $display . "\")";
            } else {
                $addressid = trim($addr_id);
                $type = empty($_POST["type"][$count]) ? "" : trim($_POST["type"][$count]);
                $details = empty($_POST["details"][$count]) ? "" : trim($_POST["details"][$count]);
                $display = empty($_POST["display"][$count]) ? "" : trim($_POST["display"][$count]);
                if (empty($details) && empty($type) && empty($display)) {
                    continue;
                }
                $qury = "UPDATE branch_telephone SET `type`=\"" . $type . "\", `details`=\"" . $details . "\", `display`=\"" . $display . "\" WHERE `id`=" . $addressid . " AND `branchid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }







        for ($count = 0; $count < $_POST["branch_pincode_type"]; $count++) {
            // new change start
            $addr_id = empty($_POST["pincode_id"][$count]) || is_null($_POST["pincode_id"][$count]) ? null : $_POST["pincode_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `branchpincode`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
                $pincode = empty($_POST["pincode"][$count]) ? "" : trim($_POST["pincode"][$count]);
              
                if (empty($details) && empty($pincode) && empty($display)) {
                    continue;
                }
                $qury = "INSERT INTO `branchpincode`(`id`, `branchid`, `pincode`) VALUES (" . $addressid . ", " . $id . ", \"" . $pincode . "\")";
            } else {
                $addressid = trim($addr_id);
                $pincode = empty($_POST["pincode"][$count]) ? "" : trim($_POST["pincode"][$count]);
               
                if (empty($details) && empty($pincode) && empty($display)) {
                    continue;
                }
                $qury = "UPDATE branchpincode SET `pincode`=\"" . $pincode . "\" WHERE `id`=" . $addressid . " AND `branchid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }






    }

    ?>
 <script>
    alert('Branch Details Successfully updated ...');
   window.location.href='../branchmaster.php';
  </script>

<?php

}

?>



