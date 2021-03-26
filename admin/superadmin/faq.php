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
if ( authorize($_SESSION["access"]["ECOMMERCE"]["FAQ"]["create"]) || 
authorize($_SESSION["access"]["ECOMMERCE"]["FAQ"]["edit"]) || 
authorize($_SESSION["access"]["ECOMMERCE"]["FAQ"]["view"]) || 
authorize($_SESSION["access"]["ECOMMERCE"]["FAQ"]["delete"]) || 
authorize($_SESSION["access"]["ECOMMERCE"]["FAQ"]["approval"])) {
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
        <h5 class="txt-dark">FAQ
        </h5>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.php">Dashboard
            </a>
          </li>
           <li>
            <a href="faq.php">
              <span>Ecommerce
              </span>
            </a>
          </li>
          <li>
            <a href="faq.php">
              <span>FAQ Master
              </span>
            </a>
          </li>
          <li class="active">
            <span>FAQ
            </span>
          </li>
        </ol>
      </div>
    </div>  
                   <!-- ROLE BASED CREATE--> 
                 <?php if (authorize($_SESSION["access"]["ECOMMERCE"]["FAQ"]["create"])) { ?> 
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12 text-right">
            <div class="panel panel-default border-panel ">
              <div  class="panel-wrapper collapse in">
                <div  class="panel-body">
                <div class="col-md-6 text-left">  

                 <!-- <?php include 'importexcel/faqfunctions.php'; ?>
                  <link rel="stylesheet" href="dist/leftrightmodal.css">  
                  <a data-target="#questionanswerright" data-toggle="modal" class="btn btn-primary" title="Edit" data-toggle="tooltip">Import Data </a> 
                  <?php include "importexcel/faqrightmodal.php"; ?>
-->
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

                      <th width="10%">Question
                      </th>
                      <th width="15%">Answer 
                      </th> 
                     
                    
                      <?php if (authorize($_SESSION["access"]["ECOMMERCE"]["FAQ"]["edit"])) {?>

                      <th width="1%">Edit</th>

                       <?php } ?>


                        <?php if (authorize($_SESSION["access"]["ECOMMERCE"]["FAQ"]["delete"])) {?>

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
            <h5 class="modal-title">Create FAQ
            </h5>
          </div>
          <div class="modal-body">
            <form method="post" id="user_form" enctype="multipart/form-data">


                <div class="form-group">
                  <label for="message-text" class="control-label mb-10">Enter question
                  </label>
                  <input type="text" name="question" id="question" class="form-control" />
                </div>    
                  <div class="form-group">
                  <label for="message-text" class="control-label mb-10">Enter answer
                  </label>
                  <textarea type="text" name="answer" id="answer" class="form-control" ></textarea>
                </div> 


              </div>
                <div class="modal-footer">
                  <input type="hidden" name="id" id="id" />
                  <input type="hidden" name="operation" id="operation" />
                  <input type="submit" name="action" id="action" class="btn btn-primary" value="Add" />
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close
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
      $('.modal-title').text("Add FAQ");
      $('#action').val("Add");
      $('#operation').val("Add");
    });
    var dataTable = $('#user_data').DataTable({
      "processing":true,
      "serverSide":true,
      "order":[],
      "ajax":{
        url:"onetime/faqfetch.php",
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
      var question = $('#question').val();    
      var answer = $('#answer').val();  


      if(question != '' && answer != '')
      {
        $.ajax({
          url:"onetime/faqinsert.php",
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
        url:"onetime/faqfetch_single.php",
        method:"POST",
        data:{
          id:id}
        ,
        dataType:"json",
        success:function(data)
        {
          $('#adddocumentmaster').modal('show');
          $('#question').val(data.question);  
          $('#answer').val(data.answer);
         

          $('.modal-title').text("Edit FAQ");
          $('#id').val(id);
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
          url:"onetime/faqdelete.php",
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
    