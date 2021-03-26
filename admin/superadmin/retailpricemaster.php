<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
 <title>Price Master <?php echo $workingin; ?>  
 </title>
<!-- ROLE BASED -->
 <?php
require_once("config.php");
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    // not logged in send to login page
    redirect("index.php");
}
$status = FALSE;
if ( authorize($_SESSION["access"]["MASTER"]["RETAILPRICEMASTER"]["create"]) || 
authorize($_SESSION["access"]["MASTER"]["RETAILPRICEMASTER"]["edit"]) || 
authorize($_SESSION["access"]["MASTER"]["RETAILPRICEMASTER"]["view"]) || 
authorize($_SESSION["access"]["MASTER"]["RETAILPRICEMASTER"]["delete"]) || 
authorize($_SESSION["access"]["MASTER"]["RETAILPRICEMASTER"]["approval"])) {
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
    <h5 class="txt-dark">Retail Price Master
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
        <a href="pricemaster.php">
        <span>Master
        </span>
        </a>
      </li>
      <li>
        <a href="pricemaster.php">
        <span>Item Setup
        </span>
        </a>
      </li>
      <li class="active">
        <span>Retail  Price Master
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

     <script>
              $(document).ready(function(){
                $("#myInput").on("keyup", function() {
                  var value = $(this).val().toLowerCase();
                  $("#product-rows tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                  });
                });
              });
              </script>
                
              <input id="myInput" type="text" placeholder="Search.." class="form-control">
              <br><br>



<table style="width:100%" id="example" class="table table-hover display  pb-30" >
  <thead>
    <tr>
       <th>Item Code</th> 
       <th>Main Category</th>  
       <th>Image</th>   
       <th>Product Name</th>     
       <th>Product Description</th>  
    </tr>
  </thead>
   <tbody id="product-rows">
    <?php 
      include('conn.php');
      
      $query=mysqli_query($conn,"SELECT DISTINCT p.id,m.menu_name as maincat,p.description,p.productcode,p.name,p.img, p.status FROM `products` p, `menu` m where p.maincat = m.menu_id");
  
      $tmpCount = 1;
      while($row = mysqli_fetch_array($query)){
      ?>
      <tr>

        <td style="padding:10px">    <a   data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"> <?php echo $row['id']; ?></a></td>
      
       <td > <?php echo $row['maincat']; ?> </td>   

       <td><a data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"> <img width="50px" src="../../media/products/<?php echo $row['img']; ?>"> </a></td>
      
       <td style="width:20%;padding: 10px"><label><a href="#" class="hover" data-target="#view<?php echo $row["id"]; ?>" data-toggle="modal" id="<?php echo $row["id"]; ?>"><?php echo $row['productcode']; ?>  - <?php echo $row["name"]; ?></a></label></td>

        <td> <?php echo $row['description']; ?> </td>
      
        <?php include 'modal/viewretailpricemaster.php';?>  
      
      </tr>
      <?php
      }
      ?>
  </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
        "lengthMenu": [[25, 50, -1], [25, 50, "All"]]
    } );
} );
</script>


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
    

