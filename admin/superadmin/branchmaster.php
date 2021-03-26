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
if ( authorize($_SESSION["access"]["MASTER"]["BRANCH_MASTER"]["create"]) || 
authorize($_SESSION["access"]["MASTER"]["BRANCH_MASTER"]["edit"]) || 
authorize($_SESSION["access"]["MASTER"]["BRANCH_MASTER"]["view"]) || 
authorize($_SESSION["access"]["MASTER"]["BRANCH_MASTER"]["delete"]) || 
authorize($_SESSION["access"]["MASTER"]["BRANCH_MASTER"]["approval"])) {
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
    <h5 class="txt-dark">Branch Master</h5>
  </div>
  <!-- Breadcrumb -->
  <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <ol class="breadcrumb">
      <li><a href="index.php">Dashboard</a></li>
      <li><a href="branchmaster.php"><span>Master</span></a></li>
      <li><a href="branchmaster.php"><span>Branch Setup</span></a></li>
      <li class="active"><span>Branch Master</span></li>
    </ol>
  </div>
  <!-- /Breadcrumb -->
</div>
<!-- /Title --> 
<div class="panel panel-default border-panel ">
  <div  class="panel-wrapper collapse in">
    <div  class="panel-body">
      <div class="col-md-7">
      

      </div>
      <div class="col-md-4 text-right">
      

          
                  <a href="branchadd.php" class="btn btn-primary btn-icon right-icon"><i class="fa fa-plus"></i><span class="btn-text"> New</span></a>
          

     

      </div>
    

    </div>
  </div>
</div>




<form action="branchmaster.php" method="post">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default border-panel card-view">
        <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="table-wrap">
              <table id="datatable" data-toggle="table">
                <thead>
                  <tr>
                    <th>Company Code</th>
                    <th>Branch Code / Prefix</th>
                    <th>Branch Name</th>
                   
                   
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include('conn.php');
                    
                    $query=mysqli_query($conn,"SELECT b.id, c.companyname_english,b.address, b.prifix, b.branchcode,b.branchname_english, b.email,b.status FROM `branch` b, `company` c where b.companyid = c.id");
                    
                      $couunt = 0;
                    while($row=mysqli_fetch_array($query)){
                       $couunt++;
                        ?>
                  <tr>
                   
                    <td><?php echo $row['companyname_english']; ?></td>
                    <td><?php echo $row['branchcode']; ?> - <?php echo $row['prifix']; ?> </td>
                    <td>  <a  href="#edit<?php echo $row['id']; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">    <?php echo $row['branchname_english']; ?></a> </td>
                  
                    <td><?php echo $row['address']; ?></td>
                  
                    <TD>
                      <!-- ROLE BASED VIEW -->
                      <?php if (authorize($_SESSION["access"]["MASTER"]["BRANCH_MASTER"]["view"])) { ?>
                      <a  href="#edit<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse" title="View" data-toggle="tooltip">
                      <i class="fa fa-eye txt-default"></i></a> &nbsp;&nbsp; 
                      <?php } ?>
                      <!-- ROLE BASED VIEW -->
                      <!-- ROLE BASED EDIT -->
                      <?php if (authorize($_SESSION["access"]["MASTER"]["BRANCH_MASTER"]["edit"])) { ?>
                      <?php  echo '<a  href="branchedit.php?edit_id='.$row['id'].'"  class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
                        <i class="zmdi zmdi-edit txt-success">
                        </i>
                        </a> '; ?> 
                    
                    
                      <?php } ?>
                      <!-- ROLE BASED EDIT -->
                      <!-- ROLE BASED DELETE -->
                      <?php if (authorize($_SESSION["access"]["MASTER"]["BRANCH_MASTER"]["delete"])) { ?>
                      <a href="#del<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="zmdi zmdi-delete txt-danger"></i></a>&nbsp;&nbsp;
                      <?php } ?>
                      <?php include('b/button.php'); ?>
                      <!-- ROLE BASED DELETE -->
                      <!-- ROLE BASED APPROVAL -->
                      <?php if (authorize($_SESSION["access"]["MASTER"]["BRANCH_MASTER"]["approval"])) { ?>
                      <span data="<?php echo $row['id'];?>" class="status_checks btn-sm label <?php echo ($row['status'])? 'label-success' : 'label-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></span> &nbsp;&nbsp; 
                      <?php } ?>
                      <a href="#branchlogs<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="fa fa-commenting" aria-hidden="true"></i></a>
                      <?php include 'logs/branchlogs.php';?> 
                      <!-- ROLE BASED APPROVAL -->
                    </TD>
                  </tr>
                  <?php
                    }
                    
                    ?>
                </tbody>
                <?php include('b/add_modal.php'); ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<!-- /Row -->
<?php include "footer.php"; ?>
</div>
</div>
<!-- /Main Content --> 
<!-- ACTIVE AND INACTIVE KA CODE -->
<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.status_checks',function(){
  var status = ($(this).hasClass("label-success")) ? '0' : '1';
  var msg = (status=='0')? 'Deactivate' : 'Activate';
  if(confirm("Are you sure to "+ msg)){
    var current_element = $(this);
    url = "b/branchajax.php";
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


</div>
</div>
<!-- branchmasteruploaddocument -->
<?php include "allscript.php"; ?>