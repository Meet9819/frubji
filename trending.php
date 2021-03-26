<?php //error_reporting(0);

include('db.php');

if (empty($_SESSION) && (session_status() === PHP_SESSION_NONE)) {
  session_start();
}

?> 

<?php include "allcss.php"; ?>
<?php include "header.php"; ?>

<body class="archive post-type-archive post-type-archive-product theme-marketo woocommerce woocommerce-page woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default" data-spy="scroll" data-target="#header">
  <div class="xs-breadcumb">
    <div class="container">
      <nav aria-label="breadcrumb-shop">
        <ol class="breadcrumb-shop">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Trending Products </li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="xs-section-padding ">
    <div class="shop-archive">
      <div class="container">
        <div class="row">
          <div id="primary" class="content-area col-md-12">
            <?php
              $products = array();

              if (empty($_SESSION["branch"]["price"]))  {
                $result = mysqli_query($con,"SELECT 
                    `id` AS `product_id`, 
                    `name` AS `product_name`, 
                    `img` AS `image`, 
                    `shortdescription` AS `desc_short` 
                  FROM 
                    `products` 
                  WHERE 
                    newold = 'Trending'
                  AND
                    `status` = 1 
                  ORDER BY 
                    `name` ASC");
                $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
              } else {
                foreach ($_SESSION["branch"]["price"] as $key => $value) {
                  if ($value["newold_status"] == "Trending") {
                    array_push($products, $value);
                  }
                }
              }
  
              $rowcount = count($products);
                
              if ($rowcount > 0)  {
            ?>

            <!-- header - start -->
            <div class="woocommerce-products-header">
              <h5 class="woocommerce-products-header__title page-title"><?php echo "Products available <b>({$rowcount})</b>"; ?></h5>
              <div class="media woocommerce-filter-content">
                <div class="media-body xs-shop-notice"></div>
               

                <div class="media">
                  <h6>View</h6>
                  <ul class="nav nav-tabs shop-view-nav" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="grid-tab" data-toggle="tab" href="#grid" role="tab" aria-controls="grid" aria-selected="true"> <i class="fa fa-th"></i> </a></li>
                    <li class="nav-item"> <a class="nav-link" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="false"> <i class="fa fa-align-justify"></i> </a></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- header - end -->

            <!-- main content - start -->
            <div class="feature-product-v4">
              <div class="row">
                

<!-- --------------------------LIST VIEW------------------------------------------------- -->

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
                <div class="col-md-4 xs-list-view">
                  <div class="xs-product-widget media xs-md-20">
                    <a href="<?php echo "detailpage.php?q={$product_id}"; ?>">
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
                    <div class="media-body align-self-center product-widget-content">
                      <h4 class="product-title" >
                        <a href="<?php echo "detailpage.php?q={$product_id}"; ?>"><?php
                          if ($product_name > 30)
                          {
                           echo substr($product_name,0,30).'...';
                          }
                          else {
                             echo $product_name;
                          } ?></a>
                      </h4>  
                        <p><?php echo substr($desc_short,0,60).'...'; ?></p>               
                    </div>
                  </div>
                </div>


<!-- ------------------------LIST VIEW--------------------------------------------------- -->



<!-- ---------------------------GRID VIEW ------------------------------------------------ -->

                <div class="col-lg-2 col-sm-6 col-6 product type-product post-22 status-publish first instock product_cat-3d-glass has-post-thumbnail featured shipping-taxable purchasable product-type-variable">
                  <div class="xs-single-product">
                    <div class="xs-product-wraper text-center">
                      <a href="<?php echo "detailpage.php?q={$product_id}"; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"></a>
                      <a class="xs_product_img_link" href="<?php echo "detailpage.php?q={$product_id}"; ?>">                      
                       
                     <?php
                     if ($img == '') {  
                       echo  $show_img_URL = '<img class="img-responsive" src="media/products/noimage.jpg">';
                     } 
                     else if (file_exists('media/products/' . $img)) {
                     ?>  <img style="height:140px" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="<?php echo $product_name; ?>" src="media/products/<?php echo "$img"; ?>" />  <?php 
                     } 
                     else  {
                      echo $show_img_URL = '<img class="img-responsive" src="media/products/noimage.jpg">';
                     }   ?> 
                                                                                                
                      </a>
                   
                      <ul class="product-item-meta">
                        <?php 
                          if (!empty($_SESSION["branch"]["pincode"]))   {
                        ?>
                          <li class="xs-cart-wrapper">
                            <a type="button" title="Add to cart" data-quantity="1" class="aajax_add_to_cart_button button product_type_variable add_to_cart_button" data-product_id="22"  rel="nofollow" onclick="addToCart(this, <?php echo $product_id; ?>)">Add to cart</a>
                          </li>
                        <?php 
                            if($user_home->is_logged_in()) {
                        ?>
                        <li>
                          <a href="#" title="Add to wishlist" class="add_to_wishlist_button" data-product_id="<?php echo $product_id; ?>" data-product_variant_id="<?php echo $product_variant_id; ?>">
                            <i class="icon icon-heart"></i>
                          </a>
                        </li>
                        <?php 
                            } 
                          }
                        ?>
                      </ul>
                      
                      <!-- ---------------------------PRODUCT VARIANT ---------------------------------------------- -->

                      <div class="xs-product-content">
                        <h4 class="product-title"><a href="<?php echo "detailpage.php?q={$product_id}"; ?>"><?php
                          if ($product_name > 30)
                          {
                           echo substr($product_name,0,30).'...';
                          }
                          else {
                             echo $product_name;
                          } ?></a></h4>

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
                            foreach ($_SESSION["branch"]["price"][$product_id]["variants"] as $value) {
                              array_push($variants, $value);
                            }
                          }

                          $rowcount = count($variants);

                          if ($rowcount > 0)  {
                        ?>
                        <div class="col-md-12 product-variant-list">
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
                  <div class="list-group xs-list-group xs-product-content"><?php echo substr($desc_short,0,60).'...'; ?> </div> 
                  </div> 
                </div>

<!-- ---------------------------GRID VIEW ------------------------------------------------ -->

                    
                <?php } ?>
              </div>
            </div>
            <!-- main content - end -->

            <?php } ?>
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