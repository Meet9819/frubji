<?php
require_once('dist/geoPlugin.php'); 
$geoplugin = new geoPlugin();
$geoplugin->locate();

session_start();
  $employeename = $_SESSION['username']; 
?>

    <?php 
        include "dbconfig.php";
        $id = $_GET['id'];
        $result = $DB_con->prepare('SELECT img FROM products WHERE id =:id');
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
        $name = $_POST['name'];     
        $description = $_POST['description']; 
        $shortdescription = $_POST['shortdescription']; 
        $hsncode = $_POST['hsncode']; 
        $newold = $_POST['newold'];  
        $maincat = $_POST['maincat'];   
        $categoryid = $_POST['categoryid'];   
        $productcode = $_POST['productcode'];    
        $status = $_POST['status'];  
        $sale = $_POST['sale'];  
        $gst = $_POST['gst'];  
        $pr = $_POST['pr'];  
        $stock = $_POST['stock'];  
        $imgFile = $_FILES['user_image']['name'];
        $tmp_dir = $_FILES['user_image']['tmp_name'];
        $imgSize = $_FILES['user_image']['size'];
                    
        if($imgFile)
        {
            $upload_dir = '../../media/products/'; // upload directory 
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
    


                        $update = "UPDATE products SET  `img`=\"" . trim($img) . "\", 
                                    `name`=\"" . trim($name) . "\",      
                                    `maincat`=\"" . trim($maincat) . "\",  
                                    `categoryid`=\"" . trim($categoryid) . "\",   
                                    `productcode`=\"" . trim($productcode) . "\",                                
                                    `description`=\"" . trim($description) . "\",  
                                    `shortdescription`=\"" . trim($shortdescription) . "\",  
                                   
                                    `hsncode`=\"" . trim($hsncode) . "\",  
                                    
                                    `newold`=\"" . trim($newold) . "\",  
                                  
                                    `status`=\"" . trim($status) . "\",  
                                    `sale`=\"" . trim($sale) . "\",  
                                    `gst`=\"" . trim($gst) . "\",  
                                    `pr`=\"" . trim($pr) . "\",  
                                    `stock`=\"" . trim($stock) . "\"
                                
                                    WHERE `id`=" . $id . ";";

                        $query = mysqli_query($con, $update) or die(mysqli_error($con));

                          //storinglogs
                      
                         $logslatitude = $geoplugin->latitude;
                         $logslongitude = $geoplugin->longitude;   
                         $logsip = $geoplugin->ip;
                        
                         $qurylogs = "INSERT INTO alllogs(idd,whichtable,updateon,latitude,longitude,nameofuser,ipaddress, comment) VALUES('$id','ITEM',CURRENT_TIMESTAMP(),'$logslatitude', '$logslongitude', '$employeename', '$logsip', 'Item was Updated')";
                                $reqq = mysqli_query($con,$qurylogs);
                        //storinglogs




    if ($query == 1) {
        $lastval = mysqli_insert_id($con);   

        for ($count = 0; $count < $_POST["total_unit"]; $count++) {
            // new change start
            $addr_id = empty($_POST["address_id"][$count]) || is_null($_POST["address_id"][$count]) ? null : $_POST["address_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `productvariant`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
             
                $qty = empty($_POST["qty"][$count]) ? "" : trim($_POST["qty"][$count]);
                $units = empty($_POST["units"][$count]) ? "" : trim($_POST["units"][$count]);

                if (empty($units)) {
                    continue;
                }
                $qury = "INSERT INTO `productvariant`(`id`, `productid`,  `units`, `qty`) VALUES (" . $addressid . ", " . $id . ", \"" . $units . "\" , \"" . $qty . "\")";
            } else {
                $addressid = trim($addr_id);
               
                $qty = empty($_POST["qty"][$count]) ? "" : trim($_POST["qty"][$count]);
                $units = empty($_POST["units"][$count]) ? "" : trim($_POST["units"][$count]);
                if (empty($units)) {
                    continue;
                }
                $qury = "UPDATE productvariant SET `units`=\"" . $units . "\",`qty`=\"" . $qty . "\" WHERE `id`=" . $addressid . " AND `productid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }





     /*    for ($count = 0; $count < $_POST["allottotal_unit"]; $count++) {
            // new change start
            $addr_id = empty($_POST["address_id"][$count]) || is_null($_POST["address_id"][$count]) ? null : $_POST["address_id"][$count];
            if (is_null($addr_id)) {
                $max_row_id_query = "SELECT MAX(`id`) AS max_id FROM `productsallotment`";
                $res = mysqli_query($con, $max_row_id_query);
                $max_row_id = mysqli_fetch_array($res);
                $addressid = intval($max_row_id["max_id"]) + 1;
             
                $branch = empty($_POST["branch"][$count]) ? "" : trim($_POST["branch"][$count]);

                if (empty($branch)) {
                    continue;
                }
                $qury = "INSERT INTO `productsallotment`(`id`, `productid`,  `branch``) VALUES (" . $addressid . ", " . $id . ", \"" . $branch . "\")";
            } else {
                $addressid = trim($addr_id);
               
             
                $branch = empty($_POST["branch"][$count]) ? "" : trim($_POST["branch"][$count]);
                if (empty($branch)) {
                    continue;
                }
                $qury = "UPDATE productsallotment SET `branch`=\"" . $branch . "\" WHERE `id`=" . $addressid . " AND `productid`=" . (int) trim($id) . ";";
            }
            $req = mysqli_query($con, $qury);
            // new change end
        }*/


    }

    ?>
 <script>
    alert('Item Successfully updated ...');
  window.location.href='itemmaster.php';
  </script>

<?php

}

?>