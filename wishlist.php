<?php

require_once 'class.user.php';

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$user_home = new USER();

?> 

<?php include "allcss.php"; ?>
<?php include "header.php"; ?>

<body class="archive post-type-archive post-type-archive-product theme-marketo woocommerce woocommerce-page woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default" data-spy="scroll" data-target="#header">
  <div class="xs-breadcumb">
    <div class="container">
      <nav aria-label="breadcrumb-shop">
        <ol class="breadcrumb-shop">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Shop </li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="xs-section-padding ">
    <div class="shop-archive">
      <div class="container">
        <div class="row">
          <div id="primary" class="content-area col-md-12">
            <div class="woocommerce-products-header">
              <h5 class="woocommerce-products-header__title page-title">Wishlist</h5>
              <div class="media woocommerce-filter-content">
                <div class="media-body xs-shop-notice"></div>
                <div class="media-body xs-before-shop-loop">
                  <div class="woocommerce-notices-wrapper"></div>
                  <p class="before-default-sorting">Sort by</p>
                  <form class="woocommerce-ordering" method="get">
                    <select name="orderby" class="orderby" aria-label="Shop order">
                      <option value="menu_order" selected='selected'>Sorting</option>
                      <option value="popularity" > Popularity</option>
                      <option value="rating" > Average rating</option>
                      <option value="date" > Newness</option>
                      <option value="price" >Price: low to high</option>
                      <option value="price-desc" >Price: high to low</option>
                    </select>
                    <input type="hidden" name="paged" value="1" />
                  </form>
                </div>
                <div class="media">
                  <h6>View</h6>
                  <ul class="nav nav-tabs shop-view-nav" id="myTab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" id="grid-tab" data-toggle="tab" href="#grid" role="tab" aria-controls="grid" aria-selected="true"> <i class="fa fa-th"></i> </a></li>
                    <li class="nav-item"> <a class="nav-link" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="false"> <i class="fa fa-align-justify"></i> </a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="feature-product-v4">
              <div class="row">
              <?php
                if(!$user_home->is_logged_in()) {
              ?>
                <span>Please <a title="Click here to login" href="login.php">login</a> to see your wishlist.</span>
              <?php
                } else if ($user_home->is_logged_in() && empty($_SESSION["branch"]["pincode"])) {
              ?>
                <span style="    font-size: 22px;    margin-left: 13px;    font-weight: 500;">Please Select a <a title="Click here to select a pin code" href="#" data-modal="#pincode-modal">Pincode</a> first</span>
              <?php
                } else {
                  require_once "db.php";

                  $wishlist = array();
                  
                  $wishlist_query = "SELECT 
                        `w`.`id` `wishlist_id`, 
                        `w`.`user_id`, 
                        `w`.`product_id` AS `product_id`,
                        `p`.`name` AS `product_name`, 
                        `w`.`variant_id` AS `product_variant_id`
                      FROM 
                        `wishlist` `w` 
                      INNER JOIN 
                        `products` `p` 
                      ON 
                        `p`.`id` = `w`.`product_id` 
                      WHERE 
                        `w`.`user_id` = {$_SESSION["userSession"]}";

                  $result = mysqli_query($con, $wishlist_query);
                  $wishlist = mysqli_fetch_all($result, MYSQLI_ASSOC);

                  $total_wishlisted = count($wishlist);

                  if ($total_wishlisted < 1)  {
              ?>
                <span>No products in your wishlist.</span>
              <?php
                  } else {
                    foreach($wishlist as $item) {
                      $product_id = $item["product_id"];
                      $product_variant_id = $item["product_variant_id"];
                      $product_name = $item["product_name"];
                      $img = empty($item['image']) ? "media/products/noimage.jpg" : "media/products/{$item['image']}";
                      $desc_short = $item["desc_short"] ?? "";
              ?>
                <div class="col-md-4 xs-list-view">
                  <div class="xs-product-widget media xs-md-20">
                    <a href="detailpage.php?q=<?php echo $product_id; ?>" ?>
                      <img style="width:100px; height:100px" class="img-responsive" alt="<?php echo $product_name; ?>" src="<?php echo $img; ?>" />  
                    </a>
                    <div class="media-body align-self-center product-widget-content">
                      <h4 class="product-title">
                        <a href="detailpage.php?q=<?php echo $product_id; ?>"><?php echo $product_name; ?></a>
                      </h4>                    
                    </div>
                  </div>
                </div>
                <div class="col-lg-2 col-sm-6 col-6 product type-product post-22 status-publish first instock product_cat-3d-glass has-post-thumbnail featured shipping-taxable purchasable product-type-variable">
                  <div class="xs-single-product">
                    <div class="xs-product-wraper text-center">
                      <a href="detailpage.php?q=<?php echo $product_id; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><?php echo $product_name; ?></a>
                      <a class="xs_product_img_link" href="detailpage.php?q=<?php echo $product_id; ?>">
                        <img style="height:140px" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail wp-post-image" alt="<?php echo $product_name; ?>" src="<?php echo "$img"; ?>" />  
                      </a>

                      <!-- add to cart and wishlist  -->
                      <ul class="product-item-meta">
                        <?php 
                          if (!empty($_SESSION["branch"]["pincode"]))   {
                        ?>
                          <li class="xs-cart-wrapper">
                            <a type="button" title="Move to cart" data-quantity="1" class="aajax_add_to_cart_button button product_type_variable add_to_cart_button" data-product_id="22" rel="nofollow" onclick="addToCart(this, <?php echo $product_id; ?>, true)">Add to cart</a>
                          </li>
                        <?php
                          }
                        ?>
                      </ul>
                      
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
                            foreach ($_SESSION["branch"]["price"][$product_id]["variants"] as $item) {
                              array_push($variants, $item);
                            }
                          }

                          $rowcount = count($variants);

                          if ($rowcount > 0)  {
                        ?>
                        <div class="col-md-12 product-variant-list">
                          <select class="form-control product-variant" readonly>
                          <?php 
                            $selected_variant = !empty($variants[0]) ? $variants[0] : null;
                            $selected_variant_price = !empty($selected_variant) ? $variants[0]["retail_price"] : 0;
                            
                            foreach ($variants as $item) {
                              $selected_variant_id = $selected_variant["id"] ?? 0;
                              $variant_id = $item["id"];
                              $price = !empty($item['retail_price']) ? $item['retail_price'] : 0;
                              $type = $item["variant"];
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
                  </div> 
                </div>
              <?php
                    }
                  }

                  mysqli_close($con);
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

  <?php include "alerts.php"?>
  <?php include "allscript.php"; ?>
  <script src="js/custom.js"></script>
  </div>     