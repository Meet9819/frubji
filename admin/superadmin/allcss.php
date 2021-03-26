 


<?php 
 

require_once "config.php";
//error_reporting(0);

$user = $_SESSION["user_id"];

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}

// if the rights are not set then add them in the current session
if (!isset($_SESSION["access"])) {

    try {

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module "
            . " WHERE 1 GROUP BY `mod_modulegroupcode` "
            . " ";

        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $commonModules = $stmt->fetchAll();

/////////////////////

        $sql = "SELECT subcode, subname FROM module "
            . " WHERE 1 GROUP BY `subcode` "
            . " ";
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $commonModules = $stmt->fetchAll();

/////////////////////

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, subcode,subname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module "
            . " WHERE 1 "
            . "   ";

        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $allModules = $stmt->fetchAll();

        $sql = "SELECT rr_modulecode, rr_create,  rr_edit, rr_delete, rr_view, rr_approval FROM role_rights "
            . " WHERE  rr_rolecode = :rc "
            . " ORDER BY `rr_modulecode` ASC  ";

        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["rolecode"]);

        $stmt->execute();
        $userRights = $stmt->fetchAll();

        $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);

    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
}
?>




 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  
    <meta name="description" content="Pharmacy and Medical Supplies." />
    <meta name="keywords" content="Medicines, Cosmetics, Diagnostic Equipments, Disposable Products, Emergency Medical Products, First Aid and Burn Kits, Orthopaedic and Rehab Products, Surgical Insruments, Laboratary Products and Hospital Furnitures." />
    <meta name="author" content="Founded by Mr. Abdul Razak Al Rais and Mr. Elias Jerroge in 1989." />


    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">



        <!-- form-advanced CSS -->
        <link href="../vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="../vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="../vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="../vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
        <link href="../vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>
        <link href="../vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>
        <link href="../vendors/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>
        <link href="../vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        <!-- form-advanced CSS -->


    <!-- Data table CSS -->
    <link href="../vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />


  <!--SWEET alerts CSS -->
    <link href="../vendors/bower_components/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
 

    <!-- BOOTSTRAP-TABLE CSS-->
    <link href="../vendors/bower_components/bootstrap-table/dist/bootstrap-table.css" rel="stylesheet" type="text/css"/>

    <!-- BOOTSTRAP-TABLE CSS-->
    
   <!-- Index page CSS -->
    <link href="../vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
    <link href="../vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>
    <link href="../vendors/bower_components/chartist/dist/chartist.min.css" rel="stylesheet" type="text/css"/>
    <link href="../vendors/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css"/>
    <!-- Index page CSS -->


<!-- FORM VALIDATION -->
        <link href="../vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- FORM VALIDATION -->

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">

     <!-- FORM FIL UPLOAD -->
        <link href="../vendors/bower_components/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/><!-- FORM FIL UPLOAD -->


        <!-- form-picker CSS -->
        <link href="../vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="../vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="../vendors/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css"/>       <!-- form-picker CSS -->

          <!--Responsive Data table CSS -->
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
    <link href="../vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="../vendors/bower_components/datatables.net-responsive/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css"/> <!--Responsive Data table CSS -->

  <style type="text/css">


    .hiddentextbox {

    background-color: #03A9F4;

    }
          #wi {
            width: 14%;
          }
          #pad {
            padding: 5px;
          }  .form-control:focus {
  
    border-color: #25a1f07a;
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset, 0px 0px 8px rgba(37, 161, 240, 0.35);

    }


.modaltable {

      overflow-x: hidden;
    overflow-y: hidden;
    width: 100%;
    padding: 20px;
}
  .bor {
    border: 1px solid #d1d1d1;
    padding: 5px;
    padding-left: 10px;
  }
        </style>


<!--
  <link href="../vendors/bower_components/filament-tablesaw/dist/tablesaw.css" rel="stylesheet" type="text/css"/>
  <link href="dist/css/style.css" rel="stylesheet" type="text/css">
    <table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe" data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap data-tablesaw-mode-switch>
                        <thead>
                          <tr>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Movie Title</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col data-tablesaw-priority="3">Rank</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Year</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="1"><abbr title="Rotten Tomato Rating">Rating</abbr></th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Gross</th>
                          </tr>
                        </thead> 
  <script src="../vendors/bower_components/filament-tablesaw/dist/tablesaw.js"></script>
  <script src="dist/js/tablesaw-data.js"></script>
-->


<?php
function getrealip()
{
  if (isset($_SERVER)){
if(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
if(strpos($ip,",")){
$exp_ip = explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(isset($_SERVER["HTTP_CLIENT_IP"])){
$ip = $_SERVER["HTTP_CLIENT_IP"];
}else{
$ip = $_SERVER["REMOTE_ADDR"];
}
}else{
if(getenv('HTTP_X_FORWARDED_FOR')){
$ip = getenv('HTTP_X_FORWARDED_FOR');
if(strpos($ip,",")){
$exp_ip=explode(",",$ip);
$ip = $exp_ip[0];
}
}else if(getenv('HTTP_CLIENT_IP')){
$ip = getenv('HTTP_CLIENT_IP');
}else {
$ip = getenv('REMOTE_ADDR');
}
}
return $ip; 
}


$MyipAddress = getrealip();
 
?>

                                                      <?php
                                                      require_once('dist/geoPlugin.php'); 
                                                      $geoplugin = new geoPlugin();
                                                      $geoplugin->locate(); 


                                                      $latitude = $geoplugin->latitude;
                                                      $longitude = $geoplugin->longitude;   


                                                      $city = $geoplugin->city;
                                                      $areaCode = $geoplugin->areaCode;
                                                      $country = $geoplugin->countryName;

                                                      $logslatitude = $geoplugin->latitude;
                                                      $logslongitude = $geoplugin->longitude;   

                                                      $logsip = $geoplugin->ip;


                                                      ?>

<style>
  #branchstock {  
    background-color: #f6f6f614;
  }
  #branchstock .row {
    border-bottom: 0px solid;
    margin: 0 0px !important;
    padding: 5px !important;
  }
  #branchstock .row div {
    padding: 0;
  } 
  .design {
    background-color: #f9f9f9; color: #777;
    padding: 4px !important;
    font-weight: bold;
    border: 1px solid #eee;
  }
</style>

<?php 
date_default_timezone_set('Asia/Kolkata'); 

$currentTime = date(' M d, Y h:i A', time());
$logstime = date('Y-m-d h:i A', time());
$fulldatee = date('Y-m-d', time());
$dateeyear = date("y");  
$year = date("Y");  
$medate = date('m-y', time());
$branchrequestorder = 'BR';     
$purchaseorder = 'PO'; 
$purchasereceipt = 'PI'; 
$pointofsale = 'POS';
    
?>

 
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php

require "barcode/vendor/autoload.php";
?> 

<style type="text/css">
  #item-data-modal .fixed-table-body {

    height: auto !important;
  }
</style>

                  <?php  require_once("dependentdropdown/dbcontroller.php");
                  $db_handle = new DBController();
                  $query ="SELECT * FROM company";                          
                  $results = $db_handle->runQuery($query);
                  ?>
                   <script>
                  function getState(val) {
                    $.ajax({
                    type: "POST",
                    url: "dependentdropdown/get_branch.php",
                    data:'companyid='+val,
                    success: function(data){
                      $("#requestfrom").html(data);
                    }
                    });
                  }

                  function selectCountry(val) {
                  $("#search-box").val(val);
                  $("#suggesstion-box").hide();
                  }
                  </script> 





 <script src="https://maps.googleapis.com/maps/api/js"></script> 





<!--
<link rel="stylesheet" href="dist/leftrightmodal.css">  -->    <?php  /*
                              $start_event = $row['start_event']; 
                              echo $newformatofstart_event = date("d-m-Y", strtotime($start_event)); */
                              ?> <!--
 <a   data-target="#right" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">fff</a> -->
 <?php /* include "modal/viewitem2rightsidemodal.php";*/ ?> 