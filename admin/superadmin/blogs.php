<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
<!-- Main Content -->
<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Blogs
        </h5>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.php">Dashboard
            </a>
          </li> 
           <li>
            <a href="blogs.php">
              <span>Ecommerce
              </span>
            </a>
          </li>
          <li>
            <a href="blogs.php">
              <span>Blogs
              </span>
            </a>
          </li>
          <li class="active">
            <span>Blogs
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

                  </div>         
             


                  <div class="col-md-6 text-right"> 
                    <a  href="" id="add_button" data-target="#userModal" 
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
                  <thead>
                    <tr> 
                    <th width="10%">Image</th>
							<th width="5%">Category</th>
							<th width="15%">Title</th>
							<th width="35%">Short Desc</th>
							<th width="35%">Desc</th>
							<th width="5%">Datee</th> 
							<th width="5%"> Status</th>

							<th width="1%">Edit</th>
							<th width="1%">Delete</th>



                   
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

	
                   <!-- ACTIVE AND INACTIVE KA CODE -->
                <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
                <script type="text/javascript">
                  $(document).on('click','.status_checks',function(){
                  var status = ($(this).hasClass("label-success")) ? '0' : '1';
                  var msg = (status=='0')? 'Deactivate' : 'Activate';
                  if(confirm("Are you sure to "+ msg)){
                    var current_element = $(this);
                    url = "allstatus/ecommerceadvertiseajax.php";
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



<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add User</h4>
				</div>
				<div class="modal-body">
					<br />
					<label>Enter Category</label>
					<input type="text" name="category" id="category" class="form-control" />
					<br>
					<label>Enter Title</label>
					<input type="text" name="title" id="title" class="form-control" />
					<br />
					<label>Enter Short Descirpiton</label>
					<input type="text" name="shortdescription" id="shortdescription" class="form-control" />
					<br />

					<label>Enter description</label>
					<input type="text" name="description" id="description" class="form-control" />
					
					<br />
					<label>Enter datee</label>
					<input type="text" name="datee" id="datee" class="form-control" />
					<br />

				

					<label>Select User Image</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span><br>
					<span><b class="txt-danger">* Image size should be 453 x 300 in PNG and Less than 1 MB</b></span>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="user_id" id="user_id" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>


 <?php include "footer.php"; ?>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add Blogs");
		$('#action').val("Add");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"ecommerce/blogs/fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var firstName = $('#title').val();
		var lastName = $('#shortdescription').val();
		var description = $('#description').val();
		var category = $('#category').val();
		var datee = $('#datee').val();	
		var sequence = $('#sequence').val();

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
		if(firstName != '' && lastName != '')
		{
			$.ajax({
				url:"ecommerce/blogs/insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Both Fields are Required");
		}
	});
	
	$(document).on('click', '.update', function(){
		var user_id = $(this).attr("id");
		$.ajax({
			url:"ecommerce/blogs/fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#title').val(data.title);
				$('#shortdescription').val(data.shortdescription);
				$('#description').val(data.description);
				$('#category').val(data.category);
				$('#datee').val(data.datee);

				$('.modal-title').text("Edit User");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"ecommerce/blogs/delete.php",
				method:"POST",
				data:{user_id:user_id},
				success:function(data)
				{
					alert(data);
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
	
});
</script>
<!-- jQuery -->
<?php include "allscriptadmin.php"; ?>
<!-- FORM FIL UPLOAD -->
        <script src="../vendors/bower_components/dropify/dist/js/dropify.min.js"></script>
        <script src="dist/js/form-file-upload-data.js"></script>
        <!-- FORM FIL UPLOAD --> 
    
    <script src="../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    