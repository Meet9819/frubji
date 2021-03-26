<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
<!-- Main Content -->
<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Static Pages
        </h5>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.php">Dashboard
            </a>
          </li> 
           <li>
            <a href="staticpages.php">
              <span>Master
              </span>
            </a>
          </li>
          <li>
            <a href="staticpages.php">
              <span>Static Pages
              </span>
            </a>
          </li>
          <li class="active">
            <span>Static Pages
            </span>
          </li>
        </ol>
      </div>
    </div> 




    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12 text-right">
            <div class="panel panel-default border-panel ">
              <div  class="panel-wrapper collapse in">
                <div  class="panel-body">
                    
                  <div class="col-md-6 text-left">  

               <!--   <?php include 'importexcel/muncipalityfunctions.php'; ?>
                  <link rel="stylesheet" href="dist/leftrightmodal.css">  
                  <a data-target="#muncipalityright" data-toggle="modal" class="btn btn-primary" title="Edit" data-toggle="tooltip">Import Data </a> 
                  <?php include "importexcel/muncipalityrightmodal.php"; ?> -->

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
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default border-panel card-view">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="table-wrap">
                <table id="user_data" class="table table-bordered ">
                  <thead >
                    <tr>  <th width="1%">Sr.no
                      </th>
                      <th width="97%">Title 
                      </th>
                      <th width="1%">Edit
                      </th>
                      <th width="1%">Delete
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <!-- adddocumentmaster -->
    <div id="adddocumentmaster" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h5 class="modal-title">Create Static Pages 
            </h5>
          </div>
          <div class="modal-body">
            <form method="post" id="user_form" enctype="multipart/form-data">
              <div class="form-group">
                <label for="message-text" class="control-label mb-10">Enter Title 
                </label>
                <input type="text" name="title" id="title" class="form-control" />
              </div>    
               <div class="form-group">
                <label for="message-text" class="control-label mb-10">Enter Content 
                </label> 

                <textarea name="content" id="content" class="form-control"></textarea>
                <script>
                       CKEDITOR.replace('content'); 

                       //CKEDITOR.instances['#content'].getData();
                </script>
              
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
      $('.modal-title').text("Add Static Pages");
      $('#action').val("Add");
      $('#operation').val("Add");
    }
                          );
    var dataTable = $('#user_data').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"onetime/staticpagesfetch.php",
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

       //var content = CKEDITOR.instances.editor1.getData();
     var content = $('#content').val();


      //var content = CKEDITOR.instances['#content'].getData();


      if(title != '' && content != '')
      {
        $.ajax({
          url:"onetime/staticpagesinsert.php",
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
   
    $(document).on('click', '.delete', function(){
      var id = $(this).attr("id");
      if(confirm("Are you sure you want to delete this?"))
      {
        $.ajax({
          url:"onetime/staticpagesdelete.php",
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
    