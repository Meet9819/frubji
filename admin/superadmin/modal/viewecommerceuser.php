<div class="modal fade bs-example-modal-lg" id="view<?php echo $row['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <center>
          <h4 class="modal-title" id="myModalLabel">View Ecommerce User <?php echo $userid = $row['user_id']; ?></h4>
        </center>
      </div>
      <div class="modal-body">
        <div class="panel panel-default border-panel card-view">
          
              <h5 class="text-center mb-10 ">Customer Details</h5>
              <div class="row" style="  background-color: #f6f6f6;">
                <div class="col-md-3 bor">First Name  </div>
                <div class="col-md-3 bor">Last Name   </div>
                <div class="col-md-3 bor"> Mobile No</div>
                <div class="col-md-2 bor"> Modified On</div>
                <div class="col-md-1 bor"> Status </div>
              </div>
              <?php
                include('database_connection.php');
                
                 $statement = $connect->prepare( "SELECT * FROM `ecommerce_users` where user_id = '$userid'"); 
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
                     <div class="col-md-3 bor">'.$sub_row["first_name"].' </div>   
                     <div class="col-md-3 bor">'.$sub_row["last_name"].' </div>     
                     <div class="col-md-3 bor">'.$sub_row["mobile"].' </div>        
                     <div class="col-md-2 bor">'.$sub_row["modified_on"].' </div>       
                     <div class="col-md-1 bor">'.$sub_row["active"].' </div>     
                  </div>                      
                 ';
                 }
                ?>
              <h5 class="text-center mb-10 mt-10">Customer Address Details</h5>
              <div class="row" style="  background-color: #f6f6f6;">
                <div class="col-md-2 bor">Type  </div>
                <div class="col-md-10 bor">Address  </div>
              </div>
              <?php
                include('database_connection.php');
                
                 $statement = $connect->prepare( "SELECT ea.id,ea.user_id,ea.address_type,et.title, ea.building, ea.street, ea.zone, ea.country FROM `ecommerce_users_address` ea, ecommerce_address_types et where ea.address_type = et.id and user_id = '$userid'"); 
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
                <div class="col-md-1 bor">Cust_Id  </div>
                <div class="col-md-3 bor">Payee Name  </div>
                <div class="col-md-2 bor">Mode of Payment </div>
                <div class="col-md-1 bor">Amt </div>
                <div class="col-md-4 bor">Transaction Id </div>
              </div>
              <?php
                include('database_connection.php');
                
                 $statement = $connect->prepare( "SELECT * FROM `ecommerce_order_payment_details`  where cust_id = '$userid'"); 
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
                     <div class="col-md-1 bor">'.$sub_row["cust_id"].' </div> 
                     <div class="col-md-3 bor">'.$sub_row["payee_name"].' - '.$sub_row["mobile"].' </div> 
                   
                     <div class="col-md-2 bor">'.$sub_row["mode_service"].' </div> 
                     <div class="col-md-1 bor">'.$sub_row["amount"].' </div> 
                     <div class="col-md-4 bor">'.$sub_row["transaction_reference_no"].' </div> 
                     
                  </div>                      
                 ';
                 }
                ?>
              <h5 class="text-center mb-10 mt-10">Customer's Favourite Product [ Wishlist ]</h5>
              <div class="row" style="  background-color: #f6f6f6;">
                <div class="col-md-1 bor">Cust_Id  </div>
                <div class="col-md-2 bor">Itemcode  </div>
                <div class="col-md-7 bor">Itemname </div>
                <div class="col-md-2 bor">Added Price </div>
              </div>
              <?php
                include('database_connection.php');
                
                 $statement = $connect->prepare( "SELECT eu.user_id, eu.added_price, eu.item_code, i.itemname_en FROM `ecommerce_users_wishlist` eu, item i where i.id = eu.item_code and user_id = '$userid'"); 
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
                     <div class="col-md-1 bor">'.$sub_row["user_id"].' </div> 
                     <div class="col-md-2 bor">'.$sub_row["item_code"].' </div> 
                     <div class="col-md-7 bor">'.$sub_row["itemname_en"].' </div> 
                   
                     <div class="col-md-2 bor">'.$sub_row["added_price"].' </div> 
                     
                  </div>                      
                 ';
                 }
                ?>
           
        </div>
      </div>
    </div>
  </div>
</div>