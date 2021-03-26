<?php
  // $id = $_GET['edit_id'];
  
  //new change
  $id = empty($_GET['edit_id']) ? null : $_GET['edit_id'];
  
  if (is_null($id) or empty($id)) {
      return;
  }
  ?> 
<?php include "allcss.php"; ?>
<?php include "header.php"; ?>  
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<div class="page-wrapper">
  <div class="container-fluid">
    <!-- Title -->
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Edit Item Master
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
            <span> Edit Item Master
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
              <form id="example-advanced-form" action="item_update.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" >
                <?php
                  $_GET['edit_id'];
                  include "db.php";
                  $result = mysqli_query($con, "SELECT * FROM products WHERE id=" . $_GET['edit_id']);
                  $item = mysqli_fetch_array($result);
                  ?>
                <div class="form-group col-md-3">
                  <label  class="control-label mb-10" >Item Code <b class="txt-danger">* </b>
                  </label> 
                  <input tabindex="0" type="text" name="id" class="form-control"  placeholder="Enter Item Code" value="<?php echo trim($item['id']) ?>"  readonly=""  required="">
                </div>
                <div class="form-group col-md-9">
                  <label  class="control-label mb-10">Item Name (En) <b class="txt-danger">* </b>
                  </label>
                  <input autofocus="" tabindex="0" type="text" name="name" class="form-control" id="txtEnglish" placeholder="Enter Item Name in English" value="<?php echo trim($item['name']) ?>"  required="">
                </div>

              

             
                <div class="">
                 

                        <div class="form-group col-md-3">
                          <label  class="control-label mb-10">Main Category <b class="txt-danger">* </b>
                          </label>

                            <select name="maincat" id="three" class="form-control" required="">

                               <?php

                              include"db.php";

                              $maincatt = $item['maincat'];

                              $result = mysqli_query($con,"SELECT * FROM menu where menu_id = $maincatt");
                              while($row = mysqli_fetch_array($result))
                              {
                              echo $menu_name = $row['menu_name'];
                              } 
                              ?>

                                 <option value="<?php echo trim($item['maincat']) ?>"><?php echo trim($menu_name); ?></option>   
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

                            <select name="categoryid" id="twenty" class="form-control" > 


                               <?php

                              include"db.php";

                              $catt = $item['categoryid'];

                              $result = mysqli_query($con,"SELECT * FROM menu where menu_id = $catt");
                              while($row = mysqli_fetch_array($result))
                              {
                              echo $menu_name = $row['menu_name'];
                              } 
                              ?>


                                <option value="<?php echo trim($item['categoryid']) ?>"><?php echo trim($menu_name); ?></option>   


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
                            <input  required=""  tabindex="0" value="<?php echo trim($item['productcode']) ?>" type="text"  name="productcode" class="form-control"  placeholder="Enter Product Code" >
                          </div>

                           <div class="form-group col-md-2">
                            <label  class="control-label mb-10">Sale 
                            </label>
                              <select name="sale"  class="form-control select2" >
                                <option value="<?php echo trim($item['sale']) ?>"><?php echo trim($item['sale']); ?></option>   

                                  <?php if(trim($item['sale']) == 'sale')
                                {
                                  echo '<option value="notinsale">notinsale</option>';
                                } 
                                else if(trim($item['sale']) == 'notinsale')
                                {
                                   echo ' <option value="sale">sale</option>   ';
                                }
                                else
                                {  echo '  <option value="sale">sale</option>  ';
                                 echo ' <option value="notinsale">notinsale</option> '; 
                               
                                } 
                                ?>
                                
                                
                                                        
                              </select>

                          </div> 
  <div class="form-group col-md-2"> 
                  <label  class="control-label mb-10" >Stock<b class="txt-danger">* </b>
                  </label>
                  <input  required="" type="text" name="stock" class="form-control"  placeholder="Enter Stock"  value="<?php echo trim($item['stock']) ?>">
                </div>



                    



                              <div class="form-group col-md-3">
                            <label  class="control-label mb-10">Trending / Monthly Essentials 
                            </label>

                            <select name="newold"  class="form-control select2" >
                                <option value="<?php echo trim($item['newold']) ?>"><?php echo trim($item['newold']) ?></option>

                                   <?php if(trim($item['newold']) == 'Trending')
                                {
                                 echo '<option value=""></option>';  echo '<option value="Monthly Essentials">Monthly Essentials</option>'; 
                                } 
                                else if(trim($item['newold']) == 'Monthly Essentials')
                                {
                                  echo '<option value=""></option>';  echo ' <option value="Trending">Trending</option>  ';
                                }
                                else
                                {echo '<option value=""></option>';   echo ' <option value="Trending">Trending</option>   ';
                                 echo '<option value="Monthly Essentials">Monthly Essentials</option>'; 
                                
                               
                                } 
                                ?>

                               
                                                               
                              </select>
                          
                          </div> 


                           <div class="form-group col-md-3">
                            <label  class="control-label mb-10">Premium / Regular
                            </label>
                              <select name="pr"  class="form-control select2" >
                                <option value="<?php echo trim($item['pr']) ?>"><?php echo trim($item['pr']) ?></option>

                                <?php if(trim($item['pr']) == 'Regular')
                                {
                                  echo '<option value="Premium">Premium</option>  ';
                                } 
                                else if(trim($item['pr']) == 'Premium')
                                {
                                   echo '<option value="Regular">Regular</option>';
                                }
                                else
                                {  echo '  <option value="Regular">Regular</option>   ';
                                 echo '<option value="Premium">Premium</option>'; 
                               
                                } 
                                ?>

                                                            
                              </select>
                          </div> 


                             <div class="form-group col-md-2" style="display: none">
                            <label  class="control-label mb-10">HSNcode 
                            </label>
                            <input  tabindex="0" type="text" value="<?php echo trim($item['hsncode']) ?>" name="hsncode" class="form-control"  placeholder="Enter HSNcode" >
                          </div>


                           <div class="form-group col-md-2" style="display: none">
                            <label  class="control-label mb-10">GST
                            </label>
                            <input  tabindex="0" type="text"  name="gst" class="form-control" value="<?php echo trim($item['gst']) ?>"  placeholder="Enter gst" >
                          </div> 
                         
                          <div class="form-group col-md-2">
                            <label  class="control-label mb-10">Status <b class="txt-danger">* </b>
                            </label>
                            <select  required="" name="status"  class="form-control select2" >
                               <option value="<?php echo trim($item['status']) ?>">
                                <?php if(trim($item['status']) == 1)
                                {
                                  echo 'Active';
                                } 
                                else
                                {
                                   echo 'Inactive';
                                }
                                  ?>
                                </option>

                                <?php if(trim($item['status']) == 1)
                                {
                                  echo ' <option value="0">Inactive</option>   ';
                                } 
                                else if(trim($item['status']) == 2)
                                {
                                   echo '<option value="1">Active</option>';
                                }
                                else
                                {
                                 echo '<option value="1">Active</option>'; 
                                 echo ' <option value="0">Inactive</option>   ';
                                } 
                                ?>
                                                          
                              </select>
                         
                          </div>


                     

                        <div class="form-group">
                         
                          <div class="col-md-12"> </div>
                          <div class="col-md-6"><label for="companyname_english" class="control-label mb-10">Profile Upload <b class="txt-danger">* </b></label>
                            <img src="../../media/products/<?php echo trim($item['img']) ?>" height="100" width="100" />
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                              <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                              <span class="input-group-addon fileupload btn btn-default btn-anim btn-file"><i class="fa fa-upload"></i> <span class="fileinput-new btn-text">Update file</span> <span class="fileinput-exists btn-text">Change</span>
                              <input type="file" name="user_image" id="file"  accept="image/*">
                              </span> <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash"></i><span class="btn-text"> Remove</span></a> 
                            </div>
                            <span><b class="txt-danger">* Image size should be 480 x 480 and Less than 1 MB</b></span>                                                             
                          </div>
                        </div>
                      </div>
                    
                    
                       <div class="form-group col-md-12  " style="    margin-top: 50px;"> 

                        <div class="col-md-10">
                          <div class="row">
                            <table  id="unit" width="100%">
                              <tbody>

                                <tr>
                                  <td>Qty</td>
                                  <td>Units</td>
                                  <td>
                                    <a id='unit_add_row'  style='margin-top:-55px' class='btn btn-default btn-icon-anim btn-circle'><i  style='margin-top: 12px;'  class='fa fa-plus' aria-hidden='true'></i></a>
                                  </td>
                                </tr>
                                <?php
                                  include "db.php";
                                  $result = mysqli_query($con, "SELECT * FROM productvariant WHERE productid=" . $_GET['edit_id']);
                                  $totalContact = mysqli_num_rows($result);
                                  $first_row = true;
                                  while ($dr_mob = mysqli_fetch_array($result)) {
                                  ?>



                                <tr id='unitrow0'>
                                  
                                
                                  <td width="15%">

                                 <input type="hidden" name="address_id[]" value="<?php echo $dr_mob['id']; ?>" />

                                    <div class="form-group col-md-12">
                                      <input tabindex="" type="text"  name="qty[]" class="form-control" id="nos0" placeholder="Enter qty " value="<?php echo $dr_mob['qty']; ?>">
                                    </div>
                                  </td>
                                   <td width="15%">
                                    <div class="form-group col-md-12">
                                      <input tabindex="" type="text"  name="units[]" class="form-control" id="type0" placeholder="Enter units " value="<?php echo $dr_mob['units']; ?>">
                                      
                                    </div>
                                  </td>
                                  <td>
                                      <a style='margin-top:-55px' id='unit_delete_row' class='btn btn-danger btn-icon-anim btn-circle unit_delete_row' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
                                  </td>
                                </tr>
                                <?php }?>
                                <tr id='unitrow1'></tr>
                                <!-- Barcode Count suppose to be hidden -->   
                                <input type="hidden" name="total_unit" id="total_unit" value="<?php echo $totalContact; ?>"  /><!-- Barcode Count  -->
                              </tbody>
                            </table>
                          </div>
                        </div>    <div class="col-md-12">
                          <b style="color:red;font-size: 15px">Note - 100 gm = 0.1, 1 kg = 1.0 , 5 kg = 5.0 </b> <br><Br>
                            </div>
                        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
                        <script type="text/javascript">
                          $(document).ready(function()  {
                            // new change
                            $("#unit_add_row").click(function()  {
                              let i = Number($("#total_unit").val());
                          
                              $("#unit tbody").append(`
                                <tr id='doctortelephone${j=++i}'>
                                  
                                  <td>
                                    <div class='form-group col-md-12'>
                          
                                    <input type='text' class='form-control' name='qty[]' id='inputName' placeholder='qty' />
                                    </div>
                                  </td>
                                 <td>
                                    <div class='form-group col-md-12'>

                            <select name='units[]' placeholder='Enter units'  class='form-control'><option value='KG'>KG</option> <option value='GM'>GM</option> <option value='LTR'>LTR</option> <option value='PC'>PC</option> <option value='BUN'>BUN</option></select>

                                    </div>
                                  </td>
                                 
                                  <td>
                          
                                   <a style='margin-top:-55px' id='unit_delete_row' class='btn btn-danger btn-icon-anim btn-circle unit_delete_row' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
                          
                                  
                                   </td>
                                </tr>`);
                              $('#total_unit').val(++i);
                            });
                            $("#unit tbody").on("click", ".unit_delete_row", function() {
                              let telephone_id = $(this).parent().parent().first().children().children().first().val();
                          
                              if (telephone_id) {
                                $.ajax({
                                  url: window.location.origin + '/frubji/admin/superadmin/masterdelete/item_delete.php?type=variant&id=' + telephone_id,
                                  type: "GET",
                                  success: function(result) {
                                    window.alert("Item Unit removed");
                                    window.setTimeout(function() {
                                      window.location.href = window.location.href + "#contactinformation";
                                      window.location.reload(true);
                                    }, 0);
                                  }
                                });
                              } else {
                                $(this).parent().parent().remove();
                                let i = Number($("#total_unit").val());
                                $('#total_unit').val(--i);
                              }
                            });
                          });  
                          
                          
                        </script> 
                      </Br>
                    </div>

                    
                     

                        <div class="form-group col-md-6">
                          <label  class="control-label mb-10">Short Descriptipn
                          </label>
                          <textarea rows="4" cols="50"  name="shortdescription" id="shortdescription" class="form-control"><?php echo trim($item['shortdescription']) ?></textarea>
                          <script>
                            CKEDITOR.replace('shortdescription');        
                          </script>
                        </div>
                        <div class="form-group col-md-6">
                          <label  class="control-label mb-10">Long Descriptipn
                          </label>
                          <textarea rows="4" cols="50"  tabindex="0" type="text"  name="description" id="description" class="form-control" ><?php echo trim($item['description']) ?></textarea>
                          <script>
                            CKEDITOR.replace('description');        
                          </script>
                        </div>
                      
                    
                       <div class="form-group col-md-12  text-right"> 
                          <a href="itemmaster.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a>
                          <input type="submit" value="Update" name="submit" id="submit" class="btn   btn-primary btn-rounded" />
                        </div>

                     
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Row --> 
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default border-panel card-view">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <!-- BULK IMAGE UPLOAD CODE-->      
              <?php $id = $_GET['edit_id']; ?>
              <form action="bulkimageupload/itemsubimgupload.php" method="post" enctype="multipart/form-data">
                <div class="form-group col-md-12">
                  <div class="seprator-block"></div>
                  <h6 style="font-size: 20px;color: #2196F3;" class="flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-calendar-note mr-10"></i>Add Multiple IMAGES Of Items</h6>
                  <hr class="light-grey-hr">
                </div>
                <div class="col-md-4 form-group">
                  <input type="hidden" name="idd" value="<?php echo $id = $_GET['edit_id']; ?> ">
                  <input type="file" name="files[]" class="form-control " multiple >       <span><b class="txt-danger">* Image size should be 480 x 480 and Less than 1 MB</b></span>  
                </div>
                <div class="col-md-3 form-group">
                  <input  class="btn btn-primary btn-rounded btn-lable-wrap left-label" type="submit"  name="submit" value="Add" />
                </div>
              </form>
              <?php
                //index.php
                include "db.php";
                
                $id = $_GET['edit_id'];
                
                $query = "SELECT * FROM productimages where idd = $id";
                $result = mysqli_query($con, $query);
                ?>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
              <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
              <?php
                if(mysqli_num_rows($result) > 0)
                {
                ?> 
              <div class="col-md-12">
                <?php 
                  $count=0;
                  
                  while($row = mysqli_fetch_array($result))
                  {
                  $count++;
                  ?>
                <div class="col-md-2 text-center" id="<?php echo $row["id"]; ?>" >
                  <?php  
                    $a = explode(".", $row["file_name"]); 
                    $a['1'];  
                    
                    if($a['1'] == 'jpg' || $a['1'] == 'png' || $a['1'] == 'jpeg' || $a['1'] == 'gif' || $a['1'] == 'JPEG' || $a['1'] == 'PNG')
                    {
                      echo   '<img width="100px" src="../media/item/'.$row["file_name"].'"> <Br> IMAGE ';
                    }
                    else if ($a['1'] == 'pdf') {
                      echo   '<a target="_blank" href="../media/item/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-pdf-o txt-danger"> </i> </a><Br> PDF ';  
                    } 
                    else if ($a['1'] == 'docx') {
                      echo   '<a target="_blank" href="../media/item/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-word-o txt-primary"> </i> </a><Br> DOC ';  
                    } 
                    
                    else if ($a['1'] == 'xls' ||  $a[1] == 'xlsx') {
                      echo   '<a target="_blank" href="../media/item/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-excel-o txt-success"> </i> </a><Br> EXCEL ';  
                    } 
                      else if ($a['1'] == 'pptx' || $a[1] == 'ppt') {
                      echo   '<a target="_blank" href="../media/item/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-powerpoint-o txt-info"> </i> </a><Br> PPT ';  
                    } 
                    
                    
                    else if ($a['1'] == 'mp4' || $a['1'] == 'avi' || $a['1'] == 'mov') {
                      echo '<video width="170" height="auto" controls>
                            <source src="../media/item/'.$row["file_name"].'" type="video/mp4">
                            </video> <Br> VIDEO';
                    }
                    ?>  
                  <br>
                  <div class="checkbox checkbox-danger">
                    <input id="checkbox<?php echo $count; ?> "  class="delete_customer" value="<?php echo $row["id"]; ?>" type="checkbox"   name="id[]">
                    <label for="checkbox<?php echo $count; ?> ">  </label>
                  </div>
                  <span data="<?php echo $row['id'];?>" class="status_checks btn-sm label <?php echo ($row['status'])? 'label-success' : 'label-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></span> &nbsp;&nbsp; 
                  <br>
                  <br>
                </div>
                <?php
                  }
                  ?> 
                <!-- ACTIVE AND INACTIVE KA CODE -->
                <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
                <script type="text/javascript">
                  $(document).on('click','.status_checks',function(){
                  var status = ($(this).hasClass("label-success")) ? '0' : '1';
                  var msg = (status=='0')? 'Deactivate' : 'Activate';
                  if(confirm("Are you sure to "+ msg)){
                    var current_element = $(this);
                    url = "bulkimageupload/itemimagesactive.php";
                    $.ajax({
                    type:"POST",
                    url: url,
                    data: {id:$(current_element).attr('data'),status:status},
                    success: function(data)
                      {   
                        location.reload();
                      }
                    });
                    }      
                  });
                </script>
                <!-- ACTIVE AND INACTIVE KA CODE --> 
              </div>
              <div class="col-md-12">
                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger btn-rounded">Delete</button>
              </div>
              <?php
                }
                else
                {
                 echo '<div class="col-md-12 "> <B>No Images Found</b></div>';
                }
                ?>
              <script>
                $(document).ready(function(){
                 
                 $('#btn_delete').click(function(){
                  
                  if(confirm("Are you sure you want to delete this?"))
                  {
                   var id = [];
                   
                   $(':checkbox:checked').each(function(i){
                    id[i] = $(this).val();
                   });
                   
                   if(id.length === 0) //tell you if the array is empty
                   {
                    alert("Please Select atleast one checkbox");
                   }
                   else
                   {
                    $.ajax({
                     url:'bulkimageupload/itemsubimagedelete.php',
                     method:'POST',
                     data:{id:id},
                     success:function()
                     {
                      for(var i=0; i<id.length; i++)
                      {
                       $('div#'+id[i]+'').css('background-color', '#ccc');
                       $('div#'+id[i]+'').fadeOut('slow');
                      }
                     }
                     
                    });
                   }
                   
                  }
                  else
                  {
                   return false;
                  }
                 });
                 
                });
              </script>
              <!-- BULK IMAGE UPLOAD CODE-->     
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /Main Content -->
</div>
<!-- /#wrapper -->
<?php include "allscript.php"; ?>
<!-- JavaScripts -->