
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

  <title>Frubji | Representative Admin Panel</title>
	<link rel="stylesheet" href="assets/styles/style.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="assets/plugin/waves/waves.min.css">

</head>

<body>

<div id="single-wrapper">
    <?php

    error_reporting(0);
    require('db.php');
    session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['mobileno'])){

        $mobileno = stripslashes($_REQUEST['mobileno']); // removes backslashes
        $mobileno = mysqli_real_escape_string($con,$mobileno); //escapes special characters in a string
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con,$password);

    //Checking is user existing in the database or not
        $query = "SELECT * FROM `representative` WHERE mobileno='$mobileno' and password='$password' and status = 1";
        $result = mysqli_query($con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if($rows==1){
            
            $_SESSION['mobileno'] = $mobileno;
            header("Location: index.php"); // Redirect user to index.php
            }else{ $abc = "<b>Mobile No / Password is incorrect.</b>";
                }
    }else{
?>

        <?php } ?>	

        <form action="" class="frm-single" name="login" method="post">

		<div class="inside"> 

			<div class="title"><img src="images/logo.png"></div> <Br><br>
		
			<div class="frm-title">Representative Login</div>

			<div class="frm-input">
			<input type="text" name="mobileno" placeholder="Mobile No" class="frm-inp" required=""><i class="fa fa-user frm-ico"></i></div>
		
			<div class="frm-input"><input type="password" name="password" placeholder="Password" class="frm-inp" required=""><i class="fa fa-lock frm-ico"></i></div>
			
			<input  class="frm-submit" name="submit" type="submit" value="Login" />

			<div class="row small-spacing">
				<div class="col-sm-12">
				<div class='txt-login-with txt-center'><?php echo $abc; ?> </div>
				</div>
			</div>
			
			<div class="frm-footer">Frubji © 2020.</div>
			
		</div>
	</form>
</div>
	<script src="assets/scripts/jquery.min.js"></script>
	<script src="assets/scripts/modernizr.min.js"></script>
	<script src="assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/plugin/nprogress/nprogress.js"></script>
	<script src="assets/plugin/waves/waves.min.js"></script>

	<script src="assets/scripts/main.min.js"></script>
</body>
</html>