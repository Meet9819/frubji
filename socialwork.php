<?php error_reporting(0);
define(SERVER_ROOT, __DIR__);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> 

  <link data-minify="1" rel='stylesheet' id='elementor-post-1083-css' href='wp-content/cache/min/18/marketo/grocery/wp-content/uploads/sites/18/elementor/css/post-1083-0e16bf83dc03c1297aa56b9413ca19a9.css' type='text/css' media='all' />

  
<?php include "allcss.php"; ?> 
<?php include "header.php"; ?>


<body class="page-template page-template-template page-template-template-full-width page-template-templatetemplate-full-width-php page page-id-1083 theme-marketo woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default elementor-kit-2663 elementor-page elementor-page-1083" data-spy="scroll" data-target="#header">

  <div class="xs-breadcumb">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Social Work</li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="page" role="main">






  <div class="builder-content xs-transparent">
  <div id="post-1083" class="full-width-content post-1083 page type-page status-publish hentry">
  <div data-elementor-type="wp-post" data-elementor-id="1083" class="elementor elementor-1083" data-elementor-settings="[]">
  <div class="elementor-inner">
  <div class="elementor-section-wrap">


  <?php

                                          include"db.php";

                                          $result = mysqli_query($con,"SELECT * FROM socialwork ");
                                           $i = 0;
                                          while($row = mysqli_fetch_array($result))
                                          {

                                             if($i%2 == 0)
                                       {
                                            echo '
                                      <section class="elementor-element elementor-element-6342a58 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="6342a58" data-element_type="section">
                                              
                                              <div class="elementor-container elementor-column-gap-default">
                                                <div class="elementor-row">
                                                  <div class="elementor-element elementor-element-fea650e elementor-column elementor-col-66 elementor-top-column" data-id="fea650e" data-element_type="column">
                                                  <div class="elementor-column-wrap elementor-element-populated">
                                                  <div class="elementor-widget-wrap">
                                                  <div class="elementor-element elementor-element-a489178 elementor-widget elementor-widget-xs-heading" data-id="a489178" data-element_type="widget" data-widget_type="xs-heading.default">
                                                  <div class="elementor-widget-container">
                                                  <div class="xs-about-content">
                                                  <div class="about-info">
                                                  
                                                    <h3 class="xs-heading-title">'.$row['title'].'</h3>
                                                    <p class="lead">'.$row['description'].'</p>
                                                  </div>
                                                  <span class="xs-watermark-text"> SOCIAL</span>
                                                  </div></div></div>
                                              </div>
                                             </div>

                                          </div>
                                          <div class="elementor-element elementor-element-9d91de4 elementor-column elementor-col-33 elementor-top-column" data-id="9d91de4" data-element_type="column">
                                            <div class="elementor-column-wrap elementor-element-populated">
                                              <div class="elementor-widget-wrap">
                                                <div class="elementor-element elementor-element-a9a0ca2 elementor-widget elementor-widget-image" data-id="a9a0ca2" data-element_type="widget" data-widget_type="image.default">
                                                  <div class="elementor-widget-container">
                                                    <div class="elementor-image">
                                                      <img width="445" height="377" src="admin/superadmin/ecommerce/socialworkimages/'.$row['image'].'" class="attachment-large size-large wp-post-image" alt="" data-lazy-src="admin/superadmin/ecommerce/socialworkimages/'.$row['image'].'" />
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          </div>
                                        </div>
                                     </section>
                                   '; 
                                     }

                                     else
                                     {
                                        echo ' 
                                <section class="elementor-element elementor-element-9a8a463 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="9a8a463" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                  <div class="elementor-container elementor-column-gap-default">
                                    <div class="elementor-row">
                                      

                                      <div class="elementor-element elementor-element-1b21cc4 elementor-column elementor-col-50 elementor-top-column" data-id="1b21cc4" data-element_type="column">
                                        <div class="elementor-column-wrap elementor-element-populated">
                                          <div class="elementor-widget-wrap">
                                            <div class="elementor-element elementor-element-c06072f elementor-widget elementor-widget-image" data-id="c06072f" data-element_type="widget" data-widget_type="image.default">
                                              <div class="elementor-widget-container">
                                                <div class="elementor-image">
                                                  <img width="500" height="370" src="" class="attachment-large size-large wp-post-image" alt="" data-lazy-src="admin/superadmin/ecommerce/socialworkimages/'.$row['image'].'" />
                                                  <noscript><img width="500" height="370" src="admin/superadmin/ecommerce/socialworkimages/'.$row['image'].'" class="attachment-large size-large wp-post-image" alt="" /></noscript>
                                                </div>
                                              </div>
                                            </div>
                                           
                                          </div>
                                        </div>
                                      </div>
                                      <div class="elementor-element elementor-element-414b710 elementor-column elementor-col-50 elementor-top-column" data-id="414b710" data-element_type="column">
                                        <div class="elementor-column-wrap elementor-element-populated">
                                          <div class="elementor-widget-wrap">
                                            <div class="elementor-element elementor-element-5ce8cd8 elementor-widget elementor-widget-xs-heading" data-id="5ce8cd8" data-element_type="widget" data-widget_type="xs-heading.default">
                                              <div class="elementor-widget-container">
                                                <div class="xs-about-content">
                                                  <div class="about-info">
                                                  
                                                     <h3 class="xs-heading-title">'.$row['title'].'</h3>
                                                    <p class="lead">'.$row['description'].'</p>
                                                  </div>
                                                  <span class="xs-watermark-text"> WORK</span>
                                                </div>
                                              </div>
                                            </div>
                                           
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </section>

                                   '; 
                                   }
                                   $i++;
                                       } ?>






</div></div></div></div></div></div>
<div class="xs-sidebar-group">
  <div class="xs-overlay bg-black"></div>
  <div class="xs-minicart-widget">
    <div class="widget-heading media">
      <h3 class="widget-title align-self-center d-flex">Shopping cart</h3>
      <div class="media-body"> <a href="#" class="close-side-widget"> <i class="icon icon-cross"></i> </a></div>
    </div>
    <div class="widget woocommerce widget_shopping_cart">
      <div class="widget_shopping_cart_content"></div>
    </div>
  </div>
</div>

      <?php include "footer.php"; ?>
   


      </div>     
      <?php include "allscript.php"; ?>
      