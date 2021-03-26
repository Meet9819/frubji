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
          <li class="breadcrumb-item">Order History </li>
        </ol>
      </nav>
    </div>
  </div>
  <div class="xs-section-padding ">
  




    <section id="featured1" class="featured featured-1">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">












<?php
require_once 'class.user.php';
$user_home = new USER();

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

                if(isset($_SESSION['userSession']))
                {
                 $email = $row['userEmail'];
                }
                else{

                }
?>    


 <?php 

  $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));

$row = $stmt->fetch(PDO::FETCH_ASSOC);

 if(isset($_SESSION['userSession']))
 {
 $custid = $row['userID'];
}
?>


                  




<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

        <script>
        $( document ).ready(function() {
        $('#tableMain').on('click', 'tr.breakrow',function(){
        $(this).find('span').text(function(_, value){return value=='-'?'+':'-'});
        $(this).nextUntil('tr.breakrow').slideToggle(200);
            });
        });
        </script>
         

       <table  id="tableMain" class="table table-bordered table-striped" style="text-transform: uppercase;">


<?php
$con = mysqli_connect('localhost','root','','frubji');
$result = mysqli_query($con,"SELECT * FROM payment  where email = '$email' ORDER BY `id` DESC");

$tmpCount = 1;
$tmpChild=1;
$html="";
$child= array();

$tmpCount = 1;

while($row = mysqli_fetch_array($result))
{
$sql_query_child="SELECT * FROM o WHERE billno=".$row["billno"];
$result_select_child=mysqli_query($con,$sql_query_child);

$status = $row['status'];
?>
               
        <tr class="breakrow">



<?php 

                                if($status == 0)
                                {
                                   echo ' 

                                    <td colspan="6" class="plusminus" style="background-color:#e7ff24;color:black;font-weight:bold">   
                                                <strong><span style="font-size:24px;">+</span></strong>
                                                Received Order - Invoice No : '.$row["billno"].' 
                                        </td>
                                ' ;
                                }
                                else if($status == 1)
                                {
                                    echo '  <td colspan="6" class="plusminus" style="background-color:#00aeff;color:black;font-weight:bold">   
                                                <strong><span style="font-size:24px;">+</span></strong>
                                                Processed Order - Invoice No : '.$row["billno"].' 
                                        </td>';
                                }
                                elseif($status == 2)
                                {
                                    echo ' <td colspan="6" class="plusminus" style="background-color:#6d0e95;color:black;font-weight:bold">   
                                                <strong><span style="font-size:24px;">+</span></strong>
                                                Shipped Order - Invoice No : '.$row["billno"].' 
                                        </td>

                                      ' ;
                                }
                                elseif($status == 3)
                                {
                                     echo ' <td colspan="6" class="plusminus " style="background-color:#00bf4f;color:black;font-weight:bold">   
                                                <strong><span style="font-size:24px;">+</span></strong>
                                                Delivered Order - Invoice No : '.$row["billno"].' 
                                        </td>

                                      ' ;
                                  
                                }
                                else if($status == 4)
                                {  
                                    echo ' <td colspan="6" class="plusminus " style="background-color:#ea4335;color:black;font-weight:bold">   
                                                <strong><span style="font-size:24px;">+</span></strong>
                                                Cancelled Order - Invoice No : '.$row["billno"].' 
                                        </td>

                                      ' ;
                                   
                                }

?>


        </tr>
                <?php if ($row_child=mysqli_query($con,$sql_query_child))
                    {
                    while($row_child = mysqli_fetch_array($result_select_child))
                    {
                    ?>  
                     <tr  id="product_65_477_0_0"  class="cart_item address_0 even" class="datarow " style="display:none; " >


                                        <td class="cart_avail"> 
                                         <p id="product_condition">
                                         </p>
                                        </td> 
                                        <td class="cart_avail">
                                            <h5 class="product-name"><?php echo $row_child["name"];?></h5>
                                            <small class="cart_ref">Product Code : <?php echo $row_child["productcode"];?></small>
                                         </td>
                                       
                                        
                                         <td class="cart_avail">
                                         <p id="product_condition">  <?php echo $row_child["weight"];?> <?php echo $row_child["units"];?>
                                         </p>
                                        </td>
                                         <td class="cart_avail">
                                         <p id="product_condition">  <?php echo $row_child["qty"];?>
                                         </p>
                                        </td>

                                       <td class="cart_avail">
                                         <p id="product_condition"> &#8377; <?php echo $row_child["price"];?>
                                         </p>
                                        </td>


                                         <td class="cart_avail">
                                         <p id="product_condition"><?php echo $row_child["datee"];?>
                                         </p>
                                        </td>


                                                
                                      
                    
                     </tr>
                 <?php 
                    }
                    }
}
?>

</table>
    
  


                </div>
            </div>
        </div>
    </section>  




 </div>   
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

  <?php include "alerts.php"?>
  <?php include "allscript.php"; ?>
  <script src="js/custom.js"></script>
   