





    <div class="modal fade bs-example-modal-lg" id="viewbatch<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Stock Details with Batch No  </h4></center>
                </div>
                <div class="modal-body">

                <?php include('conn.php');
                      $view=mysqli_query($conn,"select * from stockinpc where id='".$row['id']."'");
                      $erow=mysqli_fetch_array($view);
                      $stockin = $erow['stockin'];
                      $itemcode =  $erow['itemcode']; 
                      $vieww = mysqli_query($conn,"select * from stockinpc where itemcode = '$itemcode' and stockin = '$stockin' and convertedtopc != 0");
                      $eroww=mysqli_fetch_array($vieww);
                      $stockin = $eroww['stockin'];
                      $itemcode =  $eroww['itemcode']; 
                ?>                                    
                          				<div class="container-fluid">         
                                        <div class="table-responsive modaltable">                                                                  

                                            <div class="row" style="background-color:#f3f3f3">                                        
                                            <div class="col-md-2 bor"> ItemCode</div> 
                                            <div class="col-md-1 bor">Stock In </div>
                                            <div class="col-md-1 bor">  Pack</div>   
                                            <div class="col-md-2 bor">Batch  </div>   
                                            <div class="col-md-2 bor"> Manufacture Date </div> 
                                            <div class="col-md-2 bor">Expiry </div>     
                                            <div class="col-md-2 bor">Pc </div>   
                                          
                                         </div>  

                                          <?php
                                           foreach($vieww as $sub_row)
                                           {
                                           echo '
                                          <div class="row" >
                                             
                                                <div class="col-md-2 bor"> '.$sub_row['itemcode'].' </div> 
                                                <div class="col-md-1 bor">'.$sub_row["stockin"].'</div>                                         
                                                <div class="col-md-1 bor">  '.$sub_row["packing"].' </div>                                         
                                                <div class="col-md-2 bor"> '.$sub_row["batch"].'   </div>  
                                                <div class="col-md-2 bor">  '.$sub_row["manufacturedate"].' </div>    
                                                <div class="col-md-2 bor">  '.$sub_row["expiry"].' </div> 
                                                <div class="col-md-2 bor"> '.$sub_row["convertedtopc"].' </div> 

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
                                            </div>
                                        </div>
                                    </div>
                               

                                </div>
                                <!-- /Row -->
            




            </div>
        </div>
    </div>
<!-- /.modal -->