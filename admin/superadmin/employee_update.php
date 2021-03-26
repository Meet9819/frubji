<?php
require_once('dist/geoPlugin.php'); 
$geoplugin = new geoPlugin();
$geoplugin->locate();

session_start();
  $logsemployeename = $_SESSION['username']; 
?>

 

 <?php 


        include "dbconfig.php";

        $id = $_GET['id'];
        $result = $DB_con->prepare('SELECT img FROM employee WHERE id =:id');
        $result->execute(array(':id'=>$id));
        $displayinsert = $result->fetch(PDO::FETCH_ASSOC);
        extract($displayinsert);


?>

<?php
include "db.php";

if (isset($_POST["submit"])) {
    $id = $_GET['id'];
    if (is_null($id) or empty($id)) {
        return;
    }

        $id = trim($id);

      


          $employeename = $_POST['employeename'];  
          $employeecode = $_POST['employeecode'];            
  
             
           $u_rolecode = $_POST['u_rolecode']; 
           $username = $_POST['username'];    
           $password = $_POST['password'];  
          $workingin = $_POST['workingin'];    
          $dob = $_POST['dob'];    
          $bloodgroup = $_POST['bloodgroup'];   
          $gender = $_POST['gender'];          
          $qualification = $_POST['qualification'];  
     
           $status = $_POST['status'];  
           

        $imgFile = $_FILES['user_image']['name'];
        $tmp_dir = $_FILES['user_image']['tmp_name'];
        $imgSize = $_FILES['user_image']['size'];
                    
        if($imgFile)
        {
            $upload_dir = '../media/employee/'; // upload directory 
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


       $update = "UPDATE employee SET `img`=\"" . trim($img) . "\",  `employeename`=\"" . trim($employeename) . "\", `employeecode`=\"" . trim($employeecode) . "\", `gender`=\"" . trim($gender) . "\"      , `qualification`=\"" . trim($qualification) . "\"   , `workingin`=\"" . trim($workingin) . "\"     , `dob`=\"" . trim($dob) . "\"       , `bloodgroup`=\"" . trim($bloodgroup) . "\"
       ,  `status`=\"" . trim($status) . "\"        , `u_rolecode`=\"" . trim($u_rolecode) . "\"       , `username`=\"" . trim($username) . "\"       , `password`=\"" . trim($password) . "\"        WHERE `id`=" . $id . ";";


    $query = mysqli_query($con, $update) or die(mysqli_error($con)); 

      //storinglogs
  
     $logslatitude = $geoplugin->latitude;
     $logslongitude = $geoplugin->longitude;   
     $logsip = $geoplugin->ip;
    
     $qurylogs = "INSERT INTO alllogs(idd,whichtable,updateon,latitude,longitude,nameofuser,ipaddress, comment) VALUES('$id','EMPLOYEE',CURRENT_TIMESTAMP(),'$logslatitude', '$logslongitude', '$logsemployeename', '$logsip', 'Employee was Updated')";
            $reqq = mysqli_query($con,$qurylogs);
    //storinglogs


    if ($query == 1) {
        $lastval = mysqli_insert_id($con); 



             for ($count = 0; $count < $_POST["emp_bank_type"]; $count++) {
            // new change start
            $addr_id = empty($_POST["employee_bank_id"][$count]) || is_null($_POST["employee_bank_id"][$count]) ? null : $_POST["employee_bank_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `employee_bank`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
                $bankname = empty($_POST["bankname"][$count]) ? "" : trim($_POST["bankname"][$count]);
                $bankbranch = empty($_POST["bankbranch"][$count]) ? "" : trim($_POST["bankbranch"][$count]);
                $accountno = empty($_POST["accountno"][$count]) ? "" : trim($_POST["accountno"][$count]);
                $ibanno = empty($_POST["ibanno"][$count]) ? "" : trim($_POST["ibanno"][$count]);
                $country = empty($_POST["country"][$count]) ? "" : trim($_POST["country"][$count]);

                if (empty($bankbranch) && empty($bankname) && empty($accountno)  && empty($ibano)  && empty($country)) {
                    continue;
                }
                $qury = "INSERT INTO `employee_bank`(`id`, `employeeid`, `bankname`, `bankbranch`, `accountno`, `ibanno`, `country`) VALUES (" . $addressid . ", " . $id . ", \"" . $bankname . "\", \"" . $bankbranch . "\", \"" . $accountno . "\", \"" . $ibanno . "\", \"" . $country . "\")";
            } else {
                $addressid = trim($addr_id);
                $bankname = empty($_POST["bankname"][$count]) ? "" : trim($_POST["bankname"][$count]);
                $bankbranch = empty($_POST["bankbranch"][$count]) ? "" : trim($_POST["bankbranch"][$count]);
                $accountno = empty($_POST["accountno"][$count]) ? "" : trim($_POST["accountno"][$count]);
                $ibanno = empty($_POST["ibanno"][$count]) ? "" : trim($_POST["ibanno"][$count]);
                $country = empty($_POST["country"][$count]) ? "" : trim($_POST["country"][$count]);

                if (empty($bankbranch) && empty($bankname) && empty($accountno)  && empty($ibanno)  && empty($country)) {
                    continue;
                }
                $qury = "UPDATE employee_bank SET `bankname`=\"" . $bankname . "\", `bankbranch`=\"" . $bankbranch . "\", `accountno`=\"" . $accountno . "\", `ibanno`=\"" . $ibanno . "\", `country`=\"" . $country . "\"  WHERE `id`=" . $addressid . " AND `employeeid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }














            for ($count = 0; $count < $_POST["emp_telephone_type"]; $count++) {
            // new change start
            $addr_id = empty($_POST["telephone_id"][$count]) || is_null($_POST["telephone_id"][$count]) ? null : $_POST["telephone_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `employee_telephone`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
                $type = empty($_POST["type"][$count]) ? "" : trim($_POST["type"][$count]);
                $details = empty($_POST["details"][$count]) ? "" : trim($_POST["details"][$count]);
                $display = empty($_POST["display"][$count]) ? "" : trim($_POST["display"][$count]);
                if (empty($details) && empty($type) && empty($display)) {
                    continue;
                }
                $qury = "INSERT INTO `employee_telephone`(`id`, `employeeid`, `type`, `details`, `display`) VALUES (" . $addressid . ", " . $id . ", \"" . $type . "\", \"" . $details . "\", \"" . $display . "\")";
            } else {
                $addressid = trim($addr_id);
                $type = empty($_POST["type"][$count]) ? "" : trim($_POST["type"][$count]);
                $details = empty($_POST["details"][$count]) ? "" : trim($_POST["details"][$count]);
                $display = empty($_POST["display"][$count]) ? "" : trim($_POST["display"][$count]);
                if (empty($details) && empty($type) && empty($display)) {
                    continue;
                }
                $qury = "UPDATE employee_telephone SET `type`=\"" . $type . "\", `details`=\"" . $details . "\", `display`=\"" . $display . "\" WHERE `id`=" . $addressid . " AND `employeeid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }














            for ($count = 0; $count < $_POST["emp_address_type"]; $count++) {
            // new change start
            $addr_id = empty($_POST["address_id"][$count]) || is_null($_POST["address_id"][$count]) ? null : $_POST["address_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `employee_address`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
                $typeofaddress = empty($_POST["typeofaddress"][$count]) ? "" : trim($_POST["typeofaddress"][$count]);
                $eaddress = empty($_POST["eaddress"][$count]) ? "" : trim($_POST["eaddress"][$count]);
                $ecountry = empty($_POST["ecountry"][$count]) ? "" : trim($_POST["ecountry"][$count]);
                if (empty($eaddress) && empty($type) && empty($ecountry)) {
                    continue;
                }
                $qury = "INSERT INTO `employee_address`(`id`, `employeeid`, `typeofaddress`, `eaddress`, `ecountry`) VALUES (" . $addressid . ", " . $id . ", \"" . $typeofaddress . "\", \"" . $eaddress . "\", \"" . $ecountry . "\")";
            } else {
                $addressid = trim($addr_id);
                $typeofaddress = empty($_POST["typeofaddress"][$count]) ? "" : trim($_POST["typeofaddress"][$count]);
                $eaddress = empty($_POST["eaddress"][$count]) ? "" : trim($_POST["eaddress"][$count]);
                $ecountry = empty($_POST["ecountry"][$count]) ? "" : trim($_POST["ecountry"][$count]);
                if (empty($eaddress) && empty($typeofaddress) && empty($ecountry)) {
                    continue;
                }
                $qury = "UPDATE employee_address SET `typeofaddress`=\"" . $typeofaddress . "\", `eaddress`=\"" . $eaddress . "\", `ecountry`=\"" . $ecountry . "\" WHERE `id`=" . $addressid . " AND `employeeid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }











            for ($count = 0; $count < $_POST["emp_spouse_type"]; $count++) {
            // new change start
            $addr_id = empty($_POST["spouse_id"][$count]) || is_null($_POST["spouse_id"][$count]) ? null : $_POST["spouse_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `employee_spouse`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
                $spousetype = empty($_POST["spousetype"][$count]) ? "" : trim($_POST["spousetype"][$count]);
                $spousename = empty($_POST["spousename"][$count]) ? "" : trim($_POST["spousename"][$count]);
                $spouseemployer = empty($_POST["spouseemployer"][$count]) ? "" : trim($_POST["spouseemployer"][$count]);

                $spousemobile = empty($_POST["spousemobile"][$count]) ? "" : trim($_POST["spousemobile"][$count]);
                $spousedob = empty($_POST["spousedob"][$count]) ? "" : trim($_POST["spousedob"][$count]);
                $saddress = empty($_POST["saddress"][$count]) ? "" : trim($_POST["saddress"][$count]);
                $smobile = empty($_POST["smobile"][$count]) ? "" : trim($_POST["smobile"][$count]);
                $semail = empty($_POST["semail"][$count]) ? "" : trim($_POST["semail"][$count]);


                if (empty($spousename) && empty($spousetype) && empty($spouseemployer) && empty($spousemobile) && empty($spousedob) && empty($saddress) && empty($smobile) && empty($semail) ) {
                    continue;
                }
                $qury = "INSERT INTO `employee_spouse`(`id`, `employeeid`, `spousetype`, `spousename`, `spouseemployer` , `spousemobile` , `spousedob`, `saddress`, `smobile`, `semail`) VALUES (" . $addressid . ", " . $id . ", \"" . $spousetype . "\", \"" . $spousename . "\", \"" . $spouseemployer . "\" , \"" . $spousemobile . "\" , \"" . $spousedob . "\", \"" . $saddress . "\", \"" . $smobile . "\", \"" . $semail . "\")";
            } else {
                $addressid = trim($addr_id);
                $spousetype = empty($_POST["spousetype"][$count]) ? "" : trim($_POST["spousetype"][$count]);
                $spousename = empty($_POST["spousename"][$count]) ? "" : trim($_POST["spousename"][$count]);
                $spouseemployer = empty($_POST["spouseemployer"][$count]) ? "" : trim($_POST["spouseemployer"][$count]);

                $spousemobile = empty($_POST["spousemobile"][$count]) ? "" : trim($_POST["spousemobile"][$count]);
                $spousedob = empty($_POST["spousedob"][$count]) ? "" : trim($_POST["spousedob"][$count]);
                $saddress = empty($_POST["saddress"][$count]) ? "" : trim($_POST["saddress"][$count]);
                $smobile = empty($_POST["smobile"][$count]) ? "" : trim($_POST["smobile"][$count]);
                $semail = empty($_POST["semail"][$count]) ? "" : trim($_POST["semail"][$count]);

                if (empty($spousename) && empty($spousetype) && empty($spouseemployer) && empty($spousemobile) && empty($spousedob) && empty($saddress) && empty($smobile) && empty($semail) ) {
                    continue;
                }
                $qury = "UPDATE employee_spouse SET `spousetype`=\"" . $spousetype . "\", `spousename`=\"" . $spousename . "\", `spouseemployer`=\"" . $spouseemployer . "\", `spousemobile`=\"" . $spousemobile . "\", `spousedob`=\"" . $spousedob . "\", `saddress`=\"" . $saddress . "\", `smobile`=\"" . $smobile . "\", `semail`=\"" . $semail . "\" WHERE `id`=" . $addressid . " AND `employeeid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }
















            for ($count = 0; $count < $_POST["emp_salary"]; $count++) {
            // new change start
            $addr_id = empty($_POST["salary_id"][$count]) || is_null($_POST["salary_id"][$count]) ? null : $_POST["salary_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `employee_salary`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
                $startfrom = empty($_POST["startfrom"][$count]) ? "" : trim($_POST["startfrom"][$count]);
                $stype = empty($_POST["stype"][$count]) ? "" : trim($_POST["stype"][$count]);
                $total = empty($_POST["total"][$count]) ? "" : trim($_POST["total"][$count]);
                if (empty($stype) && empty($startfrom) && empty($total)) {
                    continue;
                }
                $qury = "INSERT INTO `employee_salary`(`id`, `employeeid`, `startfrom`, `stype`, `total`) VALUES (" . $addressid . ", " . $id . ", \"" . $startfrom . "\", \"" . $stype . "\", \"" . $total . "\")";
            } else {
                $addressid = trim($addr_id);
                $startfrom = empty($_POST["startfrom"][$count]) ? "" : trim($_POST["startfrom"][$count]);
                $stype = empty($_POST["stype"][$count]) ? "" : trim($_POST["stype"][$count]);
                $total = empty($_POST["total"][$count]) ? "" : trim($_POST["total"][$count]);
                if (empty($stype) && empty($startfrom) && empty($total)) {
                    continue;
                }
                $qury = "UPDATE employee_salary SET `startfrom`=\"" . $startfrom . "\", `stype`=\"" . $stype . "\", `total`=\"" . $total . "\" WHERE `id`=" . $addressid . " AND `employeeid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }













            for ($count = 0; $count < $_POST["emp_addon"]; $count++) {
            // new change start
            $addr_id = empty($_POST["a_id"][$count]) || is_null($_POST["a_id"][$count]) ? null : $_POST["a_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `employee_allocation`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
                $atype = empty($_POST["atype"][$count]) ? "" : trim($_POST["atype"][$count]);
                $adetails = empty($_POST["adetails"][$count]) ? "" : trim($_POST["adetails"][$count]);
                $remarks = empty($_POST["remarks"][$count]) ? "" : trim($_POST["remarks"][$count]);
                if (empty($adetails) && empty($atype) && empty($remarks)) {
                    continue;
                }
                $qury = "INSERT INTO `employee_allocation`(`id`, `employeeid`, `atype`, `adetails`, `remarks`) VALUES (" . $addressid . ", " . $id . ", \"" . $atype . "\", \"" . $adetails . "\", \"" . $remarks . "\")";
            } else {
                $addressid = trim($addr_id);
                $atype = empty($_POST["atype"][$count]) ? "" : trim($_POST["atype"][$count]);
                $adetails = empty($_POST["adetails"][$count]) ? "" : trim($_POST["adetails"][$count]);
                $remarks = empty($_POST["remarks"][$count]) ? "" : trim($_POST["remarks"][$count]);
                if (empty($adetails) && empty($atype) && empty($remarks)) {
                    continue;
                }
                $qury = "UPDATE employee_allocation SET `atype`=\"" . $atype . "\", `adetails`=\"" . $adetails . "\", `remarks`=\"" . $remarks . "\" WHERE `id`=" . $addressid . " AND `employeeid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }












    }

    ?>
 <script>
    alert('Emplloyee Data Successfully updated ...');
   window.location.href='employeemaster.php';
  </script>

<?php

}

?>