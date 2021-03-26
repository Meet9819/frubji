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
if ( authorize($_SESSION["access"]["MASTER"]["ITEM_MASTER"]["create"]) || 
authorize($_SESSION["access"]["MASTER"]["ITEM_MASTER"]["edit"]) || 
authorize($_SESSION["access"]["MASTER"]["ITEM_MASTER"]["view"]) || 
authorize($_SESSION["access"]["MASTER"]["ITEM_MASTER"]["delete"]) || 
authorize($_SESSION["access"]["MASTER"]["ITEM_MASTER"]["approval"])) {
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
    <h5 class="txt-dark">Item Master
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
        <a href="itemmaster.php">
        <span>Master
        </span>
        </a>
      </li>
      <li>
        <a href="itemmaster.php">
        <span>Item Setup
        </span>
        </a>
      </li>
      <li class="active">
        <span> Item Master
        </span>
      </li>
    </ol>
  </div>
  <!-- /Breadcrumb -->
</div>
<!-- /Title -->  
<div class="panel panel-default border-panel ">
<div  class="panel-wrapper collapse in">
<div  class="panel-body">
<div class="col-md-6 text-left">


</div>
<div class="col-md-6 text-right">
 

    <a href="itemadd.php" class="btn btn-default btn-outline btn-icon right-icon"><i class="fa fa-plus"></i><span class="btn-text"> Add New</span></a>
  
</div>
</div>
</div>
</div>
<!--due to this profile top menu is not coming  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
  </script> 
  -->
<div class="panel panel-default border-panel card-view">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div class="table-wrap">
<table style="width:100%" id="example" class="table table-hover display  pb-30" >
  <thead>
    <tr>
     
       <th>Item Code</th> 
       <th>Category</th>  
       <th>Main Image</th>     
       <th>Product Name</th>     
       <th>Product Description</th>   
       <th>Stock</th>             
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      include('conn.php');      

      $query=mysqli_query($conn,"SELECT p.id,m.menu_name,p.img,p.stock,p.status,p.productcode, p.name,p.description FROM `products` p, `menu` m where p.maincat = m.menu_id ");
  
      $tmpCount = 1;
      while($row = mysqli_fetch_array($query)){
      ?>
    <tr>
    

      <td style="padding:10px">    <a   data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"> <?php echo $row['id']; ?></a></td>


     <td> <?php echo $row['menu_name']; ?> </td>
       <td>   <a   data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">  <img width="50px" src="../../media/products/<?php echo $row['img']; ?>"> </a></td>
      

      <td style="width:20%;padding: 10px"><label> <a   data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"> <?php echo $row['productcode']; ?>  - <?php echo $row["name"]; ?></a></label></td>
  <td> <?php echo $row['description']; ?> </td>
     <?php if ($row['stock'] >='50')

     {
     echo ' <td style="background-color:#23d223;color:white"> '.$row['stock'].'</td>
    '; } else {
       echo ' <td style="background-color:red;color:white"> '.$row['stock'].'</td>';
    }
    ?>

    
      <TD>
      
        <!-- ROLE BASED EDIT -->
        <?php if (authorize($_SESSION["access"]["MASTER"]["ITEM_MASTER"]["edit"])) { ?>
        <?php echo ' 
          <a   href="itemaddedit.php?edit_id='.$row['id'].'" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
          <i class="zmdi zmdi-edit txt-success"></i>  </a> '; ?>
        <?php } ?>
        <!-- ROLE BASED EDIT -->
        <!-- ROLE BASED DELETE -->
        <?php if (authorize($_SESSION["access"]["MASTER"]["ITEM_MASTER"]["delete"])) { ?>
        <a href="#del<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="zmdi zmdi-delete txt-danger"></i></a>&nbsp;&nbsp; 
        <?php } ?>
        <!-- ROLE BASED DELETE -->
        <!-- ROLE BASED APPROVAL -->
        <?php if (authorize($_SESSION["access"]["MASTER"]["ITEM_MASTER"]["approval"])) { ?>

            <span data="<?php echo $row['id'];?>" class="status_checks btn-sm label <?php echo ($row['status'])? 'label-success' : 'label-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></span>&nbsp;&nbsp;

        <?php } ?>
        <!-- ROLE BASED APPROVAL -->
      
      </TD>
      <?php include 'modal/viewitemmaster.php';?>  
      <?php include "alldelete/itemdeletemodel.php"; ?>
    </tr>
    <?php
      }
      ?>
  </tbody>
</table>



<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).on('click','.status_checks',function(){
var status = ($(this).hasClass("label-success")) ? '0' : '1';
var msg = (status=='0')? 'Deactivate' : 'Activate';
if(confirm("Are you sure to "+ msg)){
  var current_element = $(this);
  url = "allstatus/itemajax.php";
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
     
    <!-- /Row -->
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
    

