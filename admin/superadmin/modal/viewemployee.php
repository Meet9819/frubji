
<!-- view -->


    <div class="modal fade bs-example-modal-lg" id="view<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Employee </h4></center>
                </div>
                <div class="modal-body">
           
   
        <div class="row">
           <div class="col-md-8 " style="font-size:19px">

            <?php include('conn.php');
            $view=mysqli_query($conn,"SELECT * from employee where id='".$row['id']."'");
          
            $erow=mysqli_fetch_array($view); 
            $id = $erow['id'];

           
            echo 'Username - '.$username = $erow['username'].'<br>';
            echo 'Password - '.$password = $erow['password'].'<br>';
            echo 'User_Role Code - '.$u_rolecode = $erow['u_rolecode'].'<br>';
      
            ?>

          </div>
            <div class="col-md-4 text-right"> <img width="35%" src="images/employee/photo.jpg" class="img-responsive img-thumbnail" />
            </div>
        </div>

        <div class="container-fluid">
                                                  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default border-panel card-view">
                               
                                         
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body"> 
                                    
                                         <h5 class="text-center mb-10">Personal Information</h5>

                                           <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT * FROM `employee` where id = '$id'"); 
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

                                              <div class="row" style="  background-color: #f6f6f6;">                                           
                                             
                                                <div class="col-md-2 bor"> Code</div>
                                                <div class="col-md-4 bor">Emp Name   </div>  
                                                <div class="col-md-2 bor">DOB   </div>
                                                 <div class="col-md-2 bor">Gender </div>
                                                <div class="col-md-2 bor">Qualification   </div>   

                                            </div>   


                                             <div class="row">                                         
                                             
                                                <div class="col-md-2 bor"> '.$sub_row['employeecode'].' </div>
                                                <div class="col-md-4 bor">'.$sub_row["employeename"].'    </div>
                                                <div class="col-md-2 bor">'.$sub_row["dob"].'    </div> 
                                                <div class="col-md-2 bor"> '.$sub_row['gender'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["qualification"].'    </div>
                                                </div>

                                             <div class="row" style="  background-color: #f6f6f6;">                                        
                                                <div class="col-md-2 bor">Join Date </div>
                                                <div class="col-md-2 bor">Working In  </div>
                                                <div class="col-md-2 bor">Min.Hr  </div>
                                                <div class="col-md-2 bor">Left Date  </div>
                                             
                                            </div>    


                                            <div class="row">     
                                            
                                                <div class="col-md-2 bor">'.$sub_row["designation"].'    </div>
                                                <div class="col-md-2 bor"> '.$sub_row['workingin'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["minworkinghrs"].'    </div> 
                                                <div class="col-md-2 bor"> '.$sub_row['leftdate'].' </div>


                                            </div>  

                                           
                                     

  

                      
                                            ';
                                            }

                                          ?>  



                                     
                                         <h5 class="text-center mb-10">Address Details </h5>

                                         <div class="row" style="  background-color: #f6f6f6;">                                           
                                             
                                                <div class="col-md-2 bor"> Type</div>
                                                <div class="col-md-8 bor">Address  </div>                                               
                                              
                                                <div class="col-md-2 bor">Country   </div>

                                            </div>   

                                           <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT * FROM `employee_address` where employeeid = '$id'"); 
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
                                             
                                                <div class="col-md-2 bor"> '.$sub_row['typeofaddress'].' </div>
                                                <div class="col-md-8 bor">'.$sub_row["eaddress"].'    </div>
                                             
                                                <div class="col-md-2 bor">'.$sub_row["ecountry"].'    </div>

                                            </div>    

                                          
                                           
                                  
    
                                       
                                        


                      
                                            ';
                                            }

                                          ?>  



                                     <h5 class="text-center mb-10">Bank Details </h5>
                                       <div class="row" style="  background-color: #f6f6f6;">                                           
                                             
                                                <div class="col-md-2 bor"> Bank Name</div>
                                                <div class="col-md-2 bor">Bank Branch  </div>  
                                                <div class="col-md-2 bor">Account No   </div>
                                                <div class="col-md-4 bor">IBan No   </div>
                                                <div class="col-md-2 bor">Country   </div>

                                            </div>   

                                           <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT * FROM `employee_bank` where employeeid = '$id'"); 
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
                                             
                                                <div class="col-md-2 bor"> '.$sub_row['bankname'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["bankbranch"].'</div>
                                                <div class="col-md-2 bor">'.$sub_row["accountno"].'</div>
                                                <div class="col-md-4 bor">'.$sub_row["ibanno"].'</div>
                                                <div class="col-md-2 bor">'.$sub_row["country"].'</div>


                                            </div>    

                                          
                                           
                                       

                      
                                            ';
                                            }

                                          ?>   



                                             <h5 class="text-center mb-10">  Telephone  Details </h5>
                                               <div class="row" style="  background-color: #f6f6f6;">                                           
                                             
                                                <div class="col-md-4 bor"> Type</div>
                                                <div class="col-md-4 bor">Details  </div>  
                                                <div class="col-md-4 bor">Display  </div>

                                            </div>   
                                           <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT * FROM `employee_telephone` where employeeid = '$id'"); 
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
                                             
                                                <div class="col-md-4 bor"> '.$sub_row['type'].' </div>
                                                <div class="col-md-4 bor">'.$sub_row["details"].'</div>
                                                <div class="col-md-4 bor">'.$sub_row["display"].'</div>


                                            </div>    

                                          
                                           
                                       
                      
                                            ';
                                            }

                                          ?>   





                                             <h5 class="text-center mb-10">  Salary  Details </h5>
                                               <div class="row" style="  background-color: #f6f6f6;">                                           
                                             
                                                <div class="col-md-4 bor"> Type</div>
                                                <div class="col-md-4 bor">Start From  </div>  
                                                <div class="col-md-4 bor">Total  </div>

                                            </div>   

                                           <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT * FROM `employee_salary` where employeeid = '$id'"); 
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
                                             
                                                <div class="col-md-4 bor"> '.$sub_row['stype'].' </div>
                                                <div class="col-md-4 bor">'.$sub_row["startfrom"].'</div>
                                                <div class="col-md-4 bor">'.$sub_row["total"].'</div>


                                            </div>    

                                          
                                           
                                       
                      
                                            ';
                                            }

                                          ?>  





                              </div>
                          </div>
                    </div>

          </div>






            </div>
        </div>
    </div>
<!-- /.modal -->
</div>
</div>
</div>
