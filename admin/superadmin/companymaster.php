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
if ( authorize($_SESSION["access"]["MASTER"]["COMPANY_MASTER"]["create"]) || 
authorize($_SESSION["access"]["MASTER"]["COMPANY_MASTER"]["edit"]) || 
authorize($_SESSION["access"]["MASTER"]["COMPANY_MASTER"]["view"]) || 
authorize($_SESSION["access"]["MASTER"]["COMPANY_MASTER"]["delete"]) || 
authorize($_SESSION["access"]["MASTER"]["COMPANY_MASTER"]["approval"])) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

?>
<!-- ROLE BASED --> 
<!-- MAIN CONTENT STARTS -->
<div class="page-wrapper">
<div class="container-fluid">
<!-- Title -->
<div class="row heading-bg">
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    <h5 class="txt-dark">Company Master
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
        <a href="companymaster.php">
        <span>Master
        </span>
        </a>
      </li>
      <li>
        <a href="companymaster.php">
        <span>Company Setup
        </span>
        </a>
      </li>
      <li class="active">
        <span> Company Master
        </span>
      </li>
    </ol>
  </div>
  <!-- /Breadcrumb -->
</div>
<!-- /Title -->  
<link rel="stylesheet" type="text/css" href="dist/timeline.css">
<div class="panel panel-default border-panel ">
  <div  class="panel-wrapper collapse in">
    <div  class="panel-body">
      <div class="col-md-6">
       
      </div>
      <div class="col-md-6 text-right">
       

          <a href="companyadd.php"  class="btn btn-default btn-outline btn-icon right-icon"><i class="fa fa-plus"></i><span class="btn-text">  New </span></a>
        
        
        <a href="branchmaster.php"  class="btn btn-primary  btn-icon right-icon"><span class="btn-text"> Branch</span></a>
       
      
      </div>
    </div>
  </div>
</div>
<!--due to this profile top menu is not coming <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script>-->
<div class="panel panel-default border-panel card-view">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap">
<table id="datatable" data-toggle="table">
<thead>
  <tr>
    <th>Company Name
    </th>
    <th>Company Code
    </th>
    <th>Company Prefix
    </th>
   
    <th>Address
    </th>
   
    <th>Action
    </th>
  </tr>
</thead>
<tbody>


                   <?php
  include('conn.php');
  $query=mysqli_query($conn,"SELECT * from `company` order by id desc");
  
  $couunt = 0;
  while($row=mysqli_fetch_array($query)){
    $couunt++;
    ?>
<tr>
  <td>
    <a data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">  <?php echo $row['companyname_english']; ?> </a>
  </td>
  <td><?php echo $row['companycode']; ?></td>
  <td><?php echo $row['prifix']; ?></td>
  <td><?php echo $row['address']; ?></td>
  <td>
    <!-- ROLE BASED VIEW -->
    <?php if (authorize($_SESSION["access"]["MASTER"]["COMPANY_MASTER"]["view"])) { ?>
    <a data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal"  class="text-inverse" title="View" data-toggle="tooltip">
    <i class="fa fa-eye txt-default"></i></a> &nbsp;&nbsp; 
    <?php } ?>
    <!-- ROLE BASED VIEW -->
    <!-- ROLE BASED EDIT -->
    <?php if (authorize($_SESSION["access"]["MASTER"]["COMPANY_MASTER"]["edit"])) { ?>
    <?php  echo '<a  href="companyedit.php?edit_id='.$row['id'].'"  class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
      <i class="zmdi zmdi-edit txt-success">  </i>  </a> '; ?>   
  
    <?php } ?>
    <!-- ROLE BASED EDIT -->
    <!-- ROLE BASED DELETE -->
    <?php if (authorize($_SESSION["access"]["MASTER"]["COMPANY_MASTER"]["delete"])) { ?>
    <a href="#del<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="zmdi zmdi-delete txt-danger"></i></a>&nbsp;&nbsp; 
    <?php } ?>
    <?php include "c/deletemodal.php"; ?>
    <!-- ROLE BASED DELETE -->
    <!-- ROLE BASED APPROVAL -->
    <?php if (authorize($_SESSION["access"]["MASTER"]["COMPANY_MASTER"]["approval"])) { ?>
    <span data="<?php echo $row['id'];?>" class="status_checks btn-sm label <?php echo ($row['status'])? 'label-success' : 'label-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></span> &nbsp;&nbsp; 
    <?php } ?>
    <a href="#companylogs<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="fa fa-commenting" aria-hidden="true"></i></a>
    <!-- ROLE BASED APPROVAL -->
    <?php include 'modal/viewcompany.php';?>  
    <?php include 'logs/companylogs.php';?> 
  </td>
</tr>
<?php
  }
  ?>
</tbody>
<?php include('c/add_modal.php'); ?>
</table> 
<!-- ACTIVE AND INACTIVE KA CODE -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.status_checks',function(){
  var status = ($(this).hasClass("label-success")) ? '0' : '1';
  var msg = (status=='0')? 'Deactivate' : 'Activate';
  if(confirm("Are you sure to "+ msg)){
    var current_element = $(this);
    url = "c/compajax.php";
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
</div>
</div>
<!-- /Row -->
<?php include "footer.php"; ?>
</div>
</div>
<!-- /Main Content --> 



<?php include "allscript.php"; ?>