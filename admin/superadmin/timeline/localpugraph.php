<!-- view -->


    <div class="modal fade bs-example-modal-lg" id="viewLocal_PU" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Local PU Flow</h4></center>
                </div>
                <div class="modal-body">
		
			         	<div class="container-fluid" style="text-align: center;">   
                   <link rel="stylesheet" href="timeline/style.css">
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

                  <!-- partial:index.partial.html -->
                  <main>

                    <section>
                      <div class="pieIDD pie">
                        
                      </div>
                       <ul class="pieIDD legend">
                                 
                                  <li>
                                   <a href="branchrequest.php">  <em>Branch Request </em> </a>
                                    <span>   <?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM br_request_order ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo  $total ?>                                        
                                    </span>

                                  </li> 
                               
                                  <li> 
                                    <a href="localpotosupplier.php">  <em>Local PO</em>  </a>
                                    <span> 
                                    <?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM purchase_localorder ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo $total ?>
                                    </span>
                                  </li> 
                               
                                  <li> 
                                    <a href="localpurchasereceipt.php">  <em>Purchase Receipt</em>  </a>
                                    <span> 
                                    <?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM purchase_receipt ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo $total ?>
                                    </span>
                                  </li> 

                                </ul>
                    </section>


                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
                    <script  src="timeline/script.js"></script>
                 </div>

                </div>
             </div>
           </div>
      </div>
                                       