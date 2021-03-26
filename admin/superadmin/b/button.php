<!-- Delete -->
    <div class="modal fade" id="del<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Delete Branch Master</h4></center>
                </div>
                <div class="modal-body">
				<?php
					$del=mysqli_query($conn,"SELECT * from branch where id='".$row['id']."'");
					$drow=mysqli_fetch_array($del);
				?>
				<div class="container-fluid">
					<h5><center>Branch Name : <strong><?php echo $drow['branchname_english']; ?></strong></center></h5> 
                </div> 
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <a href="b/delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
				
            </div>
        </div>
    </div>
<!-- /.modal -->


<!-- View -->

    <div class="modal fade bs-example-modal-lg" id="edit<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">view Branch Master</h4></center>
                </div>
                <div class="modal-body"> 

				<?php
					$edit=mysqli_query($conn,"SELECT b.id, c.companyname_english,b.branchcode,b.prifix,b.branchname_english,b.img,b.address,b.locationlatitude,b.locationlongitude,b.email,b.mobile,b.status,b.channelpartnerid from branch b, company c WHERE b.companyid = c.id");
					$erow=mysqli_fetch_array($edit);

                      $idd = $row['id'];
				?>
				<div class="container-fluid">
                                <div class="row">
                            
                                   <div class="col-md-12">
                                        <div class="panel panel-default border-panel card-view">

                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">
     

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-wrap">
                                                                 <div class="form-group col-md-4">
                                                                    <label for="recipient-name" class="control-label mb-10">Company
                                                                    </label>
                                                                    <input readonly="" type="text" class="form-control"  name="" value="<?php echo $row['companyname_english']; ?>">
                                                                   
                                                                  </div> 


                                                            <div class="form-group col-md-4">
                                                                    <label for="inputName" class="control-label mb-10">Branch Name (en)</label>
                                                                    <input type="text" name="branchname_english" class="form-control" id="inputName" placeholder="Enter Name  in English" required readonly="" value="<?php echo $erow['branchname_english']; ?>">
                                                                </div> 


                                                        
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputName" class="control-label mb-10">Branch Code</label> 
                                                                    <input type="text" name="branchcode" class="form-control" id="inputName" placeholder="Enter Branch Code" required readonly="" value="<?php echo $erow['branchcode']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputName" class="control-label mb-10">Prifix</label>
                                                                    <input type="text" name="prifix" class="form-control" id="inputName" placeholder="Enter Prifix" required readonly="" value="<?php echo $erow['prifix']; ?>">
                                                                </div>

                                                                 <div class="form-group col-md-4">
                                                                    <label for="inputName" class="control-label mb-10">Mobile</label>
                                                                    <input type="text" name="prifix" class="form-control" id="inputName" placeholder="Enter Prifix" required readonly="" value="<?php echo $erow['mobile']; ?>">
                                                                </div>
                                                                 <div class="form-group col-md-4">
                                                                    <label for="inputName" class="control-label mb-10">Email</label>
                                                                    <input type="text" name="prifix" class="form-control" id="inputName" placeholder="Enter Prifix" required readonly="" value="<?php echo $erow['email']; ?>">
                                                                </div>
                                                              

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="panel panel-default border-panel card-view">

                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-wrap">



                                                            <div class="form-group col-md-12">
                                                                    <label for="inputName" class="control-label mb-10">Address</label>
                                                                    <input name="address" type="text" class="form-control" id="inputName" required readonly="" value="<?php echo $erow['address']; ?>">
                                                                </div>


                                                             <div class="form-group col-md-6">
                                                                    <label for="inputName" class="control-label mb-10">Latitude Location</label>
                                                                    <input name="locationlatitude" type="text" class="form-control" id="inputName" placeholder="Enter Latitude" required readonly="" value="<?php echo $erow['locationlatitude']; ?>">
                                                                </div>

                                                           <div class="form-group col-md-6">
                                                                    <label for="inputName" class="control-label mb-10">Longitude Location</label>
                                                                    <input name="locationlongitude" type="text" class="form-control" id="inputName" placeholder="Enter Longitude " required readonly="" value="<?php echo $erow['locationlongitude']; ?>">
                                                                </div>
                                                                  <div class="col-md-12 form-group"> 
                          
                                                                  <h5 class="text-center mb-10">Alloted Pincode to this Branch</h5>
                                                                    <div class="row" style="  background-color: #f6f6f6;">
                                                                      <div class="col-md-12 bor">Pincode  </div>
                                                                    </div>
                                                                    <?php
                                                                      include('database_connection.php');
                                                                       $statement = $connect->prepare( "SELECT * FROM `branchpincode` where branchid = '$id'"); 
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
                                                                            <div class="col-md-12 bor">'.$sub_row["pincode"].' </div>  
                                                                        </div>
                                                                       ';
                                                                       }
                                                                      ?>
                                                                   
                                                                </div>




                                                      <div class="col-md-12 form-group"> 
                          
                                                                  <h5 class="text-center mb-10">Branch Contact Details</h5>
                                                                    <div class="row" style="  background-color: #f6f6f6;">
                                                                      <div class="col-md-4 bor">Type  </div>
                                                                      <div class="col-md-4 bor">Details   </div>
                                                                      <div class="col-md-4 bor"> Display in Print</div>
                                                                    </div>
                                                                    <?php
                                                                      include('database_connection.php');
                                                                       $statement = $connect->prepare( "SELECT * FROM `branch_telephone` where branchid = '$id'"); 
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
                                                                            <div class="col-md-4 bor">'.$sub_row["type"].' </div>                                             
                                                                            <div class="col-md-4 bor">'.$sub_row["details"].'  </div>
                                                                            <div class="col-md-4 bor"> '.$sub_row['display'].'   </div>
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
    </div>
</div>
