
 <?php
$id = $_GET['edit_id'];

if (is_null($id) or empty($id)) {
    return;
}
?>

 <?php include "allcss.php"; ?>
<?php include "header.php"; ?> 



   <!-- Main Content -->
    <div class="page-wrapper">
      <div class="container-fluid">
        <!-- Title -->
       
                <div class="row heading-bg">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-dark">Edit Representative</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="#"><span>Purchase Setup</span></a></li>
                            <li class="active"><span>All Representative</span></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->

<div class="panel panel-default border-panel card-view">
<div class="panel-wrapper collapse in">
<div class="panel-body">
<?php
  include "db.php";
  $result = mysqli_query($con, "SELECT * FROM representative WHERE id=" . $_GET['edit_id']);
  $repre = mysqli_fetch_array($result);
  
  ?> 

  <?php
include "db.php";


// UPDATE
if(isset($_POST['update']))
{
   $_POST['commissioninper'];
$result = mysqli_query($con,"UPDATE representative SET commissioninper='".$_POST['commissioninper']."' WHERE id=".$_POST['id']);



               ?>
                <script>
                alert('Commission Successfully Updated..');
               window.location.href='allrepresentative.php';
                </script>
                <?php

}



?>

<form id="example-advanced-form" action="" method="post" enctype="multipart/form-data" >
<!-- Row -->
<div class="row">
<div class="col-md-12">
  <div class="form-wrap">

    
 <input type="hidden" name="id" class="form-control"   tabindex="0"  value="<?php echo trim($repre['id']) ?>">

    <div class="form-group col-md-3">
      <label  class="control-label mb-10">Representative First Name  <b class="txt-danger">* </b></label>
      <input type="text" name="firstname" class="form-control"   tabindex="0"  value="<?php echo trim($repre['firstname']) ?>">
    </div>
    
    <div class="form-group col-md-3">
      <label  class="control-label mb-10">Representative Last Name <b class="txt-danger">* </b></label> 
      <input type="text" name="lastname" class="form-control"    tabindex="0"  value="<?php echo trim($repre['lastname']) ?>">
    </div> 

  
    <div class="form-group col-md-3">
      <label  class="control-label mb-10">Mobile no <b class="txt-danger">* </b></label> 
      <input type="text" name="mobileno" class="form-control"    tabindex="0"  value="<?php echo trim($repre['mobileno']) ?>">
    </div>   
    <div class="form-group col-md-3">
      <label  class="control-label mb-10">Email Id <b class="txt-danger">* </b></label> 
      <input type="text" name="emailid" class="form-control"    tabindex="0"  value="<?php echo trim($repre['emailid']) ?>">
    </div> 

      <div class="form-group col-md-6">
      <label  class="control-label mb-10">Address <b class="txt-danger">* </b></label> 
      <input type="text" name="address" class="form-control"    tabindex="0"  value="<?php echo trim($repre['address']) ?> <?php echo trim($repre['city']) ?> <?php echo trim($repre['state']) ?> ">
    </div> 

      <div class="form-group col-md-3">
      <label  class="control-label mb-10">Pincode <b class="txt-danger">* </b></label> 
      <input type="text" name="pincode" class="form-control"    tabindex="0"  value="<?php echo trim($repre['pincode']) ?>">
    </div> 

     <div class="form-group col-md-3">
      <label  class="control-label mb-10">Status <b class="txt-danger">* </b></label> 
      <input type="text" name="status" class="form-control"    tabindex="0"  value="<?php echo trim($repre['status']) ?>">
    </div>

  </div>
</div>



     <div class="form-group col-md-12" style="background-color:#f6f6f6;margin-top: 20px;margin-bottom: 20px;padding: 10px">

     <div class="form-group col-md-3">
      <label  class="control-label mb-10">Referral Code <b class="txt-danger">* </b></label> 
      <input type="text" name="referral_code" class="form-control"    tabindex="0"  value="<?php echo trim($repre['referral_code']) ?>">
    </div> 
    <div class="form-group col-md-12"></div>
     <div class="form-group col-md-3">
      <label  class="control-label mb-10">Referral Link <b class="txt-danger">* </b></label> 
      <input type="text" name="referral_link" class="form-control"    tabindex="0"  value="<?php echo trim($repre['referral_link']) ?>">
    </div>
     <div class="form-group col-md-3">
      <label  class="control-label mb-10">Commission in Percentage <b class="txt-danger">* </b></label> 
      <input type="number" name="commissioninper" class="form-control"   value="<?php echo trim($repre['commissioninper']) ?>">
    </div>



</div>



</div>
<div class="col-md-12 text-center form-group">
 
  <input type="submit" value="Update" name="update" id="update" class="btn btn-primary btn-rounded" /> 
</div>
</form>




</div></div></div>
<?php include "allscript.php"; ?>