
<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 

                        <!-- ROLE BASED -->
                         <?php
                        require_once "config.php";
                        if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
                            // not logged in send to login page
                            redirect("index.php");
                        }
                        $status = false;
                        if (authorize($_SESSION["access"]["ECOMMERCE"]["COMPLAINTBOX"]["create"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["COMPLAINTBOX"]["edit"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["COMPLAINTBOX"]["view"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["COMPLAINTBOX"]["delete"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["COMPLAINTBOX"]["approval"])) {
                            $status = true;
                        }

                        if ($status === false) {
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
                <h5 class="txt-dark">Ecommerce Complaint Box</h5>
              </div>
              <!-- Breadcrumb -->
              <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                  <li>
                    <a href="index.php">Dashboard</a>
                  </li>
                  <li>
                    <a href="complaintbox.php"><span>Ecommerce 
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="complaintbox.php">
                      <span>Main Pages
                      </span>
                    </a>
                  </li>
                  <li class="active">
                    <span> Ecommerce Complaint Box
                    </span>
                  </li>
                </ol>
              </div>
              <!-- /Breadcrumb -->
            </div>
            <!-- /Title -->  

  
            <div class="panel panel-default border-panel card-view">
              <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="table-wrap">
                     <table style="width:100%" id="example" class="table table-hover display  pb-30" >
       
                      <thead>
                        <tr>   <th >Branch</th>
                           <th >Name</th>
                           <th >Email Id</th>
                           <th >Mobile</th>
                           <th >Type of Complaint </th>
                           <th >Invoice no</th>
                           <th >Attach</th>
                            
                           <th>Message </th> 
                           <th>Attach </th> 
                        </tr>
                      </thead>
                      <tbody> 
                    <?php
                    include('conn.php'); 
                    $query=mysqli_query($conn,"SELECT c.id,c.customerid, t.userName,t.userEmail,t.mobile, c.topic,c.invoiceno,c.img,c.branch,c.message,c.status FROM `complaintbox` c , `tbl_users` t where t.userID = c.customerid ");
                     $tmpCount = 1;
                    while($row=mysqli_fetch_array($query)){
                    ?> 
                    <tr>    
                        <td style="padding: 10px"><?php echo $row['branch']; ?></td>  
                        <td style="padding: 10px"><?php echo $row['userName']; ?></td>  
                        <td style="padding: 10px"><?php echo $row['userEmail']; ?></td>  
                        <td style="padding: 10px"><?php echo $row['mobile']; ?></td>  

                        <td style="padding: 10px"><?php echo $row['topic']; ?></td>  
                        <td style="padding: 10px"><?php echo $row['invoiceno']; ?></td>  
                         <td><a target="_blank" href="../../media/complaintbox/<?php echo $row['img'];?>" ><img style="width:100px" src="../../media/complaintbox/<?php echo $row['img'];?>"> </a></td> 

                       
                        <td><?php echo $row["message"]; ?></td>  
                        
                        <td>

                            <?php if($row['status'] == 0)
                            {
                              echo '<a data-target="#viewstatus'.$row["id"].'" data-toggle="modal"  class="text-inverse btn-sm label label-danger" title="View" data-toggle="tooltip"> Pending</a> 

                               ';
                            } 
                            else if($row['status'] == 1)
                            {
                              echo ' <a data-target="#viewstatus'.$row["id"].'" data-toggle="modal"  class="text-inverse btn-sm label label-success" title="View" data-toggle="tooltip"> Resolved</a>  

                               ';
                            } 

                            ?>
                            
                          </td>
  <?php include 'modal/complaintboxstatus.php';?>  
  
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
               </table>


                    </div>
                  </div>
                </div>
              </div>
         



          <?php include "footer.php"; ?>
        </div>
      </div>
      <!-- /Main Content --> 

      <?php include "allscript.php"; ?>

