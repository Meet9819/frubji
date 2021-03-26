<?php include "allcss.php"; ?>
<?php include "header.php"; ?> 
</head>
<body> 
 
    <!-- Main Content -->
    <div class="page-wrapper">
      <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Retail Customer List
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
                <a href="#">
                  <span>Sales
                  </span>
                </a>
              </li>
              <li>
                <a href="#">
                  <span>Retail Sale
                  </span>
                </a>
              </li>
              <li class="active">
                <span>Retail Customer List
                </span>
              </li>
            </ol>
          </div>
          <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->  
        <!-- Row --> 



        <div class="row">
          <div class="col-sm-12"> 
            <div class="panel panel-default border-panel card-view">
              <div class="panel-wrapper collapse in">
                <div class="panel-body">
                

                      <?php include 'importexcel/walkin_customerfunctions.php'; ?>
                      <link rel="stylesheet" href="dist/leftrightmodal.css">  
                      <a data-target="#walkincustomerright" data-toggle="modal" class="btn btn-info" title="Edit" data-toggle="tooltip">Import Data </a> 
                      <?php include "importexcel/walkincustomerrightmodal.php"; ?>

            <form id="example-advanced-form" action="" method="post" enctype="multipart/form-data" >
                    <div class="panel panel-default border-panel card-view">
                      <div  class="pills-struct "> 
                        <ul role="tablist" class="nav nav-pills" id="myTabs_6">
                          <li class="active " role="presentation" id="wi">
                            <a aria-expanded="true" id="pad" data-toggle="tab" role="tab" id="home_tab_6" href="#walkincustomer" >                   Walk-In Customer
                            </a>
                          </li>
                          <li role="presentation" class="" id="wi">
                            <a  data-toggle="tab"  role="tab" href="#Insurancecustomer" aria-expanded="false" id="pad">Insurance Customer
                            </a>
                          </li> 
                       
                       
                        </ul>


     

                        <div class="tab-content " id="myTabContent_6" >


                          <div  id="walkincustomer" class="tab-pane fade active in " role="tabpanel">
                           
                           
     
                 <!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default border-panel card-view">
                        
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="table-wrap">
                                        <div class="">
                                               <table id="datatable" data-toggle="table">
                                                <thead>
                                                    <tr>    <th>qatarr Id</th>
                                                        <th>Patient Name</th>
                                                        <th>Email Id</th>
                                                        <th>Mobile No</th>
                                                     
                                                        <th>Status</th>
                                                       
                                                    </tr>
                                                </thead>
                                               
                                            <tbody>
                                              


                                          <?php 
                                          include('db.php');
                                          $result = mysqli_query($con,"SELECT * FROM walkin_customer");  
                                          while($row = mysqli_fetch_array($result))
                                          {
                                          echo '  <tr>    <td>'.$row['patientqatarid'].'</td>  
                                                      <td>'.$row['patientname'].'</td> 
                                                      <td>'.$row['patientemail'].'</td>
                                                      <td>'.$row['patientmobile'].'</td>         
                                                    
                                                    <td>';
                                                    ?> 
                                                    <?php  if ($row['status'] == 1) {
                                                      echo '  <span class="label label-success">Active</span>';
                                                    }
                                                    else {
                                                      echo '  <span class="label label-danger">Not Active</span>';
                                                    }
                                                    
                                                    ?>
                                                    <?php echo '</td>
                                                  
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
                </div>
                <!-- /Row -->

                          </div>



                          <div  id="Insurancecustomer" class="tab-pane fade" role="tabpanel">
                          



     
    <!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default border-panel card-view">
                        
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="table-wrap">
                                        <div class="">
                                             <table id="datatable" data-toggle="table">
                                                <thead>
                                                    <tr>  <th>qatarr Id</th>     <th>Ins. Co.</th>     <th>Insured Company</th>
                                                        <th>Patient Name</th>
                                                                                                           
                                                     
                                                        <th>Policy No</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                               
                                            <tbody>
 

                                            <?php 
                                            include('db.php');
                                            $result = mysqli_query($con,"SELECT * FROM insurance_customer");  
                                            while($row = mysqli_fetch_array($result))
                                            {
                                            echo '  <tr>    <td>'.$row['patientqatarid'].'</td>                      
                                                        <td>'.$row['insuranceid'].'</td>  <td>'.$row['insurancepatientscompanyid'].'</td>  <td>'.$row['patientname'].'</td>   
                                                      
                                                                                       
                                                       
                                                         <td>'.$row['policyno'].'</td>  
                                                    <td>';
                                                    ?> 
                                                    <?php  if ($row['status'] == 1) {
                                                      echo '  <span class="label label-success">Active</span>';
                                                    }
                                                    else {
                                                      echo '  <span class="label label-danger">Not Active</span>';
                                                    }
                                                    
                                                    ?>
                                                    <?php echo '</td>
                                                     
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
                </div>
                <!-- /Row -->

                          </div> 
                          








                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /Row -->
      </div>
    </div>
    <!-- /Main Content -->
  </div>
  <!-- /#wrapper -->
  <?php include "allscript.php"; ?>
