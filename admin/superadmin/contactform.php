
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
                        if (authorize($_SESSION["access"]["ECOMMERCE"]["CONTACTFORM"]["create"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["CONTACTFORM"]["edit"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["CONTACTFORM"]["view"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["CONTACTFORM"]["delete"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["CONTACTFORM"]["approval"])) {
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
                <h5 class="txt-dark">Ecommerce Contact Form</h5>
              </div>
              <!-- Breadcrumb -->
              <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                  <li>
                    <a href="index.php">Dashboard</a>
                  </li>
                  <li>
                    <a href="contactform.php"><span>Ecommerce 
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="leads.php">
                      <span>Main Pages
                      </span>
                    </a>
                  </li>
                  <li class="active">
                    <span> Ecommerce Contact Form
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
                     <table style="width:100%" id="myTable1" class="table table-hover display  pb-30" >
       
                      <thead>
                        <tr>
                           <th >UserId</th>
                           <th>First Name</th>
                           <th>Last Name</th>      
                           <th>Email </th>                           
                           <th>Mobile No</th>        
                           <th>Message </th> 
                        </tr>
                      </thead>
                      <tbody> 
                    <?php
                    include('conn.php'); 
                    $query=mysqli_query($conn,"SELECT * FROM `e_contact` ");
                     $tmpCount = 1;
                    while($row=mysqli_fetch_array($query)){
                    ?> 
                    <tr>    
                        <td style="padding: 10px"><?php echo $row['id']; ?></td>  
                        <td><?php echo $row['firstname']; ?></td> 
                        <td><?php echo $row["lastname"]; ?></td> 
                        <td><?php echo $row["email"]; ?></td>  
                        <td><?php echo $row['mobile']; ?></td>  
                        <td><?php echo $row["message"]; ?></td>  
                        


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

