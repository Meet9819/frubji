<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 

 
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
      <div class="col-md-12">
       <?php
include "db.php";

// EDIT 
if(isset($_GET['edit']))
{
$result = mysqli_query($con,"SELECT * FROM menu WHERE menu_id=".$_GET['edit']);
$getROW = $result->fetch_array();
}


// UPDATE
if(isset($_POST['update']))
{
$result = mysqli_query($con,"UPDATE menu SET menu_name='".$_POST['menu_name']."',parent_id='".$_POST['parent_id']."' WHERE menu_id=".$_GET['edit']);



               ?>
                <script>
                alert('Successfully Updated..');
               window.location.href='menu.php';
                </script>
                <?php

}



?>

  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

							<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Menu Name</label>
								<div class="col-sm-6">
									<input type="text" name="menu_name" class="form-control" id="" placeholder="Enter Menu Name" value="<?php if(isset($_GET['edit'])) echo $getROW['menu_name'];  ?>"  required="">
								</div>
							</div>

						
	<div class="form-group">
								<label for="inp-type-1" class="col-sm-3 control-label">Sub Category  </label>
								<div class="col-sm-6">
									


									 <select id="twelve" name="parent_id" class="form-control">
								

								  <option value="0"><?php if(isset($_GET['edit'])) echo $getROW['parent_id'];  ?></option>
								   <?php

include"db.php";

$result = mysqli_query($con,"SELECT * FROM menu where parent_id = 0");
while($row = mysqli_fetch_array($result))
{
echo '<option value="' .$row['menu_id'].'">' .$row['menu_name'].'</option>';
} 
?>

							</select>


						
								</div>

								</div>
						


							<div class="form-group margin-bottom-0">
									<label for="inp-type-5" class="col-sm-3 control-label"></label> 

									<div class="col-sm-6">
										 <input class="btn btn-primary btn-sm waves-effect waves-light" type="submit" name="update" value="Update" />
   							
								</div>
							</div>


						</form>
      </div>
      

    </div>
  </div>
</div>


	
	     
<?php include "allscripts.php"; ?>
