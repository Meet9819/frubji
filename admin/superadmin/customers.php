        <?php include "allcss.php"; ?>
        <?php include "header.php"; ?>

        <!-- ROLE BASED -->
         <?php
        require_once("config.php");
        if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
            // not logged in send to login page
            redirect("index.php");
        }
        $status = FALSE;
        if ( authorize($_SESSION["access"]["REPRESENTATIVE"]["CUSTOMERS"]["create"]) || 
        authorize($_SESSION["access"]["REPRESENTATIVE"]["CUSTOMERS"]["edit"]) || 
        authorize($_SESSION["access"]["REPRESENTATIVE"]["CUSTOMERS"]["view"]) || 
        authorize($_SESSION["access"]["REPRESENTATIVE"]["CUSTOMERS"]["delete"]) || 
        authorize($_SESSION["access"]["REPRESENTATIVE"]["CUSTOMERS"]["approval"])) {
         $status = TRUE;
        }

        if ($status === FALSE) {
        die("You dont have the permission to access this page");
        }

        ?>
        <!-- ROLE BASED --> 

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- Title -->
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">View All Customers</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="#"><span>Purchase Setup</span></a></li>
                            <li class="active"><span>All Customers</span></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->

                        <div class="panel panel-default border-panel card-view">
                        
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="table-wrap">
                                        <div class="">
                                          <table style="width:100%" id="myTable1" class="table table-hover display  pb-30" >
                                                <thead>
                                                    <tr>  <th>Representative Id   </th>   
                                                        <th>Name</th>
                                                                                                         
                                                        <th>Mobile No</th>                                                         
                                                        <th>Email Id</th><th>Address</th>
                                                    </tr>
                                                </thead>



                                                <tbody>                                         
                                                    <?php 
                                                    include('db.php');


                                                   



                                                       $result = mysqli_query($con,"SELECT * FROM `tbl_users` c, `representative` r where c.representativeid = r.id");  


                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                    echo   '<tr>   <td>'.$row['firstname'].'</td> 
                                                                 <td>'.$row['userName'].' </td>          
                                                                 <td style="padding:10px">

                                                                    <a  href="#viewbatch' . $row['id'] . '" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"> 
                                                                    '.$row['mobile'].'
                                                                    </a>

                                                                 </td>           
                                                                 <td>'.$row['userEmail'].'</td> 
                                                                 <td>'.$row['address'].'</td>

                                                                '; ?> 
                                                                    <?php include 'modal/viewstockmaster.php';?> <?php echo '
                                                            </tr> 
                                                            '; 
                                                    } 
                                                    ?>        
                                                 </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                <!-- /Row -->
            </div>
			
            <?php include "footer.php"; ?>

        </div>
        <!-- /Main Content -->

        <?php include "allscript.php"; ?> 

    
