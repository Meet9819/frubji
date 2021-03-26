<?php error_reporting(0);
define(SERVER_ROOT, __DIR__);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> 
<?php include "allcss.php"; ?>


  <link data-minify="1" rel='stylesheet' id='elementskit-css-widgetarea-control-editor-css' href='wp-content/cache/min/18/marketo/grocery/wp-content/plugins/elementskit-lite/modules/controls/assets/css/widgetarea-editor-04f69d79ad47f9c09881979612f900c9' type='text/css' media='all' />
  <link data-minify="1" rel='stylesheet' id='elementor-global-css' href='wp-content/cache/min/18/marketo/grocery/wp-content/uploads/sites/18/elementor/css/global-30eff498931cd89c98b5abecb63ae454.css' type='text/css' media='all' />
  <link data-minify="1" rel='stylesheet' id='elementor-post-1096-css' href='wp-content/cache/min/18/marketo/grocery/wp-content/uploads/sites/18/elementor/css/post-1096-af9271886b61e4828f355c808fd09cfb.css' type='text/css' media='all' />
  


<?php include "header.php"; ?>

<body class="page-template page-template-template page-template-template-full-width page-template-templatetemplate-full-width-php page page-id-1096 theme-marketo woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default elementor-kit-2663 elementor-page elementor-page-1096" data-spy="scroll" data-target="#header">
  <div class="xs-breadcumb">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Terms and Conditions</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="page" role="main">
    <div class="builder-content xs-transparent">
      <div id="post-1096" class="full-width-content post-1096 page type-page status-publish hentry">
        <div data-elementor-type="wp-post" data-elementor-id="1096" class="elementor elementor-1096 elementor-bc-flex-widget" data-elementor-settings="[]">
          <div class="elementor-inner">
            <div class="elementor-section-wrap">
              <section class="elementor-element elementor-element-cfe10fe elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="cfe10fe" data-element_type="section">
                <div class="elementor-container elementor-column-gap-default">
                  <div class="elementor-row">
                    <div class="elementor-element elementor-element-22a4f3d elementor-column elementor-col-100 elementor-top-column" data-id="22a4f3d" data-element_type="column">
                      <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">


                           <?php
include('db.php');


$result = mysqli_query($con,"SELECT * FROM e_staticpages where id = 1");
while($row = mysqli_fetch_array($result))
{

echo '
    '.$row['content'].''; 
  }
  ?>
                      
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <section class="elementor-element elementor-element-4dfb7df2 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="4dfb7df2" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                <div class="elementor-container elementor-column-gap-default">
                  <div class="elementor-row">
                    <div class="elementor-element elementor-element-12cff299 elementor-column elementor-col-100 elementor-top-column" data-id="12cff299" data-element_type="column">
                      <div class="elementor-column-wrap elementor-element-populated">
                        <div class="elementor-widget-wrap">
                          <section class="elementor-element elementor-element-4bc48c05 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="4bc48c05" data-element_type="section">
                            <div class="elementor-container elementor-column-gap-default">
                              <div class="elementor-row">
                                <div class="elementor-element elementor-element-240bf7a6 elementor-column elementor-col-50 elementor-inner-column" data-id="240bf7a6" data-element_type="column">
                                  <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                      <div class="elementor-element elementor-element-61731d32 elementor-position-left elementor-vertical-align-middle elementor-view-default elementor-widget elementor-widget-icon-box" data-id="61731d32" data-element_type="widget" data-widget_type="icon-box.default">
                                        <div class="elementor-widget-container">
                                          <div class="elementor-icon-box-wrapper">
                                            <div class="elementor-icon-box-icon"> <span class="elementor-icon elementor-animation-" > <i class="icon icon-email" aria-hidden="true"></i> </span></div>
                                            <div class="elementor-icon-box-content">
                                              <h3 class="elementor-icon-box-title"> <span >Newsletter & Get Updates</span></h3>
                                              <p class="elementor-icon-box-description">Sign up for our newsletter to get up-to-date from us</p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="elementor-element elementor-element-7f828f09 elementor-column elementor-col-50 elementor-inner-column" data-id="7f828f09" data-element_type="column">
                                  <div class="elementor-column-wrap elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                      <div class="elementor-element elementor-element-7b7bb1c5 elementor-widget elementor-widget-xs-subscribe" data-id="7b7bb1c5" data-element_type="widget" data-widget_type="xs-subscribe.default">
                                        <div class="elementor-widget-container">
                                          <form action="#" method="POST" class="xs-newsletter newsLetter-v3" data-link="test"> <label for="xs-newsletter-email"></label> <input type="email" name="email" id="xs-newsletter-email" placeholder="Enter Your Mail Here ....."> <input type="submit" class = "xs-mailchimp-btn" value="submit"></form>
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
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 
 
      <?php include "footer.php"; ?>
      </div>     
      <?php include "allscript.php"; ?>
      
