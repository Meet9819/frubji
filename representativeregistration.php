<?php error_reporting(0);
define(SERVER_ROOT, __DIR__);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
          <li class="breadcrumb-item">My account</li>
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
                                  <div class="u-columns col2-set" id="customer_login">
                                    <div class="u-column1 col-1">
                                      <h2>Representative Registration</h2>  

                                      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


                                           <form  name="form1" id="cfupForm" action="" method="post" class="woocommerce-form woocommerce-form-login login" novalidate="novalidate">
                                                       <div class="wpcf7-response-output wpcf7-display-none" aria-hidden="true"></div>
                                                      <div class="woocommerce-message" role="alert"  id="success" style="display:none;">
                                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                      </div>                                   
                                               <div class="row">
                                                   <div class="col-md-6">
                                                         <label for="username">First Name&nbsp;<span class="required">*</span></label> <div class="form-item"> 
                                                        <input type="text" name="firstname" id="firstname" value="" size="40" class="woocommerce-Input woocommerce-Input--text input-text" aria-required="true" aria-invalid="false" placeholder="First Name" />
                                                      </div>
                                                       </p>
                                                   </div>
                                                    <div class="col-md-6">
                                                        <label for="">Last Name&nbsp;<span class="required">*</span></label>
                                                        <div class="form-item"> 
                                                          <input type="text" name="lastname" id="lastname" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Last Name" />
                                                        </div>
                                                        </p>
                                                    </div>
                                                     <div class="col-md-6">
                                                        <label for="username">Email address&nbsp;<span class="required">*</span></label>
                                                       
                                                         <div class="form-item"> <span class="wpcf7-form-control-wrap your-email">
                                                           <input type="email" id="emailid" name="emailid" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Your Email" /></span></div>
                                                          </p>
                                                     </div>

                                                        <div class="col-md-6">
                                                       
                                                        <label for="password">Password&nbsp;<span class="required">*</span></label>
                                                         <div class="form-item"> <span class="wpcf7-form-control-wrap your-email">
                                                          <input class="woocommerce-Input woocommerce-Input--text input-text" id="password" name="password" placeholder="Enter your Password" required="" type="password">

                                                         </span></div>
                                                          </p>
                                                     </div>


                                                    <div class="col-md-12"> <label for="username">Mobile No&nbsp;<span class="required">*</span></label>

                                                       <div class="form-item"> <span class="wpcf7-form-control-wrap your-phone"><input type="tel" name="mobileno" id="mobileno" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-tel" aria-invalid="false" placeholder="Your Phone" /></span></div>
                                                       </p>
                                                   </div>
                                                   <div class="col-md-12">
                                                      <label for="">Address&nbsp;<span class="required">*</span></label>
                                                       <div class="form-item"><span class="wpcf7-form-control-wrap your-message"><textarea name="address" id="address" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Message"></textarea></span></div>
                                                    </div> 



                                                     <div class="col-md-4">   <br> 
                                                         <label for="username">State&nbsp;<span class="required">*</span></label> 

                                                         <div class="form-item"> 
                                                          <input type="text" name="state" id="state" value="" size="40" class="woocommerce-Input woocommerce-Input--text input-text" aria-required="true" aria-invalid="false" placeholder="State" />
                                                        </div>
                                                       </p>
                                                    </div>
                                                    <div class="col-md-4"> <br> 
                                                        <label for="">City&nbsp;<span class="required">*</span></label>
                                                        <div class="form-item"> 
                                                          <input type="text" name="city" id="city" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="City" />
                                                        </div>
                                                        </p>
                                                    </div> 
                                                    <div class="col-md-4"> <br> 
                                                        <label for="">Pincode&nbsp;<span class="required">*</span></label>
                                                        <div class="form-item"> 
                                                          <input type="text" name="pincode" id="pincode" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Pincode" />
                                                        </div>
                                                        </p>
                                                    </div>







                                                    <div class="col-md-12">
                                                       <div class="form-submit"> 
                                                         <input type="submit" id="contactbutsave"  name="save" value="Register" class="woocommerce-button button woocommerce-form-login__submit" />
                                                       </div>
                                                       </p>
                                                    </div>
                                                    </div>
                                                    
                                                </form>
                                                              <script>
                                                               $(document).ready(function() {
                                                                 $('#contactbutsave').on('click', function() {
                                                                   $("#contactbutsave").attr("disabled", "disabled");
                                                                
                                                                   var firstname = $('#firstname').val();
                                                                   var lastname = $('#lastname').val();
                                                                   var mobileno = $('#mobileno').val();
                                                                   var emailid = $('#emailid').val();
                                                                   var password = $('#password').val();
                                                                   var address = $('#address').val();


                                                                   var city = $('#city').val();
                                                                   var state = $('#state').val();
                                                                   var pincode = $('#pincode').val();
                                                                

                                                                   if( firstname!=""){
                                                                     $.ajax({
                                                                       url: "representative/representativesave.php",
                                                                       type: "POST",
                                                                       data: {                                                                         
                                                                         firstname: firstname,
                                                                         lastname: lastname ,   
                                                                         mobileno: mobileno ,   
                                                                         emailid: emailid ,   
                                                                         password: password,    
                                                                         address: address,   
                                                                         city: city,    
                                                                         state: state,    
                                                                         pincode: pincode,      
                                                                       },
                                                                       cache: false,
                                                                       success: function(dataResult){
                                                                         var dataResult = JSON.parse(dataResult);
                                                                         if(dataResult.statusCode==200){
                                                                           $("#contactbutsave").removeAttr("disabled");
                                                                           $('#cfupForm').find('input:text').val('');
                                                                           $("#success").show();
                                                                           $('#success').html('Thank you for your interest in Frubji. We will get back to you. ');            
                                                                          //alert('Thank You for Subscribing..!!');            
                                                                            
                                                                         }
                                                                         else if(dataResult.statusCode==201){
                                                                            alert("Error occured !");
                                                                         }
                                                                         
                                                                       }
                                                                     });
                                                                   }
                                                                   else{
                                                                     alert('Please fill all the field !');
                                                                   }
                                                                 });
                                                               });
                                                               </script>

                                 

              



                                    </div>

                                      <div class="u-column1 col-1">
                                           <img  style="margin-left: 43px;" src="media/login.JPEG">
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