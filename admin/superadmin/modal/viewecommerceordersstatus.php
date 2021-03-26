<div class="modal fade bs-example-modal-lg" id="viewstatus<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <center>
        <h4 class="modal-title" id="myModalLabel">View Ecommerce Order Status  - <?php echo $id = $row['id']; ?></h4>
      </center>
    </div>
    <div class="modal-body">
      <div class="panel panel-default border-panel card-view">  












        <?php
          include('database_connection.php');
          
           $statement = $connect->prepare( "SELECT * FROM `ecommerce_orders` where id = '$id'"); 
           $statement->execute( 
            array(
             ':id'       =>  $row["id"]                                            
            )
           ); 
           $item_result = $statement->fetchAll();
           $count = 0;
           foreach($item_result as $sub_row)
           {
          $order_id = $sub_row['id'];
           
          
          
           }
          ?> 
       

     


          <div class="container-fluid">
        
                <form method="post" action="modal/viewecommerceordersstatusupdate.php?order_id=<?php echo $order_id; ?>">
                  <div class="col-md-12"> 
                    <input type="hidden" value="<?php echo $order_id; ?>" name="order_id">
                  

                    <?php
          include('database_connection.php');
          
           $statement = $connect->prepare( "SELECT eos.title,eos.id FROM `ecommerce_order_payment_details` eopd,  `ecommerce_order_status` eos where eopd.status = eos.id and  order_id = '$order_id'"); 
           $statement->execute( 
            array(
             ':order_id'       =>  $row["order_id"]                                            
            )
           ); 
           $item_result = $statement->fetchAll();
           $count = 0;
           foreach($item_result as $sub_row)
           {
         
            $statustitle = $sub_row['title']; 
            $statusid = $sub_row['id'];
          
          
          
          
           }
          ?> 


                  <select class="form-control form-group" name="status">
                      <option value="<?php echo $statusid; ?>"><?php echo $statustitle; ?></option>

                       <?php
                      include('database_connection.php');
                      
                       $statement = $connect->prepare( "SELECT * FROM `ecommerce_order_status` "); 
                       $statement->execute( 
                        array(
                         ':id'       =>  $row["id"]                                            
                        )
                       ); 
                       $item_resultt = $statement->fetchAll();
                       $count = 0;
                       foreach($item_resultt as $sub_row)
                       {
                             echo ' <option value="'.$sub_row['id'].'">'.$sub_row['title'].'</option>';
                       }
                      ?>
                  </select>
                   </div>   

                  <div class="col-md-12 form-group">   
                    <div class="button-list pull-right">
                      <input type="submit" class="btn btn-info mr-10" value="Update Order Status" />  
                    </div>
                  </div>
              </form>  

            </div>
















          <?php
          include('database_connection.php');
          
           $statement = $connect->prepare( "SELECT * FROM `ecommerce_orders` where id = '$id'"); 
           $statement->execute( 
            array(
             ':id'       =>  $row["id"]                                            
            )
           ); 
           $item_result = $statement->fetchAll();
           $count = 0;
           foreach($item_result as $sub_row)
           {
          $order_id = $sub_row['id'];
            $customerid = $sub_row['cust_id'];
            $status = $sub_row['status'];
            $delivery_mode = $sub_row['delivery_mode'];
            $billing_address_id = $sub_row['billing_address_id'];
            $shipping_address_id = $sub_row['shipping_address_id'];
            $gross_total = $sub_row['gross_total'];
            $total_tax = $sub_row['total_tax'];
            $delivery_charges = $sub_row['delivery_charges'];
            $total_discount = $sub_row['total_discount'];
            $net_total = $sub_row['net_total'];
            $comments = $sub_row['comments'];
            $delivery_pickup_date = $sub_row['delivery_pickup_date'];
            $delivery_pickup_time = $sub_row['delivery_pickup_time'];
            $created_on = $sub_row['created_on'];
          
          
           }
          ?> 
        <?php
          include('database_connection.php');
          
           $statement = $connect->prepare( "SELECT * FROM `ecommerce_users` where user_id = '$customerid'"); 
           $statement->execute( 
            array(
             ':id'       =>  $row["id"]                                            
            )
           ); 
           $item_result = $statement->fetchAll();
           $count = 0;
           foreach($item_result as $sub_row)
           {
               $first_name = $sub_row["first_name"];
               $last_name = $sub_row["last_name"];
               $mobile = $sub_row["mobile"];     
           }
          ?>
        <h5 class="text-center mb-10">Customer Details</h5>
        <div class="row" style="  background-color: #f6f6f6;">
          <div class="col-md-6 bor">
            Customer Id - <?php echo $customerid; ?> <br>
            Full Name - <?php echo $first_name; ?> <?php echo $last_name; ?> <br>
            Mobile No - <?php echo $mobile; ?> 
          </div>
          <div class="col-md-6 bor"> </div>
        </div>
        <h5 class="text-center mb-10 mt-10">Customer Address Details</h5>
        <div class="row" style="  background-color: #f6f6f6;">
          <div class="col-md-2 bor">Type  </div>
          <div class="col-md-10 bor">Address  </div>
        </div>
        <?php
          include('database_connection.php');
          
           $statement = $connect->prepare( "SELECT ea.id,ea.user_id,ea.address_type,et.title, ea.building, ea.street, ea.zone, ea.country FROM `ecommerce_users_address` ea, ecommerce_address_types et where ea.address_type = et.id and user_id = '$customerid'"); 
           $statement->execute( 
            array(
             ':id'       =>  $row["id"]                                            
            )
           ); 
           $item_result = $statement->fetchAll();
           $count = 0;
           foreach($item_result as $sub_row)
           {
            $count++;
            echo ' 
            <div class="row">
               <div class="col-md-2 bor">'.$sub_row["title"].' </div>  
               <div class="col-md-10 bor">Building No - '.$sub_row["building"].', Street - '.$sub_row["street"].' , Zone - '.$sub_row["zone"].' , Country - '.$sub_row["country"].'  </div>  
            </div>                      
           ';
           }
          ?> 
        <h5 class="text-center mb-10 mt-10">Customer Order Details</h5>
        <div class="row" style="  background-color: #f6f6f6;">
          <div class="col-md-1 bor">Order_Id  </div>
          <div class="col-md-1 bor">Itemcode  </div>
          <div class="col-md-4 bor">Itemname   </div>
          <div class="col-md-2 bor">RS   </div>
          <div class="col-md-2 bor">Qty   </div>
          <div class="col-md-2 bor">Total   </div>
        </div>
        <?php
          include('database_connection.php');
          
           $statement = $connect->prepare( "SELECT eoi.order_id, eoi.item_code, eoi.quantity, eoi.gross_total, eoi.total_tax, eoi.total_discount, eoi.net_total, i.itemname_en, i.rs FROM `ecommerce_order_items` eoi, item i where i.id = eoi.item_code  and eoi.order_id = '$order_id'"); 
           $statement->execute( 
            array(
             ':id'       =>  $row["id"]                                            
            )
           ); 
           $item_result = $statement->fetchAll();
           $count = 0;
           foreach($item_result as $sub_row)
           {
            $count++;
            echo ' 
            <div class="row">
               <div class="col-md-1 bor">'.$sub_row["order_id"].' </div>  
               <div class="col-md-1 bor">'.$sub_row["item_code"].' </div>  
               <div class="col-md-4 bor">'.$sub_row["itemname_en"].' </div>  
               <div class="col-md-2 bor">'.$sub_row["rs"].' </div>  
               <div class="col-md-2 bor">'.$sub_row["quantity"].' </div> 
               <div class="col-md-2 bor">'.$sub_row["net_total"].' </div>  
            </div>                      
           ';
           }
          ?>   
        <h5 class="text-center mb-10 mt-10">Customer Order Payment Details</h5>
        <?php
          include('database_connection.php');
          
           $statement = $connect->prepare( "SELECT * FROM `ecommerce_order_payment_details` where order_id = '$order_id'"); 
           $statement->execute( 
            array(
             ':id'       =>  $row["id"]                                            
            )
           ); 
           $item_result = $statement->fetchAll();
           $count = 0;
           foreach($item_result as $sub_row)
           {
            $count++;
            echo ' 
            <div class="row">
               <div class="col-md-4 bor">'.$sub_row["mode_service"].' </div>  
               <div class="col-md-4 bor">'.$sub_row["amount"].' </div>  
               <div class="col-md-4 bor">'.$sub_row["transaction_reference_no"].' </div>  
            </div>                      
           ';
           }
          ?>  



















          

      </div>
    </div>
  </div>
</div>