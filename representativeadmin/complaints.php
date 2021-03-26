




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
					<h4 class="box-title">View Customers Complaints</h4> 


						<table id="example" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Attachment</th> 
                                                        <th>Representative Name</th>                       
                                                        <th>Customer Name</th>
                                                        <th>Type of Complaint</th> 
                                                        <th>Invoice no</th> 
                                                        <th>Message</th> 
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>



                                                <tbody>                                         
                                                    <?php 
                                                    include('db.php');

                                                     $result = mysqli_query($con,"SELECT c.id,c.customerid,c.message,c.topic,c.invoiceno,c.img,c.status, t.userID, t.representativeid, t.userName, r.firstname FROM `complaintbox` c , `tbl_users` t, `representative` r where c.customerid = t.userID and r.id = t.representativeid and t.representativeid = $representativeid");  
                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                    echo   '<tr>   <td><a target="_blank" href="../media/complaintbox/'.$row['img'].'" ><img style="width:100px" src="../media/complaintbox/'.$row['img'].'" > </a></td> 
                                                                 <td style="padding:10px">'.$row['firstname'].'</td>           
                                                                 <td>'.$row['userName'].'</td>     
                                                                 <td>'.$row['topic'].'</td>     
                                                                 <td>'.$row['invoiceno'].'</td>     
                                                                
                                                                 <td>'.$row['message'].'</td>
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
<?php include "allscripts.php"; ?>
