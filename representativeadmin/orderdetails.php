




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
					<h4 class="box-title">View Orders Details</h4> 


						<table  class="table table-striped table-bordered display" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Bill no / Email Id</th>                                                                                     
                                                        <th>Product Name</th>                                                         
                                                        <th>Price</th>
                                                        <th>Qty</th> 
                                                        <th>Units</th> 
                                                        <th>Total Amt</th> 
                                                    </tr>
                                                </thead>



                                                <tbody>                                         
                                                    <?php 
                                                    include('db.php');
                                                    $q = $_GET['q'];

                                                     $result = mysqli_query($con,"SELECT * FROM `o` where billno = $q");  
                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                    echo   '<tr> 
                                                                <td style="padding:10px">'.$row['billno'].' - '.$row['useremailid'].'</td>   
                                                                <td>'.$row['productcode'].' '.$row['name'].' </td>          
                                                                <td>'.$row['price'].'</td>          
                                                                <td>'.$row['qty'].' </td> 
                                                                <td> '.$row['units'].' '.$row['weight'].'  </td>
                                                                <td>'.$row['total'].'</td>                                               
                                                                  
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
