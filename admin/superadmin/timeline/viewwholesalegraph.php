




<!-- view -->


    <div class="modal fade bs-example-modal-lg" id="viewWholesale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">Wholesale Flow </h4></center>
                </div>
                <div class="modal-body">
		
			         	<div class="container-fluid" style="text-align: center;">   


                  
<link rel="stylesheet" href="timeline/style.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

<!-- partial:index.partial.html -->
<main>

  <section>
    <div class="pieID pie">
      
    </div>
     <ul class="pieID legend">
                                 
                                  <li>
                                   <a href="leads.php">  <em>Requirement </em> </a>
                                    <span>   <?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM leads ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo  $total ?>                                        
                                    </span>

                                  </li> 
                               

                              
                                  <li> 
                                    <a href="localrfq.php">  <em>Quotation</em>  </a>
                                    <span> 
                                    <?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM sales_localrfq ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo $total ?>
                                    </span>
                                  </li> 
                              

                                     <li> 
                                    <em>Qtn Cancelled</em>
                                    <span> 
                                    <?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM sales_localrfq where status = 100 ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo $total ?>
                                    </span>
                                  </li>  


                                 <li> 
                                    <em>Purchase Order</em>
                                    <span> 
                                    <?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM sales_localrfq where status = 2 ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo $total ?>
                                    </span>
                                  </li>  

                               
                                  <li>
                                 <a href="salesorder.php">      <em>Sales Order</em>   </a>
                                    <span>  <?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM salesorder ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo $total ?>
                                    </span>
                                  </li>
                             
                                
                                  <li>
                                    <em>Delivery Note</em>
                                    <span> <?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM salesorderdelivery ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo $total ?>                               
                                    </span>
                                  </li>
                                  <li>
                                    <em>Sales Invoice</em>
                                    <span><?php                          
                                    $result = mysqli_query($con,"SELECT count(1) FROM salesinvoice ");
                                    $row = mysqli_fetch_array($result);
                                    $total = $row[0];
                                    echo  $total ?>                                        
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
                                       