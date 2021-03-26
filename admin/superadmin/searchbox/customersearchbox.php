
    <div class="modal fade bs-example-modal-lg" id="searchbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="
    text-align: left;
">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Customer Search Box</h4></center>
                </div>
                <div class="modal-body">
        				
        				<div class="container-fluid">
                        	<div class="col-md-12">
                            



							                     
							                           <div class="form-group col-md-6">  

							                             	<label for="inputName" class="control-label mb-10">Type of Customer</label>
                                                                 
							                              <select  tabindex="0" name="type" class="form-control select2"  >                                 
							                                      <option  selected="" value="111111111" > </option>  <?php
							                                   include "db.php";
							                                    $result = mysqli_query($con, "SELECT DISTINCT type FROM customer");
							                                    while ($row = mysqli_fetch_array($result)) {
							                                        echo '<option value="'.$row['type'] . '">'. $row['type'] .'</option>';
							                                    }
							                                    ?>
							                              </select>
							                           </div>     
							                     


							                            <div class="form-group col-md-6">  

							                             	<label for="inputName" class="control-label mb-10">Type of Customer Group</label>
                                                                 
							                              <select  tabindex="0" name="customergroup" class="form-control select2"  >                                 
							                                      <option  selected="" value="111111111" > </option>  <?php
							                                   include "db.php";
							                                    $result = mysqli_query($con, "SELECT DISTINCT customergroup FROM customer");
							                                    while ($row = mysqli_fetch_array($result)) {
							                                        echo '<option value="'.$row['customergroup'] . '">'. $row['customergroup'] .'</option>';
							                                    }
							                                    ?>
							                              </select>
							                           </div>     
							                     
   												

                          
							                          <div class="col-md-12" style="text-align: right;">  
							                            <input type="submit" class="btn btn-primary" name="search" value="Search">
							                          </div> 


                                       
                        </div>
                    </div>
                  </div>
               </div>
            </div>                                                          
         </div>
    