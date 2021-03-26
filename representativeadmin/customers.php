
<?php
session_start();
if(!isset($_SESSION["mobileno"])){
header("Location: login.php");
exit(); }
?>

<?php include "allcss.php" ?>
 <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
 <script language="JavaScript" type="text/javascript">
            $(document).ready(function() {
                $("a.btn").click(function(e) {
                    if (!confirm('Are you sure?')) {
                        e.preventDefault();
                        return false;
                    }
                    return true;
                });
            });
        </script>
<body>

<?php include "header.php" ?>


<div id="wrapper">
	<div class="main-content">		

			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">View Customers</h4> 


						<table id="example" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>                                                                                     
                                                        <th>Mobile No</th>                                                         
                                                        <th>Email Id</th>
                                                        <th>Address</th> 
                                                         <th>Status</th>
                                                    </tr>
                                                </thead>



                                                <tbody>                                         
                                                    <?php 
                                                    include('db.php');

                                                     $result = mysqli_query($con,"SELECT * FROM `tbl_users` where representativeid = $representativeid");  
                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                    echo   '<tr>  
                                                                 <td>'.$row['userName'].' '.$row['lastname'].' </td>          
                                                                 <td style="padding:10px">'.$row['mobile'].'</td>           
                                                                 <td>'.$row['userEmail'].'</td> 
                                                                 <td>'.$row['address'].' '.$row['city'].' - '.$row['pincode'].' '.$row['state'].'</td>

                                                              '; ?>

                                                               <td><i data="<?php echo $row['userID'];?>" class="status_checks btn-sm <?php echo ($row['status'])? 'btn-success' : 'btn-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></i></td>

                                                               <?php echo  '
                                                                   
                                                            </tr> 
                                                            '; 
                                                    } 
                                                    ?>        
                                                 </tbody>

                                            </table>

			

				</div>
				<!-- /.box-content -->
			</div>


	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
	
	

<!-- ACTIVE AND INACTIVE KA CODE -->

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).on('click','.status_checks',function(){
var status = ($(this).hasClass("btn-success")) ? '0' : '1';
var msg = (status=='0')? 'Deactivate' : 'Activate';
if(confirm("Are you sure to "+ msg)){
	var current_element = $(this);
	url = "customersajax.php";
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
<?php include "allscripts.php"; ?>
