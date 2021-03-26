
<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
<title>co-<?php echo $sbcompany; ?> | sb-<?php echo $sb; ?>  | workingin-<?php echo $workingin; ?> </title>

<?php
$id = $user;

if (is_null($id) or empty($id)) {
    return;
}
?> 

                     <?php
                      include "db.php";
                      $result = mysqli_query($con, "SELECT * FROM employee WHERE id=" . $id);
                      $emp = mysqli_fetch_array($result);

                      ?>
             <!-- Main Content -->




        <div class="page-wrapper">  
            <div class="container-fluid pt-30">
				<!-- Row -->




				<div class="row">
					<div class="col-sm-4">
						<div class="row">
							<div class="col-sm-12"> 

								<div class="panel panel-default card-view  pa-0">
									<div class="panel-wrapper collapse in">
										<div class="panel-body  pa-0">
											<div class="profile-box">
												<div class="profile-cover-pic">
													<div class="fileupload btn btn-default">
														<span class="btn-text">edit</span>
														<input class="upload" type="file">
													</div>
													<div class="profile-image-overlay"></div>
												</div>
												<div class="profile-info text-center mb-15">
													<div class="profile-img-wrap">
														<img class="inline-block mb-10" src="../img/mock1.jpg" alt="user"/>
														<div class="fileupload btn btn-default">
															<span class="btn-text">edit</span>
															<input class="upload" type="file">
														</div>
													</div>	
													<h5 class="block mt-10 weight-500 capitalize-font txt-dark"><?php echo $employeename; ?></h5>
													<h6 class="block capitalize-font"><?php echo $u_rolecode; ?></h6>

													<h5 class="block mt-10  capitalize-font txt-dark"><?php echo $emp['familyid']; ?></h5>

												</div>	
												
											</div>
										</div>
									</div>
								</div>
							</div>
						
						</div>	
					</div>	
					<div class="col-sm-8"> 

						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default card-view pa-0"> 





									<div class="panel-wrapper collapse in">
										<div  class="panel-body pb-0">
											



											<div  class="tab-struct custom-tab-1">


												<ul role="tablist" class="nav nav-tabs nav-tabs-responsive" id="myTabs_8">

												

													<li  class="active" role="presentation" class=""><a  data-toggle="tab" id="settings_tab_8" role="tab" href="#settings_8" aria-expanded="false"><span>Change Password</span></a></li>
													
												</ul>
												<div class="tab-content" id="myTabContent_8">
												
													<div  id="settings_8" class="tab-pane fade active in" role="tabpanel">
														<!-- Row -->
														<div class="row">
															<div class="col-lg-12">
																<div class="">
																	<div class="panel-wrapper collapse in">
																		<div class="panel-body pa-0">
																			<div class="col-sm-12 col-xs-12">
																				<div class="form-wrap"> 


																					<form action="modal/password.php" method="post" enctype="multipart/form-data">



 <input type="hidden" value="<?php echo $emp['id']; ?>" name="id"  />

																						<div class="form-body overflow-hide">
																							<div class="form-group">
																								<label class="control-label mb-10" for="username">Username</label>
																								<div class="input-group">
																									<div class="input-group-addon"><i class="icon-user"></i></div>
																									<input type="text" name="username" class="form-control" id="username" value="<?php echo $emp['username']; ?>">
																								</div>
																							</div>
																							
																							<div class="form-group">
																								<label class="control-label mb-10" for="pw"> Password</label>
																								<div class="input-group">
																									<div class="input-group-addon"><i class="icon-lock"></i></div>
																									<input type="text" class="form-control" name="password" id="pw" placeholder="Enter pwd" value="<?php echo $emp['password']; ?>">
																								</div>
																							</div>
																						
																						
																						</div>
																						<div class="form-actions mt-10">			
																							<button type="submit" class="btn btn-default mr-10 mb-30">Change Password </button>
																						</div>				
																					</form>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div> 







								</div>
							</div>
						
						</div>
					</div>
				</div>	
				<!-- /Row --> 

				
			</div>
			


			
		</div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->



	
	<!-- JavaScript -->
	
    <!-- jQuery -->
    <script src="../vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    
	<!-- Vector Maps JavaScript -->
    <script src="../vendors/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="dist/js/vectormap-data.js"></script>
	
	<!-- Calender JavaScripts -->
	<script src="../vendors/bower_components/moment/min/moment.min.js"></script>
	<script src="../vendors/jquery-ui.min.js"></script>
	<script src="../vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
	<script src="dist/js/fullcalendar-data.js"></script>
	
	<!-- Counter Animation JavaScript -->
	<script src="../vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="../vendors/bower_components/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Data table JavaScript -->
	<script src="../vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	
	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>
	
	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>
	
	<!-- Sparkline JavaScript -->
	<script src="../vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<script src="../vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	<script src="dist/js/skills-counter-data.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="../vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="../vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="dist/js/morris-data.js"></script>
	
	<!-- Owl JavaScript -->
	<script src="../vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- Switchery JavaScript -->
	<script src="../vendors/bower_components/switchery/dist/switchery.min.js"></script>
	
	<!-- Data table JavaScript -->
	<script src="../vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
		
	<!-- Gallery JavaScript -->
	<script src="dist/js/isotope.js"></script>
	<script src="dist/js/lightgallery-all.js"></script>
	<script src="dist/js/froogaloop2.min.js"></script>
	<script src="dist/js/gallery-data.js"></script>
	
	<!-- twitter JavaScript -->
	<script src="dist/js/twitterFetcher.js"></script>
	
	<!-- Spectragram JavaScript -->
	<script src="dist/js/spectragram.min.js"></script>
	
	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/widgets-data.js"></script>

</body>

</html>
