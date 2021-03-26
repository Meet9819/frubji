




<!-- view -->


    <div class="modal fade bs-example-modal-lg" id="view<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Item</h4></center>
                </div>
                <div class="modal-body"> 


                     <div class="row">
                       <div class="col-md-8 " style="font-size:19px">


                        <?php 
                        include('conn.php');
                        $view=mysqli_query($conn,"SELECT * from products where id='".$row['id']."'");
                        $erow=mysqli_fetch_array($view); 
                        $id = $erow['id'];
                        echo 'Item Code  - '.$id = $erow['id'];
                        ?> 
                        <br><br>              
                        <?php
                          $rw = $row['id'];
                          $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
                          echo $code = $Bar->getBarcode($rw, $Bar::TYPE_CODE_128).'<br>';
                        ?> 
                        <?php 
                          echo 'Item Name [en] - '.$erow['name'].'<br>'; 
                        ?>  

                      </div> 
                      <div class="col-md-4 text-right"> <img width="50%" src="../../media/products/<?php echo $row['img']; ?>" class="img-responsive img-thumbnail" />
                      </div>
                    </div>


              <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default border-panel card-view">                                      
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body"> 





                      <?php
                      include('database_connection.php');
                                            
                                        



                                            $statement = $connect->prepare("SELECT * from products where  id = '$id' ");  

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
                                              
                                                <div class="col-md-2 bor">Main Category  </div>                                          
                                                <div class="col-md-2 bor">Sub Category   </div>                                               
                                                <div class="col-md-2 bor">Product Code </div>                                               
                                                <div class="col-md-6 bor">Name of Product  </div>
                                              
                                            </div>   


                                             <div class="row">                                         
                                             
                                                <div class="col-md-2 bor"> '.$sub_row['maincat'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["categoryid"].'    </div>
                                                <div class="col-md-2 bor"> '.$sub_row['productcode'].' </div>
                                                <div class="col-md-6 bor">'.$sub_row["name"].'    </div> 
                                                
                                             </div> 


                                              <div class="row" style="  background-color: #f6f6f6;">                                           
                                              
                                                <div class="col-md-12 bor">Short Description  </div>                                          
                                               
                                              
                                            </div>   


                                             <div class="row">                                         
                                             
                                                <div class="col-md-12 bor"> '.$sub_row['shortdescription'].' </div>
                                              
                                                
                                             </div>

                                              <div class="row" style="  background-color: #f6f6f6;">                                           
                                              
                                                <div class="col-md-12 bor">Description  </div>                                          
                                               
                                              
                                            </div>   


                                             <div class="row">                                         
                                             
                                                <div class="col-md-12 bor"> '.$sub_row['description'].' </div>
                                              
                                                
                                             </div>





                                             <div class="row" style="  background-color: #f6f6f6;">                                           
                                                <div class="col-md-2 bor"> T / ME </div>
                                                <div class="col-md-2 bor">P / R   </div>                                               
                                                <div class="col-md-2 bor">HSNCODE </div>
                                                <div class="col-md-2 bor">GST   </div>
                                                <div class="col-md-2 bor">Sale </div>
                                                <div class="col-md-2 bor">Status </div>
                                                
                                             

                                            </div>    


                                            <div class="row">     
                                            
                                                <div class="col-md-2 bor"> '.$sub_row['newold'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["pr"].'    </div>
                                                <div class="col-md-2 bor"> '.$sub_row['hsncode'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["gst"].'    </div>
                                                <div class="col-md-2 bor"> '.$sub_row['sale'].' </div>
                                                <div class="col-md-2 bor">'.$sub_row["status"].'    </div> 
                                                
                                            </div>  

                                           

                      
                                            ';
                                            }

                                          ?>

                                        <h5 class="text-center mb-10">Product Variant Details</h5>

                                         <div class="row" style="  background-color: #f6f6f6;">                                           
                                            
                                                <div class="col-md-6 bor">NOS  </div>         
                                                <div class="col-md-6 bor">Unit   </div>
                                             
                                            </div>   

                                           <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT * FROM `productvariant` where productid = '$id'"); 
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
                                             
                                                <div class="col-md-6 bor">'.$sub_row["qty"].' </div>                                             
                                                <div class="col-md-6 bor">'.$sub_row["units"].'  </div>
                                                
                                    
                                             </div>
                                        
                      
                                            ';
                                            }

                                          ?>



                                        <h5 class="text-center mb-10">Ecommerce Price List</h5>

                                         <div class="row" style="  background-color: #f6f6f6;">
                                                <div class="col-md-3 bor">Branch Name  </div>
                                                <div class="col-md-3 bor">NOS  </div>
                                                <div class="col-md-3 bor">Type </div>
                                                <div class="col-md-3 bor">Price</div>
                                          </div>   

                                           <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT b.branchname_english, pp.id, pp.productid,pp.variantid,pp.branchid,pp.price, pv.productid, pv.qty, pv.units FROM `productsprice` pp, `productvariant` pv, `branch` b where pp.variantid = pv.id and pp.branchid = b.id AND pp.productid = '$id'"); 
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
                                                                                        
                                                <div class="col-md-3 bor">'.$sub_row["branchname_english"].'  </div>   
                                                <div class="col-md-3 bor">'.$sub_row["qty"].'  </div>   
                                                <div class="col-md-3 bor">'.$sub_row["units"].'  </div>   
                                                <div class="col-md-3 bor">'.$sub_row["price"].'  </div>     

                                            </div>    

                                    
                                            ';
                                            }

                                          ?>


                                            <h5 class="text-center mb-10">Retail Price List</h5>

                                         <div class="row" style="  background-color: #f6f6f6;">
                                                <div class="col-md-3 bor">Branch Name  </div>
                                                <div class="col-md-3 bor">NOS  </div>
                                                <div class="col-md-3 bor">Type </div>
                                                <div class="col-md-3 bor">Price</div>
                                          </div>   

                                           <?php

                                           include('database_connection.php');

                                            $statement = $connect->prepare( "SELECT b.branchname_english, pp.id, pp.productid,pp.variantid,pp.branchid,pp.price, pv.productid, pv.qty, pv.units FROM `productsretailprice` pp, `productvariant` pv, `branch` b where pp.variantid = pv.id and pp.branchid = b.id AND pp.productid = '$id'"); 
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
                                                                                        
                                                <div class="col-md-3 bor">'.$sub_row["branchname_english"].'  </div>   
                                                <div class="col-md-3 bor">'.$sub_row["qty"].'  </div>   
                                                <div class="col-md-3 bor">'.$sub_row["units"].'  </div>   
                                                <div class="col-md-3 bor">'.$sub_row["price"].'  </div>     

                                            </div>    

                                    
                                            ';
                                            }

                                          ?>

                             
                            </div>    
                            
                            <div class="form-group col-md-12 text-right" >      
                              <a href="itemgenerate.php?generate=<?php echo $id ?>"> <span data="" class="btn btn-sm  btn-danger btn-rounded">Generate New Item  </span> </a>
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
