<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
<!-- Main Content -->
<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Farmers
        </h5>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.php">Dashboard
            </a>
          </li> 
           <li>
            <a href="testimonials.php">
              <span>Ecommerce
              </span>
            </a>
          </li>
          <li>
            <a href="testimonials.php">
              <span>Farmers
              </span>
            </a>
          </li>
          <li class="active">
            <span>Farmers
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
                  			<th width="2%">Image</th>
							<th width="5%"> Name</th>	
							<th width="5%"> Mobile</th>
							<th width="5%">Email </th> 	
							<th width="35%"> Address</th>
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



			

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Farmers</h4>
				</div>
				<div class="modal-body">
					<label>Enter Name</label>
					<input type="text" name="name" id="name" class="form-control" />
					<br />

					<label>Enter mobile</label>
					<input type="text" name="mobile" id="mobile" class="form-control" />
					<br />
					<label>Enter Email</label>
					<input type="text" name="email" id="email" class="form-control" />
					<br />
					<label>Enter address</label>
					<input type="text" name="address" id="address" class="form-control" />
					<br />
					<label>Select User Image</label>
					<input type="file" name="user_image" id="user_image" />
					<span id="user_uploaded_image"></span><br>
					<span><b class="txt-danger">* Image size should be 480 x 480 and less than 1 MB</b></span>

					<br />
					<label>Enter Bank Name</label>
					<input type="text" name="bankname" id="bankname" class="form-control" />
					<br />
					<label>Enter branchname</label>
					<input type="text" name="branchname" id="branchname" class="form-control" />
					<br />
					<label>Enter accountno</label>
					<input type="text" name="accountno" id="accountno" class="form-control" />
					<br />
					<label>Enter ifsccode</label>
					<input type="text" name="ifsccode" id="ifsccode" class="form-control" />

					<br />
				
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
		$('.modal-title').text("Add Farmers");
		$('#action').val("Add");
		$('#operation').val("Add");
		$('#user_uploaded_image').html('');
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"ecommerce/farmers/fetch.php",
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
		var name = $('#name').val();
		var address = $('#address').val();
		var mobile = $('#mobile').val();
		var email = $('#email').val();

		var bankname = $('#bankname').val();
		var branchname = $('#branchname').val();
		var accountno = $('#accountno').val();
		var ifsccode = $('#ifsccode').val();

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
		if(name != '' && address != ''  && mobile != ''  && email != '')
		{
			$.ajax({
				url:"ecommerce/farmers/insert.php",
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
			url:"ecommerce/farmers/fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#name').val(data.name);
				$('#address').val(data.address);

				$('#mobile').val(data.mobile);
				$('#email').val(data.email);

				$('#bankname').val(data.bankname);
				$('#branchname').val(data.branchname);

				$('#accountno').val(data.accountno);
				$('#ifsccode').val(data.ifsccode);

				$('.modal-title').text("Edit Farmers");
				$('#user_id').val(user_id);
				$('#user_uploaded_image').html(data.user_image);
				$('#action').val("Update");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var user_id = $(this).attr("id");
		if(confirm("Are you sure you want to delete this?"))
		{
			$.ajax({
				url:"ecommerce/farmers/delete.php",
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
    