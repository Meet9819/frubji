<?php 
include "db.php"; 
$result = mysqli_query($con,"SELECT * FROM employee where id = $user");
while($row = mysqli_fetch_array($result))
{  
  $employeename = $row['employeename'];  
  $employeecode = $row['employeecode'];  
  $qidno = $row['qidno'];    
  $familyid = $row['familyid'];    
  $gender = $row['gender'];    
  $joindate = $row['joindate'];    
  $minworkinghrs = $row['minworkinghrs'];    
  $leftdate = $row['leftdate'];  
  $qualification = $row['qualification'];    
  $designation = $row['designation'];    
  $workingin = $row['workingin'];    
  $sponsor = $row['sponsor'];    
  $nationality = $row['nationality'];    
  $dob = $row['dob'];    
  $bloodgroup = $row['bloodgroup'];    
  $marritial = $row['marritial'];    
  $dependentname = $row['dependentname']; 
  $relationshiptoemp = $row['relationshiptoemp']; 
  $manager = $row['manager'];       
  $passportno = $row['passportno'];          
  $status = $row['status'];   
  $marriagedate = $row['marriagedate'];     
  $u_rolecode = $row['u_rolecode'];   
  $password = $row['password'];    
 $username = $row['username'];
} 
?>  

<style type="text/css">        
    .padd {padding-left: 20px;}
</style> 

<body>
  <!--Preloader-->
  <div class="preloader-it">
    <div class="la-anim-1">
    </div>
  </div>

  <div id="newmenu" class="wrapper theme-2-active navbar-top-light ">

  

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="nav-wrap">
        <div class="mobile-only-brand pull-left">
          <div class="nav-header pull-left">

          <?php  
          error_reporting(0);                                       
          $result = mysqli_query($con,"SELECT * FROM branch where branchcode = '$workingin' ");
          while($row = mysqli_fetch_array($result))
          {
            $companyid = $row['companyid']; 
            $branchcode = $row['branchcode'];
          }
          ?>

          <?php  

          $result = mysqli_query($con,"SELECT * FROM company where id = null");
          while($row = mysqli_fetch_array($result))
          { 
          echo ' <div class="logo-wrap" style="width:90%;text-align:center">
                   <a href="index.php">
                     <img style="   width: 20px;" class="brand-img" src="images/logo/'.$row['img'].'" alt="'.$branchcode.'" />
                     <span class="brand-text">
                     <img style="width: 76%; margin-top: -15px;"  src="images/logo/'.$row['img'].'" alt="brand"/>
                     </span>
                    </a> 
                  </div>
          ';
          }
          ?>

           
          </div>
          <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);">
            <i class="ti-align-left">
            </i>
          </a> 


          
          <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);">
            <i class="zmdi zmdi-search">
            </i>
          </a>
          <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);">
            <i class="ti-more">
            </i>
          </a>
          <form id="search_form" role="search" class="top-nav-search collapse pull-left">
            <div class="input-group">



   
              <input type="text"  id="" class="form-control" placeholder="Search">


<!-- it is not owrkig bcoz jquery is clashing.. other wise it is working<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
<input type="text"  id="modulepageSearch" class="form-control" placeholder="Search">

<script type="text/javascript">
$(document).ready(function(){
 
 $('#modulepageSearch').autocomplete({
     source: "post_module.php",
     minLength: 2,
     select: function(event, ui) {
         var url = ui.item.id;
         if (url != '#') {
             location.href = url
         }
     },
     open: function(event, ui) {
         $(".ui-autocomplete").css("z-index", 1000)
     }
 })
 
}); 
</script> 
-->



              <span class="input-group-btn">
                <button type="button" class="btn  btn-default"  data-target="#search_form" data-toggle="collapse" aria-label="Close" aria-expanded="true">
                  <i class="zmdi zmdi-search">
                  </i>
                </button> 
              </span>
            </div>
          </form>
        </div>


        <div id="mobile_only_nav" class="mobile-only-nav pull-right">
          <ul class="nav navbar-right top-nav pull-right">
       

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>      
  <script>    
    $(document).ready(function(){
      $abc = false;
      $('#newmenubutton').click(function(){
        //$abc = $('#newmenu').attr(class);
        //alert($abc);
        $abc = !$abc;
        if($abc)
        {
        $('#newmenu').removeClass('wrapper theme-2-active navbar-top-light');
        $('#newmenu').addClass('wrapper theme-2-active navbar-top-light horizontal-nav');
        }
        else
        {
        $('#newmenu').removeClass('wrapper theme-2-active navbar-top-light horizontal-nav');
        $('#newmenu').addClass('wrapper theme-2-active navbar-top-light');
        }
       });
    });
  </script>

                    <li class="dropdown" >
                        <a href="#shortcuts" data-toggle="modal" data-toggle="tooltip"  ><i class=" top-nav-icon ti-info"></i> </a> 
                     </li>

                 
    
        <li class="dropdown" style="padding: 10px;">
           <button id="newmenubutton" class="btn btn-primary">Menu</button>
         </li>

            <li class="dropdown full-width-drp">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="ti-align-center top-nav-icon"></i></a>
                <ul class="dropdown-menu mega-menu pa-0" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                  <li class="product-nicescroll-bar row">
                    <ul class="pa-20">
                      <li class="col-md-3 col-xs-6 col-menu-list">
                    Menu    <a href="index.php"><div class="pull-left"><i class="fa fa-gitlab mr-20"></i><span class="right-nav-text">Master</span></div><div class="clearfix"></div></a>
                        <a href="index2.php"><div class="pull-left"><i class="fa fa-language mr-20  mr-20"></i><span class="right-nav-text">Purchase</span></div><div class="pull-right"><span class="label label-success">Imp Menu</span></div><div class="clearfix"></div></a>
                        <a href="profile.php"><div class="pull-left"><i class="ti-briefcase  mr-20"></i><span class="right-nav-text">Sales</span></div><div class="clearfix"></div></a>
                      </li>
                      <li class="col-md-3 col-xs-6 col-menu-list">
                        <a href="javascript:void(0);">
                          <div class="pull-left">
                            <i class="ti-shopping-cart  mr-20"></i><span class="right-nav-text">Shortcut Menu</span>
                          </div>  
                          <div class="pull-right"><i class="ti-angle-down"></i></div>
                          <div class="clearfix"></div>
                        </a>
                        <hr class="light-grey-hr ma-0"/>
                        <ul>
                        
                          <li>
                            <a href="product.php">Purchase</a>
                          </li>
                          <li>
                            <a href="product-detail.php">Sales</a>
                          </li>
                          <li>
                            <a href="add-products.php">Accounts</a>
                          </li>
                          <li>
                            <a href="product-orders.php">HR</a>
                          </li>
                         
                        </ul>
                      </li>
                      <li class="col-md-6 col-xs-12 preview-carousel">
                        <a href="javascript:void(0);"><div class="pull-left"><span class="right-nav-text">latest products</span></div><div class="clearfix"></div></a>
                        <hr class="light-grey-hr ma-0"/>
                        <div class="product-carousel owl-carousel owl-theme text-center">
                          <a href="#">
                            <img src="../img/chair.jpg" alt="chair">
                            <span>Circle chair</span>
                          </a>
                          <a href="#">
                            <img src="../img/chair2.jpg" alt="chair">
                            <span>square chair</span>
                          </a>
                          <a href="#">
                            <img src="../img/chair3.jpg" alt="chair">
                            <span>semi circle chair</span>
                          </a>
                          <a href="#">
                            <img src="../img/chair4.jpg" alt="chair">
                            <span>wooden chair</span>
                          </a>
                          <a href="#">
                            <img src="../img/chair2.jpg" alt="chair">
                            <span>square chair</span>
                          </a>                
                        </div>
                      </li>
                    </ul>
                  </li> 
                </ul>
            </li>

            <li class="dropdown alert-drp">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="ti-bell top-nav-icon">
                </i>
                <span class="top-nav-icon-badge">5
                </span>
              </a>
              <ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn" data-dropdown-out="bounceOut">
                <li>
                  <div class="notification-box-head-wrap">
                    <span class="notification-box-head pull-left inline-block">notifications
                    </span>
                    <a class="txt-danger pull-right clear-notifications inline-block" href="javascript:void(0)"> clear all 
                    </a>
                    <div class="clearfix">
                    </div>
                    <hr class="light-grey-hr ma-0" />
                  </div>
                </li>
                <li>
                  <div class="streamline message-nicescroll-bar">
                    <div class="sl-item">
                      <a href="javascript:void(0)">
                        <div class="icon bg-green">
                          <i class="ti-briefcase ">
                          </i>
                        </div>
                        <div class="sl-content">
                          <span class="inline-block capitalize-font  pull-left truncate head-notifications">
                            New subscription created
                          </span>
                          <span class="inline-block font-11  pull-right notifications-time">2pm
                          </span>
                          <div class="clearfix">
                          </div>
                          <p class="truncate">Your customer subscribed for the basic plan. The customer will pay $25 per month.
                          </p>
                        </div>
                      </a>
                    </div>
                    <hr class="light-grey-hr ma-0" />
                    <div class="sl-item">
                      <a href="javascript:void(0)">
                        <div class="icon bg-yellow">
                          <i class="zmdi zmdi-trending-down">
                          </i>
                        </div>
                        <div class="sl-content">
                          <span class="inline-block capitalize-font  pull-left truncate head-notifications txt-warning">Server #2 not responding
                          </span>
                          <span class="inline-block font-11 pull-right notifications-time">1pm
                          </span>
                          <div class="clearfix">
                          </div>
                          <p class="truncate">Some technical error occurred needs to be resolved.
                          </p>
                        </div>
                      </a>
                    </div>
                    <hr class="light-grey-hr ma-0" />
                    <div class="sl-item">
                      <a href="javascript:void(0)">
                        <div class="icon bg-blue">
                          <i class="zmdi zmdi-email">
                          </i>
                        </div>
                        <div class="sl-content">
                          <span class="inline-block capitalize-font  pull-left truncate head-notifications">2 new messages
                          </span>
                          <span class="inline-block font-11  pull-right notifications-time">4pm
                          </span>
                          <div class="clearfix">
                          </div>
                          <p class="truncate"> The last payment for your G Suite Basic subscription failed.
                          </p>
                        </div>
                      </a>
                    </div>
                    <hr class="light-grey-hr ma-0" />
                    <div class="sl-item">
                      <a href="javascript:void(0)">
                        <div class="sl-avatar">
                          <img class="img-responsive" src="../img/avatar.jpg" alt="avatar" />
                        </div>
                        <div class="sl-content">
                          <span class="inline-block capitalize-font  pull-left truncate head-notifications">Sandy Doe
                          </span>
                          <span class="inline-block font-11  pull-right notifications-time">1pm
                          </span>
                          <div class="clearfix">
                          </div>
                          <p class="truncate">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit
                          </p>
                        </div>
                      </a>
                    </div>
                    <hr class="light-grey-hr ma-0" />
                    <div class="sl-item">
                      <a href="javascript:void(0)">
                        <div class="icon bg-red">
                          <i class="zmdi zmdi-storage">
                          </i>
                        </div>
                        <div class="sl-content">
                          <span class="inline-block capitalize-font  pull-left truncate head-notifications txt-danger">99% server space occupied.
                          </span>
                          <span class="inline-block font-11  pull-right notifications-time">1pm
                          </span>
                          <div class="clearfix">
                          </div>
                          <p class="truncate">consectetur, adipisci velit.
                          </p>
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li>
                  <div class="notification-box-bottom-wrap">
                    <hr class="light-grey-hr ma-0" />
                    <a class="block text-center read-all" href="javascript:void(0)"> read all 
                    </a>
                    <div class="clearfix">
                    </div>
                  </div>
                </li>
              </ul>
            </li>

            <li class="dropdown auth-drp">
              <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown">
                <img src="../img/user1.png" alt="user_auth" class="user-auth-img img-circle" />
                <span class="user-online-status">
                </span>
              </a>
              <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                
                  <li> <a href="index.php"><i class="zmdi zmdi-account"></i>
                    <span> Hello, <?php echo $employeename;?>  !</span></a>
                  </li>
              
                  <li>
                  <a href="profile.php">
                    <i class="zmdi zmdi-settings">
                    </i>
                    <span>Profile</span>
                  </a>
                </li>

                <li class="divider">
                </li>
                <li>
                  <a href="logout.php">
                    <i class="zmdi zmdi-power">
                    </i>
                    <span>Log Out</span>
                  </a>
                </li>
                <li class="divider">
                </li>
               
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- /Top Menu Items -->

    
    <!-- Left Sidebar Menu -->
    <div class="fixed-sidebar-left">
      <ul class="nav navbar-nav side-nav nicescroll-bar">
      
        <li class="navigation-header">
          <span>
          </span>
          <hr/>
        </li> 

        <li style=" text-align: center;  font-size: 18px;">

                  <a style="    color: #03A9F4;    text-shadow: 0.3px 0.3px white;" href="index.php"> 
                    <span> Hello, <?php  echo  $employeename; ?> !</span>   
                  </a>

                  <script>
                    function branchChange(){
                      var myselect = document.getElementById("whichbranch");
                      var whichbranch = myselect.options[myselect.selectedIndex].value;
                      var branchaccess = whichbranch;

                     
                      $.ajax({
                        type: "GET",      
                          url: 'a.php?branch=' + branchaccess,
                        data:branchaccess,
                        success:function(response){
                        
                          alert(response);
                          location.reload();
                        }
                      })
                    }
                  </script>
    

                                     <b style="color:white">     
                                     <?php
                                      if ($workingin == 'ADMIN, ALLBRANCH' || $workingin == 'ADMIN')
                                      {
                                       ?>  

                                            <div class="form-group col-md-12">


                                              
                                            <select style="width: 100%"  id="whichbranch"  class="form-control " onchange="branchChange();" >
                                            <option><?php 
                                            // session_start();
                                            echo  $sb = $_SESSION['branch']; 


                                           $result = mysqli_query($con,"SELECT company_shortname FROM `branch` where branchcode = '$sb'");

                                            while($row = mysqli_fetch_array($result))
                                           {
                                            echo ' [ '.$row['company_shortname'].' ]'; 

                                            $sbcompany = $row['company_shortname'];
                                           } 

                                             ?></option>
                                            <option value="">NO BRANCH NEEDED</option>

                                            <?php
                                           include"db.php"; 
                                           $result = mysqli_query($con,"SELECT * FROM `branch`");


                                           while($row = mysqli_fetch_array($result))
                                           {
                                           echo '<option value="'.$row['branchcode'].'">' .$row['branchcode'].'</option>';
                                           } 
                                           ?> 



                                            <?php
                                           include"db.php"; 
                                           $result = mysqli_query($con,"SELECT * FROM `company`");


                                           while($row = mysqli_fetch_array($result))
                                           {
                                           echo '<option value="'.$row['shortname'].'">Company - ' .$row['shortname'].'</option>';
                                           } 
                                           ?>



                                           </select> 






                                           </div>
                                     <?php
                                     }   
                                     else if ($workingin != 'ADMIN, ALLBRANCH' || $workingin != 'ADMIN')
                                     {
                                        echo $workingin;  
                                        $result = mysqli_query($con,"SELECT * FROM `branch` where branchcode = '$workingin'");

                                           while($row = mysqli_fetch_array($result))
                                           {
                                           echo ' [ '.$row['company_shortname'].' ] '; 

                                             $sbcompany = $row['company_shortname'];
                                           } 
                                     } 
                                    ?>  
                                  </b>                   
        </li>        
             
        <li>
          <a href="index.php">
            <div class="pull-left">
              <i class="fa fa-dashboard mr-20">
              </i>
              <span class="right-nav-text">Dashboard
              </span>
            </div>
            <div class="clearfix">
            </div>
          </a>
        </li> 

<?php


$con = mysqli_connect("localhost","root","","frubji");

$result = mysqli_query($con, "SELECT * FROM  employee where id = $user");

// store user's details
while ($row = mysqli_fetch_array($result)) {
    $row['employeename'];
    $_SESSION["loggedInFullName"] = $row["employeename"];
    $_SESSION["loggedInUserName"] = $row["username"];
    $_SESSION["rolecode"] = $row["u_rolecode"];
}

$result = mysqli_query($con, "SELECT rr_modulecode FROM role_rights where rr_rolecode = '" . $_SESSION["rolecode"] . "'");
$user_module_code = "";
while ($row = mysqli_fetch_array($result)) {
    if (empty($user_module_code)) {
        $user_module_code = "'" . $row["rr_modulecode"] . "'";
    } else {
        $user_module_code .= ", '" . $row["rr_modulecode"] . "'";
    }
}
$_SESSION["user_modules"] = $user_module_code;

?>


<?php

if (!isset($_SESSION["nav_list"]) || empty($_SESSION["nav_list"])) {
    // fetch level 1
    $sql = "SELECT `level1`, `icon` FROM module_temp WHERE `mod_modulecode` IN (" . $_SESSION["user_modules"] . ")";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $level1 = $stmt->fetchAll();

    // create level 1 list
    $navigation1_icons = array();
    $navigation1 = array();
    foreach ($level1 as $val1) {
        if (!in_array($val1["level1"], $navigation1, true)) {

            // fetch level 2
            $sql = "SELECT `level2` FROM module_temp WHERE `level1` = '" . trim($val1["level1"]) . "' AND `mod_modulecode` IN (" . $_SESSION["user_modules"] . ")";
            $stmt = $DB->prepare($sql);
            $stmt->execute();
            $level2 = $stmt->fetchAll();

            // create level 2 list
            $navigation2 = array();
            foreach ($level2 as $val2) {
                if (!in_array($val2["level2"], $navigation2, true)) {
                    // fetch level 3
                    $sql = "SELECT `level3` FROM module_temp WHERE `level1` = '" . trim($val1["level1"]) . "' AND `level2` = '" . trim($val2["level2"]) . "' AND `mod_modulecode` IN (" . $_SESSION["user_modules"] . ")";
                    $stmt = $DB->prepare($sql);
                    $stmt->execute();
                    $level3 = $stmt->fetchAll();

                    $navigation3 = array();

                    // fetch modules with links
                    foreach ($level3 as $val3) {
                        $fg_modules = array();

                        if (!isset($val3["level3"])) {
                            $sql = "SELECT `module`, `module_link` FROM module_temp WHERE `level1` = '" . trim($val1["level1"]) . "' AND `level2` = '" . trim($val2["level2"]) . "' AND `mod_modulecode` IN (" . $_SESSION["user_modules"] . ")";
                            $stmt = $DB->prepare($sql);
                            $stmt->execute();
                            $module = $stmt->fetchAll();

                            foreach ($module as $entity) {
                                if (!in_array($entity["module"], $fg_modules, true)) {
                                    $fg_modules[$entity["module"]] = $entity["module_link"];
                                }
                            }

                            // collect all actual modules in level 2 navigation list
                            $navigation2[$val2["level2"]] = $fg_modules;
                        } else if (isset($val3["level3"]) && !in_array($val3["level3"], $navigation3, true)) {
                            $sql = "SELECT `module`, `module_link` FROM module_temp WHERE `level1` = '" . trim($val1["level1"]) . "' AND `level2` = '" . trim($val2["level2"]) . "' AND `level3` = '" . trim($val3["level3"]) . "' AND `mod_modulecode` IN (" . $_SESSION["user_modules"] . ")";
                            $stmt = $DB->prepare($sql);
                            $stmt->execute();
                            $module = $stmt->fetchAll();

                            // var_dump($module);
                            foreach ($module as $entity) {
                                if (!in_array($entity["module"], $fg_modules, true)) {
                                    $fg_modules[$entity["module"]] = $entity["module_link"];
                                }
                            }

                            // collect all actual modules in level 2 navigation list
                            $navigation3[$val3["level3"]] = $fg_modules;
                            $navigation2[$val2["level2"]] = $navigation3;
                        }
                    }
                }
            }

            // process level 1 list
           $navigation1[$val1["level1"]] = $navigation2;
           $navigation1_icons[$val1["level1"]] = $val1["icon"];
        }
    }

    $_SESSION["nav_list"] = $navigation1;
    $_SESSION["nav_icon_list"] = $navigation1_icons;
}
//var_dump($_SESSION["nav_list"]);



    
    
?>

<?php         
foreach ($_SESSION["nav_list"] as $key1 => $val1) {
    $fa_icon_name = "";

    if (!isset($_SESSION["nav_icon_list"]) || empty($_SESSION["nav_icon_list"]))  {
      $fa_icon_name = "fa fa-gitlab";
    } else {
      $fa_icon_name = $_SESSION["nav_icon_list"][$key1];
    }

    if (empty($val1) || sizeof($val1) == 0) {
        continue;
    } else {
        echo '<li>  
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#' . $key1 . '" style="border-top: solid #131313 0.1px;">
            <div class="pull-left">
              <i class="' . $fa_icon_name . ' mr-20">
              </i>
              <span class="right-nav-text"> 
             ' . $key1 . ' </span>
            </div>
            <div class="pull-right">
              <i class="ti-angle-down">
              </i>
            </div>
            <div class="clearfix">
            </div>
          </a>      <ul id="' . $key1 . '" class="collapse collapse-level-1">
            ';

        foreach ($val1 as $key2 => $val2) {
            if (empty($val2) || sizeof($val2) == 0) {
                continue;
            } else {
                echo '<li>   <a href="#view' . $key2 . '" data-toggle="modal" style="background-color: #4848486e;">
               ' . $key2 . ' <div class="pull-right">
                  <i class="ti-angle-down ">
                  </i>
                </div>
                <div class="clearfix">
                </div>
              </a>   
               <ul >'; 



                foreach ($val2 as $key3 => $val3) {
                    if (gettype($val3) == 'string') {
                        echo "<li><a href =\"" . $val3 . "\">" . $key3 . "</a></li> ";

                      } else {
                        echo '<li style="margin-left:80px">' . $key3 . '<ul id="' . $key2 . '" class="collapse collapse-level-2">';
                        foreach ($val3 as $key4 => $val4) {

                            echo "<li><a href=\"" . $val4 . "\">" . $key4 . "</a></li>";
                        }

                        echo "</ul></li>";
                    }
                }
                echo "</ul></li>";
            }
        }
        echo "</ul></li>";
    }
}


?>
        <li>
          <a href="javascript:void(0);">
            <div class="pull-left  mr-20 " >
          
            </div>
            <div class="clearfix"> 
            </div> 
          </a>
        </li> 


        <li>
          <a href="javascript:void(0);">
            <div class="pull-left  mr-20 " >
          
            </div>
            <div class="clearfix">
            </div>
          </a>
        </li> 
</ul>

  </div>
<!-- /Left Sidebar Menu --> 

          <?php include "timeline/shortcuts.php"; ?>                   
          <?php include 'timeline/viewwholesalegraph.php'; ?>     
          <?php include 'timeline/localpugraph.php'; ?>