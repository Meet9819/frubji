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




          
          

  <div class="main-content"> 
                  <?php
                      error_reporting( ~E_NOTICE );    
                      require_once 'dbconfig.php';  
                      if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
                      {
                          $id = $_GET['edit_id'];
                          $stmt_edit = $DB_con->prepare('SELECT status,deliveryboy FROM payment WHERE id =:id');
                          $stmt_edit->execute(array(':id'=>$id));
                          $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
                          extract($edit_row);
                          $statussss = $edit_row['status'];      
                          $deliveryboy = $edit_row['deliveryboy'];  
                      }


                    
                          
                      if(isset($_POST['btn_save_updates']))
                      {
                          $status = $_POST['status'];  
                          $deliveryboy = $_POST['deliveryboy'];
                          if(!isset($errMSG))
                          {
                          $stmt = $DB_con->prepare('UPDATE payment SET status=:status, deliveryboy =:deliveryboy
                          WHERE id=:id');
                               $stmt->bindParam(':status',$status);    
                             $stmt->bindParam(':deliveryboy',$deliveryboy);       
                           
                           
                              $stmt->bindParam(':id',$id);                
                              if($stmt->execute()){
                                  ?>
                                  <script>
                                  alert('Successfully Updated ...');
                                  window.location.href='ecommerceorders.php';
                                  </script>
                                  <?php
                              }
                              else{
                                  $errMSG = "Sorry Data Could Not Updated !";
                              }
                          
                          }
                          
                                          
                      }
                      
                  ?>

                                <div class="row small-spacing">
                  
                      <div class="col-xs-6">
                                        <div class="box-content">   <h4 class="box-title">Bill No -  <?php echo $_GET['billno']; ?></h4>  
                    <p style="   font-size: 16px;    text-align: left;    font-weight: 500;">           
                      <?php 
                      $bill_no = $_GET["billno"]; 
                      $email = $row['email'];
                      ?> 
                      <?php 
                      include('db.php');       
                                                  $result = mysqli_query($con, "SELECT * FROM payment where billno = '$bill_no' limit 1"); 
                                                  while ($row = mysqli_fetch_array($result)) {  
                                                  echo 'Name -'.$name = $row['name'].'<br>';
                                                  echo 'Email Id -'.$email = $row['email'];
                                                  echo 'Contact No -'.$phone = $row['phone'].'<br>';
                                                  echo 'Mode of Payment -'.$modeofpayment = $row['modeofpayment'].'<br>';
                                                   echo 'Address -'.$address = $row['address'].'<br>';
                                                  echo 'Delivery Boy -'.$deliveryboy = $row['deliveryboy'];
                                                 }
                                              ?> 

                    </p> 
                      
                      <a href="order.php" class="btn btn-danger btn-sm waves-effect waves-light">Close </a>
                      <?php echo '<a target="_blank" href="billprint.php?billno='.$bill_no.'&user='.$email.'" class="btn btn-info btn-sm waves-effect waves-light">Print </a> ';?>

        
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="box-content">
                                          
                    
                                         
                                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                             

                                                  <div class="form-group">
                                                        <label for="inp-type-1" class="col-sm-3 control-label">Delivery Boy</label>
                                                        <div class="col-sm-6">
                                                           
                                                            <select name="deliveryboy" class="form-control">  

                                                            <option value="<?php echo $deliveryboy; ?>"><?php echo $deliveryboy; ?></option>
                                                            <?php 
                                                                include('db.php');     
                                                                $result = mysqli_query($con,"SELECT * from employee where u_rolecode = 'DELIVERYBOY'"); 
                                                                 while($row = mysqli_fetch_array($result))
                                                                {
                                                                echo ' <option value="'.$row['username'].' / '.$row['contact'].'">'.$row['username'].'</option> ';
                                                                } ?>                                                             
                                                            </select>
                                                        </div>
                                                    </div>
                                               
                                          <div class="form-group">
                                              <label for="inp-type-1" class="col-sm-3 control-label">Status</label>
                                              <div class="col-sm-6">
                                                 
                                                  <select name="status" class="form-control"> 
                                  
                                  <?php 
                                  
                                  $statussss = $edit_row['status']; 
                                  
                                  if($statussss == '0'){
                                    $statusvalue = 'Received Order';
                                  }
                                  else if($statussss == '1'){
                                    $statusvalue = 'Processed';
                                  }
                                  else if($statussss == '2'){
                                    $statusvalue = 'Shipped';
                                  }
                                  else if($statussss == '3'){
                                    $statusvalue = 'Delivered';
                                  }else if($statussss == '4'){
                                    $statusvalue = 'Cancelled';
                                  }
                                  ?>
                                                      <option value="<?php echo $statussss; ?>"><?php echo $statusvalue; ?></option>
                                                      <option value="0">0 - Received Order</option>
                                                      <option value="1">1 - Processed</option>  
                                                      <option value="2">2 - Shipped</option>  
                                                      <option value="3">3 - Delivered</option> 
                                                       <option value="4">4 - Cancelled</option>
                                                  </select>
                                              </div>
                                          </div>                        

                                                <div class="form-group margin-bottom-0" style="   text-align: center;">
                                                    <br>
                                                    <input class="btn btn-success btn-sm waves-effect waves-light" type="submit" name="btn_save_updates" value="Update" />
                          
                          

                                                </div>

                                            </form>
                                        </div>
                                      
                                    </div>
                             

                                  


                                </div> 




    <div class="row small-spacing">
      <div class="col-xs-12">
        <div class="box-content">
              
        

<table id="datatable" data-toggle="table">
            <thead>
              <tr>
                <th>Invoice No </th>
                <th>Product Code</th> 
                <th>Product Name</th>
                <th >Qty </th>
                <th>GP Price</th> 
                <th >Units </th>
                <th>Sub Total </th>                     
                <th>Bill Amt </th> 
                <th>Action</th>   
               
              </tr>
            </thead>
          
            <tbody>
            <?php 
              include('db.php');

                 $o = $_GET['edit_id']; 
               $result = mysqli_query($con,"SELECT * FROM payment where id = '$o'"); 
               
              while($row = mysqli_fetch_array($result))
              {
                 $bil = $row['billno'];
              }
                            
              $result = mysqli_query($con,"SELECT * FROM o where billno = '$bil'"); 


              while($row = mysqli_fetch_array($result))
              {

              echo '      
              <tr>                  
                <td>'.$row['billno'].'</td>
                <td>'.$row['productcode'].'</td>
                <td>'.$row['name'].'</td>
                <td>'.$row['qty'].'</td> 
                <td>&#8377; '.$row['price'].'</td>  
                <td>'.$row['weight'].' '.$row['units'].'</td>           
                <td>&#8377; '.$row['subtotal'].'</td> 
                <td>&#8377; '.$row['finalamount'].'</td>             
                <td>'.$row['datee'].' </td>   
                          
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
</div>
</div>
<!-- /Row -->
<?php include "footer.php"; ?>
</div>
</div>
<!-- /Main Content --> 



<?php include "allscript.php"; ?>