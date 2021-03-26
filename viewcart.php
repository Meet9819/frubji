  
<?php  
include 'Cart.php';
$cart = new Cart;
?>

<?php
        define("SHIPPING_CHARGE", 0);
    ?>  <script>
            function updateCartItem(obj,id){
                $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
                    if(data == 'ok'){
                        location.reload();
                    }   else{
                        alert('Cart update failed, please try again.');
                    }
                });
            }
        </script>
        
<?php include "allcss.php"; ?> 
<?php include "headerwithoutcart.php"; ?> 
<style type="text/css">
 
   @media screen and (max-width: 900px) {
     #abcd { padding: 0px;height: 35px;width: 100%;
    }
  }  
  @media screen and (min-width: 900px) {
     #abcd {display:inline;padding: 0px;height: 35px;width: 20%; 
   }
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="page-template page-template-template page-template-template-full-width page-template-templatetemplate-full-width-php page page-id-5  theme-marketo woocommerce-cart woocommerce-page woocommerce-no-js woo-variation-swatches woo-variation-swatches-theme-marketo-child woo-variation-swatches-theme-child-marketo woo-variation-swatches-style-squared woo-variation-swatches-attribute-behavior-blur woo-variation-swatches-tooltip-enabled woo-variation-swatches-stylesheet-enabled sidebar-active elementor-default elementor-kit-2663 elementor-page elementor-page-5" data-spy="scroll" data-target="#header">
   <div class="xs-breadcumb">
      <div class="container">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="index.php">Home</a></li>
               <li class="breadcrumb-item">Cart</li>
            </ol>
         </nav>
      </div>
   </div>
   <div class="page" role="main">
      <div class="builder-content xs-transparent">
         <!-- full-width-content -->
         <div id="post-5" class="full-width-content post-5 page type-page status-publish hentry">
            <div data-elementor-type="wp-page" data-elementor-id="5" class="elementor elementor-5 elementor-bc-flex-widget" data-elementor-settings="[]">
               <div class="elementor-inner">
                  <div class="elementor-section-wrap">
                     <section class="elementor-element elementor-element-b16fcbf elementor-section-boxed elementor-section-height-default elementor-section-height-default elementor-section elementor-top-section" data-id="b16fcbf" data-element_type="section">
                        <div class="elementor-container elementor-column-gap-default">
                           <div class="elementor-row">
                              <div class="elementor-element elementor-element-4647562 elementor-column elementor-col-100 elementor-top-column" data-id="4647562" data-element_type="column">
                                 <div class="elementor-column-wrap  elementor-element-populated">
                                    <div class="elementor-widget-wrap">
                                       <div class="elementor-element elementor-element-e102e8f elementor-widget elementor-widget-shortcode" data-id="e102e8f" data-element_type="widget" data-widget_type="shortcode.default">
                                          <div class="elementor-widget-container">
                                             

                                             
<style type="text/css">
  .sizee {
    font-size: 14px;
    text-align: center;
  }
 
</style>


                                <table class="table table-bordered">
                                    <table id="cart_summary" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="sizee cart_product first_item">Product</th>
                                                <!--<th class="cart_description item">Description</th> -->
                                                <th class="sizee cart_unit item text-right">Units</th>
                                                <th class="sizee cart_unit item text-right">Price</th>
                                                <th class="sizee cart_quantity item text-center">Qty</th>
                                                <th class="sizee cart_delete last_item">&nbsp;</th>
                                                <th class="sizee cart_total item text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $cart->total_items();
                                            
                                            if($cart->total_items() > 0){
                                                //get cart items from session
                                                // gross weight
                                                $gross_weight = 0;
                                                $cartItems = $cart->contents();
                                                
                                                foreach($cartItems as $item)    {
                                                    $item_id = (int) $item["id"];
                                                    $item_variant_id = (int) $item["variant"];
                                                    $gross_weight += ($item["weight"] * $item["qty"]);
                                                    $variant = $_SESSION["branch"]["price"][$item_id]["variants"][$item_variant_id]["variant"];
                                            ?>
                                            <tr id="product_65_477_0_0" class="cart_item address_0 even">
                                                <td class="cart_product">
                                                    <a href="#"><img src="<?php echo $item["imagurl"]; ?>" width="80" height="80" /></a> 
                                                     <h6 class="product-name">
                                                        <a href="#"><?php echo $item["name"]; ?></a>
                                                    </h6> 

                                                </td>
                                             <!--   <td class="cart_description">
                                                     <br>  <small class="cart_ref">  Product Code : <?php echo $item["productcode"]; ?>HSN Code : <?php echo $item["hsncode"]; ?> - GST : <?php echo $item["gst"]; ?> 
                                                   </small>                                                    
                                                </td>  -->
                                                <td class="cart_unit" data-title="Unit price">
                                                    <ul class=" text-right" id="product_price_65_477_0">
                                                        <li class="sizee special-price"> 
                                                          <?php echo $variant; ?></li>
                                                    </ul>
                                                </td>
                                                <td class="cart_unit" data-title="Unit price">
                                                    <ul class=" text-right" id="product_price_65_477_0">
                                                        <li class="sizee special-price">&#8377;<?php echo $item["price"]; ?></li>
                                                    </ul>
                                                </td>
                                                <td  class=" cart_quantity text-center" data-title="Quantity">
                                                
                                                 <span style="padding: 5px 10px;" class="minus  btn btn-primary" >-</span>
                                                  
                                                   <input id="abcd" type="number" class="item_qty form-control text-center"  minlenght="0" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')">
                                                 
                                                 <span style="padding: 5px 10px;" class="plus btn btn-primary">+</span>
                                                   
                                                </td>
                                                <td class="cart_delete text-center" data-title="Delete">
                                                    <div>
                                                        <a style="    padding: 10px 10px;" href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-primary " onclick="return confirm('Are you sure?')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="cart_total text-center" data-title="Total">
                                                    <span class="" id="total_product_price_65_477_2">
                                                    &#8377;<?php echo $item["subtotal"]; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php
                                                    }
                                                }   else    { 
                                            ?>
                                            <tr>
                                                <td colspan="6" style="text-align: center;">
                                            <!-- <?//xml version="1.0" encoding="UTF-8"?> -->
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
<!-- Creator: CorelDRAW X7 -->
<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="56.614mm" height="51.6404mm" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
viewBox="0 0 5661 5164"
 xmlns:xlink="http://www.w3.org/1999/xlink">
 <defs>
  <style type="text/css">
   <![CDATA[
    .fil0 {fill:#64B32E}
    .fil3 {fill:#EAF3FF}
    .fil1 {fill:#EBFFDE}
    .fil2 {fill:#F39200}
   ]]>
  </style>
 </defs>
 <g id="Layer_x0020_1">
  <metadata id="CorelCorpID_0Corel-Layer"/>
  <circle id="Oval" class="fil0" cx="3317" cy="4599" r="518"/>
  <path id="Path" class="fil1" d="M3317 4891c-161,0 -292,-131 -292,-292 0,-161 131,-291 292,-291 161,0 292,130 292,291 0,161 -131,292 -292,292l0 0z"/>
  <path id="Shape" class="fil2" d="M3317 5164c-312,0 -565,-253 -565,-565 0,-311 253,-564 565,-564 311,0 565,253 565,564 0,312 -254,565 -565,565zm0 -1035c-260,0 -471,211 -471,470 0,260 211,471 471,471 259,0 470,-211 470,-471 0,-259 -211,-470 -470,-470z"/>
  <circle id="Oval_0" class="fil0" cx="1136" cy="4599" r="518"/>
  <path id="Path_1" class="fil1" d="M1135 4891c-160,0 -291,-131 -291,-292 0,-161 131,-291 291,-291 161,0 292,130 292,291 0,161 -131,292 -292,292l0 0z"/>
  <path id="Shape_2" class="fil2" d="M1135 5164c-311,0 -564,-253 -564,-565 0,-311 253,-564 564,-564 312,0 565,253 565,564 0,312 -253,565 -565,565zm0 -1035c-259,0 -470,211 -470,470 0,260 211,471 470,471 260,0 471,-211 471,-471 0,-259 -211,-470 -471,-470l0 0z"/>
  <path id="Path_3" class="fil1" d="M1288 4082l0 387c0,70 -57,127 -127,127l-37 0c-54,0 -102,-34 -119,-85l-149 -429 432 0 0 0z"/>
  <path id="Path_4" class="fil1" d="M3469 4082l0 387c0,70 -57,127 -127,127l-36 0c-54,0 -102,-34 -120,-85l-148 -429 431 0 0 0z"/>
  <path id="Shape_5" class="fil2" d="M1161 4643l-37 0c-74,0 -140,-47 -164,-117l-148 -429c-5,-14 -3,-30 6,-43 9,-12 23,-19 38,-19l432 0c26,0 47,21 47,47l0 387c0,96 -78,174 -174,174l0 0zm-238 -514l126 366c11,32 41,54 75,54l37 0c44,0 79,-36 79,-80l0 -340 -317 0z"/>
  <path id="Shape_6" class="fil2" d="M3342 4643l-36 0c-74,0 -140,-47 -165,-117l-148 -429c-5,-14 -2,-30 6,-43 9,-12 24,-19 39,-19l431 0c26,0 47,21 47,47l0 387c0,96 -78,174 -174,174l0 0zm-238 -514l126 366c12,32 42,54 76,54l36 0c44,0 80,-36 80,-80l0 -340 -318 0z"/>
  <path id="Path_7" class="fil1" d="M5503 548l-927 0c-62,0 -112,-50 -112,-112l0 -278c0,-61 50,-111 112,-111l927 0c61,0 111,50 111,111l0 278c0,62 -50,112 -111,112z"/>
  <path id="Shape_8" class="fil2" d="M5503 595l-927 0c-88,0 -159,-71 -159,-159l0 -278c0,-87 71,-158 159,-158l927 0c87,0 158,71 158,158l0 278c0,88 -71,159 -158,159zm-927 -501c-36,0 -64,29 -64,64l0 278c0,36 28,64 64,64l927 0c35,0 64,-28 64,-64l0 -278c0,-35 -29,-64 -64,-64l-927 0z"/>
  <path id="Path_9" class="fil3" d="M4133 543c9,-61 58,-107 114,-107l217 0 0 -278 -217 0c-195,0 -362,149 -389,347l-32 235 116 0c41,0 79,17 105,47 27,30 39,70 33,110l53 -354z"/>
  <path id="Shape_10" class="fil2" d="M4080 944c-2,0 -4,0 -6,0 -26,-4 -44,-28 -40,-53 3,-26 -5,-53 -22,-73 -18,-20 -43,-31 -69,-31l-117 0c-14,0 -27,-6 -36,-17 -9,-10 -13,-23 -11,-37l32 -235c31,-220 218,-387 436,-387l217 0c26,0 48,21 48,47l0 278c0,26 -22,48 -48,48l-217 0c-33,0 -62,28 -67,65 0,1 0,1 0,1l-53 354c-4,23 -24,40 -47,40l0 0zm-200 -252l63 0c41,0 82,15 114,40l30 -196c12,-84 80,-147 160,-147l170 0 0 -183 -170 0c-171,0 -318,131 -342,305l-25 181z"/>
  <path id="Shape_11" class="fil1" d="M4047 787c-26,-30 -64,-47 -104,-47l-3655 0c-70,0 -136,29 -181,82 -46,52 -67,121 -58,190l282 2095c23,169 169,297 339,297l421 0 84 0 57 0 1665 0 57 0 122 0 368 0c170,0 316,-128 339,-297l297 -2210c6,-40 -6,-80 -33,-110zm-3716 231l537 0 80 915 -494 0 -123 -915zm339 2108c-31,0 -59,-24 -63,-56l-116 -859 481 0 80 915 -382 0zm1255 0l-593 0 -80 -915 673 0 0 915zm0 -1193l-698 0 -80 -915 778 0 0 915zm872 1193l-594 0 0 -915 674 0 -80 915zm105 -1193l-699 0 0 -915 779 0 -80 915zm605 1137c-4,32 -31,56 -63,56l-368 0 80 -915 467 0 -116 859zm153 -1137l-479 0 80 -915 523 0 -124 915z"/>
  <path id="Path_12" class="fil1" d="M3617 3404c103,0 186,89 186,200 0,110 -83,200 -186,200l-3124 0c-77,0 -139,62 -139,139 0,76 62,139 139,139l3124 0c256,0 465,-215 465,-478 0,-208 -130,-384 -309,-450 -41,145 -175,250 -329,250l173 0z"/>
  <path id="Shape_13" class="fil2" d="M3444 3451l-2774 0c-194,0 -359,-145 -385,-337l-282 -2096c-12,-82 14,-165 68,-227 55,-63 134,-99 217,-99l3655 0c53,0 104,24 140,64 35,40 51,94 44,147l-298 2211c-25,192 -191,337 -385,337zm-3156 -2664c-56,0 -109,24 -146,66 -37,42 -53,98 -46,153l282 2095c20,146 145,256 292,256l2774 0c147,0 272,-110 292,-256l298 -2210c3,-26 -5,-53 -22,-73 0,0 0,0 0,0 -18,-20 -43,-31 -69,-31l-3655 0 0 0zm3156 2386l-368 0c-13,0 -26,-6 -35,-15 -8,-10 -13,-23 -12,-36l80 -915c2,-25 23,-44 47,-44l467 0c13,0 26,6 35,17 9,10 13,23 12,37l-116 860c-8,55 -55,96 -110,96l0 0zm-316 -94l316 0c8,0 15,-7 16,-15l109 -806 -369 0 -72 821zm-331 94l-594 0c-26,0 -47,-21 -47,-47l0 -915c0,-26 21,-48 47,-48l674 0c13,0 26,6 35,16 9,10 13,23 12,36l-80 915c-2,24 -22,43 -47,43l0 0zm-546 -94l503 0 72 -821 -575 0 0 821zm-326 94l-593 0c-25,0 -45,-19 -47,-43l-80 -915c-2,-13 3,-26 12,-36 9,-10 21,-16 35,-16l673 0c26,0 48,22 48,48l0 915c0,26 -22,47 -48,47l0 0zm-550 -94l503 0 0 -821 -575 0 72 821zm-323 94l-382 0c-55,0 -102,-41 -110,-96l-116 -860c-1,-14 3,-27 12,-37 9,-11 22,-17 35,-17l481 0c25,0 45,19 47,44l80 915c2,13 -3,26 -12,36 -9,9 -21,15 -35,15l0 0zm-507 -915l109 806c1,8 8,15 16,15l331 0 -72 -821 -384 0zm3115 -278l-479 0c-14,0 -26,-6 -35,-16 -9,-9 -14,-22 -12,-35l80 -916c2,-24 22,-43 47,-43l522 0c14,0 27,6 36,17 9,10 13,23 11,37l-123 915c-3,23 -23,41 -47,41l0 0zm-428 -95l387 0 111 -820 -426 0 -72 820zm-331 95l-698 0c-26,0 -47,-21 -47,-47l0 -915c0,-26 21,-48 47,-48l779 0c13,0 25,6 34,16 9,9 14,23 13,36l-80 915c-3,24 -23,43 -48,43zm-650 -95l607 0 72 -820 -679 0 0 820zm-326 95l-698 0c-24,0 -45,-19 -47,-43l-80 -915c-1,-14 3,-27 12,-36 9,-10 22,-16 35,-16l778 0c26,0 48,22 48,48l0 915c0,26 -22,47 -48,47zm-655 -95l608 0 0 -820 -679 0 71 820zm-322 95l-494 0c-24,0 -44,-18 -47,-41l-123 -915c-2,-14 2,-27 11,-37 9,-11 22,-17 36,-17l537 0c24,0 45,19 47,43l80 916c1,13 -3,26 -12,35 -9,10 -22,16 -35,16zm-453 -95l402 0 -72 -820 -440 0 110 820z"/>
  <path id="Shape_14" class="fil2" d="M3617 4129l-3124 0c-103,0 -186,-84 -186,-186 0,-103 83,-186 186,-186l3124 0c77,0 139,-69 139,-153 0,-85 -62,-153 -139,-153l-173 0c-26,0 -47,-21 -47,-47 0,-26 21,-47 47,-47 131,0 248,-89 283,-216 4,-13 13,-23 24,-29 12,-6 26,-7 38,-2 203,74 340,273 340,494 0,289 -230,525 -512,525l0 0zm-3124 -278c-51,0 -92,41 -92,92 0,50 41,92 92,92l3124 0c230,0 417,-194 417,-431 0,-165 -92,-315 -234,-387 -26,60 -66,111 -116,150 96,31 167,125 167,237 0,136 -105,247 -234,247l-3124 0 0 0z"/>
  <circle id="Oval_15" class="fil0" cx="4045" cy="2073" r="922"/>
  <path id="Path_16" class="fil1" d="M4045 2759c-379,0 -686,-307 -686,-686 0,-378 307,-686 686,-686 378,0 686,308 686,686 0,379 -308,686 -686,686z"/>
  <path id="Shape_17" class="fil2" d="M4045 3042c-535,0 -970,-434 -970,-969 0,-534 435,-969 970,-969 534,0 969,435 969,969 0,535 -435,969 -969,969zm0 -1843c-483,0 -875,392 -875,874 0,483 392,875 875,875 482,0 874,-392 874,-875 0,-482 -392,-874 -874,-874z"/>
  <path id="Path_18" class="fil0" d="M4450 2218l-811 0c-26,0 -47,-21 -47,-47l0 -198c0,-26 21,-47 47,-47l811 0c26,0 47,21 47,47l0 198c0,26 -21,47 -47,47z"/>
 </g>
</svg>

 <br><br>   <p style="    font-size: 15px;    font-weight: bold;    color: #FF5722;" class="alert alert-warning">Your shopping cart is empty.</p> 
                                                </td>
                                            </tr>
                                            <?php 
                                                } 
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <?php  
                                                if($cart->total_items() > 0) { 
                                            ?>
                                            <tr class="cart_total_price">
                                                <td colspan="3" id="subtotal_final" class="cart_voucher"></td>
                                                <td colspan="2"  class="total_price_container text-right">
                                                    <span>Total</span>
                                                    <div id="hookDisplayProductPriceBlock-price"></div>
                                                </td>
                                                <td colspan="1" class="" id="total_price_container" style="text-align: center;">
                                                    <?php
                                                        if($cart->total_items() > 0)  {
                                                    ?>
                                                    &#8377;<span id="total_price"><?php echo $cart->total(); ?></span>
                                                    <?php  } ?>
                                                </td>
                                            </tr>
                                            <tr class="cart_total_price" style="display: none">
                                                <td colspan="3" id="subtotal_final" class="cart_voucher"></td>
                                                <td colspan="2"  class="total_price_container text-right">
                                                    <span>
                                                        Gross Shipping Charges<br/>
                                                    </span>
                                                    <div id="hookDisplayProductPriceBlock-price"></div>
                                                </td>
                                                <td colspan="1" class="" id="total_price_container" style="text-align: center;">
                                                    <?php
                                                        if($cart->total() < 499)  {
                                                            // gross shipping charges
                                                            $gross_shipping_charges =  SHIPPING_CHARGE;
                                                    ?>
                                                    &#8377;<span id="total_price"><?php echo $gross_shipping_charges; ?></span> 
                                                    
                                                 <input type="hidden" name="shippingcharge" value="<?php echo $_SESSION["shipping_charges"]; ?>">
                                                 
                                                    <?php  
                                                            $_SESSION["shipping_charges"] = $gross_shipping_charges;   
                                                            
                                                          
                                                        }
                                                        else
                                                        {
                                                              $gross_shipping_charges =  0;
                                                                ?>
                                                    &#8377;<span id="total_price"><?php echo $gross_shipping_charges; ?></span> 
                                                    
                                                 <input type="hidden" name="shippingcharge" value="<?php echo $_SESSION["shipping_charges"]; ?>">
                                                 
                                                    <?php  
                                                            $_SESSION["shipping_charges"] = $gross_shipping_charges;   
                                                            
                                                          

                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </table>

                                  </div>
                            <div id="HOOK_SHOPPING_CART"></div>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-4" >
                                        <p class="cart_navigation clearfix">
                                            <a style="padding: 10px 10px;" href="index.php" class="button-exclusive btn btn-primary" title="Continue shopping">
                                                <i class="fa fa-chevron-left left"></i> Continue shopping
                                            </a>
                                        </p>
                                    </div>
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4" style="text-align: right;">
                                        <a style="padding: 10px 10px;" class="button btn btn-primary " type="submit" href="checkout.php">Proceed to checkout</a>
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





                       
 <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

 <script type="text/javascript">
    $(document).ready(function() {
    $('.minus').click(function () {
      var $input = $(this).parent().find('#abcd');
      var count = parseInt($input.val()) - 1;
      count = count < 1 ? 1 : count;
      $input.val(count);
      $input.change();
      return false;
    });
    
    $('.plus').click(function () {
      var $input = $(this).parent().find('#abcd');
      $input.val(parseInt($input.val()) + 1);
      $input.change();
      return false;
    });

    
  });
  </script>
  

    <?php include "footer.php"; ?>
      </div>     
      <?php include "allscript.php"; ?>
        <script src="js/jquery-1.12.0.min.js"></script>
