<?php 
include "db.php"; 
$result = mysqli_query($con,"SELECT * FROM employee where id = $user");
while($row = mysqli_fetch_array($result))
{  
  $employeename = $row['employeename'];  
  $employeecode = $row['employeecode'];  
  $familyid = $row['familyid'];    
  $gender = $row['gender'];    
  $designation = $row['designation'];      
  $workingin = $row['workingin'];    
  $dob = $row['dob'];    
  $manager = $row['manager'];       
  $status = $row['status'];   
  $u_rolecode = $row['u_rolecode'];   
  $password = $row['password'];    
  $username = $row['username'];
} 
 $logsemployeename = $_SESSION['username']; 


$result = mysqli_query($con,"SELECT b.id,b.companyid,b.branchname_english, c.companyname_english FROM `branch` b, `company` c WHERE b.companyid = c.id AND b.id = $workingin");
while($row = mysqli_fetch_array($result))
{  
  $companyid = $row['companyid'];  
  $companyname_english = $row['companyname_english'];   
  $branchname_english = $row['branchname_english'];  
}

?>  

<body>
  <div id="newmenu" class="wrapper theme-2-active navbar-top-light "> 
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="nav-wrap">
        <div class="mobile-only-brand pull-left">
          <div class="nav-header pull-left">

         
          <div class="logo-wrap" style="width:90%;text-align:center">
                   <a href="index.php">
                     <img style="   width: 20px;" class="brand-img" src="images/logo/logoshort.png" alt="'.$branchcode.'" />
                     <span class="brand-text">
                     <img style="width: 76%; margin-top: -15px;"  src="images/logo/logo.png" alt="Logo"/>
                     </span>
                    </a> 
                  </div>
        

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

                  <a style="    color: #ff5722;    text-shadow: 0.3px 0.3px white;" href="index.php"> 
                    <span> Hello, <?php  echo  $employeename; ?> !</span>   
                  </a>

               <b style="color: white">Code - <?php  echo  $workingin; ?> <?php  echo  $branchname_english; ?>   </b> <br>

                     <b style="color: white"><?php  echo  $u_rolecode; ?> </b>
              

                                                
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
      
      

         
</ul>

  </div>
