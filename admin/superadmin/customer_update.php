<?php
require_once('dist/geoPlugin.php'); 
$geoplugin = new geoPlugin();
$geoplugin->locate();

session_start();
  $employeename = $_SESSION['username']; 
?>


<?php
include "db.php";

if (isset($_POST["submit"])) {
        $id = $_GET['id'];
        if (is_null($id) or empty($id)) {
            return;
        }


        $id = trim($id);
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

        $update = "UPDATE customer SET `code`=\"" . trim($code) . "\", `customername`=\"" . trim($customername) . "\", `customername_ar`=\"" . trim($customername_ar) . "\", `chqprintname`=\"" . trim($chqprintname) . "\", `accounthead`=\"" . trim($accounthead) . "\", `address`=\"" . trim($address) . "\", `creditlimits`=\"" . trim($creditlimits) . "\", `creditdays`=\"" . trim($creditdays) . "\", `gracelimit`=\"" . trim($gracelimit) . "\", `gracedays`=\"" . trim($gracedays) . "\", `type`=\"" . trim($type) . "\", `ctelephone`=\"" . trim($ctelephone) . "\", `cmobile`=\"" . trim($cmobile) . "\", `fax`=\"" . trim($fax) . "\", `cemail`=\"" . trim($cemail) . "\", `status`=\"" . trim($status) . "\", `quotationvalidity`=\"" . trim($quotationvalidity) . "\", `location`=\"" . trim($location) . "\" , `customergroup`=\"" . trim($customergroup) . "\" , `billingon`=\"" . trim($billingon) . "\" , `area`=\"" . trim($area) . "\" , `sector`=\"" . trim($sector) . "\", `category`=\"" . trim($category) . "\", `category`=\"" . trim($category) . "\", `category`=\"" . trim($category) . "\", `invoicetype`=\"" . trim($invoicetype) . "\", `invoiceprice`=\"" . trim($invoiceprice) . "\"  WHERE `id`=" . $id . ";";

    $query = mysqli_query($con, $update) or die(mysqli_error($con));

     //storinglogs
    
     $logslatitude = $geoplugin->latitude;
     $logslongitude = $geoplugin->longitude;   
     $logsip = $geoplugin->ip;
    
     $qurylogs = "INSERT INTO alllogs(idd,whichtable,updateon,latitude,longitude,nameofuser,ipaddress, comment) VALUES('$id','CUSTOMER',CURRENT_TIMESTAMP(),'$logslatitude', '$logslongitude', '$employeename', '$logsip', 'Customer was Updated')";
            $reqq = mysqli_query($con,$qurylogs);
    //storinglogs


    if ($query == 1) {
        $lastval = mysqli_insert_id($con); 







             for ($count = 0; $count < $_POST["sup_bank_type"]; $count++) {
            // new change start
            $addr_id = empty($_POST["supplier_bank_id"][$count]) || is_null($_POST["supplier_bank_id"][$count]) ? null : $_POST["supplier_bank_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `customer_bank`";
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
                $qury = "INSERT INTO `customer_bank`(`id`, `customerid`, `bankname`, `bankbranch`, `accountno`, `ibanno`, `country`) VALUES (" . $addressid . ", " . $id . ", \"" . $bankname . "\", \"" . $bankbranch . "\", \"" . $accountno . "\", \"" . $ibanno . "\", \"" . $country . "\")";
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
                $qury = "UPDATE customer_bank SET `bankname`=\"" . $bankname . "\", `bankbranch`=\"" . $bankbranch . "\", `accountno`=\"" . $accountno . "\", `ibanno`=\"" . $ibanno . "\", `country`=\"" . $country . "\"  WHERE `id`=" . $addressid . " AND `customerid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }




    
  

        for ($count = 0; $count < $_POST["customer_telephone_type"]; $count++) {
            // new change start
            $con_id = empty($_POST["contact_id"][$count]) || is_null($_POST["contact_id"][$count]) ? null : $_POST["contact_id"][$count];
            if (is_null($con_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `customer_telephone`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $contactid = intval($max_row_id["max_id"]) + 1;
                $department = empty($_POST["department"][$count]) ? "" : trim($_POST["department"][$count]);
                $telephone = empty($_POST["telephone"][$count]) ? "" : trim($_POST["telephone"][$count]);
                $name = empty($_POST["name"][$count]) ? "" : trim($_POST["name"][$count]);
                $mobile = empty($_POST["mobile"][$count]) ? "" : trim($_POST["mobile"][$count]);
                $whatsapp = empty($_POST["whatsapp"][$count]) ? "" : trim($_POST["whatsapp"][$count]);
                $email = empty($_POST["email"][$count]) ? "" : trim($_POST["email"][$count]);
                if (empty($telephone) && empty($mobile) && empty($whatsapp) && empty($email)) {
                    continue;
                }
                $query = "INSERT INTO `customer_telephone`(`id`, `customerid`, `department`, `telephone`, `mobile`, `whatsapp`, `email`, `name`) VALUES (" . $contactid . ", " . $id . ", \"" . $department . "\", \"" . $telephone . "\", \"" . $mobile . "\",  \"" . $whatsapp . "\",  \"" . $email . "\",  \"" . $name . "\")";
            } else {
                $contactid = trim($_POST["contact_id"][$count]);
                $department = empty($_POST["department"][$count]) ? "" : trim($_POST["department"][$count]);
                $telephone = empty($_POST["telephone"][$count]) ? "" : trim($_POST["telephone"][$count]);
                $mobile = empty($_POST["mobile"][$count]) ? "" : trim($_POST["mobile"][$count]);
                $whatsapp = empty($_POST["whatsapp"][$count]) ? "" : trim($_POST["whatsapp"][$count]);
                $email = empty($_POST["email"][$count]) ? "" : trim($_POST["email"][$count]);
                $name = empty($_POST["name"][$count]) ? "" : trim($_POST["name"][$count]);
                if (empty($telephone) && empty($mobile) && empty($whatsapp) && empty($email)) {
                    continue;
                }
                $query = "UPDATE `customer_telephone` SET `department`=\"" . $department . "\", `telephone`=\"" . $telephone . "\", `mobile`=\"" . $mobile . "\", `whatsapp`=\"" . $whatsapp . "\", `email`=\"" . $email . "\", `name`=\"" . $name . "\" WHERE `id`=" . $contactid . " AND `customerid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $query);
        }







        for ($count = 0; $count < $_POST["customeroffice_type"]; $count++) {
            // new change start
            $con_id = empty($_POST["customeraddress_id"][$count]) || is_null($_POST["customeraddress_id"][$count]) ? null : $_POST["customeraddress_id"][$count];
            if (is_null($con_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `customer_officeaddress`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $contactid = intval($max_row_id["max_id"]) + 1;
                $branchname = empty($_POST["branchname"][$count]) ? "" : trim($_POST["branchname"][$count]);
                $contactperson = empty($_POST["contactperson"][$count]) ? "" : trim($_POST["contactperson"][$count]);
                $branchaddress = empty($_POST["branchaddress"][$count]) ? "" : trim($_POST["branchaddress"][$count]);
                $mobileno = empty($_POST["mobileno"][$count]) ? "" : trim($_POST["mobileno"][$count]);
                $latitude = empty($_POST["latitude"][$count]) ? "" : trim($_POST["latitude"][$count]);
                $longitude = empty($_POST["longitude"][$count]) ? "" : trim($_POST["longitude"][$count]);
                if (empty($contactperson) && empty($mobileno) ) {
                    continue;
                }
                $query = "INSERT INTO `customer_officeaddress`(`id`, `customerid`, `branchname`, `contactperson`, `mobileno`, `latitude`, `longitude`, `branchaddress`) VALUES (" . $contactid . ", " . $id . ", \"" . $branchname . "\", \"" . $contactperson . "\", \"" . $mobileno . "\",  \"" . $latitude . "\",  \"" . $longitude . "\",  \"" . $branchaddress . "\")";
            } else {
                $contactid = trim($_POST["customeraddress_id"][$count]);
                $branchname = empty($_POST["branchname"][$count]) ? "" : trim($_POST["branchname"][$count]);
                $contactperson = empty($_POST["contactperson"][$count]) ? "" : trim($_POST["contactperson"][$count]);
                $mobileno = empty($_POST["mobileno"][$count]) ? "" : trim($_POST["mobileno"][$count]);
                $latitude = empty($_POST["latitude"][$count]) ? "" : trim($_POST["latitude"][$count]);
                $longitude = empty($_POST["longitude"][$count]) ? "" : trim($_POST["longitude"][$count]);
                $branchaddress = empty($_POST["branchaddress"][$count]) ? "" : trim($_POST["branchaddress"][$count]);
                if (empty($contactperson) && empty($mobileno)) {
                    continue;
                }
                $query = "UPDATE `customer_officeaddress` SET `branchname`=\"" . $branchname . "\", `contactperson`=\"" . $contactperson . "\", `mobileno`=\"" . $mobileno . "\", `latitude`=\"" . $latitude . "\", `longitude`=\"" . $longitude . "\", `branchaddress`=\"" . $branchaddress . "\" WHERE `id`=" . $contactid . " AND `customerid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $query);
        }









    }

    ?>
 <script>
    alert('Customer Data Updated Successfully !!');
   window.location.href='customermaster.php';
  </script>

<?php

}

?>