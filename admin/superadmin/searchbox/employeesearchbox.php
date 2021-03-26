
    <div class="modal fade bs-example-modal-lg" id="searchbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="
    text-align: left;
">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Employee Search Box</h4></center>
                </div>
                <div class="modal-body">
        				
        				<div class="container-fluid">
                        	<div class="col-md-12">
                            






							                             <div class="form-group col-md-12">  

							                             	<label for="inputName" class="control-label mb-10">User Role Code</label>
                                                                 
							                              <select  tabindex="0" name="u_rolecode" class="form-control select2"  >                                 
							                                      <option  selected="" value="novalue" > </option>  <?php
							                                   include "db.php";
							                                    $result = mysqli_query($con, "SELECT * FROM role");
							                                    while ($row = mysqli_fetch_array($result)) {
							                                        echo '<option value="'.$row['role_rolecode'] . '">'. $row['role_rolecode'] .'</option>';
							                                    }
							                                    ?>
							                              </select>
							                           </div>     


							                             <div class="form-group col-md-6">  

							                             	<label for="inputName" class="control-label mb-10">Gender</label>
                                                                 
							                              <select  tabindex="0" name="gender" class="form-control select2"  >                                 
							                                      <option  selected="" value="novalue" > </option>  <?php
							                                   include "db.php";
							                                    $result = mysqli_query($con, "SELECT DISTINCT gender FROM employee");
							                                    while ($row = mysqli_fetch_array($result)) {
							                                        echo '<option value="'.$row['gender'] . '">'. $row['gender'] .'</option>';
							                                    }
							                                    ?>
							                              </select>
							                           </div>     

  													 <div class="form-group col-md-6">  

							                             	<label for="inputName" class="control-label mb-10">Working In</label>
                                                                 
							                              <select  tabindex="0" name="workingin" class="form-control select2"  >                                 
							                                      <option  selected="" value="novalue" > </option>  <?php
							                                   include "db.php";
							                                    $result = mysqli_query($con, "SELECT DISTINCT workingin FROM employee");
							                                    while ($row = mysqli_fetch_array($result)) {
							                                        echo '<option value="'.$row['workingin'] . '">'. $row['workingin'] .'</option>';
							                                    }
							                                    ?>
							                              </select>
							                           </div>     


							                     
							                           <div class="form-group col-md-6">  

							                             	<label for="inputName" class="control-label mb-10">Designation</label>
                                                                 
							                              <select  tabindex="0" name="designation" class="form-control select2"  >                                 
							                                      <option  selected="" value="novalue" > </option>  <?php
							                                   include "db.php";
							                                    $result = mysqli_query($con, "SELECT DISTINCT designation FROM employee");
							                                    while ($row = mysqli_fetch_array($result)) {
							                                        echo '<option value="'.$row['designation'] . '">'. $row['designation'] .'</option>';
							                                    }
							                                    ?>
							                              </select>
							                           </div>     
							                     



							                           <div class="form-group col-md-6">  


							                             	<label for="inputName" class="control-label mb-10">Search Joining Date of Employee </label> <br>
                                                                
							                           	 
								                            <b style="color: red">From -</b>  <input type="date" name="startdate" class="form-control" value="">  <br>

								                                  <b style="color: red"> To -  </b> <input type="date" name="enddate" class="form-control" value="">


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
    