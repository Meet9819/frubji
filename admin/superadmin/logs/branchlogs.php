<!-- view -->
  <div class="modal left fade bs-example-modal-lg" id="branchlogs<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Branch Logs </h4></center>
                </div>
                <div class="modal-body">                 

                        <?php 
                        include('conn.php');
                        $view=mysqli_query($conn,"SELECT * from branch where id='".$row['id']."'");
                        $erow=mysqli_fetch_array($view); 
                        $id = $erow['id'];


                        
                        ?> 
                
                        <div class="container-fluid">
                              <div class="row">
                                  <div class="col-md-12"> 


                                         <?php  echo '<div class="row">
                                            <div class="col-md-12 text-center" style="font-size:16px;text-transform:capitalize">
                                                 <span class="txt-dark  mb-5"> '.$erow['branchname_english'].' </span>
                                              
                                             
                                                </div>                        
                                        </div> <br>
                                        '; ?>



                      

                                                    <link rel="stylesheet" type="text/css" href="dist/timeline.css">

                                                    <div class="history-tl-container">
                                                      
                                                      <ul class="tl" style="width: 415px;border-left: 3px dashed #2196F3;">
                                                       
                                                        <?php    
                                                        $result = mysqli_query($con,"SELECT * FROM alllogs where whichtable = 'BRANCH' AND idd= $id");
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
