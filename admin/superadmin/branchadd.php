<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
<?php include"db.php"; ?>

    <div class="page-wrapper">
      <div class="container-fluid">     
        <div class="row heading-bg">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Add Branch Master
            </h5>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
              <li>
                <a href="index.php">Dashboard
                </a>
              </li>
              <li>
                <a href="branchmaster.php">
                  <span>Master
                  </span>
                </a>
              </li>
              <li>
                <a href="branchmaster.php">
                  <span>Branch Setup
                  </span>
                </a>
              </li>
              <li class="active">
                <span> Add Branch Master
                </span>
              </li>
            </ol>
          </div>
        </div>

         <div class="panel panel-default border-panel card-view">

            <div class="panel-wrapper collapse in">
            <div class="panel-body">
            <form id="example-advanced-form" action="b/addnew.php" method="post" enctype="multipart/form-data" >
            <div class="row">

                <div class="form-group">
                  <div class="col-md-8"> </div>
                  <div class="col-md-4">    
                    <label for="companyname_english" class="control-label mb-10">Logo Upload <b class="txt-danger">* </b></label>
                  </div>
                  <div class="col-md-8"> </div>
                  <div class="col-md-4">
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                      <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                      <span class="input-group-addon fileupload btn btn-default btn-anim btn-file"><i class="fa fa-upload"></i> <span class="fileinput-new btn-text">Select file</span> <span class="fileinput-exists btn-text">Change</span>
                      <input type="file" name="image" id="file" required="">
                      </span> <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash"></i><span class="btn-text"> Remove</span></a>  
                    </div>
                    
                    <span><b class="txt-danger">* Image size should be 448 x 83 in PNG and Less than 20 KB</b></span>
                  </div>
                </div>






            <!-- ////////////////// -->   
            <div class="form-group col-md-3">
              <label for="companyid" class="control-label mb-10">Select Company <b class="txt-danger">* </b>
              </label>  
              <select autofocus="" name="companyid" class="form-control" data-placeholder="Choose a Company" tabindex="0">
              <?php
                
                $result = mysqli_query($con,"SELECT companyname_english,id FROM company");
                while($row = mysqli_fetch_array($result))
                {
                echo '<option value="'.$row['id'].'">' .$row['companyname_english'].'</option>';
                } 
                ?>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="branchname_english" class="control-label mb-10">Branch Name (en) <b class="txt-danger">* </b></label>
              <input type="text" name="branchname_english" class="form-control" id="branchname_english" placeholder="Enter Name  in English" required tabindex="0">
            </div>
          
            <div class="form-group col-md-3">
              <label for="branchcode" class="control-label mb-10">Branch Code <b class="txt-danger">* </b> </label> <span id="availability"></span><br />  
              <input type="text" name="branchcode" class="form-control" id="branchcode" placeholder="Enter Branch Code" required tabindex="0">
            </div>
            <script>  
              $(document).ready(function(){  
                $('#branchcode').blur(function(){
              
                  var branchcode = $(this).val();
              
                  $.ajax({
                   url:'branchcodecheck.php',
                   method:"POST",
                   data:{user_name:branchcode},
                   success:function(data)
                   {
                    if(data != '1')
                    {
                     $('#availability').html('<span class="text-success"> [Good]</span>');
                     $('#submit').attr("disabled", false);
                      
                    }
                    else 
                    {
                     $('#availability').html('<span class="text-danger"> [This Code is Alloted to Some Branch]</span>');
                     $('#submit').attr("disabled", true); 
                  
                    }
                   }
                  })
              
               });
              });  
            </script>
            <div class="form-group col-md-3">
              <label for="prifix" class="control-label mb-10">Prifix <b class="txt-danger">* </b></label>
              <input type="text"  name="prifix" class="form-control" id="prifix" placeholder="Enter Prifix" required tabindex="0">
            </div>
         
          <div class="form-group col-md-3">
      <label  class="control-label mb-10">Email Id <b class="txt-danger">* </b></label>
      <input type="text"  name="email" class="form-control"  placeholder="Enter Email Id" required tabindex="0">
    </div>  <div class="form-group col-md-3">
      <label  class="control-label mb-10">Mobile No <b class="txt-danger">* </b></label>
      <input type="text"  name="mobile" class="form-control"  placeholder="Enter Mobile No" required tabindex="0" >
    </div> 
         
            <div class="form-group col-md-3">
              <label for="status" class="control-label mb-10">Status</label> 
              <select tabindex="0" name="status" id="status" class="form-control"  >
                <option value="0">In-Active</option>
                <option value="1">Active</option>
                <option value="2">Suspend</option>
                <option value="3">Blocked</option>
                <option value="4">Dispute</option>
              </select>
            </div> 

               <div class="form-group col-md-3">
              <label for="channelpartnerid" class="control-label mb-10">Select Channel Partner <b class="txt-danger">* </b>
              </label>  
              <select autofocus="" name="channelpartnerid" class="form-control" data-placeholder="Choose a Channel Partner" tabindex="0">
              <option value="0">No Channel Partner</option><?php
                
                $result = mysqli_query($con,"SELECT *  FROM channelpartner");
                while($row = mysqli_fetch_array($result))
                {
                echo '<option value="'.$row['id'].'">' .$row['name'].'</option>';
                } 
                ?>
              </select>
            </div>


             <!-- ////////////////// -->   
            <?php
              require_once('dist/geoPlugin.php'); 
              $geoplugin = new geoPlugin();
              $geoplugin->locate(); 
              
              
              $latitude = $geoplugin->latitude;
              $longitude = $geoplugin->longitude;   
              
              
              $city = $geoplugin->city;
              $areaCode = $geoplugin->areaCode;
              $country = $geoplugin->countryName;
              ?>
            <?php
              include "db.php";            
              $result = mysqli_query($con, "SELECT id FROM branch ORDER BY id DESC LIMIT 1");
              while ($row = mysqli_fetch_array($result)) {
                  $idcount = $row['id'] + 1;    
              }
              ?>
              <input type="hidden" name="id" value="<?php echo $idcount;?>">
              <div class="form-group col-md-4">   
                <label  class="control-label mb-10">Upload Multiple IMAGES / PDF / EXCEL / PPT / WORDFILE of Branch </label>
                <input class="fileinput btn-add form-control" type="file"  name="files[]" multiple >


                    <span><b class="txt-danger">* Image size should be 974 x 648 in PNG and Less than 1 MB</b></span>
              </div> 


              

              <div class="form-group col-md-12" style="background-color:#f6f6f6;margin-top: 20px;margin-bottom: 20px;padding: 10px">
             

              <div class="form-group col-md-6">
                <label for="address" class="control-label mb-10">address <b class="txt-danger">* </b></label>
                <input name="address" type="text" class="form-control" id="address" placeholder="Enter address " tabindex="0">
              </div>
             


              <div class="form-group col-md-3">
                <label for="locationlatitude" class="control-label mb-10">Latitude Location</label>
                <input name="locationlatitude" type="text" class="form-control" id="locationlatitude" placeholder="Enter Latitude"  value="<?php echo $latitude; ?>" tabindex="0">
              </div>
              <div class="form-group col-md-3">
                <label for="locationlongitude" class="control-label mb-10">Longitude Location</label>
                <input name="locationlongitude" type="text" class="form-control" id="locationlongitude" placeholder="Enter Longitude "  value="<?php echo $longitude; ?>" tabindex="0">
              </div>
              </div>


               <!-- ////////////////// -->   
              <div class="col-md-12">
                <div  id="branchtelephonetable" width="100%">
                  <div>
                    <div id='branchtelephone0'>
                      <div class="form-group col-md-3">
                        <label for="type" class="control-label mb-10">Type
                        </label>
                        <select  name="type[]" id="type" class="form-control" data-placeholder="Choose a Company" tabindex="0">
                          <option value="Tel.">Tel.</option>
                          <option value="FAX">FAX</option>
                          <option value="Whatsapp">Whatsapp</option>
                          <option value="Email">Email</option>
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="details" class="control-label mb-10">Details
                        </label>
                        <input type="text" name="details[]" class="form-control" id="details" placeholder=" Details" tabindex="0" >
                      </div>
                      <div class="form-group col-md-3">
                        <label for="display" class="control-label mb-10">Display in Print
                        </label>
                         <select  name="display[]" id="display" class="form-control" data-placeholder="Display in Print" tabindex="0">
                            <option>Display in Print</option>
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                         </select>  
                      </div>
                      <div>
                        <div class="form-group  col-md-3 "> 
                          <label  class="control-label mb-10"> <br><br>
                          </label>   
                          <a tabindex="0" style="margin-right: 10px;" id="branch_telephone_type_add"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a> 
                          <a  id='branch_telephone_type_delete' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a> 
                        </div>
                      </div>
                    </div>
                    <div id='branchtelephone1'></div>
                    <input type="hidden" name="branch_telephone_type" id="branch_telephone_type" value="1" />
                  </div>
                </div>
              </div> 
              <!-- ////////////////// -->   
              </div>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
              <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
              <script type="text/javascript">
                $(document).ready(function(){
                  var i=1;
                 $("#branch_telephone_type_add").click(function(){
                
                  $('#branchtelephone'+i).html(" <div class='form-group col-md-12'></div>   <div><div class='form-group col-md-3'>    <select  name='type[]' id='type' class='form-control' data-placeholder='Choose a Company' tabindex='1'> <option value='Tel.'>Tel.</option>   <option value='FAX'>FAX</option><option value='Whatsapp'>Whatsapp</option><option value='Email'>Email</option></select>  </div></div> <div>   <div class=' col-md-3'><input tabindex='24' type='text' class='form-control' name='details[]' placeholder=' Details' ></div>  </div><div> <div class=' col-md-3 form-group' >    <select  name='display[]' id='display' class='form-control' data-placeholder='Display in print' tabindex='1'> <option value='YES'>YES</option>   <option value='NO'>NO</option></select></div></div>");
                
                  $('#branchtelephonetable').append('<div id="branchtelephone'+(i+1)+'"></div>');
                  i++; 
                  $('#branch_telephone_type').val(i);
                });
                 $("#branch_telephone_type_delete").click(function(){
                     if(i>1){
                     $("#branchtelephone"+(i-1)).html('');
                     i--;
                     $('#branch_telephone_type').val(i);
                     }
                 });
                                  
                });
                
              </script>
            

                 <!-- ////////////////// -->   
              <div class="col-md-12">
                <div  id="branchpincodetable" width="100%">
                  <div>
                    <div id='branchpincode0'>
                      <div class="form-group col-md-3">
                        <label for="pincode" class="control-label mb-10">pincode
                        </label>

                        <input type="text" name="pincode[]" id="pincode" class="form-control" placeholder="pincode">
                      </div>
                     
                      <div>
                        <div class="form-group  col-md-3 "> 
                          <label  class="control-label mb-10"> <br><br>
                          </label>   
                          <a tabindex="0" style="margin-right: 10px;" id="branch_pincode_type_add"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a> 
                          <a  id='branch_pincode_type_delete' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a> 
                        </div>
                      </div>
                    </div>
                    <div id='branchpincode1'></div>
                    <input type="hidden" name="branch_pincode_type" id="branch_pincode_type" value="1" />
                  </div>
                </div>
              </div> 
              <!-- ////////////////// -->   
              </div>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
              <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
              <script type="text/javascript">
                $(document).ready(function(){
                  var i=1;
                 $("#branch_pincode_type_add").click(function(){
                
                  $('#branchpincode'+i).html(" <div class='form-group col-md-12'></div>   <div><div class='form-group col-md-3'>    <input type='text' name='pincode[]' id='pincode' class='form-control' placeholder='pincode'>  </div></div>   ");
                
                  $('#branchpincodetable').append('<div id="branchpincode'+(i+1)+'"></div>');
                  i++; 
                  $('#branch_pincode_type').val(i);
                });
                 $("#branch_pincode_type_delete").click(function(){
                     if(i>1){
                     $("#branchpincode"+(i-1)).html('');
                     i--;
                     $('#branch_pincode_type').val(i);
                     }
                 });
                                  
                });
                
              </script>
            


              

              </div>
             
              </div>

              <div class="modal-footer">
                <a href="branchmaster.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a>
                <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-primary btn-rounded" />
              </form>
              </div>
              </div>
              </div>
              
              </div>
              </div>
              <!-- /Main Content -->
              </div>
              <!-- /#wrapper -->
<?php include "allscript.php"; ?>