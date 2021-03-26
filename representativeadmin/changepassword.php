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
		
		<div class="col-lg-12 col-xs-12">
				<div class="box-content card white">
					<h4 class="box-title">Change Password</h4>
					<!-- /.box-title -->
					<div class="card-content">






<?php

    error_reporting( ~E_NOTICE );
    
    require_once 'dbconfig.php';
    
    if(isset($representativeid))
    {
        $id = $representativeid;
        $stmt_edit = $DB_con->prepare('SELECT * FROM representative WHERE id =:id');
        $stmt_edit->execute(array(':id'=>$id));
        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($edit_row);
    }
    else
    {
        header("Location: user.php");
    }
    
   


    if(isset($_POST['btn_save_updates']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
      
        $emailid = $_POST['emailid'];
      	$mobileno = $_POST['mobileno'];
 		$password = $_POST['password'];  
 		$address = $_POST['address'];
      	$state = $_POST['state'];
 		$city = $_POST['city'];  
 		$pincode = $_POST['pincode'];

 	

 		$fblink = $_POST['fblink'];
 		$instalink = $_POST['instalink'];
 		$twitterlink = $_POST['twitterlink'];

        $imgFile = $_FILES['user_image']['name'];
        $tmp_dir = $_FILES['user_image']['tmp_name'];
        $imgSize = $_FILES['user_image']['size'];
                    
        if($imgFile)
        {
            $upload_dir = 'images/'; // upload directory 
            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
            $img = rand(1000,1000000).".".$imgExt;
            if(in_array($imgExt, $valid_extensions))
            {           
                if($imgSize < 5000000)
                {
                    unlink($upload_dir.$edit_row['img']);
                    move_uploaded_file($tmp_dir,$upload_dir.$img);
                }
                else
                {
                    $errMSG = "Sorry, your file is too large it should be less then 5MB";
                }
            }
            else
            {
                $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";        
            }   
        }
        else
        {
            // if no image selected the old image remain as it is.
            $img = $edit_row['img']; // old image from database
        }   
                        
        
        // if no error occured, continue ....
        if(!isset($errMSG))
        {
		$stmt = $DB_con->prepare('UPDATE representative SET firstname=:firstname,lastname=:lastname,address=:address,  img=:img,mobileno=:mobileno,  emailid=:emailid,password=:password, state=:state, city=:city, pincode=:pincode,fblink=:fblink,instalink=:instalink,twitterlink=:instalink WHERE id=:id');
            $stmt->bindParam(':firstname',$firstname);    
            $stmt->bindParam(':lastname',$lastname);    
            $stmt->bindParam(':address',$address);    
            $stmt->bindParam(':img',$img);
            $stmt->bindParam(':emailid',$emailid);
            $stmt->bindParam(':mobileno',$mobileno);
 			$stmt->bindParam(':password',$password);
		   	$stmt->bindParam(':state',$state);
		   	$stmt->bindParam(':city',$city);
		   	$stmt->bindParam(':pincode',$pincode);
		 	$stmt->bindParam(':fblink',$fblink);
		  	$stmt->bindParam(':instalink',$instalink);
		  	$stmt->bindParam(':twitterlink',$twitterlink);
            $stmt->bindParam(':id',$id);
                
            if($stmt->execute()){
                ?>
                <script>
                alert('Successfully Updated ...');
                window.location.href='changepassword.php';
                </script>
                <?php
            }
            else{
                $errMSG = "Sorry Data Could Not Updated !";
            }
        
        }
        
                        
    }
    
?>





  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">



							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Referral Code</label>
								<div class="col-sm-6">
									<input type="text" readonly="" name="" class="form-control" id=""  value="<?php echo $referral_code; ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Referral Link </label>
								<div class="col-sm-6">
									<input type="text" readonly=""  class="form-control"  value="<?php echo $referral_link; ?>">
								</div>
							</div>

								<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Commission Alloted to You  </label>
								<div class="col-sm-6">
									<input type="text" readonly=""  class="form-control"  value="<?php echo $commissioninper; ?> %">
								</div>
							</div>


							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">First Name</label>
								<div class="col-sm-6">
									<input type="text" name="firstname" class="form-control" id="" placeholder="Enter First Name" value="<?php echo $firstname; ?>">
								</div>
							</div>

							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Last Name</label>
								<div class="col-sm-6">
									<input type="text" name="lastname" class="form-control" id="" placeholder="Enter Last Name" value="<?php echo $lastname; ?>">
								</div>
							</div> 

								<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">User Profile </label>
									<div class="col-sm-6">
							
										 <img src="images/<?php echo $img; ?>" height="70" width="150" />
	 									 <input type="file" name="user_image" accept="image/*" />

										 <p class="help-block">Image should be 80 x 80 in pixels</p>
									</div>

								</div>


								<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">Mobile No  </label>
									<div class="col-sm-6">
										<input type="text" value="<?php echo $mobileno; ?>" name="mobileno" class="form-control" id="" placeholder="Enter Mobile No" required="">
									</div>
								</div>


								<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">Email Id</label>
									<div class="col-sm-6">
										<input type="text" value="<?php echo $emailid; ?>" name="emailid" class="form-control" id="" placeholder="Enter Emailid Id" required="">
									</div>
								</div>

								<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-6">
										<input type="text" value="<?php echo $password; ?>" name="password" class="form-control" id="" placeholder="Enter Password" required="">
									</div>
								</div>


								<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">Address</label>
									<div class="col-sm-6">
										<textarea type="text" name="address" class="form-control" id="" placeholder="Enter Address" required=""><?php echo $address; ?></textarea>
									</div>
								</div>



									<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">state</label>
									<div class="col-sm-6">
										<input type="text" name="state" class="form-control" id="" placeholder="Enter state" required="" value="<?php echo $state; ?>">
									</div>
								</div>
									<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">city</label>
									<div class="col-sm-6">
										<input type="text" name="city" class="form-control" id="" placeholder="Enter city" required="" value="<?php echo $city; ?>">
									</div>
								</div>
								
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">pincode</label>
									<div class="col-sm-6">
										<input type="text" name="pincode" class="form-control" id="" placeholder="Enter pincode" required="" value="<?php echo $pincode; ?>">
									</div>
								</div>




								<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">FB Link</label>
									<div class="col-sm-6">
										<input type="text" name="fblink" class="form-control" id="" placeholder="Enter FB Link" required="" value="<?php echo $fblink; ?>">
									</div>
								</div>	
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">Instagram Link</label>
									<div class="col-sm-6">
										<input type="text" name="instalink" class="form-control" id="" placeholder="Enter Instagram Link" required="" value="<?php echo $instalink; ?>">
									</div>
								</div>	
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-3 control-label">Twitter Link</label>
									<div class="col-sm-6">
										<input type="text" name="twitterlink" class="form-control" id="" placeholder="Enter Twitter Link" required="" value="<?php echo $twitterlink; ?>">
									</div>
								</div>



								<div class="form-group margin-bottom-0">
										<label for="inp-type-5" class="col-sm-3 control-label"></label> 

										<div class="col-sm-6">
											 <input class="btn btn-primary btn-sm waves-effect waves-light" type="submit" name="btn_save_updates" value="Update" />
	   							
									</div>
								</div>


						</form>
					</div>
					<!-- /.card-content -->
				</div>
				<!-- /.box-content card white -->
			</div>



	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
	
	     
<?php include "allscripts.php"; ?>
