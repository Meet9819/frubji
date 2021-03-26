<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
<!-- Main Content -->
<!-- ROLE BASED -->
 <?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
$status = FALSE;
if ( authorize($_SESSION["access"]["MASTER"]["ITEM_GROUP_MASTER"]["create"]) || 
authorize($_SESSION["access"]["MASTER"]["ITEM_GROUP_MASTER"]["edit"]) || 
authorize($_SESSION["access"]["MASTER"]["ITEM_GROUP_MASTER"]["view"]) || 
authorize($_SESSION["access"]["MASTER"]["ITEM_GROUP_MASTER"]["delete"]) || 
authorize($_SESSION["access"]["MASTER"]["ITEM_GROUP_MASTER"]["approval"])) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

?>
<!-- ROLE BASED --> 

<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Item Group Master
        </h5>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.php">Dashboard
            </a>
          </li> 
           <li>
            <a href="itemgroup.php">
              <span>Master
              </span>
            </a>
          </li>
          <li>
            <a href="itemgroup.php">
              <span>Item Related Master
              </span>
            </a>
          </li>
          <li class="active">
            <span>Item Group Master
            </span>
          </li>
        </ol>
      </div>
    </div>  
                   <!-- ROLE BASED CREATE--> 
                 <?php if (authorize($_SESSION["access"]["MASTER"]["ITEM_GROUP_MASTER"]["create"])) { ?> 
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12 text-right">
            <div class="panel panel-default border-panel ">
              <div  class="panel-wrapper collapse in">
                <div  class="panel-body">
                <div class="col-md-6 text-left">  

                  <?php include 'importexcel/itemgroupfunctions.php'; ?>
                  <link rel="stylesheet" href="dist/leftrightmodal.css">  
                  <a data-target="#itemgroupright" data-toggle="modal" class="btn btn-primary" title="Edit" data-toggle="tooltip">Import Data </a> 
                  <?php include "importexcel/itemgrouprightmodal.php"; ?>

                  </div>         
             


                  <div class="col-md-6 text-right"> 
                    <a  href="" id="add_button" data-target="#adddocumentmaster" 
                       data-toggle="modal"  class="btn btn-default btn-outline btn-icon right-icon">
                      <i class="fa fa-plus">
                      </i>
                      <span class="btn-text">Add New 
                      </span> 
                    </a>
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>   <?php } ?> 
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default border-panel card-view">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="table-wrap">
                <table id="user_data" class="table table-bordered ">
                  <thead>
                    <tr> <th width="1%">Sr.no
                      </th>   
                      <th width="1%">Image
                      </th>
                      <th width="47%">Item Main Group
                      </th>
                      <th width="25%">Item Group
                      </th> 
                      <th width="25%">Ecommerce Item Group
                      </th>
                    
                                                    <?php if (authorize($_SESSION["access"]["MASTER"]["ITEM_GROUP_MASTER"]["edit"])) {?>

                                                    <th width="1%">Edit</th>

                                                     <?php } ?>


                                                      <?php if (authorize($_SESSION["access"]["MASTER"]["ITEM_GROUP_MASTER"]["delete"])) {?>

                                                    <th width="1%">Delete</th>

                                                    <?php } ?>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- adddocumentmaster -->
    <div id="adddocumentmaster" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h5 class="modal-title">Create Item Group 
            </h5>
          </div>
          <div class="modal-body">
            <form method="post" id="user_form" enctype="multipart/form-data">




                          <div class="form-group ">
                              <label  class="control-label mb-10">Main Group
                              </label>
                              <select  name="itemmaingroupid" id="itemmaingroupid" class="form-control select2" data-placeholder="Choose Main Group " >
                                <option >Select Main Group </option>
                                 <?php
                                  include "db.php";
                                  $result = mysqli_query($con, "SELECT * FROM itemmaingroup");
                                  while ($row = mysqli_fetch_array($result)) {
                                      echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                                  }
                                  ?>
                              </select>
                            </div>


              <div class="form-group">
                <label for="message-text" class="control-label mb-10">Enter Item Group <b class="txt-danger">* </b>
                </label>
                <input type="text" name="title" id="title" class="form-control" required="" /> <br />

                <br>
                 <label for="message-text" class="control-label mb-10">Enter Ecommerce Item Group <b class="txt-danger">* </b>
                </label>
                <input type="text" name="etitle" id="etitle" class="form-control" required="" /> <br />


                <label>Select User Image <b class="txt-danger">* </b></label>
                <input type="file" name="user_image" id="user_image" />
                <span id="user_uploaded_image"></span> 
                <Br><span><b class="txt-danger">* Image size should be 500 x 500 in PNG and Less than 10 KB</b></span>
              </div>             
              </div>
            <div class="modal-footer">
              <input type="hidden" name="id" id="id" />
              <input type="hidden" name="operation" id="operation" />
              <input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
              <button type="button" class="btn btn-default" data-dismiss="modal">Close
              </button>
            </div>
            </form>
        </div>
      </div>
    </div>
    <!-- adddocumentmaster --> 
    <?php include "footer.php"; ?>
    
  </div>
</div>
<!-- /Main Content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js">
</script>
<script type="text/javascript" language="javascript" >
  $(document).ready(function(){
    $('#add_button').click(function(){
      $('#user_form')[0].reset();
      $('.modal-title').text("Add Item Group Master");
      $('#action').val("Add");
      $('#operation').val("Add");
    }
                          );
    var dataTable = $('#user_data').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"onetime/itemgroupfetch.php",
        type:"POST"
      }
      ,
      "columnDefs":[
        {
          "targets":[0],
          "orderable":false,
        }
        ,
      ],
    }
                                             );
    $(document).on('submit', '#user_form', function(event){
      event.preventDefault();
      var title = $('#title').val();
      var etitle = $('#etitle').val();
      var itemmaingroupid = $('#itemmaingroupid').val();

   var extension = $('#user_image').val().split('.').pop().toLowerCase();
    if(extension != '')
    {
      if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
      {
        alert("Invalid Image File");
        $('#user_image').val('');
        return false;
      }
    } 

      if(title != '' && itemmaingroupid != '')
      {
        $.ajax({
          url:"onetime/itemgroupinsert.php",
          method:'POST',
          data:new FormData(this),
          contentType:false,
          processData:false,
          success:function(data)
          {
            alert(data);
            $('#user_form')[0].reset();
            $('#adddocumentmaster').modal('hide');
            dataTable.ajax.reload();
          }
        }
              );
      }
      else
      {
        alert("Both Fields are Required");
      }
    }
                  );
    $(document).on('click', '.update', function(){
      var id = $(this).attr("id");
      $.ajax({
        url:"onetime/itemgroupfetch_single.php",
        method:"POST",
        data:{
          id:id}
        ,
        dataType:"json",
        success:function(data)
        {
          $('#adddocumentmaster').modal('show');
          $('#title').val(data.title);  
          $('#etitle').val(data.etitle);
          $('#itemmaingroupid').val(data.itemmaingroupid);


          $('.modal-title').text("Edit Item Group Master");
          $('#id').val(id);   
          $('#user_uploaded_image').html(data.user_image);
          $('#action').val("Edit");
          $('#operation').val("Edit");
        }
      }
            )
    }
                  );
    $(document).on('click', '.delete', function(){
      var id = $(this).attr("id");
      if(confirm("Are you sure you want to delete this?"))
      {
        $.ajax({
          url:"onetime/itemgroupdelete.php",
          method:"POST",
          data:{
            id:id}
          ,
          success:function(data)
          {
            alert(data);
            dataTable.ajax.reload();
          }
        }
              );
      }
      else
      {
        return false;
      }
    }
                  );
  }
                   );
</script>
<!-- jQuery -->
<?php include "allscriptadmin.php"; ?>
<!-- FORM FIL UPLOAD -->
        <script src="../vendors/bower_components/dropify/dist/js/dropify.min.js"></script>
        <script src="dist/js/form-file-upload-data.js"></script>
        <!-- FORM FIL UPLOAD --> 
    
    <script src="../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    