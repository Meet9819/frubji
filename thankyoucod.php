<?php include "allcss.php"; ?>

<body>
   <div id="wrapper" class="wrapper clearfix">
      <?php include "header.php";  ?>
     


         <div class="breadcrumb-area mt-37 hm-4-padding">
                <div class="container-fluid">
                    <div class="breadcrumb-content text-center border-top-2">
                      <h2>Thank You</h2>
                        <ul>
                            <li>
                                <a href="#">home</a>
                            </li>
                            <li> Thank You  </li>
                        </ul>
                    </div>
                </div>
            </div>

      <div style="width:100%;text-align:center" class="container">
         <?php 

            require_once '../class.userr.php';
            $reg_user = new USERR();
            $var = $_GET["payment_request_id"]; 
            $billno = $_GET["payment_id"];                   
            $emailidofbuyer = $_GET["emailidofbuyer"]; 
        
            ?> 

              <?php
            include('../db.php');           
            $result = mysqli_query($con," SELECT * FROM `tbl_users` where userEmail = '$emailidofbuyer'");
            while($row = mysqli_fetch_array($result))
            {
                $name = $row['userName']; $mobile = $row['mobile'];
                $statee = $row['state']; $city = $row['city'];
                $addr = trim($row['address']);
                $pincode = trim($row['pincode']);
           
          } ?>  

              <?php  
            $message = " 
          
            <table width='640' cellspacing='0' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:16px;color:rgb(51, 51, 51);background-color:rgb(255, 255, 255);margin:0px auto;' cellpadding='0'>
                <tbody>
                    <tr>
                        <td colspan='1' rowspan='1' valign='top' style='padding:14px 0px 10px 20px;width:100px;border-collapse:collapse;'>
                            <a rel='nofollow' shape='rect' target='_blank' href=''>
                                <img width='181px' id='' alt='aaplekarigar' border='0' src='https://aaplekarigar.com/beta/assets/img/logo/logo.png'>
                            </a>
                        </td>
                        <td colspan='1' rowspan='1' style='text-align:right;padding:0px 20px;'>
                            <table cellspacing='0' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:16px;color:rgb(51, 51, 51);margin:0px auto;border-collapse:collapse;' cellpadding='0'>
                                <tbody>
                                 
                                    <tr>
                                        <td colspan='1' rowspan='1' style='text-align:right;padding:7px 0px 0px 20px;width:490px;'>
                                            <span style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:20px;line-height:normal;'>Shipping Confirmation</span>
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
                            <p style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:18px;line-height:normal;color:rgb(204, 102, 0);margin:15px 20px 0px;'>Hello    ${userName} ${lastname} ,</p>
                            <p style='margin:4px 20px 18px 20px;width:640px;'>Thank You for choosing Aaple Karigar. <br> Your order is on the way.
                                <a rel='nofollow' shape='rect' target='_blank' href='' style='color:#006699;text-decoration:none;'>My Orders</a> on https://aaplekarigar.com/history.php</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' rowspan='1' style='padding:0 20px;width:640px;'>
                            <table cellspacing='0' style='border-top:3px solid #2d3741;width:640px;' cellpadding='0'>
                                <tbody>
                                    <tr>
                                        <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;
                                        padding:11px 0px 14px 18px;width:280px;background-color:#ffebd6;'>
                                            <span style='color:#666;'></span>
                                            <br clear='none'>
                                            <p style='margin:2px 0 9px 0;'>
                                                <strong style='color:#009900;'></strong>
                                            </p>
                                            <br clear='none'>
                                        </td>
                                        <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;
                                        padding:11px 18px 14px;width:280px;background-color:#ffebd6;'>
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
                            <p style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:18px;line-height:normal;color:rgb(204, 102, 0);border-bottom:1px solid rgb(204, 204, 204);margin:0px 20px 3px;padding:0px 0px 3px;'>Shipment Details</p>
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
                                                        <th style='text-align:center;padding:10px;background-color:#910f02;color:white'>Product Code</th>
                                                        <th style='text-align:center;padding:10px;background-color:#910f02;color:white'>Product Name</th>
                                                        <th style='text-align:center;padding:10px;background-color:#910f02;color:white'>Units</th>
                                                        <th style='text-align:center;padding:10px;background-color:#910f02;color:white'>Qty Ordered</th>
                                                        <th style='text-align:center;padding:10px;background-color:#910f02;color:white'>Price</th>
                                                        <th style='text-align:center;padding:10px;background-color:#910f02;color:white'>Sub Total </th>
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
                                                                <td style='padding:5px;text-align:center'>" . $row['productcode'] . "</td>
                                                                <td style='padding:5px;text-align:center'>" . $row['name'] . "</td>
                                                                <td style='padding:5px;text-align:center'>" . $row['weight'] . " " . $row['units'] . "</td>
                                                                <td style='padding:5px;text-align:center'>" . $row['qty'] . "</td>
                                                                <td style='padding:5px;text-align:center'>" . $row['price'] . "</td>
                                                                <td style='padding:5px;text-align:center'>" . $row['subtotal'] . "</td>
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
                                        <td align='right' colspan='2' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:18px;padding:0px 10px 0px 0px;color:rgb(51, 51, 51);width:480px;'>Shipping &amp; Handling:</td>

                                        <td align='right' colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:18px;color:rgb(51, 51, 51);width:85px;'>&#8377;{$chargeamount}</td>
                                    </tr>

                                     <tr>
                                        <td align='right' colspan='2' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:18px;padding:0px 10px 0px 0px;color:rgb(51, 51, 51);width:480px;'>Discount:</td>
                                        
                                        <td align='right' colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:18px;color:rgb(51, 51, 51);width:85px;'>&#8377; 0.00</td>
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
                            <p style='border-top:1px solid #ccc;padding:20px 0 0 0;'>Track your order with the <a rel='nofollow' shape='rect' target='_blank' href='' style='color:#006699;text-decoration:none;'>Aaple Karigar</a>.
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
                                <strong>www.aaplekarigar.com</strong>
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
            
            
                        
            $subject = "Order Confirmation | Aaple Karigar";
                        
            $reg_user->send_mail($emailidofbuyer,$message,$subject); 
            
            ?>

       
         <br><br>
       
      
       
         <?php
            include"db.php";
            $result = mysqli_query($con,"UPDATE payment SET paymentid='$var' WHERE billno='$billno'");
            ?>

       <table  width='640' cellspacing='0' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:16px;color:rgb(51, 51, 51);background-color:rgb(255, 255, 255);margin:0px auto;' cellpadding='0'>
            <tbody>
               <tr>
                  <td colspan='2' rowspan='1' style='    background-color: #910f02 ;padding:0 20px 20px 20px;line-height:16px;width:640px;'>
                  </td>
               </tr>
               <tr>
                  <td colspan='1' rowspan='1' style='text-align:left;padding:0px 20px;'>
                     <table cellspacing='0' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:16px;color:rgb(51, 51, 51);margin:0px auto;border-collapse:collapse;' cellpadding='0'>
                        <tbody>
                           <tr>
                              <td colspan='1' rowspan='1' style='text-align:left;width:490px;'>
                                 <span style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:20px;line-height:normal;'>Invoice   </span>
                              </td>
                           </tr>
                           <tr>
                              <td colspan='1' rowspan='1' style='text-align:left;width:490px;'>
                                 <span style='font-size:12px;'> Order No #
                                 <a rel='nofollow' shape='rect' target='_blank' href='' style='text-decoration:none;color:#910f02 ;font-weight: bold;'>     <?php echo $billno; ?> </a>
                                 </span>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </td>
                  <td colspan='1' rowspan='1' valign='top' style='padding:14px 10px 10px 20px;width:100px;border-collapse:collapse;'>
                     <a rel='nofollow' shape='rect' target='_blank' href='' title='Visit aaplekarigar.com'>
                     <img width='181px' id=''  border='0' src='https://aaplekarigar.com/beta/assets/img/logo/logo.png'>
                     </a>
                  </td>
               </tr>
               <tr>
                  <td colspan='2' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:11px 26px 14px;width:280px;'>
                     <p style='margin:2px 0;line-height: 18px;'> 
                        <strong> Aaple Karigar <br> Poonam Complex, CHS Limited, Miraroad (E),<br clear='none'>
                        Thana - 401 107
                        <br clear='none'>Customer Care - +91 93245 50502 / +91 83558 14532
                        <br clear='none'>Email Id - info@aaplekarigar.com                       
                        </strong> 
                     </p>
                  </td>
               </tr>
               <tr>
                  <td colspan='2' rowspan='1' style='width:640px;'>
                     <p style='font-style:normal;font-weight:bold;font-stretch:normal;font-size:18px;line-height:normal;color:#910f02 ;margin:15px 20px 0px;'>Hello  <?php echo $name; ?>     ,</p>
                     <p style='margin:4px 20px 18px 20px;width:640px;font-size:16px'>Thank You for choosing Aaple Karigar. Your order is on the way. 
                     </p>
                  </td>
               </tr>
               <tr>
                  <td colspan='3' rowspan='1' id='yiv1669056380ydpdefbf859yiv5642539659shipmentDetails' style='padding:16px 20px;width:640px;'>
                     <table width='100%' cellspacing='0' cellpadding='0'>
                        <tbody>
                           <tr>
                              <td align='center' colspan='3' rowspan='1' valign='top' style='width:640px;min-height:115px;'>
                                 <table id='example' class='table table-striped table-bordered display' >
                                    <thead>
                                       <tr>
                                          <th style='text-align:left;background-color: #910f02 ;color: white'> Code</th>
                                          <th style='text-align:left;background-color: #910f02 ;color: white'>Product Name</th>
                                          <th style='text-align:left;background-color: #910f02 ;color: white'>Units</th>
                                          <th style='text-align:left;background-color: #910f02 ;color: white'>Qty </th>
                                          <th style='text-align:left;background-color: #910f02 ;color: white'>GP Price</th>
                                          <th style='text-align:right;background-color: #910f02 ;color: white'>Total </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                          include '../db.php';
                                          $result = mysqli_query($con, "SELECT * FROM o where billno = '$billno'"); 
                                          while ($row = mysqli_fetch_array($result)) {   
                                              
                                             
                                             $chargeamount = $row['shippingcharge'];
                                             $finalamountt = $row['finalamount'];
                                              
                                           
                                        echo " 
                                          <tr>
                                             <td> " . $row['productcode'] . "</td>
                                             <td>" . $row['name'] . "</td> 
                                             <td>" . $row['weight'] . "" . $row['units'] . "</td>  
                                             <td>" . $row['qty'] . "</td>
                                             <td>&#8377; " . $row['price'] . "</td>
                                             <td style='text-align:right'>&#8377; " . $row['subtotal'] . "</td>
                                         </tr>";
                                          } ?> 
                                    </tbody>
                                 </table>
                              </td>
                           </tr>
                           <?php echo "
                              <tr>
                                  <td colspan='2' rowspan='1' style='border-top:1px solid rgb(234, 234, 234);padding:0pt 0pt 16px;width:560px;'>&nbsp;</td>
                              </tr>
                              
                              <tr>
                                  <td align='right' colspan='2' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:15px;line-height:18px;padding:0px 10px 0px 0px;color:rgb(51, 51, 51);width:480px;'>Shipping &amp; Handling Charges :</td>
                                  <td align='right' colspan='1' rowspan='1' valign='top' style='text-align:right;font-style:normal;font-weight:normal;font-stretch:normal;font-size:15px;line-height:18px;color:rgb(51, 51, 51);width:85px;'>&#8377; $chargeamount</td>
                              </tr> 
                              
                               <tr>
                                  <td align='right' colspan='2' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:15px;line-height:18px;padding:0px 10px 0px 0px;color:rgb(51, 51, 51);width:480px;'>Discount :</td>
                                  <td align='right' colspan='1' rowspan='1' valign='top' style='text-align:right;font-style:normal;font-weight:normal;font-stretch:normal;font-size:15px;line-height:18px;color:rgb(51, 51, 51);width:85px;'>&#8377; 0.00</td>
                              </tr>
                              
                              
                              <tr>
                                  <td align='right' colspan='2' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:10px 10px 10px 0px;color:rgb(51, 51, 51);width:480px;'>Total Amount:</td>
                                  <td align='right' colspan='1' rowspan='1' valign='top' style='text-align:right;font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:10px 0px 5px;color:rgb(51, 51, 51);width:85px;'> <strong> &#8377; $finalamountt.00</strong>
                                  </td>
                              </tr> 
                              </tbody> "; ?> 
                     </table>
                  </td>
               </tr>
               <tr>
                  <td colspan='2' rowspan='1' style='padding:0 20px;line-height:22px;width:640px;'>
                     <p style='border-top:1px solid #ccc;padding:20px 0 0 0;'>Track your order with the <a rel='nofollow' shape='rect' target='_blank' href='' style='color:#910f02 ;text-decoration:none;'>Aaple Karigar</a>.
                        <br clear='none'>If you need further assistance with your order, please visit
                        <a rel='nofollow' shape='rect' target='_blank' href='http://aaplekarigar.com/contact.php' style='color:#03A9F4;text-decoration:none;'>Customer Service</a>.
                     </p>
                  </td>
               </tr>
               <tr>
                  <td colspan='2' rowspan='1' style='padding:0 20px 0 20px;line-height:22px;width:640px;'>
                     <p style='margin:10px 0;padding:0 0 20px 0;border-bottom:1px solid #eaeaea;'>We hope to see you again soon!
                        <br clear='none'>
                        <span style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;'>
                        <strong>Http://www.aaplekarigar.com</strong>
                        </span>
                     </p>
                  </td>
               </tr>
               <tr>
                  <td colspan='2' rowspan='1' style='font-size:10px;color:#666;padding:0 20px 20px 20px;line-height:16px;width:640px;'>
                     <p>This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.</p>
                  </td>
               </tr>
               <tr>
                  <td colspan='2' rowspan='1' style='    background-color: #910f02 ;padding:0 20px 20px 20px;line-height:16px;width:640px;'>
                  </td>
               </tr>
            </tbody>
         </table>
       
      </div>

  <?php include "footer.php"; ?>
   </div>



