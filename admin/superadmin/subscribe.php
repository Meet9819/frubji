
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
                        if (authorize($_SESSION["access"]["ECOMMERCE"]["SUBSCRIBE"]["create"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["SUBSCRIBE"]["edit"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["SUBSCRIBE"]["view"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["SUBSCRIBE"]["delete"]) ||
                            authorize($_SESSION["access"]["ECOMMERCE"]["SUBSCRIBE"]["approval"])) {
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
                <h5 class="txt-dark">Ecommerce Subscribe</h5>
              </div>
              <!-- Breadcrumb -->
              <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                  <li>
                    <a href="index.php">Dashboard</a>
                  </li>
                  <li>
                    <a href="subscribe.php"><span>Ecommerce 
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="">
                      <span>Main Pages
                      </span>
                    </a>
                  </li>
                  <li class="active">
                    <span> Subscribed Subscribe
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
                           <th >Id</th>
                           <th>Email Id</th>
                          
                           <th>Subscribed on</th> 
                           <th>Status</th>
                        </tr>
                      </thead>
                      <tbody> 
                    <?php
                    include('conn.php'); 
                    $query=mysqli_query($conn,"SELECT * FROM `ecommerce_subscribe` ");
                     $tmpCount = 1;
                    while($row=mysqli_fetch_array($query)){
                    ?> 
                    <tr>    
                        <td style="padding: 10px"><?php echo $row['id']; ?></td>  
                        
                        <td><?php echo $row["email"]; ?></td> 
                       
                        <td><?php echo $row["created_on"]; ?></td>  
                        <td><?php echo ' <span data="'.$row['id'].'" class="status_checks btn-sm label ';?><?php echo ($row['status'])? 'label-success' : 'label-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></span> &nbsp;&nbsp;                       
                      </td>  
                        
                     

                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
               </table>
<!-- ACTIVE AND INACTIVE KA CODE -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.status_checks',function(){
  var status = ($(this).hasClass("label-success")) ? '0' : '1';
  var msg = (status=='0')? 'Deactivate' : 'Activate';
  if(confirm("Are you sure to "+ msg)){
    var current_element = $(this);
    url = "allstatus/ecommercesubscribeajax.php";
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

                    </div>
                  </div>
                </div>
              </div>
         


          <?php include "footer.php"; ?>
        </div>
      </div>
      <!-- /Main Content --> 

      <?php include "allscript.php"; ?>

