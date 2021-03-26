<?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("logout.php");
}
?>


<?php include "allcss.php"; ?>
<?php include "header.php"; ?>  

<title><?php echo $sbcompany; ?>  <?php echo $sb; ?>   <?php echo $workingin; ?> </title> 
 <div class="page-wrapper" > 
            <div class="container-fluid">
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">Ecommerce Dashboard </h5>    
                    </div> 
                    <div class="col-lg-6 col-sm-4 col-md-4 col-xs-12 text-center">
                    
                    </div>
                    <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Ecommerce Dashboard</a></li>                        
                            <li class="active"><span>Home page</span></li>
                        </ol>
                    </div>
                </div>  

                <!-- Row -->
                <div class="row"> 
            
                    <div class="col-sm-12">
                        <div class="row"> 
     
                            <div class="col-sm-3 col-xs-12">
                                <div class="panel panel-default bg-primary card-view pa-0 " >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="sm-data-box">
                                                <div class="container-fluid ">
                                                    <div class="row">
                                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                        <?php 

                                                       


                                                        $result = mysqli_query($con,"SELECT count(1) FROM ecommerce_order_payment_details WHERE status = 1");
                                                        $row = mysqli_fetch_array($result);
                                                        $total = $row[0];
                                                        echo' <span class="txt-light block counter"><span class="counter-anim">'. $total.'</span></span>'?>  
                                                        <span class="capitalize-font block">New Orders</span>  
                                                        </div>
                                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                            <i class="fa fa-shopping-cart data-right-rep-icon" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                     <div class="progress-anim">                                  
                                                        <div class="progress">

                                                        </div>
                                                    </div>

                                                     <div class="row">
                                                       
                                                        <div class="col-xs-12 text-center  col-xs-12 text-center  mb-10">
                                                          <a href="ecommerceorders.php"><span class="txt-light capitalize-font block">NEW ORDERS  <i class="fa fa-arrow-right data-right-rep-icon" aria-hidden="true"></i> </span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="panel panel-default bg-success card-view pa-0 " >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="sm-data-box">
                                                <div class="container-fluid ">
                                                    <div class="row">
                                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                        <?php 
                                                        $result = mysqli_query($con,"SELECT count(1) FROM ecommerce_order_payment_details");
                                                        $row = mysqli_fetch_array($result);
                                                        $total = $row[0];
                                                        echo' <span class="txt-light block counter"><span class="counter-anim">'. $total.'</span></span>'?>                   
                                                        <span class="txt-light capitalize-font block">Total Sale</span> 
                                                        </div>
                                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                           <i  class="txt-light fa  fa-money data-right-rep-icon" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-anim">
                                                        <div class="progress">
                                                         
                                                        </div>
                                                    </div> <div class="row">
                                                       
                                                        <div class="col-xs-12 text-center  col-xs-12 text-center  mb-10">
                                                         <a href="ecommerceorders.php"> <span class="txt-light capitalize-font block">VIEW ALL ORDERS  <i class="fa fa-arrow-right data-right-rep-icon" aria-hidden="true"></i> </span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="panel panel-default bg-danger card-view pa-0 " >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="sm-data-box">
                                                <div class="container-fluid ">
                                                    <div class="row">
                                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                       <?php 
                                                        $result = mysqli_query($con,"SELECT count(1) FROM company");
                                                        $row = mysqli_fetch_array($result);
                                                        $total = $row[0];
                                                        echo' <span class="txt-light block counter"><span class="counter-anim">'. $total.'</span></span>'?>
                                                        <span class="txt-light capitalize-font block">Out of Stock</span> 
                                                        </div>
                                                          
                                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                            <i class="txt-light fa fa-bar-chart-o  data-right-rep-icon"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-anim">
                                                    <div class="progress">
                                                        
                                                    </div>
                                                    </div> <div class="row">
                                                       
                                                        <div class="col-xs-12 text-center  col-xs-12 text-center  mb-10">
                                                           <span class="txt-light capitalize-font block">OUT OF STOCK <i class="fa fa-arrow-right data-right-rep-icon" aria-hidden="true"></i> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-sm-3 col-xs-12">
                                <div class="panel panel-default bg-warning card-view pa-0 " >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="sm-data-box">
                                                <div class="container-fluid ">
                                                    <div class="row">
                                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                         <?php 
                                                        $result = mysqli_query($con,"SELECT count(1) FROM ecommerce_users");
                                                        $row = mysqli_fetch_array($result);
                                                        $total = $row[0];
                                                        echo' <span class="txt-light block counter"><span class="counter-anim">'. $total.'</span></span>'?>
                                                        <span class="txt-light capitalize-font block">Customer Registrations</span> 
                                                        </div>
                                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                             <i class="txt-light fa fa-users data-right-rep-icon" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-anim">
                                                        <div class="progress">
                                                           
                                                        </div>
                                                    </div> <div class="row">
                                                       
                                                        <div class="col-xs-12 text-center  col-xs-12 text-center  mb-10">
                                                           <a href="ecommerceusers.php"> <span class="txt-light capitalize-font block">VIEW ALL CUSTOMERS <i class="fa fa-arrow-right data-right-rep-icon" aria-hidden="true"></i> </span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="panel panel-default bg-info  card-view pa-0 " >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="sm-data-box">
                                                <div class="container-fluid">
                                                    <div class="row" >
                                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left ">
                                                
                                                             <?php 
                                                        $result = mysqli_query($con,"SELECT count(1) FROM item");
                                                        $row = mysqli_fetch_array($result);
                                                        $total = $row[0];
                                                        echo' <span class="txt-light block counter"><span class="counter-anim">'. $total.'</span></span>'?>                     
                                                           <span class="txt-light capitalize-font block">Total Products </span>
                                                        </div>
                                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                            <i class="txt-light FA fa fa-codiepie  data-right-rep-icon"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-anim">
                                                        <div class="progress">
                                                            
                                                        </div>
                                                    </div> <div class="row">
                                                       
                                                        <div class="col-xs-12 text-center  col-xs-12 text-center  mb-10">
                                                           <span class="txt-light capitalize-font block">VIEW ALL PRODUCTS <i class="fa fa-arrow-right data-right-rep-icon" aria-hidden="true"></i> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3 col-xs-12">
                                <div class="panel panel-default bg-default card-view pa-0 ">
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="sm-data-box">
                                                <div class="container-fluid ">
                                                    <div class="row">
                                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                        <?php 
                                                        $result = mysqli_query($con,"SELECT count(1) FROM ecommerce_order_payment_details where status = 7");
                                                        $row = mysqli_fetch_array($result);
                                                        $total = $row[0];
                                                        echo' <span class=" block counter"><span class="counter-anim">'. $total.'</span></span>'?>                    
                                                        <span class="capitalize-font block">Completed Orders</span> 
                                                        </div>
                                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                              <i  class="fa  fa fa-first-order data-right-rep-icon" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-anim">
                                                        <div class="progress">
                                                           
                                                        </div>
                                                    </div><div class="row">
                                                       
                                                        <div class="col-xs-12 text-center  col-xs-12 text-center  mb-10">
                                                           <span class=" capitalize-font block">VIEW ALL ORDERS <i class="fa fa-arrow-right data-right-rep-icon" aria-hidden="true"></i> </span>
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


                    <div class="col-sm-6 col-xs-6">
                                <div class="panel panel-default border-panel card-view panel-refresh">
                                    <div class="refresh-container">
                                        <div class="la-anim-1"></div>
                                    </div>
                                    <div class="panel-heading">
                                        <div class="pull-left">
                                            <h6 class="panel-title txt-dark">New Orders</h6>
                                        </div>
                                        <div class="pull-right">
                                            <a href="#" class="pull-left inline-block refresh mr-15">
                                                <i class="zmdi zmdi-replay"></i>
                                            </a>
                                            <a href="#" class="pull-left inline-block full-screen mr-15">
                                                <i class="zmdi zmdi-fullscreen"></i>
                                            </a>
                                           
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body row pa-0">
                                            <div class="table-wrap">
                                                <div class="table-responsive">
                                                    <div id="datable_1_wrapper" class="dataTables_wrapper no-footer">
                                                        
                    <table id="datable_1" class="table  display table-hover border-none dataTable no-footer" role="grid">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#Invoice: activate to sort column descending" style="width: 61px;">#Orderid</th>
                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Description: activate to sort column ascending" style="width: 192px;">Cust</th>
                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 66px;">Email</th>
                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="issue date: activate to sort column ascending" style="width: 85px;">Mode</th>
                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="issue date: activate to sort column ascending" style="width: 85px;">Amt</th>
                        <th class="sorting" tabindex="0" aria-controls="datable_1" rowspan="1" colspan="1" aria-label="due date: activate to sort column ascending" style="width: 85px;">Status</th>
                      </tr>
                    </thead>
                    <tbody> 
                    <?php
                    include('conn.php'); 
                    $query=mysqli_query($conn,"SELECT  eo.id,  eo.cust_id, ep.status, eo.net_total, eo.created_on, ep.transaction_reference_no, ep.mode_service, ep.mobile,ep.email FROM `ecommerce_orders` eo, ecommerce_users eu, ecommerce_order_payment_details ep where eo.cust_id = eu.user_id and eo.id = ep.order_id limit 5  ");
                     $tmpCount = 1;
                    while($row=mysqli_fetch_array($query)){
                    ?> 
                    <tr>    
                      <td style="padding: 10px"><?php echo $row['id']; ?></td>  

                          <td> <a data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal"  class="text-inverse" title="View" data-toggle="tooltip"> <?php echo $row['cust_id']; ?> </a></td>  
                          <td><?php echo $row['email']; ?></td>           
                          <td><?php echo $row["mode_service"]; ?> </td>
                          <td><?php echo $row["net_total"]; ?></td>  

                          
                        <?php include 'modal/viewecommerceorders.php';?>  
                          <td><a data-target="#viewstatus<?php echo $row["id"]; ?>" data-toggle="modal"  class="text-inverse btn-sm label label-info" title="View" data-toggle="tooltip"> Status</a></td> 
                        

                        <?php include 'modal/viewecommerceordersstatus.php';?>  

                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>

                                                     
                                                    </table></div>
                                                </div>
                                            </div>  
                                        </div>  
                                    </div>
                                </div>
                            </div>






                   
                </div>
                <!-- /Row -->

                 <!-- Row -->
                <div class="row"> 
            
                    <div class="col-sm-8">
                        <div class="row"> 
     
                            <div class="col-sm-4 col-xs-12">
                                <div class="panel panel-default card-view pa-0 " >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="sm-data-box">
                                                <div class="container-fluid ">
                                                    <div class="row">
                                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                        <?php 
                                                        $result = mysqli_query($con,"select count(1) FROM company");
                                                        $row = mysqli_fetch_array($result);
                                                        $total = $row[0];
                                                        echo' <span class="txt-dark block counter"><span class="counter-anim">'. $total.'</span></span>'?>  
                                                        <span class="capitalize-font block">Total Company</span>  
                                                        </div>
                                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                            <i class="fa fa-building data-right-rep-icon" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                     <div class="progress-anim">                                  
                                                        <div class="progress">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-12">
                                <div class="panel panel-default card-view pa-0 " >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="sm-data-box">
                                                <div class="container-fluid ">
                                                    <div class="row">
                                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                        <?php                             
                                                        $result = mysqli_query($con,"select count(1) FROM branch");
                                                        $row = mysqli_fetch_array($result);
                                                        $total = $row[0];
                                                        echo' <span class="txt-dark block counter"><span class="counter-anim">'. $total.'</span></span> ';?>                    
                                                        <span class="capitalize-font block">Total Branch</span> 
                                                        </div>
                                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                           <i  class="fa fa-sitemap data-right-rep-icon" aria-hidden="true"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-anim">
                                                        <div class="progress">
                                                         
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 col-xs-12">
                                <div class="panel panel-default card-view pa-0 " >
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body pa-0">
                                            <div class="sm-data-box">
                                                <div class="container-fluid ">
                                                    <div class="row">
                                                        <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                                       <?php 
     
                                                        if ($workingin == 'ADMIN, ALLBRANCH' || $workingin == 'ADMIN')
                                                        {
                                                            if($sb != '')
                                                            {  
                                                                if($sb == 'FPG' || $sb == 'FME')
                                                                {                                                                                 
                                                                    $result = mysqli_query($con,"SELECT * FROM employee e, branch b where e.workingin = b.branchcode and b.company_shortname = '$sb'");
                                                                }
                                                                else  if ($sb == 'ADMIN, ALLBRANCH' || $sb == 'ADMIN')
                                                                {
                                                                     $result = mysqli_query($con,"SELECT count(1) FROM employee");
                                                                }
                                                                else 
                                                                {
                                                                    $result = mysqli_query($con,"SELECT count(1) FROM employee WHERE workingin = '$sb'");
                                                                }       
                                                            } 
                                                            else 
                                                            {
                                                             $result = mysqli_query($con,"SELECT count(1) FROM employee");
                                                            }                                                           
                                                        }                                                       
                                                        else if($workingin != 'ADMIN, ALLBRANCH') 
                                                        {
                                                            $result = mysqli_query($con,"select count(1) FROM employee WHERE workingin = '$workingin'");
                                                        }

                                                     
                                                        $row = mysqli_fetch_array($result);
                                                        $total = $row[0];
                                                        echo' 
                                                        <span class="txt-dark block counter"><span class="counter-anim">'. $total.'</span></span>    '; ?>
                                                        <span class="capitalize-font block">Total Employee</span> 
                                                        </div>
                                                          
                                                        <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                                            <i class=" glyphicon glyphicon-user  data-right-rep-icon"></i>
                                                        </div>
                                                    </div>
                                                    <div class="progress-anim">
                                                    <div class="progress">
                                                        
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
                <!-- /Row -->


            </div>
            
    
            
        </div>
     <!-- Main Content -->
      

        <!-- /Main Content -->
<?php include "allscript.php"; ?>

