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
if ( authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["create"]) || 
authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["edit"]) || 
authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["view"]) || 
authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["delete"]) || 
authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["approval"])) {
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
        <h5 class="txt-dark">Cutomer Master
        </h5>
      </div>
      <!-- Breadcrumb -->
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.php">Dashboard
            </a>
          </li>
          <li>
            <a href="customermaster.php">
              <span>Master
              </span>
            </a>
          </li>
          <li>
            <a href="customermaster.php">
              <span>Cutomer Setup
              </span>
            </a>
          </li>
          <li class="active">
            <span> Cutomer Master
            </span>
          </li>
        </ol>
      </div>
      <!-- /Breadcrumb -->
    </div>
    <!-- /Title -->  
    <div class="row">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-12 text-right">
            <div class="panel panel-default border-panel ">
              <div  class="panel-wrapper collapse in">
                <div  class="panel-body">
       

 
                  <div class="col-md-6 text-left">  

                  <?php include 'importexcel/customerfunctions.php'; ?>
                  <link rel="stylesheet" href="dist/leftrightmodal.css">  
                  <a data-target="#customerright" data-toggle="modal" class="btn btn-primary" title="Edit" data-toggle="tooltip">Import Data </a> 
                  <?php include "importexcel/customerrightmodal.php"; ?>

                  </div>         
             


                  <div class="col-md-6 text-right"> 






  <!-- ROLE BASED CREATE--> 
    <?php if (authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["create"])) { ?> 

<a href="customeradd.php" class="btn btn-default btn-outline btn-icon right-icon"><i class="fa fa-plus"></i><span class="btn-text"> Add New</span></a>

    <?php } ?> 
    <!-- ROLE BASED CREATE--> 

                        <?php
                        error_reporting(0);
                        if(isset($_POST['search']))
                        {
                               $type = $_POST['type'];  

                                 $customergroup = $_POST['customergroup'];  
                               
                            
                           

                          $query = "SELECT * FROM `customer` WHERE type = '".$type."' or customergroup = '".$customergroup."'";

                            $search_result = filterTable($query);
                            
                        }
                         else { 

                        
                         $query = "select * from customer";
                           $search_result = filterTable($query);
                        }
                        ?>

                        <?php                     
                   
                         function filterTable($query)
                        {
                          include "fdb.php";
                            $filter_Result = mysqli_query($connect, $query);
                            return $filter_Result;
                        } 
                        ?>    

                      <form action="" method="post" style="display: inline;">
                       
                     
                        <a style="background: #22252a;"  href="#searchbox" data-toggle="modal" class=" btn btn-default" title="searchbox" data-toggle="tooltip"><i style="color: white" class="zmdi zmdi-search"></i>
                        </a>
                
                      <?php include('searchbox/customersearchbox.php'); ?>

                      </form>







</div>
                   </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--due to this profile top menu is not coming <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
    </script>
    <!-- Row -->
   
        <div class="panel panel-default border-panel card-view">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="table-wrap">
                 <table style="width:100%" id="myTable1" class="table table-hover display  pb-30" >
       
                  <thead>
                    <tr>
                      <th>Sr No</th>
                      <th>Customer Code
                      </th> 
                      <th>Customer Name  
                      </th>    
                      <th>Credit Limit
                      </th>
                      <th>Credit Days
                      </th>  
                      <th>Type 
                      </th>

                    
                    
                      <th>Action
                      </th>
                    </tr>
                  </thead>
                  <tbody>  





                    <?php
                        $tmpCount = 1;
                       while($row=mysqli_fetch_array($search_result)){
                    ?>
                    <tr>

                      <td style="padding: 10px">
                          <?php echo $tmpCount++ ?>
                      </td>
                         
                      <td >
                        <?php echo $row['code']; ?>
                      </td>
                      <td>
                       <a   data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">  <?php echo $row['customername']; ?> </a>
                      </td>
                      <td>
                        <?php echo $row['creditlimits']; ?>
                      </td>
                      <td>
                        <?php echo $row['creditdays']; ?>
                      </td> 
                      <td>
                        <?php echo $row['type']; ?>
                      </td>
                    



 <?php include 'modal/viewcustomermaster.php';?>  


                      <TD>
                        




<!-- ROLE BASED VIEW -->
                           <?php if (authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["view"])) { ?>
                              


  <a  data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal"  class="text-inverse pr-10" title="View" data-toggle="tooltip">
                                     <i class="fa fa-eye txt-default"></i></a> 

                                <?php } ?>

<!-- ROLE BASED VIEW -->


<!-- ROLE BASED EDIT -->
                                <?php if (authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["edit"])) { ?>
                                  
                                      <?php echo '    <a  href="customeraddedit.php?edit_id='.$row['id'].'" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
                          <i class="zmdi zmdi-edit txt-success">
                          </i>
                        </a> '; ?>
     
                                <?php } ?>
<!-- ROLE BASED EDIT -->


<!-- ROLE BASED DELETE -->

                                <?php if (authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["delete"])) { ?>
                                 
                             <a href="#del<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse pr-10" title="Delete" ><i class="zmdi zmdi-delete txt-danger"></i></a>

                                <?php } ?>

<!-- ROLE BASED DELETE -->

<!-- ROLE BASED APPROVAL -->

                                <?php if (authorize($_SESSION["access"]["MASTER"]["CUSTOMER_MASTER"]["approval"])) { ?>
                                 
                      <span data="<?php echo $row['id'];?>" class="status_checks btn-sm label <?php echo ($row['status'])? 'label-success' : 'label-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></span>&nbsp;&nbsp; 

                                <?php } ?>

<!-- ROLE BASED APPROVAL -->
 <a href="#customerlogs<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="fa fa-commenting" aria-hidden="true"></i></a>
<?php include 'logs/customerlogs.php';?> 

                      </TD>


                  
<?php include "alldelete/customerdeletemodel.php"; ?>
                    
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
     
    <!-- /Row --> 

<!-- ACTIVE AND INACTIVE KA CODE -->

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).on('click','.status_checks',function(){
var status = ($(this).hasClass("label-success")) ? '0' : '1';
var msg = (status=='0')? 'Deactivate' : 'Activate';
if(confirm("Are you sure to "+ msg)){
  var current_element = $(this);
  url = "allstatus/customerajax.php";
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
</div>
<!-- /Main Content -->



<?php include "allscript.php"; ?>

<!-- FORM FIL UPLOAD -->
        <script src="../vendors/bower_components/dropify/dist/js/dropify.min.js"></script>
        <script src="dist/js/form-file-upload-data.js"></script>
        <!-- FORM FIL UPLOAD --> 
    
    <script src="../vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
    