<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
<!-- Main Content -->
<div class="page-wrapper">
  <div class="container-fluid">
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Tempo Expenses
        </h5>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.php">Dashboard
            </a>
          </li> 
           <li>
            <a href="tempoexpenses.php">
              <span>Ecommerce
              </span>
            </a>
          </li>
          <li>
            <a href="tempoexpenses.php">
              <span>Tempo Expenses
              </span>
            </a>
          </li>
          <li class="active">
            <span>Tempo Expenses
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
                  			<th width="12%">Tempo Person Name</th>
								
							<th width="5%"> Amount</th>
							<th width="5%">Notes </th> <th width="5%"> Date</th>
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
					<h4 class="modal-title">Add Tempo</h4>
				</div>
				<div class="modal-body">
					<label>Enter Tempo Person Name</label>
					  <select name="tempoid" id="tempoid" class="form-control select2 "  data-placeholder="Choose Tempo Person Name" tabindex="0">
					  <?php
					    include"db.php";
					    $result = mysqli_query($con,"SELECT * FROM tempo");
					    while($row = mysqli_fetch_array($result))
					    {
					    echo '<option value="'.$row['id'].'">' .$row['name'].'</option>';
					    } 
					    ?> 
					  </select>


					<br />

					<label>Enter Date</label>
					<input type="date" name="datee" id="datee" class="form-control" />
					<br />
					<label>Enter Amount</label>
					<input type="text" name="amount" id="amount" class="form-control" />
					<br />
					<label>Enter Notes</label>
					<input type="text" name="notes" id="notes" class="form-control" />
					
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
		$('.modal-title').text("Add Tempo Expenses");
		$('#action').val("Add");
		$('#operation').val("Add");
		
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"ecommerce/tempoexpenses/fetch.php",
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
		var tempoid = $('#tempoid').val();
		var notes = $('#notes').val();
		var datee = $('#datee').val();
		var amount = $('#amount').val();

			
		if(tempoid != '' && notes != ''  && datee != ''  && amount != '')
		{
			$.ajax({
				url:"ecommerce/tempoexpenses/insert.php",
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
			url:"ecommerce/tempoexpenses/fetch_single.php",
			method:"POST",
			data:{user_id:user_id},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#tempoid').val(data.tempoid);
				$('#notes').val(data.notes);

				$('#datee').val(data.datee);
				$('#amount').val(data.amount);

				$('.modal-title').text("Edit Tempo Expenses");
				$('#user_id').val(user_id);
				
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
				url:"ecommerce/tempoexpenses/delete.php",
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
    