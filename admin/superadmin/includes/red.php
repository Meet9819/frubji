  <div  class="pills-struct "> 
                        <ul role="tablist" class="nav nav-pills" id="myTabs_6">
                          <li class="active"  role="presentation" id="wi">
                            <a aria-expanded="true" id="pad1" data-toggle="tab" role="tab" id="home_tab_6" href="#personalinformation" >Sales Target
                            </a>
                          </li>
                          <li role="presentation" class="" id="wi">
                            <a  data-toggle="tab"  role="tab" href="#contactinformation" aria-expanded="false" id="pad2"> Purchase Target
                            </a>
                          </li> 
                          <li role="presentation" class=""  id="wi">
                            <a  data-toggle="tab"  role="tab" href="#grouptarget" aria-expanded="false"  id="pad3">Group Targt
                            </a>
                          </li>
                       
                        </ul>





                

                        <div class="tab-content " id="myTabContent_6" >
                      
                          <div  id="personalinformation" class="tab-pane fade active in  mt-30" role="tabpanel">






                                            <div class="row">                              
                                                <div class="col-md-12">                                    
                                                   
                                                            <div class="form-wrap"> 

                                                               <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Date</label>                                                   
                                                                </div>  

                                                                <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Branch</label>
                                                   
                                                                </div>  
                                                                <div class="form-group col-md-2">
                                                                    <label  class="control-label mb-10">Branch Name</label>
                                                   
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Status</label>
                                                   
                                                                </div>  
                                                                   <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Pre Yr Tgt</label>
                                                                    
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Pre Yr Sale</label>
                                                                 
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Recom Tgt</label>
                                                                   
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Sale Rise %</label>
                                                                   
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">New Target</label>
                                                                  
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Porfit Tgt %</label>
                                                                   
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Porfit Tgt</label>
                                                                   
                                                                </div>  

                                                                
                                                             
                                        
                                                              <?php
                                                                  include('conn.php');
                                                                  $query=mysqli_query($conn,"SELECT * from branch where costingstatus = 'PROFIT'");
                                                                  $count = 0;
                                                                  while($row=mysqli_fetch_array($query)){
                                                                  $count++;
                                                                ?>

                                                               <div class="form-group col-md-1">                       
                                                                    <input type="text" name="startdate[]" id = "st<?php echo $count; ?>"class="form-control" >
                                                                </div>                                                                  

                                                                <div class="form-group col-md-1">                           
                                                                    <input type="text" name="branch[]" class="form-control" value="<?php echo $row['branchcode']; ?>" style="background-color: #ffe000;">
                                                                </div>  

                                                                  <div class="form-group col-md-2">
                                                                    <input type="text" class="form-control" value="<?php echo $row['branchname_english']; ?>" style="background-color: #ffe000;">
                                                                </div> 

                                                                   <div class="form-group col-md-1">

                                                                   <?php if($row['status'] = '1') {
                                                                    echo '     <input type="text" name="" class="form-control" value="Active" style="background-color: #ffe000;">';
                                                                   } else {
                                                                    echo '     <input type="text" name="" class="form-control" value="Inactive" style="background-color: #ffe000;">';
                                                                   } ?>                          
                                                               
                                                                </div>  

                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="previousyeartarget[]" class="form-control" value="50000" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="previousyearsale[]" class="form-control" value="45000" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="recommendtarget[]" class="form-control" value="60000" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="salerisepercent[]" class="form-control" value="10%" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="amount[]" id = 'stnwamt<?php echo $count; ?>' class="form-control" value="">
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="profittargetpercent[]" id ='stprofper<?php echo $count; ?>'class="form-control" >
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="profittarget[]" id='stperamt<?php echo $count; ?>' readonly="" class="form-control" >
                                                                </div>   


                                                               <input type="hidden" name="customer_telephone_type" id="customer_telephone_type" value="<?php echo $count; ?>" /><!-- Count  -->

                                                              
                                                                <?php 
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>






                                                    <div class="row">                              
                                                      <div class="col-md-12">                                    
                                                                <div class="col-md-4"></div>
                                                                <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10"></label>
                                                                </div>  

                                                                <div class="form-group col-md-2">
                                                                    <label  class="control-label mb-10">Previous Year Sale Target</label>
                                                                </div> 
                                                                  <div class="form-group col-md-2">
                                                                    <label  class="control-label mb-10">Previous Year Sale </label>
                                                                </div> 
                                                                 <div class="col-md-12"></div>
                                                          
                                                                    <?php
                                                                        include('conn.php');
                                                                        $query=mysqli_query($conn,"SELECT * from company");
                                                                        $count = 0;
                                                                        while($row=mysqli_fetch_array($query)){
                                                                        $count++;
                                                                      ?>
                                                                      <div class="form-group col-md-4"></div>
                                                                      <div class="form-group  col-md-1">
                                                                        <input style="background-color: red;color: white" type="text" class="form-control" value="<?php echo $row['shortname']; ?>" name="">
                                                                      </div>  

                                                                      <div class="form-group  col-md-2">
                                                                          <input style="background-color: red;color: white" type="text" class="form-control"  name="">
                                                                      </div>   

                                                                         <div class="form-group  col-md-2">
                                                                          <input style="background-color: red;color: white" type="text" class="form-control"  name="">
                                                                      </div>  

                                                                       <div class="form-group  col-md-12"></div>
                                                                  <?php  
                                                                  }
                                                                    ?>
                                                          
                                                        
                                                                
                                        
                                                          </div>
                                                        </div>




                               </div>


                                                      



                               <div  id="contactinformation" class="tab-pane fade mt-30" role="tabpanel">
                        





                                            <div class="row">                              
                                                <div class="col-md-12">                                    
                                                   
                                                            <div class="form-wrap"> 

                                                               <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Date</label>                                                   
                                                                </div>  

                                                                <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Branch</label>
                                                   
                                                                </div>  
                                                                <div class="form-group col-md-3">
                                                                    <label  class="control-label mb-10">Branch Name</label>
                                                                </div> 
                                                                 
                                                                <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">New Target</label>
                                                                  
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Pur Tgt %</label>
                                                                   
                                                                </div> 
                                                                   <div class="form-group col-md-2">
                                                                    <label  class="control-label mb-10">Pur Tgt</label>
                                                                   
                                                                </div>    <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Pur Profit Tgt %</label>
                                                                   
                                                                </div> 
                                                                   <div class="form-group col-md-2">
                                                                    <label  class="control-label mb-10">Pur Profit Tgt</label>
                                                                   
                                                                </div>  


                                                      <div class="col-md-12"></div>
                                                                
                                                             
                                        
                                                              <?php
                                                                  include('conn.php');
                                                                  $query=mysqli_query($conn,"SELECT * from branch where costingstatus = 'PROFIT'");
                                                                  $count = 0;
                                                                  while($row=mysqli_fetch_array($query)){
                                                                    $count++;
                                                                      ?>

                                                               <div class="form-group col-md-1">                       
                                                                    <input type="text" readonly="" id = "pt<?php echo $count; ?>"class="form-control" >
                                                                </div> 

                                                                <div class="form-group col-md-1">                           
                                                                    <input type="text" class="form-control" value="<?php echo $row['branchcode']; ?>" style="background-color: #ffe000;">
                                                                </div>  

                                                                   <div class="form-group col-md-3">
                                                                    <input type="text" class="form-control" value="<?php echo $row['branchname_english']; ?>" style="background-color: #ffe000;">
                                                                </div> 

                                                                   <div class="form-group col-md-1">
                                                                    <input type="text"  id = "ptnwamt<?php echo $count; ?>"class="form-control" value="" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="purchasetargetpercent[]" id = "ptpurprof<?php echo $count; ?>"class="form-control">
                                                                </div> 
                                                                   <div class="form-group col-md-2">
                                                                    <input type="text" name="purchasetarget[]" id= "ptpuramt<?php echo $count; ?>" class="form-control" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="purchaseprofittargetpercent[]" id="ptperper<?php echo $count; ?>" class="form-control" value="" >
                                                                </div> 
                                                                   <div class="form-group col-md-2">
                                                                    <input type="text" name="purchaseprofittarget[]"  id="ptperamt<?php echo $count; ?>" class="form-control" value="" readonly="">
                                                                </div> 
                                                                  
    <input type="hidden" name="customer_telephone_typetwo" id="customer_telephone_typetwo" value="<?php echo $count; ?>" /><!-- Count  -->


                                                              
                                                                <?php 
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>



                              
                               </div>



                                     <div  id="grouptarget" class="tab-pane fade mt-30" role="tabpanel">
                                      



                                            <div class="row">                              
                                                <div class="col-md-12">                                    
                                                   
                                                            <div class="form-wrap"> 

                                                                <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Date</label>                                                   
                                                                </div>  


                                                                <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">Branch</label>
                                                                </div> 
                                                                  <div class="form-group col-md-3">
                                                                    <label  class="control-label mb-10">Branch Name</label>
                                                                </div>                                                                  

                                                                 

                                                                <div class="form-group col-md-2">
                                                                    <label  class="control-label mb-10">Pre Yr Tgt</label>
                                                                </div> 

                                                                <div class="form-group col-md-2">
                                                                    <label  class="control-label mb-10">Pre Yr Sale</label>
                                                                </div>   

                                                                     <div class="form-group col-md-1">
                                                                    <label  class="control-label mb-10">New Target %</label>
                                                                </div>                                                                  
                                                                 
                                                               <div class="form-group col-md-2">
                                                                    <label  class="control-label mb-10">New Target</label>
                                                                </div>  

                                                                <div class="col-md-12"></div>
                                                                 
                                                          

                                                                <?php
                                                                include('conn.php');
                                                                $query=mysqli_query($conn,"SELECT * from branch where costingstatus = 'PROFIT'");
                                                                $count = 0;
                                                                while($row=mysqli_fetch_array($query)){
                                                                $count++;
                                                                ?>

                                                                 <div class="form-group col-md-1">
                                                                 
                                                                    <input type="text" readonly=""  id = "gt<?php echo $count; ?>"class="form-control" >
                                                                </div>


                                                                <div class="form-group col-md-1">
                                                                  
                                                                    <input type="text" class="form-control" value="<?php echo $row['branchcode']; ?>" style="    background-color: #ffe000;">
                                                                </div> 


                                                                <div class="form-group col-md-3">
                                                                    <input type="text"  class="form-control" value="<?php echo $row['branchname_english']; ?>" style="background-color: #ffe000;">
                                                                </div> 

                                                                   <div class="form-group col-md-2">
                                                                 
                                                                    <input type="text" class="form-control" value="50000" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-2">
                                                                 
                                                                    <input type="text"  class="form-control" value="45000" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-1">
                                                                  
                                                                    <input type="text"  class="form-control" value="100%" readonly="">
                                                                </div>    

                                                                <div class="form-group col-md-2">
                                                                  
                                                                    <input type="text" id="gtnwamt<?php echo $count; ?>" class="form-control" value="100000" readonly="">
                                                                </div> 
                                                                  
                                                                  









                                                              <div class="form-group col-md-4"></div>

                                                                <div class="form-group col-md-1 text-right">            
                                                                  <span style="background-color: #25a1f0;padding: 7px;color: white;">  FPG</span>
                                                                </div>  

                                                                    <div class="form-group col-md-2">
                                                                 
                                                                    <input type="text" class="form-control" value="40000" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-2">
                                                                 
                                                                    <input type="text"  class="form-control" value="40000" readonly="">
                                                                </div> 
                                                                  
                                                                   <div class="form-group col-md-1">
                                                                  
                                                                    <input type="text" name="fpgpercent[]" id = "gtfpgper<?php echo $count; ?>" class="form-control" value="" >
                                                                </div> 

                                                                 <div class="form-group col-md-2">
                                                               
                                                                    <input type="text" name="fpgpercentamount[]" id = "gtfpgamt<?php echo $count; ?>" class="form-control" value="" readonly="">
                                                                </div>  

                                                             



                                                                <div class="form-group col-md-4"></div>

                                                                 <div class="form-group col-md-1 text-right">        
                                                                   <span style="background-color: #25a1f0;padding: 7px;color: white;">    FME </span>
                                                                </div>  

                                                                 <div class="form-group col-md-2">
                                                                    <input type="text"  class="form-control" value="10000" readonly="">
                                                                </div> 
                                                                   <div class="form-group col-md-2">                       
                                                                    <input type="text"  class="form-control" value="50000" readonly="">
                                                                </div> 
                                                                  
                                                                   <div class="form-group col-md-1">
                                                                    <input type="text" name="fmepercent[]" id = "gtfmeper<?php echo $count; ?>" class="form-control" value="" >
                                                                </div> 

                                                                 <div class="form-group col-md-2">
                                                                    <input type="text" name="fmepercentamount[]" id="gtfmeamt<?php echo $count; ?>" class="form-control" readonly="" >
                                                                </div> 


                                                                    <div class="form-group col-md-12">  </div>  




    <input type="hidden" name="customer_telephone_typethree" id="customer_telephone_typethree" value="<?php echo $count; ?>" /><!-- Count  -->



 

<?php 
}
?>

                 
                                      <div class="form-group col-md-12 text-center" >  
                                              <input type="submit" value="SET YEARLY TARGET" name="yearlytarget" id="submit" class="btn btn-primary  btn-rounded" />
                                       </div>                                              


                                                             

                                                               

                                                                
                                                            </div>
                                                        </div>
                                                    </div>





                                    </div>

                                                         




 </div>
</div>
             