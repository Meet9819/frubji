
    <div class="modal fade bs-example-modal-lg" id="view<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Company</h4></center>
                </div>
                <div class="modal-body">                

                        <?php 
                        include('conn.php');
                        $view=mysqli_query($conn,"SELECT * from company where id='".$row['id']."'");
                        $erow=mysqli_fetch_array($view); 
                        $id = $erow['id'];
                        
                        ?> 
                    
                  <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">                           
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-wrap">

                                                            <div class="form-group col-md-4">
                                                                    <label for="inputName" class="control-label mb-10">Company Name (en)</label>
                                                                    <input type="text" name="companyname_english" class="form-control" id="inputName" placeholder="Enter Name  in English" required readonly="" value="<?php echo $erow['companyname_english']; ?>">
                                                                </div> 


                                                          

                                                                <div class="form-group col-md-4">
                                                                    <label for="inputName" class="control-label mb-10">Company Code</label> 
                                                                    <input type="text" name="companycode" class="form-control" id="inputName" placeholder="Enter Company Code" required readonly="" value="<?php echo $erow['companycode']; ?>">
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="inputName" class="control-label mb-10">Prifix</label>
                                                                    <input type="text" name="prifix" class="form-control" id="inputName" placeholder="Enter Prifix" required readonly="" value="<?php echo $erow['prifix']; ?>">
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
                                                                    <input name="street" type="text" class="form-control" id="inputName" placeholder="Enter Street " required readonly="" value="<?php echo $erow['address']; ?>">
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
                          
                                                                  <h5 class="text-center mb-10">Company Contact Details</h5>
                                                                    <div class="row" style="  background-color: #f6f6f6;">
                                                                      <div class="col-md-4 bor">Type  </div>
                                                                      <div class="col-md-4 bor">Details   </div>
                                                                      <div class="col-md-4 bor"> Display in Print</div>
                                                                    </div>
                                                                    <?php
                                                                      include('database_connection.php');
                                                                       $statement = $connect->prepare( "SELECT * FROM `company_telephone` where companyid = '$id'"); 
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

                            
    
                                                           <?php
                                                            $lat = $erow['locationlatitude'];
                                                            $lon = $erow['locationlongitude'];

                                                            $streetname = $erow['streetname'];
                                                            ?>

                                                            <div class="form-group col-md-12" id='Map<?php echo $couunt; ?>' style='height:180px;'></div>
                                                              <?php echo  " 
                                                              <script>
                                                                  function initialize() {
                                                                      var mapAttr = { 
                                                                          
                                                                          center: new google.maps.LatLng($lat,$lon),
                                                                          zoom: 14,
                                                                          mapTypeId: google.maps.MapTypeId.ROADMAP 
                                                                      };
                                                                      var map = new google.maps.Map(document.getElementById('Map".$couunt."'), mapAttr);


                                                                      var marker = new google.maps.Marker({
                                                                            position: new google.maps.LatLng($lat,$lon),
                                                                            map: map,
                                                                            title: '$streetname'
                                                                        });
                                                                  }

                                                                  google.maps.event.addDomListener(window, 'load', initialize);
                                                              </script> 
                                                              "; ?>


             



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
 </div>
