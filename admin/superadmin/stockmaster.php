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
        if ( authorize($_SESSION["access"]["MASTER"][""]["create"]) || 
        authorize($_SESSION["access"]["MASTER"]["STOCK_MASTER"]["edit"]) || 
        authorize($_SESSION["access"]["MASTER"]["STOCK_MASTER"]["view"]) || 
        authorize($_SESSION["access"]["MASTER"]["STOCK_MASTER"]["delete"]) || 
        authorize($_SESSION["access"]["MASTER"]["STOCK_MASTER"]["approval"])) {
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
                        <h5 class="txt-dark">View Stock Master</h5>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li><a href="#"><span>Purchase Setup</span></a></li>
                            <li class="active"><span>Stock Master</span></li>
                        </ol>
                    </div>
                    <!-- /Breadcrumb -->
                </div>
                <!-- /Title -->

                        <div class="panel panel-default border-panel card-view">
                        
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="table-wrap">
                                        <div class="">
                                            <table style="width:100%" id="myTable1" class="table table-hover display  pb-30" >
                                                <thead>
                                                    <tr>  <th>Stock In </th>   
                                                        <th>Item Code</th>
                                                                                                         
                                                        <th>Stock in PC</th>                                                         
                                                        <th>WAC</th>
                                                    </tr>
                                                </thead>



                                                <tbody>                                         
                                                    <?php 
                                                    include('db.php');


                                                     if ($workingin == 'ADMIN, ALLBRANCH' || $workingin == 'ADMIN')
                                                    {// IF LOGIN BY ADMIN, ALLBRANCH OR ADMIN 
                                                     
                                                                  if($sb != '' )
                                                                  { // ALSO GET THE OPTION OF SELECTIING BRANCH OR COMPANY
                                                                        if($sb == 'FPG' || $sb == 'FME')
                                                                        { // IF COMPANY SELECTED - DISPLAY ALL DATA OF THAT COMPANY 'FPG'

                                                                         $result = mysqli_query($con,"SELECT s.id as id, w.wac as wac, s.stockin as stockin, s.itemcode as itemcode, SUM(s.convertedtopc) as convertedtopc from stockinpc s, stockwac w WHERE s.itemcode = w.itemcode AND convertedtopc != 0  group by itemcode,stockin");  

                                                                        }
                                                                        else  if ($sb == 'ADMIN, ALLBRANCH' || $sb == 'ADMIN')
                                                                        {
                                                                               $result = mysqli_query($con,"SELECT s.id as id, w.wac as wac, s.stockin as stockin, s.itemcode as itemcode, SUM(s.convertedtopc) as convertedtopc from stockinpc s, stockwac w WHERE s.itemcode = w.itemcode AND convertedtopc != 0 group by itemcode,stockin"); 
                                                                        }
                                                                        else 
                                                                        { // IF BRANCH SELECTED - DISPLAY ALL DATA OF THAT BRANCH 'P01'

                                                                        $result = mysqli_query($con,"SELECT s.id as id, w.wac as wac, s.stockin as stockin, s.itemcode as itemcode, SUM(s.convertedtopc) as convertedtopc from stockinpc s, stockwac w WHERE s.itemcode = w.itemcode AND convertedtopc != 0 and s.stockin = '$sb' group by itemcode,stockin");  

                                                                        }
                                                                  }
                                                                  else 
                                                                  {// IF NOTHING SELECTED - DISPLAY ALL DATA 

                                                                     $result = mysqli_query($con,"SELECT s.id as id, w.wac as wac, s.stockin as stockin, s.itemcode as itemcode, SUM(s.convertedtopc) as convertedtopc from stockinpc s, stockwac w WHERE s.itemcode = w.itemcode AND convertedtopc != 0 group by itemcode,stockin");  

                                                                  }
                                                    } 
                                                    else if($workingin != 'ADMIN, ALLBRANCH')
                                                    {// IF LOGIN BY NORMAL PEOPLE EMPLOYEE WORKING IN 'P01'           
                                                               $result = mysqli_query($con,"SELECT s.id as id, w.wac as wac, s.stockin as stockin, s.itemcode as itemcode, SUM(s.convertedtopc) as convertedtopc from stockinpc s, stockwac w WHERE s.itemcode = w.itemcode AND convertedtopc != 0 and s.stockin = '$workingin' group by itemcode,stockin");  
                                                    }


                                                    


                                                    while($row = mysqli_fetch_array($result))
                                                    {
                                                    echo   '<tr> 
                                                                 <td>'.$row['stockin'].'</td>          
                                                                 <td style="padding:10px">

                                                                    <a  href="#viewbatch' . $row['id'] . '" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip"> 
                                                                    '.$row['itemcode'].'
                                                                    </a>

                                                                 </td>           
                                                                 <td>'.$row['convertedtopc'].'</td> 
                                                                 <td>'.$row['wac'].'</td>

                                                                '; ?> 
                                                                    <?php include 'modal/viewstockmaster.php';?> <?php echo '
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
                <!-- /Row -->
            </div>
			
            <?php include "footer.php"; ?>

        </div>
        <!-- /Main Content -->

        <?php include "allscript.php"; ?> 

    
