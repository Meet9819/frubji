<div class="modal fade bs-example-modal-lg" id="viewstatus<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <center>
        <h4 class="modal-title" id="myModalLabel">View Complaint Details  - <?php echo $id = $row['id']; ?></h4>
      </center>
    </div>
    <div class="modal-body">
      <div class="panel panel-default border-panel card-view">  


        <?php
          include('database_connection.php');
          
           $statement = $connect->prepare( "SELECT c.id,c.customerid, t.userName,t.userEmail,t.mobile, c.topic,c.invoiceno,c.img,c.branch,c.message,c.status FROM `complaintbox` c , `tbl_users` t where t.userID = c.customerid and c.id = '$id'"); 
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
            $adminmessage = $sub_row['adminmessage'];
            $status = $sub_row['status'];
            $userEmail = $sub_row['userEmail'];
           
          
          
           }
          ?> 
       
          <div class="container-fluid">
        
              <form method="post" action="modal/complaintboxstatuss.php?order_id=<?php echo $order_id; ?>">
                  
                

                  <div class="col-md-12"> 
                    <input type="hidden" value="<?php echo $order_id; ?>" name="order_id">
                  
                      Complaint Status 
                    
                      <select class="form-control form-group" name="status">
                        <option value="<?php echo $status; ?>">

                           <?php if($status == 1)
                                {
                                  echo 'Resolved';
                                } 
                                else
                                {
                                   echo 'Pending';
                                }
                                  ?>

                                 </option>
                                
                                <?php if($status == 1)
                                {
                                  echo ' <option value="0">Pending</option> ';
                                } 
                                else if($status == 0)
                                {
                                   echo '<option value="1">Resolved</option> ';
                                }
                                else
                                {
                                 echo ' <option value="0">Pending</option>'; 
                                 echo ' <option value="1">Resolved</option>  ';
                                } 
                                ?>

                        
                      </select>
                  </div>
              
               <div class="col-md-12"> 
                     Customer Email
                     
                     <input type="text" readonly="" class="form-control form-group" name="userEmail" value="<?php echo $userEmail; ?>">
                   </div>

                  <div class="col-md-12"> 
                      Admin Comment
                     
                     <textarea class="form-control" name="adminmessage"><?php echo $adminmessage; ?></textarea>
                   </div>

                  <div class="col-md-12 form-group">   
                    <div class="button-list pull-right">
                      <input type="submit" class="btn btn-success mr-10" value="Update Complaint Status" />  
                    </div>
                  </div>

              </form>  

            </div>




      </div>
    </div>
  </div>
</div>