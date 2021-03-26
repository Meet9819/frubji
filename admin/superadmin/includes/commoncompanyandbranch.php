 <!-- WHICHCOMPANY START  -->
                                    <div class="col-md-1 form-group">
                                     <b>Company</b><br />
                                              
                                              <select name="whichcompany"  id="whichcompany"  class="form-control select2"  data-placeholder="Choose Insurance Co. "  onChange="getState(this.value);">
                                                      <option value="">Select Company</option>
                                                      <?php
                                                      foreach($results as $company) {
                                                      ?>
                                                      <option value="<?php echo $company["shortname"]; ?>"><?php echo $company["shortname"]; ?></option>
                                                      <?php
                                                      }
                                                      ?>
                                                </select>                           
                                             
                                  </div> 
 <!-- WHICHCOMPANY END -->


                                

                              










  
 <!-- BRANCH START  [REQUESTFROM]-->
                                  <div class="col-md-3">
                                      <b>Request From </b><br />
                                        

                                            <select name="requestfrom" id="requestfrom" class="form-control select2" data-placeholder="Choose Branch" >
                                                <option value="">Select Branch</option>
                                            </select>                                              
                                           
                                           

                                 </div>
 <!-- BRANCH START -->


 







