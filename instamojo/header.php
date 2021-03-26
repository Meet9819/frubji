
<?php  
// initializ shopping cart class
include '../Cart.php';
$cart = new Cart;

?>
 

 <!-- SESSION CODE | Login karne k baad --> 
<?php
error_reporting(0);

session_start();
require_once '../class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
// $user_home->redirect('login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));



$row = $stmt->fetch(PDO::FETCH_ASSOC);

$con = mysqli_connect("localhost","root","","frubji") or die ('Unable to connect');


?>
<!-- SESSION CODE | Login karne k baad --> 

   <header id="navbar-spy" class="header header-1">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-5">
                        <ul class="list-inline top-contact">
                            <li><span>Phone :</span> +91 72081 90045</li>
                            <li><span>Email :</span> info@grocerpoint.in</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-7">
                        <ul class="list-inline pull-right top-links">
                          
                          <!--  <li>
                                <a href="checkout.php">Checkout</a>
                            </li> -->
                          

                          
                            <?php
                if(isset($_SESSION['userSession']))
                {
                 echo '  


                             <li class="dropdown"> 

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello, '.$row['userName'].' <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
 <li>
                                <a href="../profile.php">My Account</a>
                            </li> 

                             <li>
                                <a href="../wishlist.php">My Wishlist</a>
                            </li>
                             <li>
                                <a href="../history.php">My Order</a>
                            </li>
                                   
                                    

                                    <li>
                                        <a href="../logout.php" > Sign Out</a> 
                                    </li>
                                </ul>
                            </li>           
 ';
}
                else{
echo '  <li>
                                <a href="../login.php">Login</a> /
                                <a href="../register.php">Register</a>
                            </li>';
                }?>

                        </ul>
                    </div>
                </div>
                
            </div>
          
        </div>
       
        <nav id="primary-menu" class="navbar navbar-fixed-top">
            <div class="container">
              
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="logo" href="../index.php">
                        <img style="width:200px" src="../assets/images/logo/logo.png" alt="Autoshop">
                    </a>
                </div>

               
                <div class="collapse navbar-collapse pull-right" id="header-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="../index.php">Home</a>
                        </li>
                        <li class="has-dropdown">
                            <a href="../products.php">shop</a>
                            <ul class="dropdown-menu">
<!-- MENU CODE --> 
<?php 
include "../db.php";

function get_menu_tree($parent_id) 
{
    global $con;
    $menu = "";
    $sqlquery = " SELECT * FROM menu where status='1' and parent_id='" .$parent_id . "' ";
    $res=mysqli_query($con,$sqlquery);
    while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
    { 

        $menu .= '<li class="dropdown-submenu"> <a href="../shop.php?q='.$row['menu_id'].'">'.$row['menu_name'].'</a> ';

        $menu .=  '<ul class="dropdown-menu">'.get_menu_tree($row['menu_id']).'
                    </ul>'; 

        $menu .= '</li>';

    }

    return $menu;

}  

?>
<?php echo get_menu_tree(0); ?>
<!-- MENU CODE --> 
                            </ul>
                        </li>
                       
                        <li>
                            <a href="../about.php">about</a>
                        </li>

                        <li>
                            <a href="../contact.php">Contact</a>
                        </li>

                    </ul>

<!-- SEARCH CODE -->  



                           


                    <div class="module module-search pull-left" style="margin-top:35px">
                        <div class="search-icon">
                            <i class="fa fa-search"></i>
                            <span class="title">search</span>
                        </div>
                        <div class="search-box"> 


                             <?php
    ini_set('display_errors', 1);
    error_reporting(~0);
    $strKeyword = null;
    if(isset($_POST["txtKeyword"]))
    {
        $strKeyword = $_POST["txtKeyword"];
    }
?>  

   <form id="searchbox" name="frmSearch" method="post" action="../searchresult.php" class="search-form">
                                <div class="input-group">
                                    <input  type="text" class="search_query form-control" placeholder="Type Your Search Words" name="txtKeyword" id="txtKeyword" value="<?php echo $strKeyword;?>">
                                    <span class="input-group-btn">
                                    <button class="btn btn-default button-search" type="submit"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                              
                            </form>





<?php
   $servername = "localhost";
   $userName = "vipulecommerce";
   $userPassword = "loveyoudad9820102993";
   $dbName = "vipulecommerce";

   $conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
  
  


  $sql = "SELECT * FROM products WHERE productcode LIKE '%".$strKeyword."%' OR name like '%".$strKeyword."%' OR price like '%".$strKeyword."%' OR discount like '%".$strKeyword."%' OR description like '%".$strKeyword."%'  OR descr like '%".$strKeyword."%'"; 
   $query = mysqli_query($conn,$sql);

   $query = mysqli_query($conn,$sql); 



?>

                         
                        </div>
                    </div>
<!-- SEARCH CODE --> 
                    <div class="module module-cart pull-left" style="margin-top:38px">
                        <div class="cart-icon">


                            

                            <i class="fa fa-shopping-cart"></i>
                            <span class="title">shop cart</span>
                        </div>
                    
                    </div>
                   
                </div>
            </div>
        </nav>
    </header>