<?php error_reporting(0);
define(SERVER_ROOT, __DIR__);
 
include('db.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> 

<?php include "allcss.php"; ?>
<?php include "header.php"; ?>



   <body class="home page-template page-template-template page-template-template-multipage-homepage page-template-templatetemplate-multipage-homepage-php page page-id-2269 theme-marketo woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default elementor-kit-2663 elementor-page elementor-page-2269" data-spy="scroll" data-target="#header"> 



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 
 
      <div data-elementor-type="wp-post" data-elementor-id="2269" class="elementor elementor-2269 elementor-bc-flex-widget" data-elementor-settings="[]">
         <div class="elementor-inner">
            <div class="elementor-section-wrap"> 


              <!-- <section class="elementor-element elementor-element-0a7668e elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="0a7668e" data-element_type="section">
                  <div class="elementor-container elementor-column-gap-default">
                     <div class="elementor-row">
                        <div class="elementor-element elementor-element-388a871 elementor-column elementor-col-100 elementor-top-column" data-id="388a871" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-f32917c elementor-widget elementor-widget-wp-widget-rev-slider-widget" data-id="f32917c" data-element_type="widget" data-widget_type="wp-widget-rev-slider-widget.default">
                                    <div class="elementor-widget-container">
                                       <p class="rs-p-wp-fix"></p>
                                       <rs-module-wrap id="rev_slider_12_1_wrapper" data-source="gallery" style="background:transparent;padding:0;margin:0px auto;margin-top:0;margin-bottom:0;">
                                          <rs-module id="rev_slider_12_1" style="display:none;" data-version="6.1.5">
                                             <rs-slides>
                                             
                                             <?php

                                          include"db.php";

                                          $result = mysqli_query($con,"SELECT * FROM slider ");

                                          while($row = mysqli_fetch_array($result))
                                          {
                                          echo '

                                          
                                              <rs-slide data-key="rs-'.$row['id'].'" data-title="Slide" data-thumb="admin/superadmin/ecommerce/sliderimages/'.$row['image'].'" data-anim="ei:d;eo:d;s:d;r:0;t:curtain-3;sl:d;">
                                                   <img src="wp-content/plugins/revslider/public/assets/assets/dummy.png" title="Home Grocery" data-lazyload="admin/superadmin/ecommerce/sliderimages/'.$row['image'].'" data-bg="p:50% 0%;" data-parallax="off" class="rev-slidebg" data-no-retina> 
                                                 
                                                </rs-slide>




                                                ';
                                                }
                                                ?>

                                              



                                              


                                             </rs-slides>
                                             <rs-progress style="height: 5px; background: rgba(0,0,0,0.15);"></rs-progress>
                                          </rs-module>
                                          <script type="text/javascript">setREVStartSize({c: 'rev_slider_12_1',rl:[1240,1024,778,480],el:[],gw:[1240,1024,778,480],gh:[600,600,500,400],layout:'fullwidth',mh:"0"});
                                             var	revapi12,
                                             	tpj;
                                             jQuery(function() {
                                             	tpj = jQuery;
                                             	if(tpj("#rev_slider_12_1").revolution == undefined){
                                             		revslider_showDoubleJqueryError("#rev_slider_12_1");
                                             	}else{
                                             		revapi12 = tpj("#rev_slider_12_1").show().revolution({
                                             			jsFileLocation:"//wp.xpeedstudio.com/marketo/grocery/wp-content/plugins/revslider/public/assets/js/",
                                             			sliderLayout:"fullwidth",
                                             			visibilityLevels:"1240,1024,778,480",
                                             			gridwidth:"1240,1024,778,480",
                                             			gridheight:"600,600,500,400",
                                             			minHeight:"",
                                             			lazyType:"smart",
                                             			responsiveLevels:"1240,1024,778,480",
                                             			navigation: {
                                             				mouseScrollNavigation:false,
                                             				touch: {
                                             					touchenabled:true,
                                             					swipe_min_touches:50
                                             				},
                                             				arrows: {
                                             					enable:true,
                                             					style:"hesperiden",
                                             					hide_onmobile:true,
                                             					hide_under:600,
                                             					hide_onleave:true,
                                             					left: {
                                             						h_offset:30
                                             					},
                                             					right: {
                                             						h_offset:30
                                             					}
                                             				},
                                             				bullets: {
                                             					enable:true,
                                             					tmp:"",
                                             					style:"hephaistos",
                                             					hide_onmobile:true,
                                             					hide_under:600,
                                             					hide_onleave:true,
                                             					v_offset:30
                                             				}
                                             			},
                                             			parallax: {
                                             				levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
                                             				type:"mouse",
                                             				origo:"slidercenter",
                                             				speed:1000
                                             			},
                                             			fallbacks: {
                                             				allowHTML5AutoPlayOnAndroid:true
                                             			},
                                             		});
                                             	}
                                             	
                                             });
                                          </script>

                                          <script>var htmlDivCss = unescape("%23rev_slider_12_1_wrapper%20.hesperiden.tparrows%20%7B%0A%09cursor%3Apointer%3B%0A%09background%3Argba%280%2C0%2C0%2C0.5%29%3B%0A%09width%3A40px%3B%0A%09height%3A40px%3B%0A%09position%3Aabsolute%3B%0A%09display%3Ablock%3B%0A%09z-index%3A1000%3B%0A%20%20%20%20border-radius%3A%2050%25%3B%0A%7D%0A%23rev_slider_12_1_wrapper%20.hesperiden.tparrows%3Ahover%20%7B%0A%09background%3A%23000000%3B%0A%7D%0A%23rev_slider_12_1_wrapper%20.hesperiden.tparrows%3Abefore%20%7B%0A%09font-family%3A%20%27revicons%27%3B%0A%09font-size%3A20px%3B%0A%09color%3A%23ffffff%3B%0A%09display%3Ablock%3B%0A%09line-height%3A%2040px%3B%0A%09text-align%3A%20center%3B%0A%7D%0A%23rev_slider_12_1_wrapper%20.hesperiden.tparrows.tp-leftarrow%3Abefore%20%7B%0A%09content%3A%20%27%5Ce82c%27%3B%0A%20%20%20%20margin-left%3A-3px%3B%0A%7D%0A%23rev_slider_12_1_wrapper%20.hesperiden.tparrows.tp-rightarrow%3Abefore%20%7B%0A%09content%3A%20%27%5Ce82d%27%3B%0A%20%20%20%20margin-right%3A-3px%3B%0A%7D%0A%23rev_slider_12_1_wrapper%20.hephaistos%20.tp-bullet%20%7B%0A%09width%3A12px%3B%0A%09height%3A12px%3B%0A%09position%3Aabsolute%3B%0A%09background%3A%23999999%3B%0A%09border%3A3px%20solid%20rgba%28255%2C255%2C255%2C0.9%29%3B%0A%09border-radius%3A50%25%3B%0A%09cursor%3A%20pointer%3B%0A%09box-sizing%3Acontent-box%3B%0A%20%20%20%20box-shadow%3A%200px%200px%202px%201px%20rgba%28130%2C130%2C130%2C%200.3%29%3B%0A%7D%0A%23rev_slider_12_1_wrapper%20.hephaistos%20.tp-bullet%3Ahover%2C%0A%23rev_slider_12_1_wrapper%20.hephaistos%20.tp-bullet.selected%20%7B%0A%09background%3A%23ffffff%3B%0A%20%20%20%20border-color%3A%23000000%3B%0A%7D%0A");
                                             var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
                                             if(htmlDiv) {
                                             	htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                             }else{
                                             	var htmlDiv = document.createElement('div');
                                             	htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
                                             	document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
                                             }
                                          </script> <script>var htmlDivCss = unescape("%0A%0A%0A%0A%0A%0A");
                                             var htmlDiv = document.getElementById('rs-plugin-settings-inline-css');
                                             if(htmlDiv) {
                                             	htmlDiv.innerHTML = htmlDiv.innerHTML + htmlDivCss;
                                             }else{
                                             	var htmlDiv = document.createElement('div');
                                             	htmlDiv.innerHTML = '<style>' + htmlDivCss + '</style>';
                                             	document.getElementsByTagName('head')[0].appendChild(htmlDiv.childNodes[0]);
                                             }
                                          </script> 
                                       </rs-module-wrap>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>  -->

<style type="text/css">
   @media screen and (max-width: 900px) {
  .webslider { display: none;
  }
}


</style>


 <div id="myCarousel" class="webslider carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner"> 

                                 <?php include('admin/db.php');
                                     $result = mysqli_query($con,"SELECT * FROM slider  ");

                                     $count  = 0;
                                     while($row = mysqli_fetch_array($result))
                                     {

                                      if ($count == 0)
                                      {
                                           echo '  <div class="item active">
                                                        <img src="admin/superadmin/ecommerce/sliderimages/'.$row['image'].'" alt="'.$row['image'].'" style="width:100%;">  
                                                       
                                                      </div>
                                                ';
                                      }
                                      else {
                                           echo '   <div class="item">
                                                        <img src="admin/superadmin/ecommerce/sliderimages/'.$row['image'].'" alt="'.$row['image'].'" style="width:100%;"> 
                                                         
                                                  </div>';
                                      }

                                      $count++;

                                  } ?>

    
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>




<style type="text/css">
   @media screen and (min-width: 900px) {
  .appslider { display: none;
  }
}


</style>


  <div id="myCarousel" class="appslider carousel slide" data-ride="carousel">
 
    <!-- Wrapper for slides -->
    <div class="carousel-inner"> 

                                 <?php include('admin/db.php');
                                     $result = mysqli_query($con,"SELECT * FROM mobileslider  ");

                                     $count  = 0;
                                     while($row = mysqli_fetch_array($result))
                                     {

                                      if ($count == 0)
                                      {
                                           echo '  <div class="item active">
                                                        <img src="media/mobileslider/'.$row['image'].'" alt="Los Angeles" style="width:100%;">  
                                                       
                                                      </div>
                                                ';
                                      }
                                      else {
                                           echo '   <div class="item">
                                                        <img src="media/mobileslider/'.$row['image'].'" alt="Los Angeles" style="width:100%;"> 
                                                         
                                                  </div>';
                                      }

                                      $count++;

                                  } ?>

    
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
     
               <?php include "homepage.php"; ?>


<style type="text/css">
   @media screen and (max-width: 900px) {
  .hideadvertise { display: none;
  }
}


</style>
             
               <section class="hideadvertise elementor-element elementor-element-71cb17c elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="71cb17c" data-element_type="section">
                  <div class="elementor-container elementor-column-gap-default">
                     <div class="elementor-row">
                            
                                             <?php

                                          include"db.php";

                                          $result = mysqli_query($con,"SELECT * FROM ecommerceadveritse ");

                                          while($row = mysqli_fetch_array($result))
                                          {
                                          echo '



                                           <div class="elementor-element elementor-element-fd68cc1 elementor-column elementor-col-50 elementor-top-column" data-id="fd68cc1" data-element_type="column">
                                             <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                   <div class="elementor-element elementor-element-34d1932 elementor-widget elementor-widget-xs-image" data-id="34d1932" data-element_type="widget" data-widget_type="xs-image.default">
                                                      <div class="elementor-widget-container">
                                                         <div class="xs-banner-campaign">
                                                            <a href="'.$row['link'].'">
                                                               <img width="340" height="280" src=" class="attachment-large size-large wp-post-image" alt="'.$row['image'].'" data-lazy-src="admin/superadmin/ecommerce/advertiseimages/'.$row['image'].'" />
                                                            </a>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div> '; } ?>

                    
                     </div>
                  </div>
               </section>




           

  <script  src="./script.js"></script>
  

               <style type="text/css">
                     @media screen and (max-width: 900px) {
                    .abcd { display: none;
                    }
                  }
               </style>
               <section class="abcd elementor-element elementor-element-2c6fb7b1 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="2c6fb7b1" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;gradient&quot;}">
                  <div class="elementor-container elementor-column-gap-default">
                     <div class="elementor-row">
                        <div class="elementor-element elementor-element-4b488980 elementor-column elementor-col-25 elementor-top-column" data-id="4b488980" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-87e3513 elementor-widget elementor-widget-xs-fun-fact" data-id="87e3513" data-element_type="widget" data-widget_type="xs-fun-fact.default" style="text-align: center;">
                                    <div class="elementor-widget-container">
                                       <div class="waypoint-tigger">
                                          <div class="media xs-single-fun-fact">
                                             <i class="icon icon-team d-felx"></i>
                                             <div class="media-body">
                                                <h4> Farmers</h4> 
                                                <p><span class="number-percentage-count number-percentage" data-value="60" data-animation-duration="1000">3</span> +</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="elementor-element elementor-element-5386d948 elementor-column elementor-col-25 elementor-top-column" data-id="5386d948" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-772d525e elementor-widget elementor-widget-xs-fun-fact" data-id="772d525e" data-element_type="widget" data-widget_type="xs-fun-fact.default"  style="text-align: center;">
                                    <div class="elementor-widget-container">
                                       <div class="waypoint-tigger">
                                          <div class="media xs-single-fun-fact">
                                             <i class="icon icon-team-1 d-felx"></i>
                                             <div class="media-body">
                                                <h4> Customers</h4>
                                                <p><span class="number-percentage-count number-percentage" data-value="450" data-animation-duration="1000">20</span> +</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="elementor-element elementor-element-43f02c85 elementor-column elementor-col-25 elementor-top-column" data-id="43f02c85" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-10cac68f elementor-widget elementor-widget-xs-fun-fact" data-id="10cac68f" data-element_type="widget" data-widget_type="xs-fun-fact.default"  style="text-align: center;">
                                    <div class="elementor-widget-container">
                                       <div class="waypoint-tigger">
                                          <div class="media xs-single-fun-fact">
                                             <i class="icon icon-vegetables d-felx"></i>
                                             <div class="media-body">
                                                <h4> Products</h4>
                                                <p><span class="number-percentage-count number-percentage" data-value="870" data-animation-duration="1000">500</span> + </p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="elementor-element elementor-element-2103cf80 elementor-column elementor-col-25 elementor-top-column" data-id="2103cf80" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-48503288 elementor-widget elementor-widget-xs-fun-fact" data-id="48503288" data-element_type="widget" data-widget_type="xs-fun-fact.default"  style="text-align: center;">
                                    <div class="elementor-widget-container">
                                       <div class="waypoint-tigger">
                                          <div class="media xs-single-fun-fact">
                                             <i class="icon icon-medal d-felx"></i>
                                             <div class="media-body">
                                                <h4> Employees</h4>
                                                <p><span class="number-percentage-count number-percentage" data-value="10" data-animation-duration="1000">100</span> +</p>
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








   <section class="elementor-element elementor-element-d523042 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="d523042" data-element_type="section">
                  <div class="elementor-container elementor-column-gap-default">
                     <div class="elementor-row">
                        <div class="elementor-element elementor-element-2751ae6 elementor-column elementor-col-100 elementor-top-column" data-id="2751ae6" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-1092c4b elementor-widget elementor-widget-image" data-id="1092c4b" data-element_type="widget" data-widget_type="image.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-image">


                                        <style type="text/css">
                                           @media screen and (max-width: 900px) {
                                          #websocialwork { display: none;
                                          }
                                        }
                                        </style>

                                        <style type="text/css">
                                           @media screen and (min-width: 900px) {
                                          #appsocialwork { display: none;
                                          }
                                        }
                                        </style>

                                          <a  href="socialwork.php"><img id="websocialwork" width="1110" height="394" src="media/socialwork.png" class="attachment-large size-large wp-post-image" alt="socialwork"  /></a>
                                        

                                          <a  href="socialwork.php"><img id="appsocialwork" width="1110" height="394" src="media/socialworkmobile.png" class="attachment-large size-large wp-post-image" alt="socialwork"  /></a>
                                        

                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>


            <?php include "testimonials.php"; ?>
            



               <section class="elementor-element elementor-element-41ad9007 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="41ad9007" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                  <div class="elementor-container elementor-column-gap-default">
                     <div class="elementor-row">
                        <div class="elementor-element elementor-element-35d602cd elementor-column elementor-col-100 elementor-top-column" data-id="35d602cd" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <section class="elementor-element elementor-element-43acfe70 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-inner-section" data-id="43acfe70" data-element_type="section">
                                    <div class="elementor-container elementor-column-gap-default">
                                       <div class="elementor-row">
                                          <div class="elementor-element elementor-element-53f034c4 elementor-column  elementor-inner-column" data-id="53f034c4" data-element_type="column">
                                             <div class="elementor-column-wrap elementor-element-populated">
                                                <div class="elementor-widget-wrap">
                                                   <div class="elementor-element elementor-element-11f95317 elementor-position-left elementor-vertical-align-middle elementor-view-default elementor-widget elementor-widget-icon-box" data-id="11f95317" data-element_type="widget" data-widget_type="icon-box.default">
                                                      <div class="elementor-widget-container">
                                                         <div class="elementor-icon-box-wrapper">
                                                           
                                                            <div class="elementor-icon-box-content">
                                                               <h3 class="elementor-icon-box-title" style="text-align: center;"> <span >“When tillage begins, other arts follow. The farmers, therefore, are the founders of human civilization.” - Daniel Webster
</span></h3>
                                                             
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
                  </div>
               </section>
            </div>
         </div>
      </div>
   
     

      <?php include "footermain.php"; ?>
      <?php include "footer.php"; ?>
      </div>      
      <?php include "alerts.php"?>
      <?php include "allscript.php"; ?>
      

  <script src="js/custom.js"></script>

  <?php
    mysqli_close($con);
  ?>