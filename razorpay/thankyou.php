<?php

require_once '../class.userr.php';
require_once 'Razorpay.php';
require_once 'db.php';

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$reg_user = new USERR();

$RAZORPAY_API_KEY = "rzp_test_IBYF6BLbafNp1O";
$RAZORPAY_API_SECRET = "7aa8lve68XwZnZ40EmxD3yya";
   $emailidofbuyer = 'meetshah9819@gmail.com';
?>

  <?php  
            $message = "
                        
            <table width='640' cellspacing='0' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:16px;color:rgb(51, 51, 51);background-color:rgb(255, 255, 255);margin:0px auto;' cellpadding='0'>
                <tbody>
                    <tr>
                        <td colspan='1' rowspan='1' valign='top' style='padding:14px 0px 10px 20px;width:100px;border-collapse:collapse;'>
                            <a rel='nofollow' shape='rect' target='_blank' href=''>
                                <img width='181px' id='' alt='frubji' border='0' src='https://frubji.com/beta/wp-content/mobilelogo.png'>
                            </a>
                        </td>
                        <td colspan='1' rowspan='1' style='text-align:right;padding:0px 20px;'>
                            <table cellspacing='0' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:16px;color:rgb(51, 51, 51);margin:0px auto;border-collapse:collapse;' cellpadding='0'>
                                <tbody>
                                 
                                    <tr>
                                        <td colspan='1' rowspan='1' style='text-align:right;padding:7px 0px 0px 20px;width:490px;'>
                                            <span style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:20px;line-height:normal;'>Order Confirmation</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan='1' rowspan='1' style='text-align:right;padding:0px 0px 5px 20px;width:490px;'>
                                            <span style='font-size:12px;'> Order #
                                                <a rel='nofollow' shape='rect' target='_blank' href='' style='text-decoration:none;color:#006699;'>${payid}</a>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' rowspan='1' style='width:640px;'>
                            <p style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:18px;line-height:normal;color:#ad0000;margin:15px 20px 0px;'>Hello    ${userName} ${lastname} ,</p>
                            <p style='margin:4px 20px 18px 20px;width:640px;'>Thank You for choosing Frubji. Your order is on the way. 
                                <a rel='nofollow' shape='rect' target='_blank' href='' style='color:#006699;text-decoration:none;'>My Orders</a> on http://frubji.com/history.php</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' rowspan='1' style='padding:0 20px;width:640px;'>
                            <table cellspacing='0' style='border-top:3px solid #2d3741;width:640px;' cellpadding='0'>
                                <tbody>
                                    <tr>
                                        <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:11px 0px 14px 18px;width:280px;background-color:rgb(239, 239, 239);'>
                                            <span style='color:#666;'></span>
                                            <br clear='none'>
                                            <p style='margin:2px 0 9px 0;'>
                                                <strong style='color:#009900;'></strong>
                                            </p>
                                            <br clear='none'>
                                        </td>
                                        <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:11px 18px 14px;width:280px;background-color:rgb(239, 239, 239);'>
                                            <span style='color:#666;'>Your package was sent to:</span>
                                            <br clear='none'>
                                            <p style='margin:2px 0;'> <strong>   ${name}<br clear='none'>   ${addr} , India </strong>.
                                                <br clear='none'> ${mobile}  <br clear='none'>${emailidofbuyer} <br clear='none'> Invoice No - ${billno}
                                            </p>
                                        </td>
                                    </tr>
                                 
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' rowspan='1' style='width:640px;'>
                            <p style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:18px;line-height:normal;color:#ad0000;border-bottom:1px solid rgb(204, 204, 204);margin:0px 20px 3px;padding:0px 0px 3px;'>Shipment Details</p>
                        </td>
                    </tr>
            
            
                    
                    <tr>
                        <td colspan='3' rowspan='1' id='yiv1669056380ydpdefbf859yiv5642539659shipmentDetails' style='padding:16px 40px;width:640px;'>
                            <table width='100%' cellspacing='0' cellpadding='0'>
                                <tbody>
                                    <tr>
                                        <td align='center' colspan='3' rowspan='1' valign='top' style='width:640px;min-height:115px;'>
                                            <table id='example' class='table table-striped table-bordered display' style='width:640px'>
                                                <thead>
                                                    <tr>
                                                        <th style='text-align:left'>Product Code</th>
                                                        <th style='text-align:left'>Product Name</th>
                                                        <th style='text-align:left'>Units</th>
                                                        <th style='text-align:left'>Qty Ordered</th>
                                                        <th style='text-align:left'>Price</th>
                                                        <th style='text-align:left'>Sub Total </th>
                                                    </tr>
                                                </thead>
                                                <tbody>";
                include 'db.php';
                $result = mysqli_query($con, "SELECT * FROM o where billno = '$billno'"); 
                while ($row = mysqli_fetch_array($result)) {   
                    
                   
                   $chargeamount = $row['shippingcharge'];
                   $finalamountt = $row['finalamount'];
                    
                    $message .= "
                                                            <tr>
                                                                <td>" . $row['productcode'] . "</td>
                                                                <td>" . $row['name'] . "</td>
                                                                <td>" . $row['weight'] . " " . $row['units'] . "</td>
                                                                <td>" . $row['qty'] . "</td>
                                                                <td>" . $row['price'] . "</td>
                                                                <td>" . $row['subtotal'] . "</td>
                                                            </tr>";
                }
                $message .= "</tbody>
                                            </table>
                                        </td>
                                    </tr> 
                                    
                                    
                        
            
            
                                    <tr>
                                        <td colspan='2' rowspan='1' style='border-top:1px solid rgb(234, 234, 234);padding:0pt 0pt 16px;width:560px;'>&nbsp;</td>
                                    </tr>
                                   

                                    <tr>
                                        <td align='right' colspan='2' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:10px 10px 10px 0px;color:rgb(51, 51, 51);width:480px;'>Total Amount:</td>
                                        <td align='right' colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:10px 0px 5px;color:rgb(51, 51, 51);width:85px;'> <strong> &#8377;{$finalamountt}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' rowspan='1' style='padding:0 20px;line-height:22px;width:640px;'>
                            <p style='border-top:1px solid #ccc;padding:20px 0 0 0;'>Track your order with the <a rel='nofollow' shape='rect' target='_blank' href='' style='color:#006699;text-decoration:none;'>Frubji | Food and Health</a>.
                                <br clear='none'>If you need further assistance with your order, please visit
                                <a rel='nofollow' shape='rect' target='_blank' href='' style='color:#006699;text-decoration:none;'>Customer Service</a>.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' rowspan='1' style='padding:0 20px 0 20px;line-height:22px;width:640px;'>
                            <p style='margin:10px 0;padding:0 0 20px 0;border-bottom:1px solid #eaeaea;'>We hope to see you again soon!
                            <br clear='none'>
                            <span style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;'>
                                <strong>www.frubji.com</strong>
                            </span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' rowspan='1' style='font-size:10px;color:#666;padding:0 20px 20px 20px;line-height:16px;width:640px;'>
                        <p>This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</p>
                        </td>
                    </tr>
                </tbody>
            </table> 
                   
                  
         
            ";
            
                        
            $subject = "Order Confirmation - Frubji | Food and Health";
                        
            $reg_user->send_mail($emailidofbuyer,$message,$subject); 
            
            ?>
<body>
     
   
      <div style="width:100%;text-align:center" class="container">
         <?php 
            // require_once "../bluedart/services/waybill.php";
            // require_once "../bluedart/services/pin.php";
            
            // use BlueDart\Services\Waybill\Waybill;
            // use BlueDart\Services\Pincode\Pincode;
            
            $api = new Api($RAZORPAY_API_KEY, $RAZORPAY_API_SECRET);
            
            $razorpay_payment_id = $_GET["razorpay_payment_id"];
            $razorpay_invoice_id = $_GET["razorpay_invoice_id"];
            $razorpay_invoice_status = $_GET["razorpay_invoice_status"];
            $razorpay_invoice_receipt = $_GET["razorpay_invoice_receipt"];
            $razorpay_signature = $_GET["razorpay_signature"];
            
            try {
                try {
                    $attributes = array(
                        'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                        'razorpay_payment_id' => $razorpay_payment_id,
                        'razorpay_signature' => $razorpay_signature
                    );

                    // if (($razorpay_invoice_status == "paid") && $api->utility->verifyPaymentSignature($attributes))    {
                    if (($razorpay_invoice_status == "paid"))    {
                        $result = mysqli_query($con, "UPDATE payment SET razor_payment_id = '{$razorpay_payment_id}' WHERE reference_no = '{$razorpay_invoice_receipt}'");
                        
                        unset($_SESSION["razorpay_invoice_id"]);
                        unset($_SESSION["razorpay_order_id"]);

                        $_SESSION["cart"] = array();
                        
                        print('Payment success');
                    } else {
                        print('Payment fail');
                    }
                }   catch(\SignatureVerificationError $e)    {
                    $success = false;
                    $error = 'Razorpay Error : ' . $e->getMessage();
                    print('Payment fail');
                } catch (\Throwable $th) {
                    //throw $th;
                    print('Payment fail');
                }
            ?>
         <?php if(!empty($var)){
            $order_details = array();
            $order_details["totalItems"] = 0;
            $order_details["totalAmount"] = 0;
            $mobile = isset($response['payments'][0]['buyer_phone']) ? substr(trim($response['payments'][0]['buyer_phone']), 3) : "";
            $order_details["invoiceNumber"] = $billno;
            $order_details["name"] = trim($response['payments'][0]['buyer_name']);
            $order_details["mobile"] = $mobile;
            $order_details["email"] = trim($response['payments'][0]['buyer_email']);
            ?> 
         <br><br>
         <!--     <p  class="<?php echo $ordStatus; ?> alert alert-success"><?php echo $statusMsg; ?></p> -->
         <?php
            include('../db.php');
            
            
            $result = mysqli_query($con," SELECT * FROM `tbl_users` where userEmail = '$emailidofbuyer'");
            while($row = mysqli_fetch_array($result))
            {
                
                $statee = $row['state'];
            $addr = trim($row['address']);
            $order_details['address1'] = substr($addr, 0, 30) ? substr($addr, 0, 30) : "";
            $order_details['address2'] = substr($addr, 30, 60) ? substr($addr, 30, 60) : "";
            $order_details['address3'] = substr($addr, 60, 90) ? substr($addr, 60, 90) : "";
            $order_details['pin'] = trim($row['pincode']);
             '
             
            '.$row['address'].' 
            '.$row['pincode'].'  
            
            '.$row['state'].' 
            
            '; } ?> 
       
         <?php   echo "<pre>";
            echo print_r($response);
             echo "</pre>";
              
            $userName = $response['payments'][0]['buyer_name'];
             "<p style='text-align:left'>
            Invoice No: $billno <br>
            Payment ID: " . $response['payments'][0]['payment_id'] . "<br>" ;
             "Buyer Name: " . $response['payments'][0]['buyer_name'] . "<br>" ;
             "Buyer Email: " . $response['payments'][0]['buyer_email'] . "<br>" ;
             "Buyer Contact No: " . $response['payments'][0]['buyer_phone'] . "<br>" ;
             "State:".$statee. "</p>"
            ?> 
         <?php
            include"db.php";
            $result = mysqli_query($con,"UPDATE payment SET paymentid='$var' WHERE billno='$billno'");
            ?>














       
       
         <?php 
            include "db.php";
            //  generate waybill
            // print_r($order_details);
            $pin_serviceable = Pincode::check_pin_serviceable($order_details["pin"]);
            if ($pin_serviceable == false)   {
                $q = "UPDATE `o` SET `bluedart_order`=0 WHERE `billno`=".$billno;
            } else {
                $awb_status = Waybill::generate_waybill($order_details);
                
                if (isset($awb_status["status"]))  {
                    $insert_query = "INSERT INTO `bluedart`
                                            (`user`, `awb_no`, `token_no`, `pickup_datetime`, `dest_area`, `dest_loc`, `credit_ref`, `state`) 
                                        VALUES 
                                        (\"". $userName . "\", \"". $awb_status["awbno"] ."\",\"" . $awb_status["token"] . "\",\"" . $awb_status["pickupdate"] . "\",\"" . $awb_status["destArea"] . 
                                         "\",\"" . $awb_status["destLoc"] . "\",\"" . $awb_status["creditreference"] ."\",\"" . $statee . "\")";
                    $q = mysqli_query($con, $insert_query);
                    
                    unset($_SESSION["cart_contents"]);
                } else {
                    ?> 
         <p  class="error alert alert-danger">Your Payment has Failed</p>
         <?php
            }
            }
            }
            }
            catch (Exception $e) {
            print('Error: ' . $e->getMessage());
            }
            
            
            
            ?>
      </div>
      <!-- /container -->
   </div>

   