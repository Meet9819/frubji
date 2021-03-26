<?php
error_reporting(0);
session_start();
if (!isset($_SESSION["userSession"])) {
    header("Location: login.php");
    exit();}
?>

<?php
include 'logindb.php';

$query = $db->query("SELECT * FROM tbl_users WHERE userID = " . $_SESSION['userSession']);

$custRow = $query->fetch_assoc();
?>

        <?php include "allcss.php";?>
        <?php include "header.php";?>

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
                                                    
                                                   <div class="form-group">
                                                     <br> <h6 style="color: #ff5722">Order Information :</h6>
                                                   </div>
											<table class="table table-bordered  table-striped">
			                                <tbody>
			                                    <thead>
			                                        <tr>
			                                            <th style="background-color: #ff5722;color:white">Product Code</th>
			                                            <th style="background-color: #ff5722;color:white">Product Name</th>
                                                        <th style="background-color: #ff5722;color:white">MRP</th>
			                                            <th style="background-color: #ff5722;color:white">Units</th>
			                                            <th style="background-color: #ff5722;color:white">Quantity</th>
			                                            <th style="background-color: #ff5722;color:white">Total</th>
			                                        </tr>
			                                    </thead>

		                                    <?php
											$con = mysqli_connect("localhost","root","","frubji");
											$result = mysqli_query($con, "SELECT * FROM o ORDER BY id DESC LIMIT 1");
											while ($row = mysqli_fetch_array($result)) {
											    $billno = $row['billno'] + 1;
											}
											?>

			                               	<?php 
											date_default_timezone_set('Asia/Kolkata');
											if ($cart->total_items() > 0) {
												$cartItems = $cart->contents();
												foreach ($cartItems as $item) {
										   ?>

                                            <tr>

                                                <input type="hidden" name="billno[]" value="<?php echo $itemcode = $billno; ?>">
                                                <input type="hidden" name="useremailid[]" value="<?php echo $itemcode = $custRow['userEmail']; ?>">
                                                <input type="hidden" name="datee[]" value="<?php echo $itemcode = date(" Y-m-d h:i "); ?>"> 


                                                <?php $charge = $_SESSION["shipping_charges"];?>
                                                    	<input type="hidden" name="shippingcharge[]" value="<?php echo $itemcode = $charge; ?>">
                                                   		<?php if ($cart->total_items() > 0) {?>
                                                        <strong> <?php echo '  <input type="hidden" name="finalamount[]" value="' . $finalpayment = $cart->total() + $charge . '">  '; ?></strong>
                                                        <?php }?>
                                                            <td>
                                                             <input type="hidden" name="productcode[]" value="<?php echo $itemcode = $item["productcode"]; ?>">
                                                                <?php echo $itemcode = $item["productcode"]; ?>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="name[]" value="<?php echo $itemcode = $item["name"]; ?>">
                                                                <?php echo $itemname = $item["name"]; ?>
                                                            </td>

                                                            	                                                            <td>
                                                                <input type="hidden" name="price[]" value="<?php echo $itemcode = $item["price"]; ?>">
                                                                <?php echo '&#8377;' . $item["price"]; ?>
                                                            </td>
                                                           
                                                              <td>
																 

                                                                <?php $itemname = $item["hsncode"];?>  
                                                                <?php  $weight = $item["weight"]; ?>  
                                                                <?php  $units = $item["units"]; ?> 
                                                                <?php  $variant = $item["variant"]; ?>

                                                                 <?php
                                                                  include"db.php";
                                                                  $result = mysqli_query($con,"SELECT * FROM productvariant where id = $variant ");

                                                                  while($row = mysqli_fetch_array($result))
                                                                  {
                                                                  echo $newunits = $row['qty'].' '.$row['units']; } ?>

                                                                   <input type="hidden" name="weight[]" value="<?php echo $itemcode = $item["weight"]; ?>">
                                                                  <input type="hidden" name="units[]" value="<?php echo $newunits; ?>">


                                                            </td>

                                                            <td>

                                                                <input type="hidden" name="qty[]" value="<?php echo $itemcode = $item["qty"]; ?>">
                                                                <?php echo $item["qty"]; ?>
                                                                    <br>
                                                            </td>

                                                            <td>
                                                                <input type="hidden" name="subtotal[]" value="<?php echo $itemcode = $item["subtotal"]; ?>">
                                                                <?php echo '&#8377;' . $item["subtotal"]; ?>
                                                            </td>
                                            </tr>
									     <?php 
											$useremailid = $custRow['userEmail'];
									        $datee = date("Y-m-d h:i");
									        $productcode = $item['productcode'];
									        $mrp = $item['mrp'];
									        $name = $item['name'];
									        $weight = $item['weight'];
									        $units = $item['variant'];
									        $qty = $item['qty'];
									        $price = $item['price'];
									        $subtotal = $item['subtotal']; 
									       
									        $finalamount = $finalpayment;
									        $shippingcharge = $charge;
									        $billno = $billno;
									        $total = $subtotal + $shippingcharge;
									        $save = mysqli_query($con, "INSERT INTO o (representativeid, representativecommission, productcode,name,qty,price,useremailid,datee,shippingcharge,subtotal,total,finalamount,billno,weight,units,mrp) VALUES ( '$representativeid', '$representativecommission', '$productcode','$name','$qty','$price','$useremailid','$datee','$shippingcharge','$subtotal','$total','$finalamount','$billno','$weight','$units','$mrp')");

									    }} else {?>

                                                <p class="alert alert-warning">Your shopping cart is empty.</p>

                                                <?php }?>

                                                    <tr>
                                                        <th></th>
                                                        <th></th>  <th></th> 
                                                        <th></th>
                                                        <th style="background-color: #ff5722;color:white;text-align:center">SHIPPING CHARGES</th>
                                                        <th style="background-color: #ff5722;color:white">
                                                            <?php echo '&#8377;' . $charge = $_SESSION["shipping_charges"]; ?>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th style="background-color: #1fae04;color:white"></th>  <th style="background-color: #1fae04;color:white"></th>
                                                        <th style="background-color: #1fae04;color:white"></th>
                                                        <th style="background-color: #1fae04;color:white"></th>
                                                        <th style="background-color: #1fae04;color:white;text-align:center">TOTAL</th>
                                                        <th style="background-color: #1fae04;color:white">
                                                            <?php if ($cart->total_items() > 0) {?>
                                                                <strong> <?php echo '&#8377;' . $finalpayment = $cart->total() + $charge; ?></strong>
                                                                <?php }?>
                                                        </th>
                                                    </tr>
		                                </tbody>
		                            </table>
                            </div>





                                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                       <form name="registration" id="registration-form" class="box"> 


                                        <!-- Note that the amount is in paise = 50 INR 
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_test_IBYF6BLbafNp1O"
        data-amount="10000"
        data-buttontext="Pay with Razorpay"
        data-name="PHPExpertise.com"
        data-description="Test Txn with RazorPay"
        data-image="https://your-awesome-site.com/your_logo.jpg"
        data-prefill.name="Harshil Mathur"
        data-prefill.email="support@razorpay.com"
        data-theme.color="#F37254"
    ></script>
    <input type="hidden" value="Hidden Element" name="hidden">-->

                                                    <?php
                                                    $datee = date("l jS \of F Y h:i:s A");
                                                    $date = date("d-m-Y");
                                                    ?>
                                                    <input type="hidden"  name="product_name" value="<?php echo $name; ?>">
                                                    <input type="hidden" value="<?php echo $productcode; ?>" name="productcode">
                                                    <input type="hidden" value="<?php echo $finalpayment; ?>" name="product_price">
                                                    <input type="hidden" value="<?php echo $billno; ?>" name="billno">
                                                    <input type="hidden" value="<?php echo $datee; ?>" name="created"> 
                                                    <input type="hidden" value="<?php echo $date; ?>" name="datee">
                                                    <?php
                                                        error_reporting(0);
                                                        session_start();

                                                        $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
                                                        $stmt->execute(array(":uid" => $_SESSION['userSession']));
                                                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                                        $con = mysqli_connect("localhost","root","","frubji") or die('Unable to connect');
                                                        if (isset($_SESSION['userSession'])) {echo '
                                                   		 <input type="hidden" name="userID" value="' . $row['userID'] . '" >
                                                    ';}?>

                                                	<div class="xs-contact-form">
                                                        <div class="form-row">
                                                        	   <div class="col-md-12">
                                                        	  <div class="form-group">
                                                                   <br> <h6 style="color: #ff5722">Shipping Address :</h6>
                                                                </div>
                                                  			</div>
                                                  			<div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>Representative ID</label>
                                                                      <input class="form-control"  name="representativecommission" name="representativecommission" required="" type="hidden" value="<?php echo $representativecommission; ?>" required="">

                                                                     <input class="form-control"  name="representativeid" name="representativeid" required="" type="hidden" value="<?php echo $representativeid; ?>" required="">
                                                                    <input readonly="" class="form-control" placeholder="Enter your username" name="name" required="" type="text" value="FRUBJI-8">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label>First Name</label>
                                                                    <input class="form-control" placeholder="Enter your username" name="name" required="" type="text" value="<?php echo $custRow['userName']; ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2 ">
                                                                <div class="form-group">
                                                                    <label>Last Name</label>
                                                                    <input class="form-control" placeholder="Enter your username" name="lastname" required="" value="<?php echo $custRow['lastname']; ?>" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input class="form-control" placeholder="Enter your email address" name="email" required="" type="email" value="  <?php echo $custRow['userEmail']; ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Mobile </label>
                                                                    <input class="form-control" id="mobile" placeholder="Enter Your Mobile No" value="<?php echo $custRow['mobile']; ?> " name="phone" required="" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>Street Address </label>
                                                                    <input class="form-control" id="address" name="address" placeholder="House Number and Street Name" value=" <?php echo $custRow['address']; ?> " required="" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">

                                                                <label>State </label>
                                                                <select style=" height: 3.25rem;" name="state" class="form-control" required="">
                                                                    <option value="<?php echo $custRow['state']; ?>"><?php echo $custRow['state']; ?></option>
                                                                    <option value="">Select a state&hellip;</option>                                                                   
                                                                    <option value="MH">Maharashtra</option>                                                                  
                                                                </select>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Postcode / ZIP </label>
                                                                    <input class="form-control" id="pincode" placeholder="Enter Your pincode" value="<?php echo $custRow['pincode']; ?>" name="pincode" required="" type="text">
                                                                </div>
                                                            </div>  
                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label>Country </label>
                                                                    <input class="form-control" id="country" placeholder="Enter Your Country" value=" India " name="country" required="" type="text">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12">
                                                                <?php if ($finalamount < 2000) {?> 

                                                                    
                                                                <div class="form-group">
                                                                   <br> <h6 style="color: #ff5722">Select Payment Mode :</h6>
                                                                </div>
                                                                 <div  style=" font-size: 18px;  padding: 10px;  font-weight: bold;">
                                                                    <input style="height: auto;" type="radio" name="payment-mode" id="payment-mode-COD" value="1" <?php echo ($finalamount <= 2000) ? "checked='checked'" : "" ?> />
                                                                    <label style="display: inline;    padding-left: 10px;" for="payment-mode-COD">Cash On Delivery </label>
                                                                </div>
                                                               
                                                                <div  style=" font-size: 18px;  padding: 10px;  font-weight: bold;">
                                                                    <input style="height: auto;" type="radio" name="payment-mode" id="payment-mode-online" value="2" <?php echo ($finalamount > 2000) ? "checked='checked'" : "" ?>  />
                                                                    <label style="display: inline;    padding-left: 10px;" for="payment-mode-online">Online Payment</label>
                                                                </div>
                                                                <?php }?>
                                                            </div>

                                                            <div class="col-sm-12" style="text-align: right;">
                                                                 <input  class="wpcf7-form-control wpcf7-submit btn btn-primary badge badge-pill btn-lg" id="reg-form-submit" type="button" name="save" value="Place Order" />
                                                            </div>
															</div>
														</div>
                                                    </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


                              

 <?php include "footer.php";?>
</div>
<?php include "allscript.php";?>

<script>
    $('#reg-form-submit').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        let paymentMode = Number($('input[name="payment-mode"]:checked').val()) || ((Number($('input[name="product_price"]').val()) >= 2000) ? 2 : 0);

        if (!paymentMode)   {
            return;
        }

        $('#registration-form').attr('method', 'POST');

        if (paymentMode === 1)    {
            $('#registration-form').attr('action', 'offline-pay.php');
            $('#registration-form').submit();
        } else if (paymentMode === 2) {
            $('#registration-form').attr('action', 'razorpay/pay.php');
            $('#registration-form').submit();
        }
    });
</script>