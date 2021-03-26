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
        if ( authorize($_SESSION["access"]["REPRESENTATIVE"]["ALLREPRESENTATIVE"]["create"]) || 
        authorize($_SESSION["access"]["REPRESENTATIVE"]["ALLREPRESENTATIVE"]["edit"]) || 
        authorize($_SESSION["access"]["REPRESENTATIVE"]["ALLREPRESENTATIVE"]["view"]) || 
        authorize($_SESSION["access"]["REPRESENTATIVE"]["ALLREPRESENTATIVE"]["delete"]) || 
        authorize($_SESSION["access"]["REPRESENTATIVE"]["ALLREPRESENTATIVE"]["approval"])) {
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
                        <h5 class="txt-dark">View All Representative</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="#"><span>Purchase Setup</span></a></li>
                            <li class="active"><span>All Representative</span></li>
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
                                                    <tr>  
                                                      <th>Unique Code  </th>   
                                                        <th>Name</th>  
                                                        <th>Mobile No</th>                                                         
                                                        <th>Email Id</th>
                                                        <th>Address</th>
                                                        <th>Link</th> <th>Commission</th>
                                                        <th style="width: 100px">Action</th>

                                                    </tr>
                                                </thead>



                                                <tbody>                                         
                                                    <?php 
                                                    include('db.php');    
                                                    $result = mysqli_query($con,"SELECT * from representative");  

                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                    echo   '<tr>   <td>'.$row['id'].'</td> 
                                                                 <td>'.$row['firstname'].' '.$row['lastname'].'</td>          
                                                                 <td style="padding:10px">

                                                                    <a  href="#viewbatch' . $row['id'] . '" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"> 
                                                                    '.$row['mobileno'].'
                                                                    </a>

                                                                 </td>           
                                                                 <td>'.$row['emailid'].'</td> 
                                                                 <td>'.$row['address'].'</td> 
                                                                 <td>'.$row['referral_code'].' ---  '.$row['referral_link'].'</td>
                                                                 <td>'.$row['commissioninper'].' %</td> 

                                                                 ';?> 
                                                                 <td> 

                                                                  <?php echo '<a  href="allrepresentativeedit.php?edit_id='.$row['id'].'"  class="text-inverse pr-10" title="Edit" data-toggle="tooltip"> <i class="zmdi zmdi-edit txt-danger">
                                                                  </i>  </a>';   ?>


                                                                  <span data="<?php echo $row['id'];?>" class="status_checks btn-sm label <?php echo ($row['status'])? 'label-success' : 'label-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></span>&nbsp;&nbsp;</td>


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


             <!-- ACTIVE AND INACTIVE KA CODE -->

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).on('click','.status_checks',function(){
var status = ($(this).hasClass("label-success")) ? '0' : '1';
var msg = (status=='0')? 'Deactivate' : 'Activate';
if(confirm("Are you sure to "+ msg)){
  var current_element = $(this);
  url = "allstatus/representativeajax.php";
  $.ajax({
  type:"POST",
  url: url,
  data: {id:$(current_element).attr('data'),status:status},
  success: function(data)
    {   
      location.reload();
    }
  });
  }      
});
</script>

     <!-- ACTIVE AND INACTIVE KA CODE --> 
			
            <?php include "footer.php"; ?>

        </div>
        <!-- /Main Content -->

        <?php include "allscript.php"; ?> 

    
