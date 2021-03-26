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
</head>
<body> 

    <!-- Main Content -->
    <div class="page-wrapper">
      <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Edit Company Master
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
                <a href="companymaster.php">
                  <span>Master
                  </span>
                </a>
              </li>
              <li>
                <a href="companymaster.php">
                  <span>Company Setup
                  </span>
                </a>
              </li>
              <li class="active">
                <span> Edit Company Master
                </span>
              </li>
            </ol>
          </div>
          <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->  
        <!-- Row --> 

    
<div class="panel panel-default border-panel card-view">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<form id="example-advanced-form" action="c/edit.php?id=<?php echo $id; ?>"  method="post" enctype="multipart/form-data" >
<div class="row">
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12">
      <div class="form-wrap">
        <?php 
          include "db.php";
          $result = mysqli_query($con, "SELECT * FROM company WHERE id=" . $_GET['edit_id']);
          $company = mysqli_fetch_array($result);
          ?> 
        <div class="form-group">
          <div class="col-md-8"> </div>
          <div class="col-md-4">    
            <label for="companyname_english" class="control-label mb-10">Logo Upload <b class="txt-danger">* </b></label>
          </div>
          <div class="col-md-8"> </div>
          <div class="col-md-4">
            <img src="../media/company/<?php echo trim($company['img']) ?>" height="70" width="70" />
            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
              <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
              <span class="input-group-addon fileupload btn btn-default btn-anim btn-file"><i class="fa fa-upload"></i> <span class="fileinput-new btn-text">Update file</span> <span class="fileinput-exists btn-text">Change</span>
              <input type="file" name="user_image" id="file"  accept="image/*">
              </span> <a href="#" class="input-group-addon btn btn-danger btn-anim fileinput-exists" data-dismiss="fileinput"><i class="fa fa-trash"></i><span class="btn-text"> Remove</span></a> 
            </div>  <span><b class="txt-danger">* Image size should be 448 x 83 in PNG and Less than 20 KB</b></span>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="companyname_english" class="control-label mb-10">Company Name (en) <b class="txt-danger">* </b></label>
          <input autofocus="" type="text" name="companyname_english" class="form-control" id="companyname_english" placeholder="Enter Name  in English" required value="<?php echo trim($company['companyname_english']) ?>" tabindex="0">
        </div>
       
        

        <div class="form-group col-md-4">
          <label for="status" class="control-label mb-10">Status</label> 
          <select tabindex="0" name="status" id="status" class="form-control"  >
            <option value="<?php echo trim($company['status']) ?>"><?php echo trim($company['status']) ?></option>
            <option value="0">In-Active</option>
            <option value="1">Active</option>
            <option value="2">Suspend</option>
            <option value="3">Blocked</option>
            <option value="4">Dispute</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="companycode" class="control-label mb-10">Company Code <b class="txt-danger">* </b></label> 
          <input type="number" name="companycode" class="form-control" id="companycode" placeholder="Enter Company Code" required value="<?php echo trim($company['companycode']) ?>" tabindex="0">
        </div>
        <div class="form-group col-md-4">
          <label for="prifix" class="control-label mb-10">Prifix <b class="txt-danger">* </b></label>
          <input type="text"  name="prifix" class="form-control" id="prifix" placeholder="Enter Prifix" required  value="<?php echo trim($company['prifix']) ?>" tabindex="0">
        </div>
       
      </div>
    </div>
  </div>
</div>



 <div class="col-md-12 form-group" style="background-color: #f6f6f6;margin-top: 20px;margin-bottom: 20px;padding: 20px">
 


  <div class="form-group col-md-6">
    <label for="area" class="control-label mb-10">address <b class="txt-danger">* </b></label>
    <input name="address" type="text" class="form-control" id="address" placeholder="Enter address " required value="<?php echo trim($company['address']) ?>" tabindex="0">
  </div>

  <div class="form-group col-md-3">
    <label for="locationlatitude" class="control-label mb-10">Latitude Location</label>
    <input name="locationlatitude" type="text" class="form-control" id="locationlatitude" placeholder="Enter Latitude"  tabindex="0" value="<?php echo trim($company['locationlatitude']) ?>">
  </div>
  <div class="form-group col-md-3">
    <label for="locationlongitude" class="control-label mb-10">Longitude Location</label>
    <input name="locationlongitude" type="text" class="form-control" id="locationlongitude" placeholder="Enter Longitude "  tabindex="0" value="<?php echo trim($company['locationlongitude']) ?>">
  </div>
</div>


<div class="col-md-12 ">
  <div class="row">
    <table  id="companyaddresstable" width="100%">
      <tbody>
        <tr>
          <td>
            <div class="col-md-12">
              <label class="control-label mb-10">Type
              </label> 
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label class="control-label mb-10">Details
              </label> 
            </div>
          </td>
          <td>
            <div class="col-md-12">
              <label class="control-label mb-10">Display
              </label> 
            </div>
          </td>
          <td>
            <a id='company_telephone_type_add'  style='margin-top:-55px' class='btn btn-default btn-icon-anim btn-circle'><i  style='margin-top: 12px;'  class='fa fa-plus' aria-hidden='true'></i></a>
          </td>
        </tr>
        <?php
          include "db.php";
          $result = mysqli_query($con, "SELECT * FROM company_telephone WHERE companyid=" . $_GET['edit_id']);
          $totalAddr = mysqli_num_rows($result);
          $first_row = true;
          while ($dr_addr = mysqli_fetch_array($result)) {
              ?>
        <tr id='companyaddress0'>
          <td>
            <!-- new change -->
            <input type="hidden" name="address_id[]" value="<?php echo $dr_addr['id']; ?>" />
            <div class="form-group col-md-12">
              <select  name="type[]" id="type" class="form-control" data-placeholder="Choose a Company" tabindex="0">
                <option value="<?php echo $dr_addr['type'] ?>"><?php echo $dr_addr['type'] ?></option>
                <option value="Tel.">Tel.</option>
                <option value="FAX">FAX</option>
                <option value="Whatsapp">Whatsapp</option>
                <option value="Email">Email</option>
              </select>
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <input name="details[]" type="text" class="form-control"  placeholder="Enter Address " value="<?php echo $dr_addr['details'] ?>" >
            </div>
          </td>
          <td>
            <div class="form-group col-md-12">
              <select  name="display[]" id="display" class="form-control" data-placeholder="Choose a Company" tabindex="0">
                <option value="<?php echo $dr_addr['display'] ?>"><?php echo $dr_addr['display'] ?></option>
                <option value="YES">YES</option>
                <option value="NO">NO</option>
              </select>
            </div>
          </td>
          <td>
           

              
                  <a style='margin-top:-55px' id='company_telephone_type_delete' class='btn btn-danger btn-icon-anim btn-circle company_telephone_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
                
          </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
    <input type="hidden" class="hiddentextbox" name="company_telephone_type" id="company_telephone_type" value="<?php echo $totalAddr; ?>" />
  </div>
</div>
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script type="text/javascript">
  $(document).ready(function()  {
    // new change
    $("#company_telephone_type_add").click(function()  {
      let i = Number($("#company_telephone_type").val());
  
      $("#companyaddresstable tbody").append(`
        <tr id='companyaddress${j=++i}'>
          <td>
           <div class='form-group col-md-12'>   
  
           <select  name='type[]' id='type' class='form-control' data-placeholder='Choose a Company' tabindex='1'> <option value='Tel.'>Tel.</option>   <option value='FAX'>FAX</option><option value='Whatsapp'>Whatsapp</option><option value='Email'>Email</option></select>
  
           
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
              <input name='details[]' type='text' class='form-control'  placeholder='Enter Details' />
            </div>
          </td>
          <td>
            <div class='form-group col-md-12'>
  
              <select  name='display[]' id='display' class='form-control'  tabindex='1'> <option value='YES'>YES</option>   <option value='NO'>NO</option></select>
  
  
            </div>
          </td>
          <td>    <a style='margin-top:-55px' id='company_telephone_type_delete' class='btn btn-danger btn-icon-anim btn-circle company_telephone_type_delete' ><i style='margin-top: 12px' class='fa fa-trash' aria-hidden='true'></i></a> 
          </td>
        </tr>`);
    
  
      $('#company_telephone_type').val(i);
    });
    $("#companyaddresstable tbody").on('click', '.company_telephone_type_delete', function() {
      let address_id = $(this).parent().parent().first().children().children().first().val();
  
      if (address_id) {
        $.ajax({
          url: window.location.origin + '/frubji/admin/superadmin/masterdelete/company_delete.php?type=address&id=' + address_id,
          type: "GET",
          success: function(result) {
            window.alert("Contact Removed");
            window.setTimeout(function() {
            
              window.location.reload(true);
            }, 0);
          }
        });
      } else {
        $(this).parent().parent().remove();
        let i = Number($("#company_telephone_type").val());
        $('#company_telephone_type').val(--i);
      }
    });
  });
</script>
</div>
<div class="form-group col-md-12 text-right ">   
  <a href="companymaster.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a>
  <input type="submit" value="Update" name="submit" id="submit" class="btn btn-primary  btn-rounded" />
</div>
</form> 
<!-- BULK IMAGE UPLOAD CODE-->      
<?php $id = $_GET['edit_id']; ?>
<form action="bulkimageupload/companysubimgupload.php" method="post" enctype="multipart/form-data">
 

  <div class="form-group col-md-12">  
      <div class="seprator-block"></div>
      <h6 style="font-size: 20px;color: #2196F3;" class="flex flex-middle  capitalize-font"><i class="font-20 txt-grey zmdi zmdi-calendar-note mr-10"></i>Add Multiple IMAGES / PDF / EXCEL / PPT / WORDFILE Of Branch</h6>
      <hr class="light-grey-hr">
    </div>

    
  <div class="col-md-4 form-group">
    <input class="hiddentextbox" type="hidden" name="idd" value="<?php echo $id = $_GET['edit_id']; ?> ">
    <input type="file" name="files[]" class="form-control " multiple >       <span><b class="txt-danger">* Image size should be 974 x 648 in PNG and Less than 1 MB</b></span>
   
  </div>
  <div class="col-md-3 form-group">
    <input  class="btn btn-primary btn-rounded btn-lable-wrap left-label" type="submit"  name="submit" value="Add" />
  </div>
</form>
<?php
  //index.php
  include "db.php";
  
  $id = $_GET['edit_id'];
  
  $query = "SELECT * FROM companyimages where idd = $id";
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
        echo   '<img width="100px" src="../media/company/'.$row["file_name"].'"> <Br> IMAGE ';
      }
      else if ($a['1'] == 'pdf') {
        echo   '<a target="_blank" href="../media/company/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-pdf-o txt-danger"> </i> </a><Br> PDF ';  
      } 
      else if ($a['1'] == 'docx') {
        echo   '<a target="_blank" href="../media/company/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-word-o txt-primary"> </i> </a><Br> DOC ';  
      } 
      
      else if ($a['1'] == 'xls' ||  $a[1] == 'xlsx') {
        echo   '<a target="_blank" href="../media/company/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-excel-o txt-success"> </i> </a><Br> EXCEL ';  
      } 
        else if ($a['1'] == 'pptx' || $a[1] == 'ppt') {
        echo   '<a target="_blank" href="../media/company/'.$row["file_name"].'" ><i style="font-size:120px" class="fa fa-file-powerpoint-o txt-info"> </i> </a><Br> PPT ';  
      } 
      
      
      else if ($a['1'] == 'mp4' || $a['1'] == 'avi' || $a['1'] == 'mov') {
        echo '<video width="170" height="auto" controls>
              <source src="../media/company/'.$row["file_name"].'" type="video/mp4">
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
      url = "c/companyimagesactive.php";
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
       url:'bulkimageupload/companysubimagedelete.php',
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
<!-- /Row -->
</div>
</div>
<!-- /Main Content -->
</div>
<!-- /#wrapper -->
<?php include "allscript.php"; ?>