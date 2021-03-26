




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
					<h4 class="box-title">View Orders</h4> 


						<table id="example" class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Representative Full Name</th>                                                                                     
                                                        <th>Bill No</th>                                                         
                                                        <th>Customer Name / Email Id / Mobile</th>
                                                        <th>Mode of Payment</th> 
                                                        <th>Bill Amount</th> 
                                                        <th>Commission</th> 
                                                        <th>View Order Details</th> 
                                                    </tr>
                                                </thead>



                                                <tbody>                                         
                                                    <?php 
                                                    include('db.php');

                                                     $result = mysqli_query($con,"SELECT r.firstname, r.lastname,p.id, p.representativeid,p.billno,p.name,p.email,p.phone, p.modeofpayment,p.product_price, p.representativecommission FROM `payment` p, `representative` r where p.representativeid = r.id and r.id = $representativeid");  
                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                    echo   '<tr>  
                                                                 <td>'.$row['firstname'].' '.$row['lastname'].' </td>          
                                                                 <td style="padding:10px">'.$row['billno'].'</td>           
                                                                 <td>'.$row['name'].' / '.$row['email'].' / '.$row['phone'].'</td> 
                                                                 <td> '.$row['modeofpayment'].' </td>
                                                                 <td>'.$row['product_price'].'</td>   
                                                                 <td>'.$row['representativecommission'].' %</td>                                                               
                                                                     <td><a href="orderdetails.php?q='.$row['billno'].'" ><i data="" class="status_checks btn-sm btn-success">View Details </i></a></td>
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
