<?php

require_once "class/encdec.php";

// Turn off all error reporting
error_reporting(0);

session_start();

require_once 'class.user.php';

$reg_user = new USER();

if($reg_user->is_logged_in()) {
  $reg_user->redirect('shop.php?q=2');
}

// referral link 
$referral_code = null;

if (!empty($_SESSION["referralCode"])) {
  if (empty($_SESSION["referralTimeOut"]) || (!empty($_SESSION["referralTimeOut"]) && ((time() - $_SESSION["referralTimeOut"]) > 3600)))  {
    unset($_SESSION["referralCode"]);
    unset($_SESSION["referralTimeOut"]);
  } else {
    $referral_code = $_SESSION["referralCode"];
  }
} else {
  $referral_code = !empty($_GET["referral"]) ? Utility\EncryptDecrypt::decrypt_data($_GET["referral"]) : null;

  if (!empty($referral_code))  {
    // verify code
    $stmt = $reg_user->runQuery("SELECT COUNT(*) AS `total` FROM `representative` WHERE `referral_code` = :code AND `status` = 1");

    $stmt->execute(array(":code"=>$referral_code));

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() > 0) {
      $_SESSION["referralCode"] = $referral_code;
      $_SESSION["referralTimeOut"] = time();
    } else {
      $referral_code = null;
    }
  }
}
// referral link 

$msg = "";

if(isset($_POST["register"]) && ($_POST["register"] == "Sign Up"))
{
    $uname = trim($_POST['txtuname']);
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtpass']);
    $mobile = trim($_POST["mobile"]);
    $address = trim($_POST['address']);
    $referral = trim($_POST["representativeid"]);

    $dat = explode("_", $referral);

    $representative_id = (int) $dat[1];

    $code = md5(uniqid(rand()));
    
    $stmt = $reg_user->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
    $stmt->execute(array(":email_id"=>$email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($stmt->rowCount() > 0) {
        $msg = "<div class='alert alert-danger'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Sorry !</strong>  Email already exists , Please Try another one OR do you want to Login ?
                </div>";
    } else { 
        if($reg_user->register($uname,$email,$upass,$code,$mobile,$address, $representative_id)) {           
            $id = $reg_user->lasdID();      
            $key = base64_encode($id);
            $id = $key;
            $message = "<center>
                            <img style='width:300px' src='http://grocerpoint.in/assets/images/logo/logo.png'/>      <br>                
                            <p style='font-size:20px;color:black'><b>{$uname},</b><br /><br />
                                Welcome to Grocer Point<br>
                                To sign in to our website, use these credentials during checkout or on the <a style='color:blue' href='http://grocerpoint.in/profile.php' target='_blank'> My Account </a> page:<br />
                                <b>Email:</b> {$email}<br />
                                <b>Password:</b> Password you set when creating account <br/ >
                                If you have forgotten your account password then click <a style='color:blue' href='http://grocerpoint.in/fpass.php' target='_blank'>here </a> to reset it. <br />
                                When you sign in to your account, you will be able to: <br / > <br />
                                - Proceed through checkout faster <br>
                                - Check the status of your order <br>
                                - View order history <br /><br />
                                Thank You, Grocer Point <br>
                            </p>
                        </center>";
                        
            $subject = "Welcome to Grocer Point ";
                        
            $reg_user->send_mail($email,$message,$subject); 

            $msg = "<div class='alert alert-success'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Success!</strong> Thank you for registering with Grocer Point . Please Sign In using your login credentials.
                    </div>";
            header("Location: index.php");            
        } else {
            $msg = "<div class='alert alert-danger'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Failure!</strong> Some error occured while registering with us. Please try again.
                    </div>";
        }       
    }
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
          <li class="breadcrumb-item">Register</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="page" role="main">
    <div class="builder-content xs-transparent">
      <!-- full-width-content -->
      <div id="post-7" class="full-width-content post-7 page type-page status-publish hentry">
        <div data-elementor-type="wp-page" data-elementor-id="7" class="elementor elementor-7 elementor-bc-flex-widget" data-elementor-settings="[]">
          <div class="elementor-inner">
            <div class="elementor-section-wrap">
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
                                  <div class="u-columns col2-set" id="customer_login" style="text-align: center;">

                                      <h2>Register</h2>

                                   <!-- referral link -->
                                   <?php if (empty($referral_code)) { ?>
                                    <div class="alert alert-warning">
                                        <strong>Warning!</strong> You need a <B>Referral link</B> from any of our REPRESENTATIVES to register with us. You can call us on <b><?php echo $_SESSION["branch"]["mobile"] ?? ""; ?></b> to become a REPRESENTATIVE.
                                    </div>
                                    <?php } ?>
                                    <!-- referral link -->
                                    <div class="u-column1 col-1">
                                        <img src="media/register.png">
                                    </div>
                                    <div class="u-column2 col-2">
                                    
                                      <?php 
                                            if(isset($msg)) {
                                                echo $msg;
                                            }  
                                        ?> 

                                      <form class="woocommerce-form woocommerce-form-login login" action="" method="post" name="registration" id="create-account_form">
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                          <label for="username">Represetative ID &nbsp;<span class="required">*</span></label>
                                          <input class="form-control"  placeholder="Representative ID " value="<?php echo $referral_code; ?>" readonly=""  name="representativeid" required="" type="text">
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                          <label for="username">Username &nbsp;<span class="required">*</span></label>
                                          <input class="form-control"  placeholder="Enter your username"  name="txtuname" required="" type="text">
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                          <label for="username">Email address&nbsp;<span class="required">*</span></label>
                                          <input class="form-control"  placeholder="Type your email address" name="txtemail" required="" type="email">
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                          <label for="username">Password&nbsp;<span class="required">*</span></label>
                                          <input class="form-control" placeholder="Type your password" value="" name="txtpass"  required="" type="password">
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide" id="mobile-block">
                                          <label for="mobile">Mobile&nbsp;<span class="required">*</span></label>
                                          <input class="form-control user-verify-mobile" placeholder="Enter your mobile no." value="" name="mobile" type="text" minlength="10" maxlength="10" required />
                                          <br/>
                                          <span class="verify-mobile-alert"></span>
                                        </p>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"  id="otp-block">
                                          <label for="username">OTP&nbsp;<span class="required">*</span></label>
                                          <input type="text" class="form-control user-verify-otp" id="otp" minlength="10" maxlength="10" placeholder="Enter OTP" name="otp" required="" disabled />
                                          <br/>
                                          <span class="verify-otp-alert"></span>
                                          <br/>
                                          <span class="verify-otp-timeout"></span>
                                        </p>
                                        <div class="form-group text-right">
                                          <span id="mobile-otp-message-block"></span>
                                        </div>
                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide"  id="mobile-block">
                                          <label for="username">Address&nbsp;<span class="required">*</span></label>
                                          <input class="form-control" id="address" placeholder="Enter Your Address" value="" name="address" required="" type="text">
                                        </p>
                                        <div class="checkbox">
                                          <label>
                                            <input style="margin: 5px;" type="checkbox" name="termsandconditions" required="" />I Agree To <a href="terms.php" target="_blank" >The Terms Of Use ?</a>
                                          </label>
                                        </div>
                                        <br />
                                        <?php if (!empty($referral_code)) { ?>
                                          <div class="form-group" >
                                            <input class="btn btn-primary btn-block register-btn"  type="submit" name="register" value="Sign Up" disabled />
                                          </div>
                                        <?php } ?>
                                      </form>
                                      <a href="login.php">Have an account? Login Here</a>

                                        
                                 
                                 
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
            </div>
          </div>
        </div>
      </div>
      <!-- end full-width-content -->
    </div>
    <!-- end main-content -->
  </div>
  <!-- end main-content -->
  <div class="xs-sidebar-group">
    <div class="xs-overlay bg-black"></div>
    <div class="xs-minicart-widget">
      <div class="widget-heading media">
        <h3 class="widget-title align-self-center d-flex">Shopping cart</h3>
        <div class="media-body">
          <a href="#" class="close-side-widget">
          <i class="icon icon-cross"></i>
          </a>
        </div>
      </div>
      <div class="widget woocommerce widget_shopping_cart">
        <div class="widget_shopping_cart_content"></div>
      </div>
    </div>
  </div>
  <?php include "footer.php"; ?>
  </div>     
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <?php include "allscript.php"; ?>
  <script src="js/sms.js"></script>
  <script src="js/custom.js"></script>