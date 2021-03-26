<?php

require_once "Cart.php";
require_once "class.user.php";
include "db.php";

$cart = new Cart;

if (empty($_SESSION) && (session_status() === PHP_SESSION_NONE)) {
  session_start();
}

$user_home = new USER();

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");

$stmt->execute(array(":uid" => $_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$con = mysqli_connect("localhost", "root", "", "frubji") or die('Unable to connect');

$userName = $row['userName'];
$userID = $row['userID'];
$userEmail = $row['userEmail'];
$mobile = $row['mobile'];
$representativeid = $row['representativeid'];

$pin_selected = !empty($_SESSION["branch"]["pincode"]);
$pincode = !empty($_SESSION["branch"]["pincode"]) ? trim($_SESSION["branch"]["pincode"]) : "";

?>

              <?php
                    $result = mysqli_query($con, "SELECT * FROM representative where id = $representativeid");
                    while ($row = mysqli_fetch_array($result)) {
                  
                      $representativecommission = $row['commissioninper'];
                  }
                  ?>

<div class="xs-top-bar d-none d-md-none d-lg-block">
  <div class="container">
    <div class="row">

      <div class="col-lg-8">
        <div class="topbar-info-group">
          <ul class="xs-top-bar-info">
            <li> 
              <a href="deliveryinformation.php">
                <i class="icon icon-van"></i>Free Delivery
              </a>
            </li>
            <?php
              if (isset($_SESSION['userSession'])) {
            ?>
              <li>
                <a href="complaintbox.php">Complaint Box</a>
              </li>
            <?php
              }
            ?>
            <span id="pincode-block" style="display: <?php echo $pin_selected ? "" : "none"; ?>"> Location :
              <a style="padding-right: 10px ; color:white" class="pincode" href="#" title="Click to change location" id="pincode"><?php echo $pincode; ?></a>
            </span>
          </ul>
        </div>
      </div>

      <div class="col-lg-4">
        <ul class="xs-top-bar-info right-content">
          <?php
            if (isset($_SESSION['userSession'])) {
          ?>
            <li>
              Hi, <b><?php echo $userName; ?></b>
            </li>
            <li>
              <a href="profile.php">
                <b>Profile</b>
              </a>
            </li>
            <li>
              <a href="logout.php" title="Sign out">
                <b>Sign Out</b>
              </a>
            </li>
          <?php 
            } else {
          ?>
          <li>
            <a href="login.php">Login</a> / <a href="register.php">Register</a>
          </li>
          <?php 
            }
          ?>
        </ul>
      </div>

    </div>
  </div>
</div>

<header class="xs-header xs-mb-0">

  <div class="xs-navBar navBar-v6">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-sm-4 xs-order-1 flex-middle">
          <div class="xs-logo-wraper">
            <a class="xs_default_logo" href="index.php">
              <img  src="" alt="Frubji" data-lazy-src="wp-content/logo.png">
            </a>
            <a class="xs_retina_logo" href="index.php">
              <img  src="" alt="Frubji" data-lazy-src="wp-content/logo.png">
            </a>
          </div>
        </div>

        <div class="col-lg-6 col-sm-3 xs-order-3 xs-menus-group">
          <form class="xs-navbar-search xs-navbar-search-wrapper" action="" method="get" id="header_form">
            <div class="input-group">
              <input type="search" name="s" class="form-control" placeholder="Find your product">
              <div class="xs-category-select-wraper">
                <i class="xs-spin"></i>
                <select class="xs-category-select" name="product_cat">
                  <option value="-1">All Categories</option>
                  <?php
                    $result = mysqli_query($con, "SELECT * FROM menu where parent_id = 0 ");
                    while ($row = mysqli_fetch_array($result)) {
                  ?>
                    <option value="-1"><?php echo $row['menu_name']; ?></option>
                  <?php 
                    }
                  ?>
                </select>
              </div>
              <div class="input-group-btn">
                <input type="hidden" id="search-param" name="post_type" value="product">
                  <button type="submit" class="btn btn-primary">
                    <i style="margin-top: 10px;" class="fa fa-search"></i>
                  </button>
                </div>
            </div>
          </form>
        </div>

        <div class="col-lg-3 col-sm-5 xs-order-2 xs-wishlist-group">
          <div class="xs-wish-list-item">
            <span class="xs-wish-list">
              <a href="wishlist.php" class="xs-single-wishList">
                <i class="icon icon-heart"></i>
              </a> 
            </span>
            <div class="xs-miniCart-dropdown">
              <a href="viewcart.php" class ="xs-single-wishList ">
                <span class="xs-item-count highlight xscart">
                  <span id="cartCount" class="cart-label"><?php echo $cart->total_items(); ?></span>
                </span>
                <i class="icon icon-bag"></i>
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="xs-navDown navDown-v7 secondary-header-v">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 d-none d-md-none d-lg-block">
          <div class="cd-dropdown-wrapper xs-vartical-menu">
            <a class="cd-dropdown-trigger xs-dropdown-trigger" href="#0"> 
              <i class="fa fa-list-ul"></i> All Categories 
            </a>
            <nav class="cd-dropdown">
              <h2>Marketpress</h2>
              <a href="#0" class="cd-close">Close</a>
              <div class="">
                <ul id="main-menu-vertical" class="cd-dropdown-content">
                  <?php 
                    $result = mysqli_query($con, "SELECT * FROM menu where parent_id = 0 ");
                    
                    while ($row = mysqli_fetch_array($result)) {
                  ?>
                  <li id="menu-item-1466" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-has-children menu-item-1466">
                    <a title="Camera" href="shop.php?q=<?php echo $row['menu_id']; ?>"><?php echo $row['menu_name']; ?>
                      <i class="fa fa-angle-right submenu-icon"></i>
                    </a>
                   <!-- <ul role="menu" class="cd-secondary-dropdown is-hidden">
                      <li id="menu-item-1746" class="menu-item menu-item-type-post_type menu-item-object-mega_menu menu-item-1746">
                        <div data-elementor-type="wp-post" data-elementor-id="1744" class="elementor elementor-1744 elementor-bc-flex-widget" data-elementor-settings="[]">
                          <div class="elementor-inner">
                            <div class="elementor-section-wrap">
                              <section class="elementor-element elementor-element-0c09860 elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="0c09860" data-element_type="section">
                                <div class="elementor-container elementor-column-gap-default">
                                  <div class="elementor-row">
                                    <div class="elementor-element elementor-element-bbd1698 elementor-column elementor-col-100 elementor-top-column" data-id="bbd1698" data-element_type="column">
                                      <div class="elementor-column-wrap elementor-element-populated">
                                        <div class="elementor-widget-wrap">
                                          <div class="elementor-element elementor-element-f8375e1 elementor-widget elementor-widget-xs-woo-tab" data-id="f8375e1" data-element_type="widget" data-widget_type="xs-woo-tab.default">
                                            <div class="elementor-widget-container">
                                              <div class="tab-content">
                                                <div class="tab-pane fade show active" id="xs-tabs-99115-0" role="tabpanel">
                                                  <div class="xs-product-slider-11 owl-carousel" data-slider="3">
                                                    <div class="xs-product-slider-item">
                                                      <div class="xs-product-widget media version-2">
                                                        <a class="xs_product_img_link" href="product/sony-gamepad/index.php">
                                                          <img class="d-flex" src="wp-content/uploads/sites/18/2018/08/8-71x70.jpg">

                                                        </a>
                                                        <div class="media-body align-self-center product-widget-content">
                                                          <h4 class="product-title small"><a href="product/sony-gamepad/index.php">Sony Gamepad Studio Max</a></h4>
                                                          <span class="price small"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>110.00</span> &ndash; <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>120.00</span> </span>
                                                        </div>
                                                      </div>
                                                      <div class="xs-product-widget media version-2">
                                                        <a class="xs_product_img_link" href="product/golden-bluetooth-2/index.php">
                                                          <img class="d-flex" src="data:image/svg+xml,%3Csvg%20xmlns=">
                                                          <noscript><img class="d-flex" src="wp-content/uploads/sites/18/2018/08/0-min-71x70.jpg" alt="Golden Bluetooth Model Color"></noscript>
                                                        </a>
                                                        <div class="media-body align-self-center product-widget-content">
                                                          <h4 class="product-title small"><a href="product/golden-bluetooth-2/index.php">Golden Bluetooth Model Color</a></h4>
                                                          <span class="price small"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>300.00</span> </span>
                                                        </div>
                                                      </div>
                                                      <div class="xs-product-widget media version-2">
                                                        <a class="xs_product_img_link" href="product/bluetooth-speaker-2/index.php">
                                                          <img class="d-flex" src="data:image/svg+xml,%3Csvg%20xmlns=">
                                                          <noscript><img class="d-flex" src="wp-content/uploads/sites/18/2018/08/5-min-71x70.jpg" alt="Bluetooth Speaker Accurate Sound"></noscript>
                                                        </a>
                                                        <div class="media-body align-self-center product-widget-content">
                                                          <h4 class="product-title small"><a href="product/bluetooth-speaker-2/index.php">Bluetooth Speaker Accurate Sound</a></h4>
                                                          <span class="price small"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>1,500.00</span> </span>
                                                        </div>
                                                      </div>
                                                    </div>


                                                    <div class="xs-product-slider-item">
                                                      <div class="xs-product-widget media version-2">
                                                        <a class="xs_product_img_link" href="product/mini-3d-glass/index.php">
                                                          <img class="d-flex" src="data:image/svg+xml,%3Csvg%20xmlns=">
                                                          <noscript><img class="d-flex" src="wp-content/uploads/sites/18/2018/10/12-min-71x70.jpg" alt="Mini 3D Glass"></noscript>
                                                        </a>
                                                        <div class="media-body align-self-center product-widget-content">
                                                          <h4 class="product-title small"><a href="product/mini-3d-glass/index.php">Mini 3D Glass</a></h4>
                                                          <span class="price small"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>220.00</span> </span>
                                                        </div>
                                                      </div>
                                                      <div class="xs-product-widget media version-2">
                                                        <a class="xs_product_img_link" href="product/bluetooth-gamepad/index.php">
                                                          <img class="d-flex" src="data:image/svg+xml,%3Csvg%20xmlns=">
                                                          <noscript><img class="d-flex" src="wp-content/uploads/sites/18/2018/10/15-min-71x70.jpg" alt="Bluetooth Gamepad"></noscript>
                                                        </a>
                                                        <div class="media-body align-self-center product-widget-content">
                                                          <h4 class="product-title small"><a href="product/bluetooth-gamepad/index.php">Bluetooth Gamepad</a></h4>
                                                          <span class="price small"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>199.00</span> </span>
                                                        </div>
                                                      </div>
                                                      <div class="xs-product-widget media version-2">
                                                        <a class="xs_product_img_link" href="product/apple-iphone-6s/index.php">
                                                          <img class="d-flex" src="data:image/svg+xml,%3Csvg%20xmlns=">
                                                          <noscript><img class="d-flex" src="wp-content/uploads/sites/18/2018/10/12-min-71x70.jpg" alt="Apple iPhone 6s"></noscript>
                                                        </a>
                                                        <div class="media-body align-self-center product-widget-content">
                                                          <h4 class="product-title small"><a href="product/apple-iphone-6s/index.php">Apple iPhone 6s</a></h4>
                                                          <span class="price small"> <span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">&#36;</span>299.00</span> </span>
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
                                  </div>
                                </div>
                              </section>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul> -->
                  </li>
                  <?php 
                    }
                  ?>
                </ul>
              </div>
            </nav>
          </div>
        </div>

        <div class="col-lg-6">
          <nav class="xs-menus xs_nav-landscape">
            <div class="nav-header">
              <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
              <span class="nav-menus-wrapper-close-button">✕</span>
              <div class=" ">
                <ul id="main-menu" class="nav-menu lg-menu">
                  <li id="menu-item-478" class="megamenu menu-item menu-item-type-custom menu-item-object-custom menu-item-478">
                    <a title="Home" href="index.php">Home</a>
                  </li>
                  <li id="menu-item-478" class="megamenu menu-item menu-item-type-custom menu-item-object-custom menu-item-478">
                    <a title="Home" href="aboutus.php">About us</a>
                  </li>
                  <li id="menu-item-563" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-563 dropdown">
                    <a title="Shop" href="#">Shop</a>
                    <ul role="menu" class="nav-dropdown nav-submenu ">
                      <!-- MENU CODE -->
                      <?php 
                        function get_menu_tree($parent_id)  {
                          global $con;
                          $menu = "";
                          $sqlquery = " SELECT * FROM menu where status='1' and parent_id='" . $parent_id . "' ";
                          $res = mysqli_query($con, $sqlquery);
                          while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                              $menu .= ' <li id="menu-item-563" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-563 dropdown ">
                                                          <a title="Products" href="shop.php?q=' . $row['menu_id'] . '">' . $row['menu_name'] . '</a>  ';
                              $menu .= ' <ul role="menu" class="nav-dropdown nav-submenu ">' . get_menu_tree($row['menu_id']) . '
                                                                      </ul>';
                              $menu .= '</li>';
                          }
                          return $menu;
                        }

                        echo get_menu_tree(0);
                      ?>
                    </ul>
                  </li>
                

                  <li id="menu-item-1133" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1133">
                    <a title="Contact" href="contact.php">Contact</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="nav-overlay-panel"></div>
          </nav>
        </div>

        <div class="col-lg-3 col-lg-3 d-none d-md-none d-lg-block home-v-7">
          <a href="sale.php" class="btn btn-primary btn-lg">
            <span>Today's Sale</span>
          </a>
        </div>

      </div>
    </div>
  </div>

  <div class="nav-cover"></div>
</header>

   <div class = "tabmenu-area ">
      <div class = "container">
         <div class = "row justify-content-between no-gutters">
            <div class = "xs-menus tab_menu_area">
               <div class = "nav-header">
                  <div class = "nav-toggle"></div>
               </div>
               <div class = "nav-menus-wrapper">
                  <ul class = "nav nav-tabs tab_menu_tiggers clearfix" id = "nav-tab" role = "tablist">
                     <li class = "nav-item"> <a class = "nav-link active" id = "nav-home-tab" data-toggle = "tab" href = "#nav-home" role = "tab" aria-controls = "nav-home" aria-selected = "true"><i class = "fa fa-bars"></i></a></li>
                     <li class = "nav-item"> <a class = "nav-link" id = "nav-profile-tab" data-toggle = "tab" href = "#nav-profile" role = "tab" aria-controls = "nav-profile" aria-selected = "false"><i class = "fa fa-user"></i></a></li>
                  </ul>
                  <div class = "tab-content tab_menu_content" id="nav-tabContent">
                     <div class = "tab-pane fade show active" id="nav-home" role = "tabpanel" aria-labelledby = "nav-home-tab">
                        <div class=" ">
                           <ul id="main-menu" class="nav-menu tab_menu">
                              <li class="megamenu menu-item menu-item-type-custom menu-item-object-custom menu-item-478">
                                <a title="Home" href="#">Home</a>
                              </li>  
                              <li id="menu-item-478" class="megamenu menu-item menu-item-type-custom menu-item-object-custom menu-item-478">
                                <a title="Home" href="aboutus.php">About us</a>
                              </li>
                              <li id="menu-item-563" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-563 dropdown">
                                <a title="Shop" href="shop.php">Shop</a>
                                <ul role="menu" class="nav-dropdown nav-submenu ">
                                  <!-- MENU CODE -->
                                  <?php error_reporting(0);

                                    function get_menu_treee($parent_id)
                                    {
                                        global $con;
                                        $menu = "";
                                        $sqlquery = " SELECT * FROM menu where status='1' and parent_id='" . $parent_id . "' ";
                                        $res = mysqli_query($con, $sqlquery);
                                        while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
                                            $menu .= ' <li id="menu-item-563" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-563 dropdown ">
                                                                        <a title="Products" href="shop.php?q=' . $row['menu_id'] . '">' . $row['menu_name'] . '</a>  ';
                                            $menu .= ' <ul role="menu" class="nav-dropdown nav-submenu ">' . get_menu_treee($row['menu_id']) . '
                                                                                    </ul>';
                                            $menu .= '</li>';
                                        }
                                        return $menu;
                                    }

                                    echo get_menu_treee(0);
                                  ?>
                                  <!-- MENU CODE -->
                                </ul>
                              </li>
                             
                             
                              <li id="menu-item-1133" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1133">
                                <a title="Contact" href="contact.php">Contact</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class = "tab-pane fade" id = "nav-profile" role = "tabpanel" aria-labelledby = "nav-profile-tab">
                        <ul class = "tab_link_content">
                           <li> <a href="my-account/index.php" ><i class="icon icon-user2"></i> My Account</a></li>
                           <li> <a href="wishlist/index.php"> <i class="icon icon-heart"></i> Wishlist</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class = "xs-logo-wraper">
               <a class="xs_default_logo" href="index.php">
                  <img  alt="grocery" data-lazy-src="wp-content/mobilelogo.png">
               </a>
               <a class="xs_retina_logo" href="index.php">
                  <img  alt="grocery" data-lazy-src="wp-content/mobilelogo.png">

               </a>
            </div>
            <style type="text/css">
                    .blinking{
                animation:blinkingText 1.2s infinite;
            }
            @keyframes blinkingText{
                0%{     color: white;    }
                49%{    color: white; }
                60%{    color: transparent; }
                99%{    color:transparent;  }
                100%{   color: white;    }
            }
            </style>

            <ul class = "lists">
              <li>
                  <div class="xs-miniCart-dropdown"> <a  href="sale.php" class =" blinking" style="font-size: 14px;    background-color: red;padding: 5px;color: white;font-weight: bold;">OFFERS</a></div>
               </li> 
               <li>
                  <div class = "navSearch-group tab_menu_search">
                     <a href = "#" class = "navsearch-button"><i class = "icon icon-search"></i></a>
                     <form class="xs-navbar-search xs-navbar-search-wrapper navsearch-form" action="" method="get" id="header_forms">
                        <div class="input-group">
                           <input type="search" name="s" class="form-control" placeholder="Find your product">
                           <div class="xs-category-select-wraper">
                              <i class="xs-spin"></i>
                              <select class="xs-category-select2" name="product_cat">
                               <option value="-1">All Categories</option> 
                                <?php
                                  $result = mysqli_query($con, "SELECT * FROM menu where parent_id = 0 ");

                                  while ($row = mysqli_fetch_array($result)) {
                                ?>
                                  <option value="-1"><?php echo $row['menu_name']; ?></option>
                                <?php
                                  }
                                ?>
                              </select>
                           </div>
                           <div class="input-group-btn"> <input type="hidden" name="post_type" value="product"> <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button></div>
                        </div>
                     </form>
                  </div>
               </li>  
               <li> 
                  <div class="xs-miniCart-dropdown"> 

                    <a href="viewcart.php" class =""> <i class="icon icon-bag"></i>
 <span id="cartCountt" style="    font-size: .4em;
    color: #ffffff;
    font-weight: 500;
    position: absolute;
    /* top: -5px; */
    right: -10px;
    display: inline-block;
    width: 21px;
    height: 21px;
    line-height: 17px;
    border: 3px solid #FFF;
    text-align: center;
    background-color: #8BC34A;
    border-radius: 100%;" class="cart-label"><?php echo $cart->total_items(); ?></span> </a>
                    

                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>

<div id="pincode-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" style="padding-right: 12px; display: block;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-dialog__header-title"><img class="pincodeMap-svg-icon img-responsive" src="media/map-green.svg"> Where would you like us to deliver?</h5>
        <p>
          <input id="pincode-input"  placeholder="Enter Your Pincode" type="text" name="name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" aria-required="true" aria-invalid="false">
         </p>
        <button type="button" class="btn btn-sm btn-primary" onclick="checkPinCodeValid()">Confirm</button>
      </div>
       <div class="modal-footer" id="pincode-message">Currently, We Deliver in Selected Areas of Mumbai</div>
    </div>
  </div>
</div> 









  <div class="xs-sidebar-group">
    <div class="xs-overlay bg-black"></div>
  
  </div>
