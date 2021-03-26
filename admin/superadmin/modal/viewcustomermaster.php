
<!-- view -->


    <div class="modal fade bs-example-modal-lg" id="view<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Customer </h4></center>
                </div>
                <div class="modal-body">
           
   
              
                    <?php include('conn.php');
                    $view=mysqli_query($conn,"SELECT * from customer where id='".$row['id']."'");
                  
                    $erow=mysqli_fetch_array($view); 
                    $id = $erow['id'];

                   
              
                    ?>

             

                <div class="container-fluid">
                                                  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default border-panel card-view">
                               
                                         
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">  

                                        <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT * FROM `customer` where id = '$id'"); 
                                            $statement->execute( 
                                             array(
                                              ':id' =>  $row["id"]                                            
                                             )
                                            ); 
                                            $item_result = $statement->fetchAll();
                                            $count = 0;
                                            foreach($item_result as $sub_row)
                                            {
                                             $count++; 

                                          
                                             echo ' 

                                              <div class="row" style="  background-color: #f6f6f6;">                                           
                                             
                                                <div class="col-md-3 bor"> Old Code</div>
                                                <div class="col-md-3 bor">Code   </div>                                               
                                                <div class="col-md-3 bor">Customer Name </div>
                                                <div class="col-md-3 bor">Chq Name  </div>
                                                
                                            </div>   


                                             <div class="row">                                         
                                             
                                                <div class="col-md-3 bor"> '.$sub_row['oldcode'].' </div>
                                                <div class="col-md-3 bor">'.$sub_row["code"].'    </div>
                                                <div class="col-md-3 bor"> '.$sub_row['chqprintname'].' </div>
                                                <div class="col-md-3 bor"> '.$sub_row['chqprintname'].' </div>
                                                 
                                            </div> 
                                                   

                                               <div class="row" style="  background-color: #f6f6f6;">  
                                               <div class="col-md-2 bor">Address</div>                                
                                               <div class="col-md-2 bor"> Location </div>
                                                <div class="col-md-2 bor">Type</div>                                              
                                                <div class="col-md-2 bor">Telephone</div>
                                                <div class="col-md-2   bor">Mobile </div>
                                               <div class="col-md-2 bor"> Fax </div>

                                            </div>   

                                            <div class="row">  
                                                <div class="col-md-2 bor">'.$sub_row["address"].' </div>                                 
                                             
                                                <div class="col-md-2 bor"> '.$sub_row['location'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["type"].'    </div>
                                                
                                                <div class="col-md-2 bor">'.$sub_row["ctelephone"].'    </div>
                                                <div class="col-md-2 bor"> '.$sub_row['cmobile'].' </div>
                                                <div class="col-md-2 bor"> '.$sub_row['fax'].' </div>
                                            </div>   


                                             <div class="row" style="  background-color: #f6f6f6;">                                           
                                                <div class="col-md-2 bor"> Email </div>
                                                <div class="col-md-2 bor">Group   </div>                                               
                                                
                                                <div class="col-md-2 bor">Area   </div>
                                                <div class="col-md-2 bor">Sector  </div>
                                                <div class="col-md-2 bor">Category </div>
                                                <div class="col-md-2 bor">Invoice Type </div>
                                             

                                            </div>    

                                            <div class="row">                                         
                                              
                                            
                                                <div class="col-md-2 bor"> '.$sub_row['cemail'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["customergroup"].'    </div>
                                                
                                                <div class="col-md-2 bor">'.$sub_row["area"].'    </div>
                                                <div class="col-md-2 bor"> '.$sub_row['sector'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["category"].'    </div> 
                                                <div class="col-md-2 bor">'.$sub_row["invoicetype"].'    </div> 


                                            </div>  

                                            <div class="row" style="background-color: #f6f6f6;">                                           
                                                <div class="col-md-2 bor"> Invoice Price</div>
                                                <div class="col-md-2 bor">Credit Limits   </div>                                               
                                                <div class="col-md-2 bor">Credit Days </div>
                                                 <div class="col-md-2 bor"> Grace Limit</div>
                                                <div class="col-md-2 bor">Grace Days  </div>                                               
                                                <div class="col-md-2 bor">Company</div>
                                                
                                            </div>    


                                            <div class="row">                                         
                                              
                                        
                                                <div class="col-md-2 bor">'.$sub_row["invoiceprice"].'    </div>
                                               
                                                <div class="col-md-2 bor">'.$sub_row["creditlimits"].'    </div> 
                                                <div class="col-md-2 bor"> '.$sub_row['creditdays'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["gracelimit"].'    </div>
                                               
                                                <div class="col-md-2 bor">'.$sub_row["gracedays"].'    </div> 
                                                <div class="col-md-2 bor"> '.$sub_row['companyid'].' </div>

                                            </div>  

                      
                                            ';
                                            }

                                          ?> 



  <h5 class="text-center mb-10">Telephone Details </h5> 

  <div class="row" style="  background-color: #f6f6f6;">                                           
                                                
                                                
                                                <div class="col-md-2 bor"> Department</div>
                                                <div class="col-md-2 bor">Name  </div>                                               
                                                <div class="col-md-2 bor">Telephone</div>
                                                <div class="col-md-2 bor">Mobile</div>
                                                <div class="col-md-2 bor">Whatsapp  </div>
                                                <div class="col-md-2 bor">Email  </div>

                                            </div>   
                                          <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT * FROM `customer_telephone` where customerid = '$id'"); 
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
                                             
                                                
                                                <div class="col-md-2 bor">'.$sub_row["department"].'    </div>
                                                <div class="col-md-2 bor"> '.$sub_row['name'].' </div>
                                                <div class="col-md-2 bor"> '.$sub_row['telephone'].' </div>
                                                 <div class="col-md-2 bor"> '.$sub_row['ibanno'].' </div>
                                                
                                                <div class="col-md-2 bor"> '.$sub_row['country'].' </div>
                                                 <div class="col-md-2 bor"> '.$sub_row['email'].' </div>  

                                            </div> 
                                     
                      
                                            ';
                                            }

                                          ?>




                                              <h5 class="text-center mb-10">Bank Details </h5> 
                                            <div class="row" style="  background-color: #f6f6f6;">                                           
                                                
                                                
                                                <div class="col-md-2 bor"> Bank Name</div>
                                                <div class="col-md-2 bor">Bank Branch   </div>                                               
                                                <div class="col-md-2 bor">Account No</div>
                                                
                                                
                                                <div class="col-md-4 bor">Ibanno</div>
                                                
                                                <div class="col-md-2 bor">Country  </div>
                                                

                                            </div>   


                                        <?php 

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT * FROM `customer_bank` where customerid = '$id'"); 
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
                                                <div class="col-md-2 bor">'.$sub_row["bankname"].'    </div>
                                                <div class="col-md-2 bor"> '.$sub_row['bankbranch'].' </div>
                                                <div class="col-md-2 bor"> '.$sub_row['accountno'].' </div>
                                                 <div class="col-md-4 bor"> '.$sub_row['ibanno'].' </div>
                                                <div class="col-md-2 bor"> '.$sub_row['country'].' </div>

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



    </div>
<!-- /.modal -->
</div>
</div>