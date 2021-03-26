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
        $result = $DB_con->prepare('SELECT img FROM company WHERE id =:id');
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
    $companyname_english=$_POST['companyname_english'];
   
    $companycode=$_POST['companycode'];
    $prifix=$_POST['prifix'];   
    $locationlatitude=$_POST['locationlatitude'];
    $locationlongitude=$_POST['locationlongitude']; 
    $address=$_POST['address'];
    $status=$_POST['status']; 

        $imgFile = $_FILES['user_image']['name'];
        $tmp_dir = $_FILES['user_image']['tmp_name'];
        $imgSize = $_FILES['user_image']['size'];
                    
        if($imgFile)
        {
            $upload_dir = '../../media/company/'; // upload directory 
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
                        
        
    



    $update = "UPDATE company SET `img`=\"" . trim($img) . "\",  `companyname_english`=\"" . trim($companyname_english) . "\", `companycode`=\"" . trim($companycode) . "\", `prifix`=\"" . trim($prifix) . "\", `locationlatitude`=\"" . trim($locationlatitude) . "\", `locationlongitude`=\"" . trim($locationlongitude) . "\", `address`=\"" . trim($address) . "\", `status`=\"" . trim($status) . "\" WHERE `id`=" . $id . ";";

    $query = mysqli_query($con, $update) or die(mysqli_error($con)); 


    //storinglogs
   
     $logslatitude = $geoplugin->latitude;
     $logslongitude = $geoplugin->longitude;   
     $logsip = $geoplugin->ip;
    
     $qurylogs = "INSERT INTO alllogs(idd,whichtable,updateon,latitude,longitude,nameofuser,ipaddress,comment) VALUES('$id','COMPANY',CURRENT_TIMESTAMP(),'$logslatitude', '$logslongitude', '$employeename', '$logsip', 'Company was Updated')";
            $reqq = mysqli_query($con,$qurylogs);
    //storinglogs



  // $insertt = "INSERT INTO companylogs(companyid, img, companycode, prifix,shortname,companyname_english, companyname_arabic,street,zone,streetname,zonename, area,landmark,buildingno, pobox,city,country,sponsorname,authorizedperson,locationlatitude,locationlongitude,costingstatus,status,datee,addedby) VALUES ('$id','$img', '$companycode','$prifix','$shortname','$companyname_english','$companyname_arabic','$street','$zone','$streetname','$zonename','$area','$landmark','$buildingno','$pobox','$city','$country','$sponsorname','$authorizedperson','$locationlatitude','$locationlongitude','$costingstatus','$status',CURRENT_TIMESTAMP(),  '$employeename')"; 



           //$query =  mysqli_query($con,$insertt) or die(mysqli_error($con)); 

           

    if ($query == 1) {
        $lastval = mysqli_insert_id($con);

    
            for ($count = 0; $count < $_POST["company_telephone_type"]; $count++) {
            // new change start
            $addr_id = empty($_POST["address_id"][$count]) || is_null($_POST["address_id"][$count]) ? null : $_POST["address_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `company_telephone`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
                $type = empty($_POST["type"][$count]) ? "" : trim($_POST["type"][$count]);
                $details = empty($_POST["details"][$count]) ? "" : trim($_POST["details"][$count]);
                $display = empty($_POST["display"][$count]) ? "" : trim($_POST["display"][$count]);
                if (empty($details) && empty($type) && empty($display)) {
                    continue;
                }
                $qury = "INSERT INTO `company_telephone`(`id`, `companyid`, `type`, `details`, `display`) VALUES (" . $addressid . ", " . $id . ", \"" . $type . "\", \"" . $details . "\", \"" . $display . "\")";
            } else {
                $addressid = trim($addr_id);
                $type = empty($_POST["type"][$count]) ? "" : trim($_POST["type"][$count]);
                $details = empty($_POST["details"][$count]) ? "" : trim($_POST["details"][$count]);
                $display = empty($_POST["display"][$count]) ? "" : trim($_POST["display"][$count]);
                if (empty($details) && empty($type) && empty($display)) {
                    continue;
                }
                $qury = "UPDATE company_telephone SET `type`=\"" . $type . "\", `details`=\"" . $details . "\", `display`=\"" . $display . "\" WHERE `id`=" . $addressid . " AND `companyid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }









    }

    ?>
 <script>
    alert('Company Details Successfully updated ...');
   window.location.href='../companymaster.php';
  </script>

<?php

}

?>


