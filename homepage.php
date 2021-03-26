<?php
   include('db.php');
?>
  <div class="xs-section-padding ">
    <div class="shop-archive">
      <div class="container">   


                        <div class="xs-content-header">
                           <h2 class="xs-content-title">
                              <a href="trending.php" >All Categories </a>
                              <br /><br />
                           </h2>
                           <div class="clearfix"></div>
                        </div>

  <link rel="stylesheet" href="./style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
  <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>


  <div class="bxslider">
      <?php

                                          include"db.php";

                                          $result = mysqli_query($con,"SELECT * FROM menu where parent_id = 0 and status = '1'");

                                          while($row = mysqli_fetch_array($result))
                                          {
                                          echo '
                                          <div class="xs-single-product">
                                             <div style="padding:5px" class="xs-product-wraper text-center">
                                               <a style="margin-top:0px" class="" href="shop.php?q='.$row['menu_id'].'">
                                                 <img style="    border: 1px solid;" src="media/menu/'.$row['img'].'" alt="ClientName" title="ClientName1">   <div class="xs-product-content">
                                                 <a style="height:44px" href="shop.php?q='.$row['menu_id'].'"><h4 class="product-title">'.$row['menu_name'].'</h4></a>
                                              </div>
                                               </a>
                                          </div>
                                          </div>    
                                          '; }      
                                          ?>

  
  </div>



                      

                      </div>
           

          </div>
        </div>


<section class="elementor-element elementor-element-7977297c elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="7977297c" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}" style="padding: 2% 0% 2% 0%">
   <div class="elementor-container elementor-column-gap-default">
      <div class="elementor-row">
         <div class="elementor-element elementor-element-18f455be grocery-hover-style elementor-column elementor-col-100 elementor-top-column" data-id="18f455be" data-element_type="column">
            <div class="elementor-column-wrap elementor-element-populated">
               <div class="elementor-widget-wrap">
                  <div class="elementor-element elementor-element-27778686 elementor-widget elementor-widget-xs-woo-tab" data-id="27778686" data-element_type="widget" data-widget_type="xs-woo-tab.default">
                     <div class="elementor-widget-container">
                        <div class="xs-content-header">
                           <h2 class="xs-content-title">
                              <a href="trending.php" >Trending </a>
                              <br /><br />
                           </h2>
                           <div class="clearfix"></div>
                        </div> 




                        <?php
                           $products = array();
                                                   
                           if (empty($_SESSION["branch"]["price"]))  {
                              $result = mysqli_query($con,"SELECT 
                                    `P`.`id` `product_id`,
                                    `P`.`maincat` `product_cat`,
                                    `P`.`categoryid` `product_cat_id`,
                                    `P`.`productcode` `product_code`,
                                    `P`.`name` `product_name`,
                                    `P`.`shortdescription` `desc_short`,
                                    `P`.`description` `desc`,
                                    `P`.`img` `image`,
                                    `P`.`sale` `sale_status`,
                                    `P`.`newold` `newold_status`,
                                    `P`.`hsncode` `hsn`,
                                    `P`.`pr` `tag`
                                 FROM 
                                    `products` `P` 
                                 WHERE 
                                    `P`.`status` = '1' 
                                 AND 
                                    `p`.`newold` = 'Trending' 
                                 LIMIT 10");

                              $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
                           } else {
                              foreach ($_SESSION["branch"]["price"] as $key => $value) {
                                 if ($value["product_cat"] == 6) {
                                    array_push($products, $value);
                                    }
                                 }
                           }

                           $rowcount = count($products);

                           if ($rowcount < 1)  {
                        ?>
                        No Trending Products Found
                        <?php 
                           } else {
                        ?>

                        <div class="bxslider">
                     
                        
                        <?php
                           foreach ($products as $value) {
                              $product_id = $value["product_id"];
                              $product_name = $value["product_name"];
                              $img = empty($value['image']) ? "noimage.jpg" : "{$value['image']}";
                              $desc_short = $value["desc_short"];
                              $selected_variant = array_key_first($value["variants"]);
                              $selected_variant_price = !empty($selected_variant) ? $value["variants"][$selected_variant]["retail_price"] : 0;
                              $product_variant_id = $selected_variant;
                        ?>
                        <div class="xs-product-category" style="padding:0px; text-align:center;
    border:1px solid rgb(220 220 220); ">
                         
                         <a class="" href="detailpage.php?q=<?php echo $product_id; ?>">
                               <?php             
                                 if ($img == '') {  
                                  echo  $show_img_URL = '<img style="height:95px" class="img-responsive" src="media/products/noimage.jpg">';
                                } 
                                 else if (file_exists('media/products/' . $img)) {
                                    ?> <img style="height:95px;" alt="<?php echo $product_name; ?>" src="media/products/<?php echo $img; ?>" />  <?php 
                                 } 
                                 else {
                                     echo $show_img_URL = '<img style="height:95px" class="img-responsive" src="media/products/noimage.jpg">';
                                 }                                                                                                
                                 ?>   
                           </a>
                       

                           <h4 class="product-title">
                              <a href="detailpage.php?q=<?php echo $product_id; ?>"><?php echo $product_name; ?></a>
                           </h4>
                           <span class="price"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#8377;</span><?php echo $selected_variant_price; ?></span> </span>
                        </div>
                        <?php 
                           }
                        }
                        ?>
                     </div>
               
               </div>
            </div>
         </div>
      </div>
   </div>
</section>






      <section class="elementor-element elementor-element-7977297c elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="7977297c" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}" style="padding: 2% 0% 0% 0%">
                  <div class="elementor-container elementor-column-gap-default">
                     <div class="elementor-row">
                        <div class="elementor-element elementor-element-18f455be grocery-hover-style elementor-column elementor-col-100 elementor-top-column" data-id="18f455be" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-27778686 elementor-widget elementor-widget-xs-woo-tab" data-id="27778686" data-element_type="widget" data-widget_type="xs-woo-tab.default">
                                    <div class="elementor-widget-container">
                                       <div class="xs-content-header">
                                          <h2 class="xs-content-title">
                                             <a href="monthlyessentials.php">Monthly Essentials</a>
                                             <br /><br />
                                          </h2>
                                          <div class="clearfix"></div>
                                       </div>
                                       <?php
                                          $products = array();
                                                      
                                          if (empty($_SESSION["branch"]["price"]))  {
                                             $result = mysqli_query($con,"SELECT 
                                                   `P`.`id` `product_id`,
                                                   `P`.`maincat` `product_cat`,
                                                   `P`.`categoryid` `product_cat_id`,
                                                   `P`.`productcode` `product_code`,
                                                   `P`.`name` `product_name`,
                                                   `P`.`shortdescription` `desc_short`,
                                                   `P`.`description` `desc`,
                                                   `P`.`img` `image`,
                                                   `P`.`sale` `sale_status`,
                                                   `P`.`newold` `newold_status`,
                                                   `P`.`hsncode` `hsn`,
                                                   `P`.`pr` `tag`
                                                FROM 
                                                   `products` `P` 
                                                WHERE 
                                                   `P`.`status` = '1' 
                                                AND 
                                                  
                                                   `p`.`newold` = 'Monthly Essentials' 

                                                LIMIT 10");

                                             $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                          } else {
                                             foreach ($_SESSION["branch"]["price"] as $key => $value) {
                                                if ($value["product_cat"] == 2) {
                                                   array_push($products, $value);
                                                }
                                             }  
                                          }
                                          
                                          $rowcount = count($products);
                                          
                                          if ($rowcount < 1)  {
                                       ?>
                                          No Monthly Essentials Products found
                                       <?php 
                                          } else {
                                       ?>
                                        <div class="bxslider">
                                          <?php
                                             foreach ($products as $value) {
                                                $product_id = $value["product_id"];
                                                $product_name = $value["product_name"];
                                                $img = empty($value['image']) ? "noimage.jpg" : "{$value['image']}";
                                                $desc_short = $value["desc_short"];
                                                $selected_variant = array_key_first($value["variants"]);
                                                $selected_variant_price = !empty($selected_variant) ? $value["variants"][$selected_variant]["retail_price"] : 0;
                                                $product_variant_id = $selected_variant;
                                             ?>
                                            <div class="xs-product-category" style="padding:0px; text-align:center;border:1px solid rgb(220, 220, 220); ">
                         
                                                <a class="xs_product_img_link" href="detailpage.php?q=<?php echo $product_id; ?>">
                                                     <?php             
                                                         if ($img == '') {  
                                                          echo  $show_img_URL = '<img style="width:100px;height:100px" class="img-responsive" src="media/products/noimage.jpg">';
                                                        } 
                                                         else if (file_exists('media/products/' . $img)) {
                                                            ?> <img style="width:100px;height:100px" alt="<?php echo $product_name; ?>" src="media/products/<?php echo $img; ?>" />  <?php 
                                                         } 
                                                         else  {
                                                             echo $show_img_URL = '<img style="width:100px;height:100px" class="img-responsive" src="media/products/noimage.jpg">';
                                                         }                                                                                                
                                                         ?>   
                                             </a> 
                                             <h4 class="product-title">
                                                <a href="detailpage.php?q=<?php echo $product_id; ?>"><?php echo $product_name; ?></a>
                                             </h4>
                                                <span class="price"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#8377;</span><?php echo $selected_variant_price; ?></span> </span>
                                             </div>
                                          <?php 
                                                }
                                             }
                                          ?>
                                       </div>
                                   
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>

<section style="background-color: rgb(231 255 238);padding: 10px" class="elementor-element elementor-element-9a8a463 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="9a8a463" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
  <div class="elementor-container elementor-column-gap-default">
    <div class="elementor-row">
      <div class="elementor-element elementor-element-1b21cc4 elementor-column elementor-col-50 elementor-top-column" data-id="1b21cc4" data-element_type="column">
        <div class="elementor-column-wrap elementor-element-populated">
          <div class="elementor-widget-wrap">
            <div class="elementor-element elementor-element-c06072f elementor-widget elementor-widget-image" data-id="c06072f" data-element_type="widget" data-widget_type="image.default">
              <div class="elementor-widget-container">
                   <img src="media/home.jpg" style="width: 420px">
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
                    <h3 class="xs-heading-title">“If you enjoyed your meal tonight, thank a farmer.”</h3><br>
                     <h2 class="xs-heading-sub">Our Mission</h2>
                    <p class="lead" style="text-align: justify;">We strive for customer satisfaction by delivering fresh products at best prices, right at your doorstep, within 24 hours.</p>

                    <h2 class="xs-heading-sub">Our vision</h2>
                    <p class="lead" style="text-align: justify;">At Frubji, we endeavour to deliver a wide range of essential goods ranging from fresh fruits, vegetables, bakery items, sweets, spices, juices, healthy salads and much more.</p>
                    <p class="lead" style="text-align: justify;">
                    We believe in providing a fair price to the farmers and the producers of the above goods without exploiting them and thus empowering them towards success.
                    </p>
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
              <br><Br>

               <section class="elementor-element elementor-element-015e6b4 promo-style-shadow elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="015e6b4" data-element_type="section">
                  <div class="elementor-container elementor-column-gap-default">
                     <div class="elementor-row">
                        <div style="width: 50% !important" class="elementor-element elementor-element-32309d6 elementor-column  elementor-top-column" data-id="32309d6" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-e0dde60 elementor-position-left elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="e0dde60" data-element_type="widget" data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-icon-box-wrapper">
                                          <div class="elementor-icon-box-icon"> <span class="elementor-icon elementor-animation-" ><img src="media/freedelivery.png" width="70px"> </span></div>
                                          <div class="elementor-icon-box-content" style="margin-top: 30px">
                                             <h3 class="elementor-icon-box-title"> <span >Free Delivery</span></h3>
                                            
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div style="width: 50% !important" class="elementor-element elementor-element-f6a37fd elementor-column elementor-col-20 elementor-top-column" data-id="f6a37fd" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-30ea94b elementor-position-left elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="30ea94b" data-element_type="widget" data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-icon-box-wrapper">
                                          <div class="elementor-icon-box-icon"> <span class="elementor-icon elementor-animation-" > <img src="media/freshproduce.png" width="70px"> </span></div>
                                          <div class="elementor-icon-box-content" style="margin-top: 30px">
                                             <h3 class="elementor-icon-box-title"> <span >Fresh Produce</span></h3>
                                             
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div style="width: 50% !important" class="elementor-element elementor-element-2269a54 elementor-column elementor-col-20 elementor-top-column" data-id="2269a54" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-35dd364 elementor-position-left elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="35dd364" data-element_type="widget" data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-icon-box-wrapper">
                                          <div class="elementor-icon-box-icon"> <span class="elementor-icon elementor-animation-" >   <img src="media/fairprice.png" width="70px">  </span></div>
                                         <div class="elementor-icon-box-content" style="margin-top: 30px">
                                             <h3 class="elementor-icon-box-title"> <span >Fair Price</span></h3>
                                             
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div style="width: 50% !important" class="elementor-element elementor-element-01d92fd elementor-column elementor-col-20 elementor-top-column" data-id="01d92fd" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-b30fa20 elementor-position-left elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="b30fa20" data-element_type="widget" data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-icon-box-wrapper">
                                          <div class="elementor-icon-box-icon"> <span class="elementor-icon elementor-animation-" > <img src="media/hygiene.png" width="70px"></span></div>
                                         <div class="elementor-icon-box-content" style="margin-top: 30px">
                                             <h3 class="elementor-icon-box-title"> <span >Hygiene</span></h3>
                                             
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div style="width: 50% !important" class="elementor-element elementor-element-4ff69f1 elementor-column elementor-col-20 elementor-top-column" data-id="4ff69f1" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-28e2802 elementor-position-left elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="28e2802" data-element_type="widget" data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-icon-box-wrapper">
                                          <div class="elementor-icon-box-icon"> <span class="elementor-icon elementor-animation-" ><img src="media/socialworkicon.png" width="70px"> </span></div>
                                          <div class="elementor-icon-box-content" style="margin-top: 30px">
                                             <h3 class="elementor-icon-box-title"> <span >Social Work</span></h3>
                                                                                       </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                          <div style="width: 50% !important" class="elementor-element elementor-element-4ff69f1 elementor-column elementor-col-20 elementor-top-column" data-id="4ff69f1" data-element_type="column">
                           <div class="elementor-column-wrap elementor-element-populated">
                              <div class="elementor-widget-wrap">
                                 <div class="elementor-element elementor-element-28e2802 elementor-position-left elementor-view-default elementor-vertical-align-top elementor-widget elementor-widget-icon-box" data-id="28e2802" data-element_type="widget" data-widget_type="icon-box.default">
                                    <div class="elementor-widget-container">
                                       <div class="elementor-icon-box-wrapper">
                                          <div class="elementor-icon-box-icon"> <span class="elementor-icon elementor-animation-" >  <img src="media/empowerment.png" width="70px"> </span></div>
                                          <div class="elementor-icon-box-content" style="margin-top: 30px">
                                             <h3 class="elementor-icon-box-title"> <span >Empowerment</span></h3>
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
            
  <script  src="./script.js"></script>
  