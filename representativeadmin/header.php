<?php 
include "db.php"; 

$representativeuniquemobileno = $_SESSION['mobileno'];

$result = mysqli_query($con,"SELECT * FROM representative where mobileno = $representativeuniquemobileno");
while($row = mysqli_fetch_array($result))
{    echo $representativeid = $row['id']; 
  echo $firstname = $row['firstname'];  
  echo $lastname = $row['lastname'];  
   
  echo $mobileno = $row['mobileno'];    
  echo $emailid = $row['emailid'];    
  echo $address = $row['address'];    
  echo $password = $row['password'];    
  echo $referral_code = $row['referral_code'];    
  echo $referral_link = $row['referral_link'];       
  echo $commissioninper = $row['commissioninper'];   
} 
?>  

<div class="main-menu">
    <header class="header">
        <a href="index.php" class="logo">FRUBJi </a>
        <button type="button" class="button-close fa fa-times js__menu_close"></button>
        <div class="user">
            <a href="#" class="avatar"><img src="images/user.png" alt=""><span class="status online"></span></a>
            <h5 class="name"><a href="changepassword.php">
                            <?php  echo $_SESSION['mobileno']; ?>!
                            </a></h5>
            <h5 class="position">Representative</h5>
           
        </div>
        <!-- /.user -->
    </header>
    <!-- /.header -->
    <div class="content">

        <div class="navigation">
            <h5 class="title">Navigation</h5>
            <!-- /.title -->
            <ul class="menu js__accordion">
                <li class="">
                    <a class="waves-effect" href="index.php"><i class="menu-icon fa fa-home"></i><span>Dashboard</span></a>
                </li>


                <li>
                    <a class="waves-effect" href="customers.php"><i class="menu-icon fa fa-user"></i><span>Customers</span></a>
                </li>
   
                <li>
                    <a class="waves-effect" href="orders.php"><i class="menu-icon fa fa-first-order"></i><span>Orders</span></a>
                </li>
                   <li>
                    <a class="waves-effect" href="complaints.php"><i class="menu-icon fa fa-list-alt"></i><span>Complaints</span></a>
                </li>

                 <li>
                    <a class="waves-effect" href="changepassword.php"><i class="menu-icon fa fa-pencil"></i><span>Change Password</span></a>
                </li>



              

   
              

            </ul>
           
            <!-- /.menu js__accordion -->
        </div>
        <!-- /.navigation -->
    </div>
    <!-- /.content -->
</div>
<!-- /.main-menu -->




<div class="fixed-navbar">
    <div class="pull-left">
        <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
        <h1 class="page-title"></h1>
        <!-- /.page-title -->
    </div>
    <!-- /.pull-left -->
    <div class="pull-right">
        
        <!-- /.ico-item -->
        <div class="ico-item fa fa-arrows-alt js__full_screen"></div>
      
        <a href="logout.php" class="ico-item fa fa-power-off"></a>
    </div>
    <!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->



