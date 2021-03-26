<?php include "allcss.php";?>
<?php include "header.php";?> <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<div class="page-wrapper">
  <div class="container-fluid">
    <!-- Title -->
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Add Item Master
        </h5>
      </div>
      <!-- Breadcrumb -->
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.php">Dashboard
            </a>
          </li>
          <li>
            <a href="itemmaster.php">
            <span>Master
            </span>
            </a>
          </li>
          <li>
            <a href="itemmaster.php">
            <span>Item Setup
            </span>
            </a>
          </li>
          <li class="active">
            <span> Add Item Master
            </span>
          </li>
        </ol>
      </div>
      <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->
    <!-- Row -->
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default border-panel card-view">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <form id="example-advanced-form" action="item_insert_sumit.php" method="post" enctype="multipart/form-data" >
                <?php
                  include "db.php";
                  $result = mysqli_query($con, "SELECT * FROM products ORDER BY id DESC LIMIT 1");
                  while ($row = mysqli_fetch_array($result)) {
                      $abc = $row['id'] + 1;
                  }
                  ?> 
                <div class="form-group col-md-2"> 
                  <label  class="control-label mb-10" >Item Code <b class="txt-danger">* </b>
                  </label>
                  <input tabindex="0" type="text" name="id" class="form-control"  placeholder="Enter Item Code" value="<?php echo $abc; ?>" required="" readonly="">
                </div>
                <div class="form-group col-md-4">
                  <label  class="control-label mb-10">Item Name (En) <b class="txt-danger">* </b>
                  </label>
                  <input autofocus="" tabindex="0" type="text" name="name" id="txtEnglish" class="form-control"  placeholder="Enter Item Name in English" required="">
                </div> 
                        
                <div class="col-md-3">  
                  <label  class="control-label mb-10">Main Image </label>
                   <input class="fileinput btn-add form-control" type="file" id="file" name="image"  >
                    <span><b class="txt-danger">* Image size should be 480 x 480 in 'jpeg', 'jpg', 'png', 'gif', 'PNG', 'JPG', 'JPEG' and Less than 150 KB</b></span>
                 </div>

                <div class="form-group col-md-3">   
                  <label  class="control-label mb-10">Add Multiple Images  </label>
                  <input class="fileinput btn-add form-control" type="file"  name="files[]" multiple ><span><b class="txt-danger">* Image size should be 480 x 480 in 'jpeg', 'jpg', 'png', 'gif', 'PNG', 'JPG', 'JPEG' and Less than 150 KB</b></span>
                </div>

              


                <div class="form-group col-md-12" style="padding: 5px"></div>
               
                      <div  id="itemdetails" class="tab-pane fade active in  mt-30" role="tabpanel">
                        <div class="form-group">


                        <div class="form-group col-md-3">
                          <label  class="control-label mb-10">Main Category <b class="txt-danger">* </b>
                          </label>



                          <select name="maincat" id="three" class="form-control select2" required="">
                            <option>Select Main Category</option>
                             <?php

                            include"db.php";

                            $result = mysqli_query($con,"SELECT * FROM menu where parent_id = 0");
                            while($row = mysqli_fetch_array($result))
                            {
                            echo '<option value="' .$row['menu_id'].'">' .$row['menu_name'].'</option>';
                            } 
                            ?>

                        </select>


                        </div>
                      
                        <div class="form-group col-md-3">
                          <label  class="control-label mb-10">Sub Category
                          </label>
                          <select name="categoryid"  class="form-control select2" >
                            <option>Select Sub Category</option>
                             <?php

                              include"db.php";

                              $result = mysqli_query($con,"SELECT * FROM menu where parent_id != 0");
                              while($row = mysqli_fetch_array($result))
                              {
                              echo '<option value="' .$row['menu_id'].'">' .$row['menu_name'].'</option>';
                              } 
                              ?>

                        </select>


                        </div>  

                         <div class="form-group col-md-2">
                            <label  class="control-label mb-10">Product Code <b class="txt-danger">* </b>
                            </label>
                            <input  tabindex="0" type="text"  name="productcode" class="form-control"  placeholder="Enter Product Code" required="">
                          </div>
                           <div class="form-group col-md-2">
                            <label  class="control-label mb-10">Sale 
                            </label>
                              <select name="sale"  class="form-control select2" >
                              
                                <option value="notinsale">notinsale</option>      <option value="sale">sale</option>                         
                              </select>

                          </div>   
                          <div class="form-group col-md-2"> 
                            <label  class="control-label mb-10" >Stock <b class="txt-danger">* </b>
                            </label>
                            <input  type="text" name="stock" class="form-control"  placeholder="Enter Stock" value="" required="">
                          </div>



                       
                         

                          <div class="form-group col-md-3">
                            <label  class="control-label mb-10">Trending / Monthly Essentials
                            </label>
                             <select name="newold"  class="form-control select2" >
                                <option value=""></option> 
                                <option value="Trending">Trending</option> 
                                <option value="Monthly Essentials">Monthly Essentials</option>   
                                                        
                              </select>
                          </div>


                           <div class="form-group col-md-3">
                            <label  class="control-label mb-10">Premium / Regular
                            </label>
                             <select name="pr"  class="form-control select2" >
                                <option value="Regular">Regular</option>   
                                <option value="Premium">Premium</option>                          
                              </select>
                          </div> 


                          <div class="form-group col-md-2" style="display:none;">
                            <label  class="control-label mb-10">HSNcode <b class="txt-danger">* </b>
                            </label>
                            <input  tabindex="0" type="text"  name="hsncode" class="form-control"  placeholder="Enter HSNcode" >
                          </div>
                          <div class="form-group col-md-2" style="display:none;">
                            <label  class="control-label mb-10">GST <b class="txt-danger">* </b>
                            </label>
                            <input  tabindex="0" type="text"  name="gst" class="form-control"  placeholder="Enter gst" >
                          </div> 
                         
                          <div class="form-group col-md-3">
                            <label  class="control-label mb-10">Status <b class="txt-danger">* </b>
                            </label>
                             <select name="status"  class="form-control select2" required="">
                                <option value="1">Active</option> 
                                <option value="0">Inactive</option>                            
                              </select>
                          </div>


                        
                          <div class="col-md-12"> </div>

                        </div>
                      </div>
                    
                    
                     <div class="col-md-12"> </div> 

                        <div class="col-md-10">
                          <div class="row">
                            <table  id="unit" width="100%">
                              <tbody>
                                <tr id='unitrow0'>
                                   

                                    <td width="15%">
                                    <div class="form-group col-md-12">
                                      <label  class="control-label mb-10"> Nos </label>
                                      <input tabindex="" type="text"   name="qty[]" class="form-control" id="qty0" placeholder="Enter Nos " >
                                    </div>
                                  </td>
                                 
                                    <td width="15%">
                                      <div class="form-group col-md-12">
                                        <label  class="control-label mb-10"> units </label>
                                        <select name="units[]" class="form-control" id="units0" placeholder="Enter Unit " >
                                          <option value="KG">KG</option>
                                          <option value="GM">GM</option>
                                          <option value="LTR">LTR</option>
                                          <option value="PC">PC</option>
                                          <option value="BUN">BUN</option>
                                        </select>
                                      </div>
                                    </td>
                                  
                                  <td>
                                    <div class="form-group col-md-12">
                                      <a style="margin-right: 10px;" tabindex="25" id="unit_add_row"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a>
                                      <a  id='unit_delete_row' class="btn btn-danger btn-icon-anim btn-circle"><i style="margin-top: 12px" class="fa fa-trash" aria-hidden="true"></i></a>
                                      <!--<a style="margin-right: 10px;" id="cal"   class="btn btn-default btn-icon-anim btn-circle"><i  style="margin-top: 12px;"  class="fa fa-plus" aria-hidden="true"></i></a>
                                        -->
                                    </div>
                                  </td>
                                </tr>
                                <tr id='unitrow1'></tr>
                                <!-- Barcode Count suppose to be hidden --> <input type="hidden" name="total_unit" id="total_unit" value="1" /><!-- Barcode Count  -->
                              </tbody>
                            </table>
                          </div>
                        </div> <div class="col-md-12">
                          <b style="color:red;font-size: 15px">Note - 100 gm = 0.1, 1 kg = 1.0 , 5 kg = 5.0 </b> <br><Br>
                            </div>
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
                        <script type="text/javascript">
                          $(document).ready(function(){
                          
                            var i=1;
                           $("#unit_add_row").click(function(){
                            $('#unitrow'+i).html("<td>   <div class='form-group col-md-12'><input tabindex='10'   name='qty[]'  type='text' placeholder='Enter qty'  class='form-control'></div></td>  <td>   <div class='form-group col-md-12'><select name='units[]' placeholder='Enter units'  class='form-control'><option value='KG'>KG</option> <option value='GM'>GM</option> <option value='LTR'>LTR</option> <option value='PC'>PC</option> <option value='BUN'>BUN</option></select></div></td>");
                          
                            $('#unit').append('<tr id="unitrow'+(i+1)+'"></tr>');
                            i++;
                            $('#total_unit').val(i);
                          });
                           $("#unit_delete_row").click(function(){
                               if(i>1){
                               $("#unitrow"+(i-1)).html('');
                               i--;
                               $('#total_unit').val(i);
                               }
                           });
                          
                          });
                          
                          
                        </script>
                       
   <div class="form-group col-md-6">
                            <label  class="control-label mb-10">Short Descriptipn
                            </label>
                            <textarea rows="4" cols="50" name="shortdescription" id="shortdescription" class="form-control"><?php echo trim($staticpages['shortdescription']) ?></textarea>
                            <script>
                              CKEDITOR.replace('shortdescription');        
                            </script>
                          </div>
                          <div class="form-group col-md-6">
                            <label  class="control-label mb-10">Long Descriptipn
                            </label>
                            <textarea rows="4" cols="50" tabindex="0" type="text"  name="description" id="description" class="form-control" ></textarea>
                           <script>
                            CKEDITOR.replace('description');        
                          </script>
                        </div>
                           <div class="form-group col-md-12  text-right"> 
                          <a href="itemmaster.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Back</span> </a>
                          <input type="submit" value="submit" name="submit" id="submit" class="btn   btn-primary btn-rounded" />
                        </div>

                    









                 
                 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Row -->
  </div>
</div>
<!-- /Main Content -->
</div>
<!-- /#wrapper -->
<?php include "allscript.php";?>
<!-- JavaScripts -->