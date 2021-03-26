<?php include "allcss.php"; ?>
<?php include "header.php"; ?>
<!-- Main Content -->
<div class="page-wrapper">
  <div class="container-fluid">
    <!-- Title -->
    <div class="row heading-bg">
      <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">User Group
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
            <a href="usergroup.php">
              <span>Master
              </span>
            </a>
          </li>
          <li>
            <a href="usergroup.php">
              <span>Process Control
              </span>
            </a>
          </li>
          <li class="active">
            <span> User Group
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

          <div class="col-sm-12" style="text-align: right;">
            <div class="panel panel-default border-panel ">
              <div  class="panel-wrapper collapse in">
                <div  class="panel-body"> 


<div class="col-md-8">
</div>
<div class="col-md-4">
              
 <a href="#addnew" data-toggle="modal" class="btn btn-default btn-outline btn-icon right-icon"><i class="fa fa-plus"></i><span class="btn-text"> Add New Group</span></a>
  
</div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-default border-panel card-view">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="table-wrap">




                <table id="datatable" data-toggle="table">
                  <thead>
                    <tr>
                    
                      <th>Role Code
                      </th> 
                      <th>Give Roles & Access
                      </th> 
                    
                      <th>Action
                      </th>
                    </tr>
                  </thead>
                  <tbody> 





                    <?php
                  include('conn.php');
                  $query=mysqli_query($conn,"select * from role");
                  while($row=mysqli_fetch_array($query)){
                  ?>
                    <tr>
                      <td>
                        <a  href="#view<?php echo $row['role_rolecode']; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">    <?php echo $row['role_rolecode']; ?></a> 

                          <?php include('usergroup/viewusergroup.php'); ?>

                      </td>
                    
                      <td>  <?php echo '<a href="usergroupadd.php" ><span data="" class="status_checks btn-sm label label-danger">Give Permission</span></a>
                    ';?>
                      </td> 

                      <td>
                      

                      <a href="#del<?php echo $row['role_rolecode']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="zmdi zmdi-delete txt-danger"></i></a>&nbsp;&nbsp; 


                        <?php include('usergroup/button.php'); ?>
                      </td>
                    </tr>
                    <?php
}
?>
                  </tbody>
                  <?php include('usergroup/add_modal.php'); ?> 


                </table> 



                
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
