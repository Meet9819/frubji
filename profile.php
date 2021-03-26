<?php error_reporting(0);
define(SERVER_ROOT, __DIR__);
 
include('db.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> 

<?php include "allcss.php"; ?>
<?php include "header.php"; ?>

<body class="page-template page-template-template page-template-template-full-width page-template-templatetemplate-full-width-php page page-id-7  theme-marketo woocommerce-account woocommerce-page woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default elementor-kit-2663 elementor-page elementor-page-7" data-spy="scroll" data-target="#header">
  <div class="xs-breadcumb">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">My Profile </li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="page" role="main">


  <section class="elementor-element elementor-element-5af2cb9 elementor-section-boxedelementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="5af2cb9" data-element_type="section">
      <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
          <div class="elementor-element elementor-element-a92dce5 elementor-column elementor-col-25 elementor-top-column" data-id="a92dce5" data-element_type="column">
            <div class="elementor-column-wrap">
              <div class="elementor-widget-wrap"></div>
            </div>
          </div>
          <div class="elementor-element elementor-element-90a2d0a elementor-column elementor-col-50 elementor-top-column" data-id="90a2d0a" data-element_type="column">
            <div class="elementor-column-wrap elementor-element-populated">
              <div class="elementor-widget-wrap">
                <div class="elementor-element elementor-element-e67c3b6 elementor-widget elementor-widget-xs-heading" data-id="e67c3b6" data-element_type="widget" data-widget_type="xs-heading.default">
                  <div class="elementor-widget-container">
                    <div class="xs-heading">
                      <h3 class="xs-heading-title">Hello, <?php echo $userName; ?></h3>
                    </div>
                  </div>
                </div>
                <div class="elementor-element elementor-element-1483796 elementor-widget elementor-widget-divider" data-id="1483796" data-element_type="widget" data-widget_type="divider.default">
                  <div class="elementor-widget-container">
                    <div class="elementor-divider"> <span class="elementor-divider-separator"> </span></div>
                  </div>
                </div>
                <div class="elementor-element elementor-element-cebe75b elementor-widget elementor-widget-xs-heading" data-id="cebe75b" data-element_type="widget" data-widget_type="xs-heading.default">
                  <div class="elementor-widget-container">
                    <div class="xs-heading">
                      <p class="lead">Fundpress site thoughtfully designed for real humans which means the best user experience for your entire community of donors, fundraisers, customers, and staff.</p>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
          <div class="elementor-element elementor-element-3ce8451 elementor-column elementor-col-25 elementor-top-column" data-id="3ce8451" data-element_type="column">
            <div class="elementor-column-wrap">
              <div class="elementor-widget-wrap"></div>
            </div>
          </div>
        </div>
      </div>
  </section>

    <section class="elementor-element elementor-element-4601733 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="4601733" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                  <div class="elementor-row">
                    <div class="elementor-element elementor-element-46a8d5a elementor-column elementor-col-100 elementor-top-column" data-id="46a8d5a" data-element_type="column">
                      <div class="elementor-column-wrap  elementor-element-populated">
                        <div class="elementor-widget-wrap">
                          <div class="elementor-element elementor-element-0aa7991 elementor-widget elementor-widget-shortcode" data-id="0aa7991" data-element_type="widget" data-widget_type="shortcode.default">
                            <div class="elementor-widget-container">
                              <div class="elementor-shortcode">
                                <div class="woocommerce">
                                  <div class="woocommerce-notices-wrapper"></div>
                                  <div class="u-columns col2-set" id="customer_login">
                                  
                                    <div class="u-column1 col-1">
                                       

     <?php
        error_reporting(0);
        session_start();
        require_once 'class.user.php';
        $user_home = new USER();
        if(!$user_home->is_logged_in())
        {
        }
        $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
        $stmt->execute(array(":uid"=>$_SESSION['userSession']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC); 



        $con = mysqli_connect("localhost","root","","frubji") or die ('Unable to connect');
        ?> 

        <?php
         if(isset($_SESSION['userSession']))
         {
              
             $studentid = $row['userID'];    
           
         }
        ?> 

        <?php

        $dbHost = 'localhost';
        $dbUsername = 'root';
        $dbPassword = '';
        $dbName = 'frubji';

        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        if ($db->connect_error) {
            die("Unable to connect database: " . $db->connect_error);
        } 

        $query = $db->query("SELECT * FROM tbl_users WHERE userID = $studentid");
        $custRow = $query->fetch_assoc();


        ?>

    <?php

    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = '';
    $DB_NAME = 'frubji';
    
    try{
        $DB_con = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME}",$DB_USER,$DB_PASS);
        $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
        
    
    if(isset($_POST['btn_save_updates']))
    {        
        $stmt_edit = $DB_con->prepare('SELECT img FROM tbl_users WHERE userID =:userID');
        $stmt_edit->execute(array(':userID'=>$userID));
        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($edit_row);

        $userID = $studentid;
        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $state = $_POST['state'];   
        $city = $_POST['city']; 
        $pincode = $_POST['pincode'];
        $flatno = $_POST['flatno'];


        $fblink = $_POST['fblink'];
        $instalink = $_POST['instalink'];
        $twitterlink = $_POST['twitterlink'];
       
        $imgFile = $_FILES['user_image']['name'];
        $tmp_dir = $_FILES['user_image']['tmp_name'];
        $imgSize = $_FILES['user_image']['size'];
                    
        if($imgFile)
        {
            $upload_dir = 'images/profile/'; // upload directory 
            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $img = rand(1000,1000000).".".$imgExt;
            if(in_array($imgExt, $valid_extensions))
            {           
                if($imgSize < 5000000)
                {
                    unlink($upload_dir.$edit_row['img']);
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
            $img = $edit_row['img']; // old image from database
        }   
                        


        // if no error occured, continue ....
        if(!isset($errMSG))
        {
        $stmt = $DB_con->prepare('UPDATE tbl_users SET img=:img, userName =:userName, userEmail=:userEmail, mobile=:mobile, address=:address, state=:state, city=:city, pincode=:pincode, flatno=:flatno,fblink=:fblink,instalink=:instalink,twitterlink=:twitterlink
        WHERE userID=:userID');
           
            $stmt->bindParam(':img',$img);
            $stmt->bindParam(':userName',$userName);
            $stmt->bindParam(':userEmail',$userEmail);
            $stmt->bindParam(':mobile',$mobile);
            $stmt->bindParam(':address',$address);
            $stmt->bindParam(':state',$state);
            $stmt->bindParam(':city',$city);
            $stmt->bindParam(':pincode',$pincode);
            $stmt->bindParam(':flatno',$flatno);

            $stmt->bindParam(':fblink',$fblink);
            $stmt->bindParam(':instalink',$instalink);
            $stmt->bindParam(':twitterlink',$twitterlink);

            $stmt->bindParam(':userID',$userID);
                
            if($stmt->execute()){
                ?>
                <script>
                alert('Successfully Updated ...');
                window.location.href='profile.php';
                </script>
                <?php
            }
            else{
                $errMSG = "Sorry Data Could Not Updated !";
            }
        
        }
        
                        
    }
    
?>
   <?php

                                          include"db.php";

                                          $r = $custRow['representativeid'];
                                          $result = mysqli_query($con,"SELECT * FROM representative where id = $r");

                                          while($row = mysqli_fetch_array($result))
                                          {
                                             $referral_code = $row['referral_code'];
                                          
                                          }
                                          ?>

     

                                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                             

                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">Represetative ID &nbsp;<span class="required">*</span></label>
                                              <input class="form-control"  placeholder="Representative ID " value="<?php echo $referral_code; ?>" readonly=""  name="representativeid" required="" type="text">
                                            </p>

                                          

                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">Username &nbsp;<span class="required">*</span></label>
                                              <input class="form-control"  placeholder="Enter your username" value="<?php echo $custRow['userName']; ?>" name="userName" required="" type="text">
                                            </p>

                                             <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">Email address&nbsp;<span class="required">*</span></label>

                                              <input class="form-control"  placeholder="Type your email address" name="userEmail" value="<?php echo $custRow['userEmail']; ?>" required="" type="email">
                                            </p>

                                           
                                              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide" id="mobile-block">
                                              <label for="mobile">Mobile&nbsp;<span class="required">*</span></label>

                                              <input type="text" class="form-control user-verify-mobile" value="<?php echo $custRow['mobile']; ?>" minlength="10" maxlength="10" placeholder="Enter your Mobile" name="mobile" required="" />
                                              <br/>
                                            </p>
                                              
                                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">Flat No &nbsp;<span class="required">*</span></label>
                                              <input class="form-control"  placeholder="Enter your Flat No" value="<?php echo $custRow['flatno']; ?>" name="flatno" required="" type="text">
                                            </p>

                                             <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"  id="mobile-block">
                                              <label for="username">Address&nbsp;<span class="required">*</span></label>

                                              <input class="form-control" id="address" placeholder="Enter Your Address" value="<?php echo $custRow['address']; ?>" name="address" required="" type="text">
                                            </p>

                                            </div>
                                            <div class="u-column2 col-2">
                                      
                                                <img src="media/profile/<?php echo $img; ?>" height="100" width="100" />

                                                <input type="file" name="user_image" accept="image/*" />

                                                <p class="help-block">Image should be 500 x 500 in pixels</p>
                                              

                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">City &nbsp;<span class="required">*</span></label>
                                              <input class="form-control"  placeholder="Enter your city"  value="<?php echo $custRow['city']; ?>" name="city"  type="text">
                                            </p>   

                                             <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">Pincode &nbsp;<span class="required">*</span></label>
                                              <input class="form-control"  placeholder="Enter your pincode"  value="<?php echo $custRow['pincode']; ?>" name="pincode"  type="text">
                                            </p>  

                                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">State &nbsp;<span class="required">*</span></label>
                                              <input class="form-control"  placeholder="Enter your state" value="<?php echo $custRow['state']; ?>"  name="state"  type="text">
                                            </p>


                                              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">FB Link </label>
                                              <input class="form-control"  placeholder="Enter your fb" value="<?php echo $custRow['fblink']; ?>"  name="fblink"  type="text">
                                            </p>
                                              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">Instagram Link  </label>
                                              <input class="form-control"  placeholder="Enter your instagram" value="<?php echo $custRow['instalink']; ?>"  name="instalink"  type="text">
                                            </p>
                                              <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                              <label for="username">Twitter Link  </label>
                                              <input class="form-control"  placeholder="Enter your twitter" value="<?php echo $custRow['twitterlink']; ?>"  name="twitterlink"  type="text">
                                            </p>





                                            <div class="form-group" >

                                             <input class="btn btn-primary btn-block register-btn"  type="submit" name="btn_save_updates" value="Update Profile"  />
                                           
                                            </div>
                                        </form>  

                                        
                                 
                                 
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>



                      
                                



                   



<?php include "footer.php"; ?>
<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

<?php
include "allscript.php"; ?>