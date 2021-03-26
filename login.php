
<?php
error_reporting(0);
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
    
    
    $user_login->redirect('shop.php?q=2');
}

if(isset($_POST['btn-login']))
{
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtupass']);

    if($user_login->login($email,$upass))
    {
        $user_login->redirect('login.php');
    }
}
?>
    <!-- LOGIN --> 

    <?php include "allcss.php"; ?>
<?php include "header.php"; ?>
<body class="page-template page-template-template page-template-template-full-width page-template-templatetemplate-full-width-php page page-id-7  theme-marketo woocommerce-account woocommerce-page woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default elementor-kit-2663 elementor-page elementor-page-7" data-spy="scroll" data-target="#header">
  <div class="xs-breadcumb">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Login</li>
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
                                  <div class="u-columns col2-set" id="customer_login" style="text-align: center;">  <h2>Login</h2>  
                                    <div class="u-column1 col-1">
                                    


                                       <?php 
                                        if(isset($_GET['inactive']))
                                        {
                                            ?>
                                             <div class='alert alert-danger'>
                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                 <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it.
                                              </div>
                                             <?php
                                        }
                                        ?>
                                       <?php
                                        if(isset($_GET['error']))
                                        {
                                            ?>
                                            <div class='alert alert-danger'>
                                                <button class='close' data-dismiss='alert'>&times;</button>
                                                  <strong>Wrong Details!</strong>
                                            </div>
                                        <?php
                                        }
                                      ?>

                                      <form class="woocommerce-form woocommerce-form-login login" action="" method="post" name="registration" id="create-account_form">


                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                          <label for="username">Username or email address&nbsp;<span class="required">*</span></label>

                                          <input class="woocommerce-Input woocommerce-Input--text input-text" placeholder="Enter your Email Id / Mobile No"  id="email" name="txtemail" required="" type="text">
                                        </p>


                                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                         <label for="password">Password&nbsp;<span class="required">*</span></label>

                                           <input class="woocommerce-Input woocommerce-Input--text input-text" id="passwd" name="txtupass" placeholder="Enter your Password" required="" type="password">
                                        </p>

                                         <button type="submit" name="btn-login" class="woocommerce-button button woocommerce-form-login__submit"> Sign In</button>

                                          <p class="woocommerce-LostPassword lost_password"><a href="register.php">Create New Account</a></p>    
                                          <p style="text-align: right;" class="woocommerce-LostPassword lost_password"><a href="fpass.php">Lost your password?</a></p>
                                      </form>
                    

                                    </div>

                                      <div class="u-column1 col-1"> <br><Br>
                                          <img   src="media/login.png">
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
  <?php include "allscript.php"; ?>