<?php

session_start();


require_once "db.php";


$bill_no = $_GET["billno"];
$user = $_GET["user"];

if (!(isset($bill_no) && isset($user)))    {
    die();
}   else {
   

    $customer = mysqli_query($con, "SELECT `userName`, `mobile`, `address`, `pincode` FROM `tbl_users` WHERE `userEmail`=\"". $user . "\"");
    $customer_info = mysqli_fetch_array($customer);

    $orders = mysqli_query($con, "SELECT * FROM `o` WHERE billno=". $bill_no);
}
?>

   <?php 
                                       
                                        $result = mysqli_query($con, "SELECT * FROM payment where billno = '$bill_no'"); 
                                        while ($row = mysqli_fetch_array($result)) {   
                                           $deliveryboy = $row['deliveryboy']; 
                                             $invoiceno = $row['id']; 
                                            $paymentid = $row['paymentid'];
                                            $email = $row['email'];
                                            
                                       }
                                    ?>  




    <link rel="stylesheet" href="style.css" media="all" />
  

<!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/admin/">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
       Print Bill: Invoice#<?php echo $bill_no;  ?> 
    </title>
    <style>
        @font-face {
            font-family: '3Of9Barcode';
            src: url('assets/fonts/3of9/3of93Of9Barcode.eot?#iefix') format('embedded-opentype'), url('assets/fonts/3of9/3Of9Barcode.woff') format('woff'), url('assets/fonts/3of9/3Of9Barcode.ttf') format('truetype'), url('assets/fonts/3of9/3Of9Barcode.svg#3Of9Barcode') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        
        @media print {
            @page   {
                margin: 0;
            }
            
            body { 
                margin: 1.6cm;
                font-size: 11px !important;
            }
            
            #print-btn {
                display: none;
            }
        }
    </style>
</head>

<body style="font-family: Helvetica Narrow, sans-serif; font-size: 14px;">
   <div style="margin: 3rem;display: flex;align-items: center;justify-content: center;">
        <button id="print-btn" style="font-size: 2rem;" onclick="window.print();">Print Bill</button>
    </div>  <div> 
    

            
            <table  width='640' cellspacing='0' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:16px;color:rgb(51, 51, 51);background-color:rgb(255, 255, 255);margin:0px auto;' cellpadding='0'>
                <tbody> 

                     <tr>
                        <td colspan='2' rowspan='1' style='    background-color: #76be02;padding:0 20px 30px 20px;line-height:16px;width:640px;'>
                        </td>
                    </tr>
                     <tr>
                        <td colspan='2' rowspan='1' style='    background-color: white;padding:0 20px 5px 20px;line-height:10px;width:640px;'>
                        </td>
                    </tr>
                      <tr>
                        <td colspan='2' rowspan='1' style='    background-color: #c00202;padding:0 20px 10px 20px;line-height:10px;width:640px;'>
                        </td>
                    </tr>
                    <tr>  
                        <td colspan='1' rowspan='1' style='text-align:left;padding:0px 20px;'>
                            <table cellspacing='0' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:12px;line-height:16px;color:rgb(51, 51, 51);margin:0px auto;border-collapse:collapse;' cellpadding='0'>
                                <tbody>
                                 
                                    <tr>
                                        <td colspan='1' rowspan='1' style='text-align:left;width:490px;'>
                                            <span style='font-style:normal;font-weight:bold;font-stretch:normal;font-size:20px;line-height:normal;'>Invoice   </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan='1' rowspan='1' style='text-align:left;width:490px;'>
                                            <span style='font-size:12px;font-weight:bold'> Order No #
                                                <a rel='nofollow' shape='rect' target='_blank' href='' style='text-decoration:none;color:#76be02;font-weight: bold;color:#1913a8'>     <?php echo $bill_no; ?></a>
                                            </span> <br><span style='font-size:12px;font-weight:bold'> Invoice No #
                                                <a rel='nofollow' shape='rect' target='_blank' href='' style='text-decoration:none;color:#76be02;font-weight: bold;color:#1913a8'>     <?php echo $invoiceno; ?></a>
                                            </span> 
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td colspan='1' rowspan='1' valign='top' style='padding:14px 10px 10px 20px;width:100px;border-collapse:collapse;'>
                            <a rel='nofollow' shape='rect' target='_blank' href='' title='Visit frubji.com'>
                                <img width='241px' id=''  border='0' src='https://frubji.com/beta/wp-content/logo.png'>
                            </a>
                        </td>
                      
                    </tr>  

  <tr> 
                       <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:11px 26px 14px;width:280px;'>
                                           
                                        <p style='margin:2px 0;line-height: 18px;'> 
                                        
                                        <strong> Frubji | Food and Health
                                        <br clear='none'> 
                                        
                                        Kandivali, Kandivali East, Mumbai,<br clear='none'>  Maharashtra 400101
                                        <br clear='none'>Customer Care - +91 88796 99136
                                        <br>Email Id - frubjistore@gmail.com <br> 

                                       

                                      
                                        </strong> 
                                            </p>
                                        </td>

                                          <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:11px 26px 14px;width:280px;text-align: center;'>
                                           
                                             
                                        </td>

</tr>


                    <tr>  
                        <td colspan='2' rowspan='1' style='width:640px;'>
                            <p style='font-style:normal;font-weight:bold;font-stretch:normal;font-size:18px;line-height:normal;color:rgb(88, 140, 0);margin:0px 20px 0px;'>Hello     <?php
                                        echo  $customer_info["userName"]; ?> ,</p>
                            <p style='margin:4px 0px 4px 20px;width:640px;font-size:16px;    line-height: 21px;
    font-style: italic;
    font-weight: bold;'>Thank You for choosing Frubji | Food and Health. Your order is on the way by <Br> Delivery Boy : <?php echo $deliveryboy; ?>.  </p>  

                          
                        </td>
                    </tr> 
                    <tr>
                        <td colspan='2' rowspan='1' >
                            <table cellspacing='0' style='border-top:3px solid #2d3741;' cellpadding='0'>
                                <tbody>
                                    <tr>
                                        <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:18px;padding:11px 18px 14px;width:280px;'>
                                            <span style='color:#666;'>Bill to:</span>
                                            <br clear='none'> 
                                            
                                            
                                             <?php
                                        echo  " 
                                        
                                        <p style='margin:2px 0;'> <strong> ". $customer_info["userName"] ."
                                        <br clear='none'>  ".$customer_info["address"]."  <br> Pin Code: " . $customer_info["pincode"]." , India </strong>.
                                                <br clear='none'> " . $customer_info["mobile"]."
                                            
                                             <br clear='none'><span style='color:green;font-weight:bold'> Transaction Id - ".$paymentid."</span>";
                                       
                                    ?>  <br>  



                                 


                                      <?php 
                                        include 'db.php';
                                        $result = mysqli_query($con, "SELECT * FROM o where billno = '$bill_no'"); 
                                        while ($row = mysqli_fetch_array($result)) {   
                                            
                                           
                                           $datee = $row['datee'];
                                           $datee = $row['datee'];
                                       }
                                            ?> 
                                            Order Date - <?php echo  $datee; ?>
                                    
                                            </p>
                                        </td>
                                        <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:18px;padding:11px 18px 14px;width:280px;'>
                                          
                                         
                                  
                                            </p>
                                        </td>
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>
                        </td>
                    </tr>
                  
          
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

                    <tr>
                        <td colspan='3' rowspan='1' id='yiv1669056380ydpdefbf859yiv5642539659shipmentDetails' style='padding:16px 20px;width:640px;'>
                            <table width='100%' cellspacing='0' cellpadding='0'  class='table table-striped table-bordered display'>
                                <tbody>
                                    <tr>
                                        <td align='center' colspan='3' rowspan='1' valign='top' style='width:640px;min-height:115px;'>
                                            <table id='example' class='table table-striped table-bordered display' >
                                                <thead>
                                                    <tr>  <th style='text-align:left;color:black'>SR.</th>
                                                        <th style='text-align:left;color:black'>Code</th>
                                                        <th style='text-align:left;color:black'>Product Name</th>
                                                        
                                                          <th style='text-align:left;color:black'>Units</th>
                                                         <th style='text-align:left;color:black'>Qty </th> 
                                                        
                                                        <th style='text-align:left;color:black'>MRP</th>     
                                                        
                                                        <th style='text-align:left;color:black'>GP Price</th>
                                                        
                                                        <th style='text-align:left;color:black'>You Save</th>
                                                      
                                                   
                                                     
                                                        
                                                        <th style='text-align:right;color:black'>Total </th>
                                                        <th style='text-align:right;color:black'>* </th>
                                                    </tr>
                                                </thead>
                                                <tbody style="    font-size: 13px;">                                               
                                                 <?php 
                                                    include 'db.php';
                                                    $result = mysqli_query($con, "SELECT * FROM o where billno = '$bill_no'");  

                                                    $totalmrp = 0;
                                                    $totalyousave = 0;
                                                    $totalgpprice = 0;
                                                    $temp = 1;

                                                    while ($row = mysqli_fetch_array($result)) {                      
                                                            $chargeamount = $row['shippingcharge'];
                                                            $finalamountt = $row['finalamount'];  
                    
                                                            $finalamounttwithoutship = $finalamountt - $chargeamount; 
                                                            $mrp = $row['mrp'];
                                                            $qty = $row['qty'];
                                                            
                                                            $gpprice = $row['price'];
                                                            $yousave = $mrp - $gpprice;
                                                            $totalmrp+=  $mrp; 
                                                        
                                                            $totalyousave+=  $yousave;
                                                            $totalgpprice+=  $gpprice;
                                                           echo " <tr>
                                                                <td>" . $temp++ . "</td>
                                                                <td>" . $row['productcode'] . "</td>
                                                                <td>" . $row['name'] . "</td> 
                                                                <td> " . $row['units'] . "</td>
                                                                <td>" . $row['qty'] . "</td> 
                                                                <td>&#8377; " . $row['mrp'] . "</td> 
                                                                
                                                                <td>&#8377; " . $row['price'] . "</td>
                                                                <td>&#8377; ".$yousave * $row['qty']." </td>
                                                                
                                                                <td style='text-align:right'>&#8377; " . $row['subtotal'] . "</td>                                                              
                                                                <td> "; ?> <?php if ($row['status']== 1)
                                                                {
                                                                echo '<b style="color:green">  <i class="fa fa-check" aria-hidden="true"></i></b>';
                                                                }
                                                                else {
                                                                echo '<b style="color:red">   <i class="fa fa-times" aria-hidden="true"></i></b>';
                                                                } ?>
                                                    
                                                                <?php echo   " </td>
                                                            </tr>";
                }  ?> 
              </tbody>                 

                                                            <tr style="    background-color: black;    color: white;"> 
                                                               <td></td>  
                                                                <td></td> 
                                                                <td></td>
                                                                
                                                                <td> </td>  
                                                                <td></td> 
                                                                <td></td>
                                                             
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                
                                                                  
                                                                <td></td>
                                                            </tr>
                                            </table>
                                        </td>
                                    



                                       
                                    </tr>

                                    
                                   
                                    
                        <?php  $finalamounttwithdiscount = $finalamountt ;
    
    echo "

 
                                    <tr> 
                                        <td colspan='2' rowspan='1' style='border-top:1px solid rgb(234, 234, 234);padding:0pt 0pt 16px;width:560px;'>&nbsp;</td>
                                    </tr>
                                   
                                    <tr>
                                        <td align='right'  colspan='2' rowspan='1' valign='top' style='text-align:right;font-style:normal;font-weight:normal;font-stretch:normal;font-size:15px;line-height:18px;padding:0px 10px 0px 0px;color:rgb(51, 51, 51);width:480px;'>Shipping &amp; Handling Charges :</td>
                                        <td align='right' colspan='1' rowspan='1' valign='top' style='text-align:right;font-style:normal;font-weight:normal;font-stretch:normal;font-size:15px;line-height:18px;color:rgb(51, 51, 51);width:85px;'>&#8377; $chargeamount</td>
                                    </tr> 
                                    
                                    
                                    
                                    
                                    <tr>
                                        <td align='right'  colspan='2' rowspan='1' valign='top' style='text-align:right;font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:10px 10px 10px 0px;color:rgb(51, 51, 51);width:480px;'>Total Amount: 

                                      

                                        </td>  
                                        <td align='right' colspan='1' rowspan='1' valign='top' style='text-align:right;font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:normal;padding:10px 0px 5px;color:rgb(51, 51, 51);width:85px;'> <strong> &#8377; $finalamounttwithdiscount.00</strong>
                                        </td>
                                    </tr> 
                                </tbody> "; ?> 
                            </table>
                        </td>
                    </tr> 

                  
                     <tr>
                        <td colspan='2' rowspan='1' style='padding:0 20px 0 20px;line-height:22px;width:640px;'>
                               <p style='border-top:1px solid #ccc;padding:20px 0 0 0;'>Track your order with the <a rel='nofollow' shape='rect' target='_blank' href='' style='color:#76be02;text-decoration:none;color:#355305'><b>Frubji</b></a>.
                                <br clear='none'>If you need further assistance with your order, please visit
                                <a rel='nofollow' shape='rect' target='_blank' href='http://frubji.com/contact.php' style='color:#03A9F4;text-decoration:none;'>Customer Service</a>. We hope to see you again soon!
                            </span>
                            </p>
                        </td>
                    </tr>
                 

                   
                      <tr>
                        <td colspan='2' rowspan='1' style='    background-color: #c00202;padding:0 20px 10px 20px;line-height:10px;width:640px;'>
                        </td>
                    </tr>
                      <tr>
                        <td colspan='2' rowspan='1' style='    background-color: white;padding:0 20px 5px 20px;line-height:10px;width:640px;'>
                        </td>
                    </tr>
                   
                     <tr>
                        <td colspan='2' rowspan='1' style='    background-color: #76be02;padding:0 20px 30px 20px;line-height:16px;width:640px;'>
                      
                        </td>


                    </tr>

                        <tr>
                        <td colspan='2' rowspan='1' >
                         <img width="30px" src="http://grocerpoint.in/admin/a.png">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
                         </td>
                    </tr>


                     <tr>
                                        <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;width:280px;'>
                                            <span style='color:#666;'>Bill to:</span>
                                            <br clear='none'> 
                                            
                                            
                                             <?php
                                            echo  "<p style='margin:2px 0;'> <strong> ". $customer_info["userName"] ."
                                            <br clear='none'>  ".$customer_info["address"]."  <br> Pin Code: " . $customer_info["pincode"]." , India </strong>.
                                                    <br clear='none'> " . $customer_info["mobile"];
                                           
                                             ?>  <br>  Bill Amount - <?php echo  $finalamounttwithdiscount; ?><Br>  

                                            Order Id - <?php echo  $bill_no; ?><Br> 
                                            Transaction Id - <?php echo  $paymentid; ?><Br> 
                                            Order Date - <?php echo  $datee; ?><Br> 
                                            Delivery Boy : <?php echo $deliveryboy; ?>. 
                                    
                                            </p>
                                        </td>
                                       <td colspan='1' rowspan='1' valign='top' style='font-style:normal;font-weight:normal;font-stretch:normal;font-size:14px;line-height:18px;padding:11px 18px 14px;width:280px;'>
                                           
                                            </p> <br clear='none'>  <b>
                                            <span style='color:#666;'>Customer Sign :</span>
                                            <br clear='none'>   <br clear='none'>  
                                            
                                            ________________________________  </b>
                                  
                                        </td>
                                    </tr>


                </tbody>
            </table>
            
            
    </div>
   
</body>

</html> 