<?php include "allcss.php"; ?>
<?php include "header.php"; ?>
			

        <!-- Main Content -->
		<div class="page-wrapper">
            <div class="container ">              
<?php 
include('db.php'); 

 $employeetablekaid=$_GET['q'];


$result = mysqli_query($con,"SELECT * FROM employee where id = $employeetablekaid");  
while($row = mysqli_fetch_array($result))
{ 
    $company_id = $row['id'];

echo '                
                <div class="row heading-bg">
                  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"> 
                             <h5 class="txt-dark">Document of '.$row['employeename'].' </h5>  
                        </div>
                 
                    <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="#"><span>Company Documents Detail Page</span></a></li>
                            <li class="active"><span>'.$row['employeename'].'</span></li>
                        </ol>
                    </div>
                 
                </div>   

                        '; } 
                        ?> 

                  
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


<?php 
include('db.php'); 

 $employeetablekaid=$_GET['q'];


$result = mysqli_query($con,"SELECT * FROM employee where id = $employeetablekaid");  
while($row = mysqli_fetch_array($result))
{ 
    $company_id = $row['id'];

echo '      	
												<div class="profile-info text-center mb-15">
													<div class="profile-img-wrap">
														<img class="inline-block mb-10" src="images/employee/'.$row['img'].' " alt="user"/>
														<div class="fileupload btn btn-default">
															<span class="btn-text">edit</span>
															<input class="upload" type="file">
														</div>
													</div>	
													<h5 class="block mt-10 weight-500 capitalize-font txt-dark">'.$row['employeename'].' </h5>
													<h6 class="block capitalize-font">'.$row['designation'].' </h6>
												</div>	

             

                        '; } 
                        ?> 

												<div class="social-info">
												
													<button class="btn btn-orange btn-block  btn-anim mt-15" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i><span class="btn-text">edit profile</span></button>
													<div id="myModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																	<h5 class="modal-title" id="myModalLabel">Edit Profile</h5>
																</div>
																<div class="modal-body">
																	<!-- Row -->
																	<div class="row">
																		<div class="col-lg-12">
																			<div class="">
																				<div class="panel-wrapper collapse in">
																					<div class="panel-body pa-0">
																						<div class="col-sm-12 col-xs-12">
																							<div class="form-wrap">
																								<form action="#">
																									<div class="form-body overflow-hide">
																										<div class="form-group">
																											<label class="control-label mb-10" for="exampleInputuname_1">Name</label>
																											<div class="input-group">
																												<div class="input-group-addon"><i class="icon-user"></i></div>
																												<input type="text" class="form-control" id="exampleInputuname_1" placeholder="willard bryant">
																											</div>
																										</div>
																										<div class="form-group">
																											<label class="control-label mb-10" for="exampleInputEmail_1">Email address</label>
																											<div class="input-group">
																												<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																												<input type="email" class="form-control" id="exampleInputEmail_1" placeholder="xyz@gmail.com">
																											</div>
																										</div>
																										<div class="form-group">
																											<label class="control-label mb-10" for="exampleInputContact_1">Contact number</label>
																											<div class="input-group">
																												<div class="input-group-addon"><i class="icon-phone"></i></div>
																												<input type="email" class="form-control" id="exampleInputContact_1" placeholder="+102 9388333">
																											</div>
																										</div>
																										<div class="form-group">
																											<label class="control-label mb-10" for="exampleInputpwd_1">Password</label>
																											<div class="input-group">
																												<div class="input-group-addon"><i class="icon-lock"></i></div>
																												<input type="password" class="form-control" id="exampleInputpwd_1" placeholder="Enter pwd" value="password">
																											</div>
																										</div>
																										<div class="form-group">
																											<label class="control-label mb-10">Gender</label>
																											<div>
																												<div class="radio">
																													<input type="radio" name="radio1" id="radio_1" value="option1" checked="">
																													<label for="radio_1">
																													M
																													</label>
																												</div>
																												<div class="radio">
																													<input type="radio" name="radio1" id="radio_2" value="option2">
																													<label for="radio_2">
																													F
																													</label>
																												</div>
																											</div>
																										</div>
																										<div class="form-group">
																											<label class="control-label mb-10">Country</label>
																											<select class="form-control" data-placeholder="Choose a Category" tabindex="0">
																												<option value="Category 1">USA</option>
																												<option value="Category 2">Austrailia</option>
																												<option value="Category 3">India</option>
																												<option value="Category 4">UK</option>
																											</select>
																										</div>
																									</div>
																									<div class="form-actions mt-10">			
																										<button type="submit" class="btn btn-default mr-10 mb-30">Update profile</button>
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
																<div class="modal-footer">
																	<button type="button" class="btn btn-orange waves-effect" data-dismiss="modal">Save</button>
																	<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
																</div>
															</div>
															<!-- /.modal-content -->
														</div>
														<!-- /.modal-dialog -->
													</div>
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
													<li class="active" role="presentation"><a  data-toggle="tab" id="profile_tab_8" role="tab" href="#profile_8" aria-expanded="false"><span>Personal Details</span></a></li>
													<li  role="presentation" class="next"><a aria-expanded="true"  data-toggle="tab" role="tab" id="follo_tab_8" href="#follo_8"><span>Contact Details</a></li>
													<li role="presentation" class=""><a  data-toggle="tab" id="photos_tab_8" role="tab" href="#photos_8" aria-expanded="false"><span>photos</span></a></li>
													<li role="presentation" class=""><a  data-toggle="tab" id="earning_tab_8" role="tab" href="#earnings_8" aria-expanded="false"><span>Education Details</span></a></li>
													<li role="presentation" class=""><a  data-toggle="tab" id="settings_tab_8" role="tab" href="#settings_8" aria-expanded="false"><span>Job Details</span></a></li>
													<li class="dropdown" role="presentation">
														<a  data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop_7" href="#" aria-expanded="false"><span>More</span> <span class="caret"></span></a>
														<ul id="myTabDrop_7_contents"  class="dropdown-menu">
															<li class=""><a  data-toggle="tab" id="dropdown_13_tab" role="tab" href="#dropdown_13" aria-expanded="true">About</a></li>
															<li class=""><a  data-toggle="tab" id="dropdown_14_tab" role="tab" href="#dropdown_14" aria-expanded="false">Bank Details</a></li>
															<li class=""><a  data-toggle="tab" id="dropdown_15_tab" role="tab" href="#dropdown_15" aria-expanded="false">Appreciation</a></li>
															<li class=""><a  data-toggle="tab" id="dropdown_16_tab" role="tab" href="#dropdown_16" aria-expanded="false">Reviews</a></li>
														</ul>
													</li>
												</ul>
												<div class="tab-content" id="myTabContent_8">
												







    <!-- BOOTSTRAP-TABLE CSS-->
    <link href="../vendors/bower_components/bootstrap-table/dist/bootstrap-table.css" rel="stylesheet" type="text/css"/>


													<div  id="profile_8" class="tab-pane fade active in" role="tabpanel">
													<?php 
include('db.php');

$employeetablekaid=$_GET['q'];

$result = mysqli_query($con,"SELECT * FROM employee where id = $employeetablekaid");  
while($row = mysqli_fetch_array($result))
{ 
    $company_id = $row['id'];

echo '      
              
                                <div class="panel-body" style="padding:20px">
                                  
                                      
                                            Name - '.$row['employeename'].'  <br>
                                            Employee Code - '.$row['employeecode'].' <br>
                                            Employee Family Id - '.$row['familyid'].' <br>
                                             Gender - '.$row['gender'].' <br>
                                              Date of Birth - '.$row['dob'].' <br>
                                                 Nationality -   '.$row['nationality'].' <br>
                                                   Marrital Status -  '.$row['marritial'].' <br>
                                             
                                         Blood Group - '.$row['bloodgroup'].'<br>
                                                 Qualification - '.$row['qualification'].' <br>
                                           </div>
             

'; } 
?>
         
													</div>

  <script src="../vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/responsive-datatable-data.js"></script>


          <!--Responsive Data table CSS -->


    <!-- Data table JavaScript -->
     <script src="dist/js/dataTables-data.js"></script>





													
													<div  id="follo_8" class="tab-pane fade" role="tabpanel">
														<div class="row">
															<div class="col-lg-12">
																<div class="followers-wrap">
																	<ul class="followers-list-wrap">
																		<li class="follow-list">
																			<div class="follo-body">
																				<div class="follo-data">
																					<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																					<div class="user-data">
																						<span class="name block capitalize-font">Clay Masse</span>
																						<span class="time block truncate txt-grey">No one saves us but ourselves.</span>
																					</div>
																					<button class="btn btn-default pull-right btn-xs fixed-btn">Follow</button>
																					<div class="clearfix"></div>
																				</div>
																				<div class="follo-data">
																					<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																					<div class="user-data">
																						<span class="name block capitalize-font">Evie Ono</span>
																						<span class="time block truncate txt-grey">Unity is strength</span>
																					</div>
																					<button class="btn btn-default btn-outline pull-right btn-xs fixed-btn">following</button>
																					<div class="clearfix"></div>
																				</div>
																				<div class="follo-data">
																					<img class="user-img img-circle"  src="../img/user2.png" alt="user"/>
																					<div class="user-data">
																						<span class="name block capitalize-font">Madalyn Rascon</span>
																						<span class="time block truncate txt-grey">Respect yourself if you would have others respect you.</span>
																					</div>
																					<button class="btn btn-default btn-outline pull-right btn-xs fixed-btn">following</button>
																					<div class="clearfix"></div>
																				</div>
																				<div class="follo-data">
																					<img class="user-img img-circle"  src="../img/user3.png" alt="user"/>
																					<div class="user-data">
																						<span class="name block capitalize-font">Mitsuko Heid</span>
																						<span class="time block truncate txt-grey">I’m thankful.</span>
																					</div>
																					<button class="btn btn-default pull-right btn-xs fixed-btn">Follow</button>
																					<div class="clearfix"></div>
																				</div>
																				<div class="follo-data">
																					<img class="user-img img-circle"  src="../img/user.png" alt="user"/>
																					<div class="user-data">
																						<span class="name block capitalize-font">Ezequiel Merideth</span>
																						<span class="time block truncate txt-grey">Patience is bitter.</span>
																					</div>
																					<button class="btn btn-default pull-right btn-xs fixed-btn">Follow</button>
																					<div class="clearfix"></div>
																				</div>
																				<div class="follo-data">
																					<img class="user-img img-circle"  src="../img/user1.png" alt="user"/>
																					<div class="user-data">
																						<span class="name block capitalize-font">Jonnie Metoyer</span>
																						<span class="time block truncate txt-grey">Genius is eternal patience.</span>
																					</div>
																					<button class="btn btn-default btn-outline pull-right btn-xs fixed-btn">following</button>
																					<div class="clearfix"></div>
																				</div>
																			</div>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
													<div  id="photos_8" class="tab-pane fade" role="tabpanel">
														<div class="col-md-12 pb-20">
															<div class="gallery-wrap">
																<div class="portfolio-wrap project-gallery">
																	<ul id="portfolio_1" class="portf auto-construct  project-gallery" data-col="4">
																		<li  class="item"   data-src="../img/gallery/equal-size/mock1.jpg" data-sub-html="<h6>Bagwati</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>" >
																			<a href="">
																			<img class="img-responsive" src="../img/gallery/equal-size/mock1.jpg"  alt="Image description" />
																			<span class="hover-cap">Bagwati</span>
																			</a>
																		</li>
																		<li class="item" data-src="../img/gallery/equal-size/mock2.jpg"   data-sub-html="<h6>Not a Keyboard</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																			<a href="">
																			<img class="img-responsive" src="../img/gallery/equal-size/mock2.jpg"  alt="Image description" />
																			<span class="hover-cap">Not a Keyboard</span>
																			</a>
																		</li>
																		<li class="item" data-src="../img/gallery/equal-size/mock3.jpg" data-sub-html="<h6>Into the Woods</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																			<a href="">
																			<img class="img-responsive" src="../img/gallery/equal-size/mock3.jpg"  alt="Image description" />
																			<span class="hover-cap">Into the Woods</span>
																			</a>
																		</li>
																		<li class="item" data-src="../img/gallery/equal-size/mock4.jpg"  data-sub-html="<h6>Ultra Saffire</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																			<a href="">
																			<img class="img-responsive" src="../img/gallery/equal-size/mock4.jpg"  alt="Image description" />
																			<span class="hover-cap"> Ultra Saffire</span>
																			</a>
																		</li>
																		
																		<li class="item" data-src="../img/gallery/equal-size/mock5.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																			<a href="">
																			<img class="img-responsive" src="../img/gallery/equal-size/mock5.jpg"  alt="Image description" />	
																			<span class="hover-cap">Happy Puppy</span>
																			</a>
																		</li>
																		<li class="item" data-src="../img/gallery/equal-size/mock6.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																			<a href="">
																			<img class="img-responsive" src="../img/gallery/equal-size/mock6.jpg"  alt="Image description" />
																			<span class="hover-cap">Wooden Closet</span>
																			</a>
																		</li>
																		<li class="item" data-src="../img/gallery/equal-size/mock7.jpg" data-sub-html="<h6>Happy Puppy</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																			<a href="">
																			<img class="img-responsive" src="../img/gallery/equal-size/mock7.jpg"  alt="Image description" />	
																			<span class="hover-cap">Happy Puppy</span>
																			</a>
																		</li>
																		<li class="item" data-src="../img/gallery/equal-size/mock8.jpg"  data-sub-html="<h6>Wooden Closet</h6><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
																			<a href="">
																			<img class="img-responsive" src="../img/gallery/equal-size/mock8.jpg"  alt="Image description" />
																			<span class="hover-cap">Wooden Closet</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</div>	
													</div>
													<div  id="earnings_8" class="tab-pane fade" role="tabpanel">
														<!-- Row -->
														<div class="row">
															<div class="col-lg-12">
																<form id="example-advanced-form" action="#">
																	<div class="table-wrap">
																		<div class="table-responsive">
																			<table class="table table-striped display product-overview" id="datable_1">
																				<thead>
																					<tr>
																						<th>Date</th>
																						<th>Item Sales Colunt</th>
																						<th>Earnings</th>
																					</tr>
																				</thead>
																				<tfoot>
																					<tr>
																						<th colspan="2">total:</th>
																						<th></th>
																					</tr>
																				</tfoot>
																				<tbody>
																					<tr>
																						<td>monday, 12</td>
																						<td>
																						 3
																						</td>
																						<td>$400</td>
																					</tr>
																					<tr>
																						<td>tuesday, 13</td>
																						<td>
																						 2
																						</td>
																						<td>$400</td>
																					</tr>
																					<tr>
																						<td>wednesday, 14</td>
																						<td>
																						 3
																						</td>
																						<td>$420</td>
																					</tr>
																					<tr>
																						<td>thursday, 15</td>
																						<td>
																						 5
																						</td>
																						<td>$500</td>
																					</tr>
																					<tr>
																						<td>friday, 15</td>
																						<td>
																						 3
																						</td>
																						<td>$400</td>
																					</tr>
																					<tr>
																						<td>saturday, 16</td>
																						<td>
																						 3
																						</td>
																						<td>$400</td>
																					</tr>
																					<tr>
																						<td>sunday, 17</td>
																						<td>
																						 3
																						</td>
																						<td>$400</td>
																					</tr>
																					<tr>
																						<td>monday, 18</td>
																						<td>
																						 3
																						</td>
																						<td>$500</td>
																					</tr>
																					<tr>
																						<td>tuesday, 19</td>
																						<td>
																						 3
																						</td>
																						<td>$400</td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</form>
															</div>
														</div>
													</div>
													<div  id="settings_8" class="tab-pane fade" role="tabpanel">
														<!-- Row -->
														<div class="row">
															<div class="col-lg-12">
																<div class="">
																	<div class="panel-wrapper collapse in">
																		<div class="panel-body pa-0">
																			<div class="col-sm-12 col-xs-12">
																				<div class="form-wrap">
																					<form action="#">
																						<div class="form-body overflow-hide">
																							<div class="form-group">
																								<label class="control-label mb-10" for="exampleInputuname_01">Name</label>
																								<div class="input-group">
																									<div class="input-group-addon"><i class="icon-user"></i></div>
																									<input type="text" class="form-control" id="exampleInputuname_01" placeholder="willard bryant">
																								</div>
																							</div>
																							<div class="form-group">
																								<label class="control-label mb-10" for="exampleInputEmail_01">Email address</label>
																								<div class="input-group">
																									<div class="input-group-addon"><i class="icon-envelope-open"></i></div>
																									<input type="email" class="form-control" id="exampleInputEmail_01" placeholder="xyz@gmail.com">
																								</div>
																							</div>
																							<div class="form-group">
																								<label class="control-label mb-10" for="exampleInputContact_01">Contact number</label>
																								<div class="input-group">
																									<div class="input-group-addon"><i class="icon-phone"></i></div>
																									<input type="email" class="form-control" id="exampleInputContact_01" placeholder="+102 9388333">
																								</div>
																							</div>
																							<div class="form-group">
																								<label class="control-label mb-10" for="exampleInputpwd_01">Password</label>
																								<div class="input-group">
																									<div class="input-group-addon"><i class="icon-lock"></i></div>
																									<input type="password" class="form-control" id="exampleInputpwd_01" placeholder="Enter pwd" value="password">
																								</div>
																							</div>
																							<div class="form-group">
																								<label class="control-label mb-10">Gender</label>
																								<div>
																									<div class="radio">
																										<input type="radio" name="radio1" id="radio_01" value="option1" checked="">
																										<label for="radio_01">
																										M
																										</label>
																									</div>
																									<div class="radio">
																										<input type="radio" name="radio1" id="radio_02" value="option2">
																										<label for="radio_02">
																										F
																										</label>
																									</div>
																								</div>
																							</div>
																							<div class="form-group">
																								<label class="control-label mb-10">Country</label>
																								<select class="form-control" data-placeholder="Choose a Category" tabindex="0">
																									<option value="Category 1">USA</option>
																									<option value="Category 2">Austrailia</option>
																									<option value="Category 3">India</option>
																									<option value="Category 4">UK</option>
																								</select>
																							</div>
																						</div>
																						<div class="form-actions mt-10">			
																							<button type="submit" class="btn btn-default mr-10 mb-30">Update profile</button>
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
			<!-- Footer -->
			<footer class="footer pl-30 pr-30">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<p>2018 &copy; Admintres. Pampered by Hencework</p>
						</div>
						<div class="col-sm-6 text-right">
							<p>Follow Us</p>
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-google-plus"></i></a>
						</div>
					</div>
				</div>
			</footer>
			<!-- /Footer -->
			
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
   