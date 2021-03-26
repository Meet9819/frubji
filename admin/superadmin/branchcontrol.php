<?php include "allcss.php"; ?>
<?php include "header.php"; ?>
<!-- Main Content -->
<div class="page-wrapper">
  <div class="container">
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">Branch Control
        </h5>
      </div>
      <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
          <li>
            <a href="index.html">Dashboard
            </a>
          </li> <li>
            <a href="#">
              <span>Master
              </span>
            </a>
          </li>
          <li>
            <a href="#">
              <span>Process Control
              </span>
            </a>
          </li>
          <li class="active">
            <span>Branch Control
            </span>
          </li>
        </ol>
      </div>
    </div>  
    <!-- Row -->
    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default border-panel card-view">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="table-wrap">
                <table data-toggle="table">
                  <thead>
                    <tr>
                      <th>Sr. No
                      </th>
                      <th>Type of Control
                      </th>
                      <th>Counter
                      </th>
                      <th>Action
                      </th>
                    </tr>
                  </thead>
                  <tbody> 
                    <?php 
include('db.php');
$result = mysqli_query($con,"SELECT * FROM processcontrol where typeofcontrol='Branch Control'");  
while($row = mysqli_fetch_array($result))
{
echo ' 
<td>'.$row['id'].'</td>
<td>'.$row['typeofcontrol'].'</td>
<td>'.$row['counter'].'</td>
<td><a href=""  data-toggle="modal" data-target="#companycontrol"  class="text-inverse pr-10" title="Edit" data-toggle="tooltip"><i class="zmdi zmdi-edit txt-success"></i></a>
</td>
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
    </div>
    <!-- /Row -->
    <!-- companycontrol -->
    <div id="companycontrol" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h5 class="modal-title">Update Branch Control
            </h5>
          </div>
          <div class="modal-body">
            <?php
include "db.php";
$_GET['edit'] = 2;
// EDIT 
if(isset($_GET['edit']))
{
$result = mysqli_query($con,"SELECT * FROM processcontrol WHERE id=".$_GET['edit']);
$getROW = $result->fetch_array();
}
// UPDATE
if(isset($_POST['update']))
{
$result = mysqli_query($con,"UPDATE processcontrol SET counter='".$_POST['counter']."'
WHERE id=".$_GET['edit']);
?>
            <script>
              alert('Successfully Updated..');
              window.location.href='branchcontrol.php';
            </script>
            <?php
}
?>
            <form  action="" method="post" enctype="multipart/form-data" >
              <div class="form-group">
                <label for="message-text" class="control-label mb-10">Enter Branch Control 
                </label>
                <input type="number" class="form-control" name="counter" value="<?php if(isset($_GET['edit'])) echo $getROW['counter'];  ?>">
              </div> 
              </div>
            <div class="modal-footer">
              <input class="btn btn-primary" type="submit" name="update" value="Update" />
              </form>
          </div>
        </div>
      </div>
    </div>
    <!-- companycontrol --> 
    <?php include "footer.php"; ?>
  </div>
</div>
<!-- /Main Content -->
<?php include "allscript.php"; ?>
