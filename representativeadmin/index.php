<?php
session_start();

if(!isset($_SESSION["mobileno"])){
header("Location: login.php");
exit(); }
?>
<?php include "allcss.php" ?>
<body>
<?php include "header.php" ?>

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">		
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Your Customers</h4>
					
					<!-- /.dropdown js__dropdown -->
					<div class="content widget-stat">
						<div class="percent bg-warning"><i class="fa fa-line-chart"></i>53%</div>
						<!-- /.percent -->
						<div class="right-content"> 


                            <?php
							include"db.php";

							$result = mysqli_query($con,"SELECT count(1) FROM tbl_users where representativeid = $representativeid");
							$row = mysqli_fetch_array($result);

							$total = $row[0];

							       echo'  
								<h2 class="counter"> '. $total.'</h2>
							                            
							      '
							?>
	
						
							<!-- /.counter -->
							<p class="text">No of Customer</p>
							<!-- /.text -->
						</div>
						<!-- /.right-content -->
						<div class="clear"></div>
						<!-- /.clear -->
						<div class="process-bar">
							<div class="bar-bg bg-warning"></div>
							<div class="bar js__width bg-warning" data-width="70%"></div>
							<!-- /.bar js__width bg-success -->
						</div>
						<!-- /.process-bar -->
					</div>
					<!-- /.content widget-stat -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-md-6 col-xs-12 -->
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Orders </h4>
					
					<!-- /.dropdown js__dropdown -->
					<div class="content widget-stat-chart">
						<div class="c100 p76 small blue js__circle">
							<span>76%</span>
							<div class="slice">
								<div class="bar"></div>
								<div class="fill"></div>
							</div>
						</div>
						<!-- /.c100 p58 -->
						<div class="right-content">

							   <?php
									include"db.php";

									$result = mysqli_query($con,"SELECT count(1) FROM o");
									$row = mysqli_fetch_array($result);

									$total = $row[0];

									       echo'  
										<h2 class="counter"> '. $total.'</h2>
									                            
									      '
									?>
	
				
							
							<!-- /.counter -->
							<p class="text">No of Orders</p>
							<!-- /.text -->
						</div>
						<!-- /.right-content -->
					</div>
					<!-- /.content -->
				</div>
				<!-- /.box-content -->
			</div>
				





					<div class="col-lg-12 col-md-6 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Main Details </h4>
					
					<!-- /.dropdown js__dropdown -->
					<div class="content widget-stat-chart">
						
						<!-- /.c100 p58 -->
						<div class="right-content">

							 
							<h2 class="counter"> <?php echo $referral_code; ?></h2>
							
<p style="
    color: #FF5722;
    font-weight: bold;
    font-size: 30px;
    font-family: system-ui;
">
<input style="display: none" type="text" value="<?php echo $referral_link; ?>" id="myInput">
<a style="font-size: 20px"  onclick="myFunction()">Copy Link &nbsp;&nbsp;&nbsp;</a>

<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
</script>		  
							<!-- /.counter -->
							<?php echo $referral_link; ?></p> 




							<!-- /.text -->
						</div>
						<!-- /.right-content -->
					</div>
					<!-- /.content -->
				</div>
				<!-- /.box-content -->
			</div>
			





		</div>
	
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->



<?php include "allscripts.php" ?>