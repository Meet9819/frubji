




<!-- view -->


    <div class="modal fade bs-example-modal-lg" id="view<?php echo $row['role_rolecode']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View User Roles</h4></center>
                </div>
                <div class="modal-body">
				<?php include('conn.php');
					$view=mysqli_query($conn,"SELECT * FROM `role_rights` where rr_rolecode = '".$row['role_rolecode']."'");
				$erow=mysqli_fetch_array($view); 



				?>
				<div class="container-fluid">
				
      



    <div class="row" style="background-color:#f3f3f3">
                                               
                                                <div class="col-md-3 bor">Role Code </div>                                 
                                                <div class="col-md-4 bor">Menu Title</div>                                         
                                                <div class="col-md-1 bor">  View</div>                                         
                                                <div class="col-md-1 bor"> Create  </div>  
                                                 <div class="col-md-1 bor"> Edit </div>                                     
                                                <div class="col-md-1 bor"> Delete</div>                                       
                                                 <div class="col-md-1 bor"> Approve </div>         

                                             </div>




<?php
//print_invoice.php
if(isset($row["role_rolecode"]))
{
 include('database_connection.php');
 $statement = $connect->prepare("
  SELECT * FROM role_rights 
  WHERE rr_rolecode = :role_rolecode

 ");
 $statement->execute(
  array(
   ':role_rolecode'       =>  $row["role_rolecode"]
  )
 );
 $result = $statement->fetchAll();
 foreach($result as $row)
 {


  

 echo '
                                    <div class="row" >
                                               
                                                <div class="col-md-3 bor">   '.$row['rr_rolecode'].' </div>                                 
                                                <div class="col-md-4 bor">'.$row["rr_modulecode"].'</div>                                         
                                                                                    
                                               '; 

                                                if($row['rr_view'] == 'yes')
                                                {
                                                  echo '  <div style="    background-color: #00bc00;color:white" class="col-md-1 bor">'.$row["rr_view"].'   </div> '; 
                                                }    
                                                else {
                                                  echo '  <div style="    background-color: red;color:white" class="col-md-1 bor">'.$row["rr_view"].'   </div> '; 
                                                } 
                                                
                                              

                                                if($row['rr_create'] == 'yes')
                                                {
                                                  echo '  <div style="    background-color: #00bc00;color:white" class="col-md-1 bor">'.$row["rr_create"].'   </div> '; 
                                                }    
                                                else {
                                                  echo '  <div style="    background-color: red;color:white" class="col-md-1 bor">'.$row["rr_create"].'   </div> '; 
                                                }  


                                                   if($row['rr_edit'] == 'yes')
                                                {
                                                  echo '  <div style="    background-color: #00bc00;color:white" class="col-md-1 bor">'.$row["rr_edit"].'   </div> '; 
                                                }    
                                                else {
                                                  echo '  <div style="    background-color: red;color:white" class="col-md-1 bor">'.$row["rr_edit"].'   </div> '; 
                                                }  
 

                                              if($row['rr_delete'] == 'yes')
                                                {
                                                  echo '  <div style="    background-color: #00bc00;color:white" class="col-md-1 bor">'.$row["rr_delete"].'   </div> '; 
                                                }    
                                                else {
                                                  echo '  <div style="    background-color: red;color:white" class="col-md-1 bor">'.$row["rr_delete"].'   </div> '; 
                                                }    



                                                 if($row['rr_approval'] == 'yes')
                                                {
                                                  echo '  <div style="    background-color: #00bc00;color:white" class="col-md-1 bor">'.$row["rr_approval"].'   </div> '; 
                                                }    
                                                else {
                                                  echo '  <div style="    background-color: red;color:white" class="col-md-1 bor">'.$row["rr_approval"].'   </div> '; 
                                                }  



                                           echo '  </div>

 




  '; 

 }
}
?>
           


                 </div>
                                                </div>
                                            </div>
                                        </div>



                                                            
                                                            </div>
                                                      