
 <link rel="stylesheet" type="text/css" href="dist/leftrightmodal.css"> 

 <!-- view -->
  <div class="modal left fade bs-example-modal-lg" id="salesinvoicelogs<?php echo $row['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Sales Invoice Logs </h4></center>
                </div>
                <div class="modal-body">                 

                        <?php 
                        include('conn.php');
                        $view=mysqli_query($conn,"SELECT * from salesinvoice where order_id='".$row['order_id']."'");
                        $erow=mysqli_fetch_array($view); 
                        $id = $erow['order_id'];
                        
                        ?> 
                 


<?php
//print_invoice.php
if(isset($row["order_id"]))
{
 include('database_connection.php');
 $statement = $connect->prepare("SELECT  s.order_id as order_id,s.whichcompany as whichcompany, s.whichbranch as whichbranch,s.siorderprifix as siorderprifix, c.customername as customername, s.employeeid as employeeid  from salesinvoice s, customer c where c.id = s.customername  and  s.order_id = :order_id  LIMIT 1

 ");
 $statement->execute(
  array(
   ':order_id' =>  $row["order_id"]
  )
 );
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
 echo '
                                 <div class="row">
                                            <div class="col-md-12" style="font-size:16px">
                                                Salesman: <span class="txt-dark  mb-5"> '.$row["employeeid"].' </span><br>
                                                Customer:  <span class="txt-dark  mb-5"> '.$row["customername"].'</span><br>
                                                Document No : <span class="txt-dark  mb-5"> '.$row["whichcompany"].'/'.$row["whichbranch"].'/'.$row["siorderprifix"].'</span>   
                                                </div>                        
                                        </div> <br>


'; }} ?>




                        <div class="container-fluid">
                              <div class="row">
                                  <div class="col-md-12"> 



                                                    <link rel="stylesheet" type="text/css" href="dist/timeline.css">

                                                    <div class="history-tl-container">
                                                      
                                                      <ul class="tl" style="width: 415px;border-left: 3px dashed #2196F3;">
                                                       
                                                        <?php    
                                                        $result = mysqli_query($con,"SELECT * FROM alllogs where whichtable = 'SALESINVOICE' AND idd= $id");
                                                        while($row = mysqli_fetch_array($result))
                                                        {
                                                            $start_event = $row['updateon']; 
                                                            $datee = date("M d, Y", strtotime($start_event));
                                                            $timee = date("h:i A", strtotime($start_event));
                                                        
                                                            $abc = $row['nameofuser'].'/'.$row['latitude'].'/'.$row['longitude'].'/';

                                                            echo '
                                                            <li class="tl-item" ng-repeat="item in retailer_history">
                                                              <div class="timestamp" style="font-size: 18px;font-weight: bold;">
                                                                '.$timee.'
                                                              </div>
                                                                <p style="font-size: 16px;text-transform:capitalize">'.$row['comment'].' by  <b style="font-weight:bold"> '.$row['nameofuser'].' </b><br>'.$datee.'</p>
                                                            
                                                            </li>    
                                                            ';  
                                                        }
                                                        ?>

                                                      </ul>

                                                    </div>   
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                               </div>
                             </div>
                          </div>
