 <!-- WHICHCOMPANY START  -->
                                    <div class="col-md-1 form-group">
                                     <b>Company</b><br />
                                       <?php
                                         if ($workingin == 'ADMIN, ALLBRANCH' || $workingin == 'ADMIN') {
                                                if ($sb != '') {
                                                    if ($sb == 'FPG' || $sb == 'FME') {
                                                        ?>
                                                        <input type="text" class="form-control" value="<?php echo $sb ?>" id="whichcompany" name="whichcompany" readonly="">
                                                    <?php
                                                    } 
                                                    else if ($sb == 'ADMIN, ALLBRANCH' || $sb == 'ADMIN') {
                                                    ?>

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
                                                               
                                                    <?php
                                                    } 
                                                    else {
                                                    ?>
                                                    <input type="text" class="form-control" value="<?php echo $sbcompany ?>" id="whichcompany" name="whichcompany" readonly="">
                                                 <?php
                                                   }
                                              } 
                                              else {
                                              ?>          
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
                                              <?php
                                              }
                                      } 
                                      else if ($workingin != 'ADMIN, ALLBRANCH') {
                                           ?>
                                            <input type="text" class="form-control" value="<?php echo $sbcompany ?>" id="whichcompany" name="whichcompany" readonly="">
                                      <?php
                                     }
                                      ?>
                                  </div> 
 <!-- WHICHCOMPANY END -->


                                

                              










  
 <!-- BRANCH START  [REQUESTFROM]-->
                                  <div class="col-md-2">
                                      <b>Branch </b><br />
                                          <?php
                                             if ($workingin == 'ADMIN, ALLBRANCH' || $workingin == 'ADMIN') {
                                                if ($sb != '') {
                                                    if ($sb == 'FPG' || $sb == 'FME') {
                                                        ?> 
                                                        <select name="whichbranch"  id="requestfrom"  class="form-control select2"  data-placeholder="Choose a Branch Request " tabindex="0" autofocus="true">
                                                            <option selected="" value="" disabled="">Select Branch Request From</option>
                                                              <?php
                                                              include "db.php";

                                                              $result = mysqli_query($con, "SELECT * FROM `branch` where company_shortname = '$sb'");
                                                              while ($row = mysqli_fetch_array($result)) {
                                                               echo '<option value="' . $row['branchcode'] . '">' . $row['branchcode'] . '</option>';
                                                              }
                                                                        ?>
                                                        </select>

                                                               
                                                    <?php
                                                    } 
                                                    else if ($sb == 'ADMIN, ALLBRANCH' || $sb == 'ADMIN') {
                                                        ?>
                                                          <select name="whichbranch" id="requestfrom" class="form-control select2" data-placeholder="Choose Branch" >
                                                               <option value="">Select Branch</option>
                                                          </select>                                                                 
                                                    <?php
                                                    } 
                                                    else {
                                                    ?>
                                                   <input type="text" id="requestfrom" class="form-control" value=" <?php echo $sb ?>" name="whichbranch" readonly="">
                                                 
                                                 <?php
                                                   }
                                          } 
                                          else {
                                           ?> 
                                            <select name="whichbranch" id="requestfrom" class="form-control select2" data-placeholder="Choose Branch" >
                                                <option value="">Select Branch</option>
                                            </select>                                              
                                            <?php
                                    }
                    
                                } else if ($workingin != 'ADMIN, ALLBRANCH') {
                                     ?>
                                     <input type="text" id="requestfrom" class="form-control" value=" <?php echo $workingin ?>" name="whichbranch" readonly="">
                                    <?php
                             }
                            ?>

                                 </div>
 <!-- BRANCH START -->


 







