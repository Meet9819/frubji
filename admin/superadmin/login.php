  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Master Panel | Frubji</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">

    <!-- Main structure css file -->
    <link  rel="stylesheet" href="loginpage/login4-style.css">

  </head>
  
  <body>


    
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-5 col-lg-4 authfy-panel-left">
          <!-- brand-logo start -->
          <div class="brand-logo text-center">
            <img src="logo.png" width="250" alt="brand-logo">

          </div><!-- ./brand-logo -->
          <!-- authfy-login start -->



          <div class="authfy-login">
            <!-- panel-login start -->
            <div class="authfy-panel panel-login text-center active">
              <div class="authfy-heading">
                <h3 class="auth-title">Login to your account</h3>
                <p>Don’t have an account? <a class="lnk-toggler" data-panel=".panel-signup" href="#">Contact Admin!</a></p>
              </div>
              <!-- social login buttons start -->
              <div class="row social-buttons">
                <div class="col-xs-4 col-sm-4">
                  <a href="#" class="btn btn-lg btn-block btn-facebook">
                  <i class="fa fa-facebook"></i>
                  </a>
                </div>
                <div class="col-xs-4 col-sm-4">
                  <a href="#" class="btn btn-lg btn-block btn-twitter">
                  <i class="fa fa-twitter"></i>
                  </a>
                </div>
                <div class="col-xs-4 col-sm-4">
                  <a href="#" class="btn btn-lg btn-block btn-google">
                  <i class="fa fa-google-plus"></i>
                  </a>
                </div>
              </div><!-- ./social-buttons -->
              <div class="row loginOr">
                <div class="col-xs-12 col-sm-12">
                  <span class="spanOr">or</span>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12"> 




                  <?php

require_once("config.php");

if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != "") {
    // if logged in send to dashboard page
    redirect("index.php");
}

$mode = $_REQUEST["mode"];
if ($mode == "login") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "" || $password == "") {

        $_SESSION["errorType"] = "danger";
        $_SESSION["errorMsg"] = "Enter manadatory fields";
    } else {
        $sql = "SELECT * FROM employee WHERE username = :username AND password = :password";

        try {
            $stmt = $DB->prepare($sql);

            // bind the values
            $stmt->bindValue(":username", $username);
            $stmt->bindValue(":password", $password);

            // execute Query
            $stmt->execute();
            $results = $stmt->fetchAll();

            if (count($results) > 0) {
                $_SESSION["errorType"] = "success";
                $_SESSION["errorMsg"] = "You have successfully logged in.";
                $_SESSION["user_id"] = $results[0]["id"]; 
                $_SESSION["rolecode"] = $results[0]["u_rolecode"];
                $_SESSION["username"] = $results[0]["username"]; 
                $_SESSION["branch"] = $results[0]["workingin"];
                
                redirect("index.php");
                exit;
            } else {
                $_SESSION["errorType"] = "info";
                $_SESSION["errorMsg"] = "username or password does not exist.";
            }
        } catch (Exception $ex) {

            $_SESSION["errorType"] = "danger";
            $_SESSION["errorMsg"] = $ex->getMessage();
        }
    }
    redirect("login.php");
}


?> 

     
       <div class="form-group">

                         <?php if ($ERROR_MSG <> "") { ?>
                   <div class='txt-login-with txt-center'> <?php echo $ERROR_MSG; ?>   </div>        
                  <?php } ?>


</div>
                  <form name="contact_form" class="loginForm" action="" method="post">
                      <input type="hidden" name="mode" value="login" > 

               
                    <div class="form-group">
                      <input type="text" class="form-control email" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <div class="pwdMask">
                      <input type="password" class="form-control password" name="password" id="password" value="password" placeholder="Password">
                      <span class="fa fa-eye-slash pwd-toggle"></span>
                      </div>
                    </div>
                  
                    <div class="form-group">

                    <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Login with Username </button>

                

                    </div>
                  </form>
                </div>
              </div>
            </div> <!-- ./panel-login -->
        

          </div> <!-- ./authfy-login -->
        </div> <!-- ./authfy-panel-left -->
        <div class="col-md-7 col-lg-8 authfy-panel-right hidden-xs hidden-sm">
          <div class="hero-heading row">
            <div id="authfySlider" class="headline carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <li data-target="#authfySlider" data-slide-to="0" class="active"></li>
                <li data-target="#authfySlider" data-slide-to="1"></li>
              </ol>
              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                <div class="item active">
                   <h3>Welcome to Frubji</h3> <br>
                  <p>Food and Health</p>
                </div>
              
              </div>
            </div>
          </div>
          
        </div>
      </div> <!-- ./row -->
    </div> <!-- ./container -->
    
    <!-- Javascript Files -->

    <!-- initialize jQuery Library -->
    <script src="loginpage/jquery-2.2.4.min.js"></script>
  
    <!-- for Bootstrap js -->
    <script src="loginpage/bootstrap.min.js"></script>
  
    <!-- Custom js-->
    <script src="loginpage/custom.js"></script>
  
  </body>	
</html>

 
   


    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>



  
