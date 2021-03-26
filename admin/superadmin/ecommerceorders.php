<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 

<!-- ROLE BASED -->
 <?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
$status = FALSE;
if ( authorize($_SESSION["access"]["MASTER"]["ECOMMERCEORDERS"]["create"]) || 
authorize($_SESSION["access"]["MASTER"]["ECOMMERCEORDERS"]["edit"]) || 
authorize($_SESSION["access"]["MASTER"]["ECOMMERCEORDERS"]["view"]) || 
authorize($_SESSION["access"]["MASTER"]["ECOMMERCEORDERS"]["delete"]) || 
authorize($_SESSION["access"]["MASTER"]["ECOMMERCEORDERS"]["approval"])) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

?>
<!-- ROLE BASED --> 
<!-- MAIN CONTENT STARTS -->
<div class="page-wrapper">
<div class="container-fluid">
<!-- Title -->
<div class="row heading-bg">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h5 class="txt-dark">Ecommerce Orders Master
    </h5>
  </div>
  <!-- Breadcrumb -->
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
      <li>
        <a href="index.php">Dashboard
        </a>
      </li>
      <li>
        <a href="ecommerceorders.php">
        <span>Master
        </span>
        </a>
      </li>
      <li>
        <a href="ecommerceorders.php">
        <span>Ecommerce Orders Setup
        </span>
        </a>
      </li>
      <li class="active">
        <span> Ecommerce Orders Master
        </span>
      </li>
    </ol>
  </div>
  <!-- /Breadcrumb -->
</div>
<!-- /Title -->  
<link rel="stylesheet" type="text/css" href="dist/timeline.css">

<!--due to this profile top menu is not coming <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script>-->
<div class="panel panel-default border-panel card-view">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap"> 



<table id="datatable" data-toggle="table">

            <thead>
              <tr>
                 
                     <!--  <th title="Select All"><button class="btn btn-dark btn-sm waves-effect waves-light" onclick="checkUncheckAllManifest()" title="Add All to Manifest">
                          <span class="fas fa-plus"></span>
                      </button>  </th>-->
                 
                                <th>Invoice No </th>   
                                <th>Repre Id / Commission  </th>  
                                <th>Order Id  </th> 
                                <th>Mobile No</th>
                                <th>User Email Id</th>
                                <th>Date / Time</th>
                                <th>Paid Amount</th> 
                                <th>Mode of Payment</th>                 
                                <th style="width:14%">View / Print Bill</th>
                                <th>Received Order </th>
                
              </tr>
            </thead>
            <tbody>
      <?php 
      include('db.php');
                /* code for data delete */
                if(isset($_GET['del']))
                {
                    $SQL = mysqli_query($con,"DELETE FROM payment WHERE id=".$_GET['del']);

                 ?>
                <script>
                alert('Successfully Deleted ...');
                window.location.href='order.php';
                </script>
                <?php

                    }
                    /* code for data delete */
                     
                    $result = mysqli_query($con,"SELECT p.id as id, r.firstname, p.representativeid,p.representativecommission, p.status as status, p.billno,p.name,p.email,p.phone,p.product_price,p.product_name,p.paymentid,p.address,p.productcode,p.created,p.modeofpayment,p.paymentid FROM payment p, representative r  where p.paymentid != '' and p.representativeid = r.id"); 
                     $tmpCount = 1;

                    while($row = mysqli_fetch_array($result))
                    {   

                        $status = $row['status'];

                    echo '          
              <tr>         
                  <td>'.$row['id'].'</td>                
                  <td>'.$row['representativeid'].' '.$row['firstname'].' - '.$row['representativecommission'].' %</td>         
                  <td>'.$row['billno'].'</td>                     
                  <td><a target="_blank" href="https://web.whatsapp.com/" >'.$row['phone'].'</a></td>                 
                  <td>'.$row['email'].' <br> <span style="font-weight: bold;">[ '.$row['paymentid'].' ]</span></td>  
                  <td>'.$row['created'].'</td>
                  <td>&#8377; '.$row['product_price'].'</td>   
                  <td>'.$row['modeofpayment'].'</td>
                 <td> 

                                <a  href="ecommerceordersdetail.php?edit_id='.$row['id'].'&billno='.$row['billno'].'" class="text-inverse" data-toggle="tooltip"><i style="background-color:#ff24ee;color:black" class="fa fa-eye btn  btn-sm waves-effect waves-light"></i></a> &nbsp;&nbsp;
                            
                                <a href="billprint.php?billno='. $row['billno'] .'&user=' . $row['email'] . '" target="_blank" class="text-inverse"  data-toggle="tooltip"><i style="background-color:#0095ff;color:black" class="fa fa-print btn  btn-sm waves-effect waves-light"></i></a> &nbsp;&nbsp;
                            
                            </td>
                    <td> 

                                '; if($status == 0)
                                {
                                   echo '  <a style="background-color:#e7ff24;color:black" href="#" type="button" class="btn  btn-sm waves-effect waves-light"  >Received Order</a>' ;
                                }
                                else if($status == 1)
                                {
                                    echo '  <a href="#" type="button" class="btn btn-info btn-sm waves-effect waves-light"  >Processed Order</a>' ;
                                }
                                elseif($status == 2)
                                {
                                    echo '  <a style="    background-color: #6d0e95;    color: white;" href="#" type="button" class="btn  btn-sm waves-effect waves-light"  >Shipped Order</a>' ;
                                }
                                elseif($status == 3)
                                {
                                    echo '  <a href="#" type="button" class="btn btn-success btn-sm waves-effect waves-light"  >Delivered Order</a>' ;
                                }
                                else if($status == 4)
                                {
                                    echo '  <a href="#" type="button" class="btn btn-danger btn-sm waves-effect waves-light"  >Cancelled Order</a>' ;
                                }
                                         ?> <?php echo '

                                  
                                </td>
              </tr>

            


              '; } ?>

            </tbody>
          </table> 
          
          

</div>
</div>
</div>
</div>
</div>
</div>
<!-- /Row -->
<?php include "footer.php"; ?>
</div>
</div>
<!-- /Main Content --> 



<?php include "allscript.php"; ?>