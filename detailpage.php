
<?php
error_reporting(0);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> 
<?php include "allcss.php"; ?>
<?php include "header.php"; ?>

<body class="product-template-default single single-product postid-22 theme-marketo woocommerce woocommerce-page woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default" data-spy="scroll" data-target="#header">
  <div class="xs-breadcumb">
    <div class="container">
      <nav aria-label="breadcrumb-shop">
        <ol class="breadcrumb-shop">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <?php
          include('db.php');
          $var=$_GET['q'];   
          $pr_id = $_GET['q'];
          $result = mysqli_query($con,"SELECT * FROM products WHERE id=$var ");
          while($row = mysqli_fetch_array($result))
          {
          echo ' <li class="breadcrumb-item">'.$row['name'].'</li>
          '; } 
          ?>   

         

        </ol>
      </nav>
    </div>
  </div>




             <?php 
            
                  $result = mysqli_query($con,"SELECT  `p`.`maincat`, `p`.`id` AS `product_id`, `pv`.`id` AS `product_variant_id`, `p`.`name` AS `product_name`, `p`.`img` AS `image`, `p`.`shortdescription` AS `desc_short` FROM `products` `p` INNER JOIN `productvariant` `pv` ON `p`.`id` = `pv`.`productid` WHERE `p`.`id` = {$pr_id} limit 1");
                  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

              ?>
            



  <div class="xs-section-padding xs_single_wrapper">
    <div class="shop-archive">
      <div class="container">
        <div class="row">

              <?php
                  foreach ($products as $value) {
                    $product_id = $value["product_id"];
                    $product_variant_id = $value["product_variant_id"];
                    $product_name = $value["product_name"];
                    $img = empty($value['image']) ? "noimage.jpg" : "{$value['image']}";
                    $desc_short = $value["desc_short"];
                    $maincat = $value["maincat"];
                ?>


              <div id="primary" class="content-area col-md-12">
                <div class="woocommerce-notices-wrapper"></div>
                <div class="xs-section-padding xs-single-products">
                  <div id="product-22" class="product type-product post-22 status-publish first instock product_cat-3d-glass has-post-thumbnail featured shipping-taxable purchasable product-type-variable">
                <?php
                     if ($img == '') {  
                       echo  $show_img_URL = '<img style=" width: 500px;    height: 500px;"  class="img-responsive" src="media/products/noimage.jpg">';
                     } 
                     else if (file_exists('media/products/' . $img)) {
                     ?>  <img  style=" width: 500px;    "  class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="<?php echo $product_name; ?>" src="media/products/<?php echo "$img"; ?>" />  <?php 
                     } 
                     else  {
                      echo $show_img_URL = '<img style=" width: 500px;    height: 500px;"  class="img-responsive" src="media/products/noimage.jpg">';
                     }   ?> 
                              
                    <div class="summary entry-summary" style="padding: 10px">
                      <h1 class="product_title entry-title"><?php echo $product_name; ?> </h1>
                      <!--<div class="product_meta"> <span class="sku_wrapper">SKU: <span class="sku">P0002</span></span> <span class="posted_in">Category: <a href="" rel="tag">Vegetables</a></span></div> -->
                      <div class="woocommerce-product-rating">
                        <div class="star-rating" role="img" aria-label="Rated 4.33 out of 5"><span style="width:86.6%">Rated <strong class="rating">4.33</strong> out of 5 based on </div>
                      
                      </div>
                      <div class="woocommerce-product-details__short-description">
                        <p><?php echo $desc_short; ?></p>
                      </div>
                    
                    <div class="product-variant-list">                    
                         <!-- ---------------------------PRODUCT VARIANT ---------------------------------------------- -->
                      <div class="xs-product-content">
                       

                        <!-- VARIANTS -->
                        <?php
                          $variants = array();

                          if (empty($_SESSION["branch"]["price"]))  {
                            $result = mysqli_query($con,"SELECT 
                                `PV`.`id`, 
                                CONCAT(`PV`.`qty`, `PV`.`units`) `variant`,
                                `PP`.`branchid` AS `branch`,
                                `PP`.`price` AS `retail_price`
                              FROM 
                                `productvariant` `PV`
                              LEFT JOIN
                                `productsprice` `PP`
                              ON
                                `PP`.`variantid` = `PV`.`id`
                              WHERE 
                                `PV`.`productid` = {$product_id}
                              ORDER BY 
                                `PV`.`id`");
                            $variants = mysqli_fetch_all($result, MYSQLI_ASSOC);
                          } else {
                            $sesion_variants = $_SESSION["branch"]["price"][$product_id]["variants"] ?? array();
                            foreach ($sesion_variants as $value) {
                              array_push($variants, $value);
                            }
                          }

                          $rowcount = count($variants);

                          if ($rowcount > 0)  {
                        ?>
                        <div class="product-variant-list">
                          <select class="form-control product-variant">
                          <?php 
                            $selected_variant = !empty($variants[0]) ? $variants[0] : null;
                            $selected_variant_price = !empty($selected_variant) ? $variants[0]["retail_price"] : 0;
                            
                            foreach ($variants as $value) {
                              $selected_variant_id = $selected_variant["id"] ?? 0;
                              $variant_id = $value["id"];
                              $price = !empty($value['retail_price']) ? $value['retail_price'] : 0;
                              $type = $value["variant"];
                            ?>
                            <option value="<?php echo $variant_id; ?>,<?php echo $price; ?>" <?php echo ($variant_id == $selected_variant_id) ? "selected": "";  ?>><?php echo $type; ?></option>
                            <?php } ?>
                          </select> 
                        </div> 
                        <?php } ?>

                        <?php if (!empty($selected_variant_price) && !empty($_SESSION["branch"]["pincode"]) && ($selected_variant_price > 0)) { ?>
                        <span class="price">
                          <div class="product-price product-price-list" style="padding: 10px">                  
                           
                            <ins>
                              <span style="font-size: 20px;    margin-left: -10px;" class="woocommerce-Price-amount amount">
                                <span  class="woocommerce-Price-currencySymbol">₹</span> <?php echo $selected_variant_price; ?>
                              </span>
                            </ins>
                          </div>  
                        </span>
                        <?php } ?>
                        
                        <input type="hidden" value="1" class="item_qty" min="1"  />
                      </div>
                      <!-- ---------------------------PRODUCT VARIANT ---------------------------------------------- -->

                    </div> 
                     <br>   
                    <?php if (!empty($_SESSION["branch"]["pincode"]))   { ?>
                         
                       <a type="button" data-quantity="1"  class="single_add_to_cart_button aajax_add_to_cart_button button alt product_type_variable add_to_cart_button" data-product_id="22" rel="nofollow" onclick="addToCart(this, <?php echo $product_id; ?>)">Add to cart</a>
                         
                    <?php } ?>        
                          
                      <a type="button" data-quantity="1"  class="single_add_to_cart_button aajax_add_to_cart_button button alt product_type_variable add_to_wishlist_button" data-product_id="<?php echo $product_id; ?>" data-product_variant_id="<?php echo $product_variant_id; ?>"   rel="nofollow" >Add to Wishlist</a>  

                  </div>

                


               
                </div>
                <div class="woocommerce-tabs wc-tabs-wrapper">
                  <ul class="nav nav-tabs xs-nav-tab version-4" id="myTab" role="tablist">
                    <li class="nav-item description_tab" id="tab-title-description" role="tab" aria-controls="tab-description"> <a class="nav-link active" id="description-tab" data-toggle="tab" href="#tab-description" role="tab" aria-controls="description" aria-selected="true">Description</a></li>
                  <!--  <li class="nav-item additional_information_tab" id="tab-title-additional_information" role="tab" aria-controls="tab-additional_information"> <a class="nav-link " id="additional_information-tab" data-toggle="tab" href="#tab-additional_information" role="tab" aria-controls="additional_information" aria-selected="true">Additional information</a></li> -->
                  
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane animated slideInUp show active" id="tab-description" role="tabpanel" aria-labelledby="description-tab">
                      <p><strong>Product Description</strong></p>
                      <p><?php echo $desc_short; ?></p>
                     
                  
                    </div>
                   <!-- <div class="tab-pane animated slideInUp " id="tab-additional_information" role="tabpanel" aria-labelledby="additional_information-tab">
                      <ul class="table list-inline">
                        <li class="xs-attr list-inline-item woocommerce-product-attributes-item woocommerce-product-attributes-item--attribute_pa_quantity">
                          <div class="woocommerce-product-attributes-item__label">Quantity:</div>
                          <div class="woocommerce-product-attributes-item__value">
                            <p>1 kg, 2 kg</p> <p><?php echo $desc_short; ?></p>
                          </div>
                        </li>
                      </ul>
                    </div> -->
                    
                  </div>
                </div>


            <?php } ?>
       


                <!-- RELATED PRODUCTS -->
















          <section class="up-sells upsells products feature-product-v4">
                  <h3 class="upells-title">You may also like&hellip;</h3>
                  <div class="row"> 


                                             
              
          
               <?php
              include('db.php');                                         

              $result = mysqli_query($con,"SELECT * FROM products WHERE status = '1' and maincat = $maincat limit 6");
               while($row = mysqli_fetch_array($result))
               {
               $var = $row['id']; 
                                             
              ?>           

                <div class="col-lg-2 col-sm-6 col-6 product type-product post-22 status-publish first instock product_cat-3d-glass has-post-thumbnail featured shipping-taxable purchasable product-type-variable">
                  <div class="xs-single-product">
                    <div class="xs-product-wraper text-center">
                      <a href="detailpage.php?q=<?php echo $row['id']; ?> " class="woocommerce-LoopProduct-link woocommerce-loop-product__link"> 
                      <a class="xs_product_img_link" href="detailpage.php?q=<?php echo $row['id']; ?> ">                      
                         <?php
                           $img = $row['img'];

                           if ($img == '') { 
                             echo '<img width="100" height="100" class="img-responsive" src="media/products/noimage.jpg">';
                           } 
                             else if (file_exists('media/products/' . $img)) {
                            
                            echo '<img style="width:100px;height:100px" alt="'.$row['name'].'" src="media/products/'.$row['img'].'" alt="'.$row['name'].'"> ';
                           } 
                          else{ 
                            echo '<img style="width:100px;height:100px" alt="'.$row['name'].'" src="media/products/noimage.jpg" alt="'.$row['name'].'">'; 
                          } 
                          ?>  
                      </a>
                   
                      <div class="xs-product-content">
                          <h4 class="product-title"><a href="detailpage.php?q=<?php echo $row['id']; ?> "><?php echo $row['name']; ?></a></h4>
                        
                      </div>
                      <div class="xs-product-content"></a></div>
                    </div>
                    <div class="list-group xs-list-group xs-product-content"> <?php echo substr($row['shortdescription'],0,30).'...';  ?></div>
                
                  </div>

                </div>  
                 <?php } ?>
           
            </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

   <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

  <?php include "alerts.php"?>
  <?php include "footer.php"; ?>
  <?php include "allscript.php"; ?>
  <script src="js/custom.js"></script>

  <?php
    mysqli_close($con);
  ?>
         