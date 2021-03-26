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
if ( authorize($_SESSION["access"]["MASTER"]["EMPLOYEE_MASTER"]["create"]) || 
authorize($_SESSION["access"]["MASTER"]["EMPLOYEE_MASTER"]["edit"]) || 
authorize($_SESSION["access"]["MASTER"]["EMPLOYEE_MASTER"]["view"]) || 
authorize($_SESSION["access"]["MASTER"]["EMPLOYEE_MASTER"]["delete"]) || 
authorize($_SESSION["access"]["MASTER"]["EMPLOYEE_MASTER"]["approval"])) {
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
        <h5 class="txt-dark">Employee Master
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
            <a href="employeemaster.php">
              <span>Master
              </span>
            </a>
          </li>
          <li>
            <a href="employeemaster.php">
              <span>Employee Setup
              </span>
            </a>
          </li>
          <li class="active">
            <span> Employee Master
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



<div class="col-md-8">
               

</div> 

<div class="col-md-4" style="text-align: right;">



<a href="employeeadd.php" class="btn btn-default btn-outline btn-icon right-icon"><i class="fa fa-plus"></i><span class="btn-text"> Add New</span></a>


              
              

                        <?php
                        error_reporting(0);
                        if(isset($_POST['search']))
                        {
                            $u_rolecode = $_POST['u_rolecode'];  
                            $gender = $_POST['gender']; 
                            $workingin = $_POST['workingin'];                            
                            $startdate = $_POST['startdate'];  
                            $enddate = $_POST['enddate'];  
                          
                            $query = "SELECT * FROM `employee` where (joindate BETWEEN '".$startdate."' AND '".$enddate."') or u_rolecode = '".$u_rolecode."' or gender = '".$gender."'  or workingin = '".$workingin."' "; 

                            $search_result = filterTable($query);
                            
                        }
                         else {                         
                         $query = "SELECT * from employee";
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
                
                      <?php include('searchbox/employeesearchbox.php'); ?>

                      </form>





                   </div>      
                </div>
              </div>
            </div>
        

 <b style="font-size: 17px;
    color: #2196F3;"> 
    <?php

     if(isset($_POST['search']))
                        {
                             if ($u_rolecode == 'novalue' )
                             {}
                             else{
                              echo 'Search Criteria -'.$u_rolecode = $_POST['u_rolecode'].'<br>';                             
                             }


                             if ($workingin == 'novalue' )
                             {}
                             else{
                              echo 'Search Criteria -'.$workingin = $_POST['workingin'].'<br>';                             
                             }


                             if ($gender == 'novalue' )
                             {}
                             else{
                              echo 'Search Criteria -'.$gender = $_POST['gender'].'<br>';                             
                             }


                          
                             if ($startdate == '' AND $enddate == '')
                             {}
                             else{
                              echo 'Search Criteria -'.$startdate = $_POST['startdate'].' to ';   
                              echo $enddate = $_POST['enddate'];                             
                             }
                        }
                        ?>
                      </b>

        <div class="panel panel-default border-panel card-view">
          <div class="panel-wrapper collapse in">
            <div class="panel-body">
              <div class="table-wrap">
                <table style="width:100%" id="myTable1" class="table table-hover display  pb-30" >
                 <thead>
                    <tr>
                     <th>Sr No</th>
                      <th>FRUBJI Id </th>                    
                      <th>User Group </th>
                      <th>Username</th>
                      <th>Password</th>                    
                      <th>Gender</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    

                    <?php                    
                    $tmpCount = 1;  
                    while($row = mysqli_fetch_array($search_result)){
                    ?>
                    <tr>  <td style="padding: 10px">
                                                        <?php echo $tmpCount++ ?>
                                                    </td>
                       <td>
                       <a  href="#view<?php echo $row["id"]; ?>" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"> <?php echo $row['employeecode']; ?> </a>
                      </td>
                     
                         
                

                       <td>
                        <?php echo $row['u_rolecode']; ?>
                      </td> 
                       <td>
                        <?php echo $row['username']; ?>
                      </td>
                       <td>
                        <?php echo $row['password']; ?>
                      </td>
                     
                       <td>
                        <?php echo $row['gender']; ?>
                      </td>  
                      
<TD>
  
<!-- ROLE BASED VIEW -->
                           <?php if (authorize($_SESSION["access"]["MASTER"]["EMPLOYEE_MASTER"]["view"])) { ?>
                                  <a  href="#view<?php echo $row["id"]; ?>" data-toggle="modal" class="text-inverse" title="View" data-toggle="tooltip">
                                     <i class="fa fa-eye txt-default"></i></a> &nbsp;&nbsp; 

                                <?php } ?>

<!-- ROLE BASED VIEW -->


<!-- ROLE BASED EDIT -->
                                <?php if (authorize($_SESSION["access"]["MASTER"]["EMPLOYEE_MASTER"]["edit"])) { ?>
                                  
                                   <?php echo '  <a  href="employeeedit.php?edit_id='.$row['id'].'" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
                          <i class="zmdi zmdi-edit txt-success">
                          </i>
                        </a> '; ?>


     
                                <?php } ?>
<!-- ROLE BASED EDIT -->


<!-- ROLE BASED DELETE -->

                                <?php if (authorize($_SESSION["access"]["MASTER"]["EMPLOYEE_MASTER"]["delete"])) { ?>
                                 
                            <a href="#del<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="zmdi zmdi-delete txt-danger"></i></a>&nbsp;&nbsp;   

                                <?php } ?>

<!-- ROLE BASED DELETE -->

<!-- ROLE BASED APPROVAL -->

                                <?php if (authorize($_SESSION["access"]["MASTER"]["EMPLOYEE_MASTER"]["approval"])) { ?>
                                 
                      <span data="<?php echo $row['id'];?>" class="status_checks btn-sm label <?php echo ($row['status'])? 'label-success' : 'label-danger'?>"><?php echo ($row['status'])? 'Active' : 'Inactive'?></span> &nbsp;&nbsp; 

                                <?php } ?>


 <a href="#employeelogs<?php echo $row['id']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="fa fa-commenting" aria-hidden="true"></i></a>

<!-- ROLE BASED APPROVAL -->


</TD>



    
      <?php include 'modal/viewemployee.php';?>      
 <?php include 'logs/employeelogs.php';?>       


<?php include "alldelete/employeedeletemodel.php"; ?>


               
                    </tr>
                    <?php
}
?>
                  </tbody>
                
                </table> 







<script>
 $(document).ready(function(){

  $('.hover').tooltip({
   title: fetchData,
   html: true,
   placement: 'right'
  });

  function fetchData()
  {
   var fetch_data = '';
   var element = $(this);
   var id = element.attr("id");
   $.ajax({
    url:"tooltip/employeefetch.php",
    method:"POST",
    async: false,
    data:{id:id},
    success:function(data)
    {
     fetch_data = data;
    }
   });   
   return fetch_data;
  }
 });
</script>

 <!-- ACTIVE AND INACTIVE KA CODE -->

<script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$(document).on('click','.status_checks',function(){
var status = ($(this).hasClass("label-success")) ? '0' : '1';
var msg = (status=='0')? 'Deactivate' : 'Activate';
if(confirm("Are you sure to "+ msg)){
  var current_element = $(this);
  url = "allstatus/employeeajax.php";
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