
 <link rel="stylesheet" type="text/css" href="dist/leftrightmodal.css"> 

 <!-- view -->
  <div class="modal left fade bs-example-modal-lg" id="localrfqlogs<?php echo $row['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Local RFQ Logs </h4></center>
                </div>
                <div class="modal-body">                 

                        <?php 
                        include('conn.php');
                        $view=mysqli_query($conn,"SELECT * from sales_localrfq where order_id='".$row['order_id']."'");
                        $erow=mysqli_fetch_array($view); 
                        $id = $erow['order_id'];
                        
                        ?> 
                 





<?php
//print_invoice.php
if(isset($row["order_id"]))
{
 include('database_connection.php');
 $statement = $connect->prepare("  SELECT s.whichcompany as whichcompany, s.whichbranch as whichbranch, s.order_id as order_id, s.leadid as leadid,s.rfqreferenceno as rfqreferenceno,s.rfqorderprifix as rfqorderprifix,  c.customername as customername, s.customeremail as customeremail,s.employeeid as employeeid, s.order_date as order_date,s.order_total_before_tax as order_total_before_tax, s.order_total_after_tax as order_total_after_tax, s.order_datetime as order_datetime,s.status as status from sales_localrfq s, customer c where c.id = s.customername AND s.order_id = :order_id
  LIMIT 1

 ");
 $statement->execute(
  array(
   ':order_id'       =>  $row["order_id"]
  )
 );
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
 echo '
                        <div class="row">
                                            <div class="col-md-12" style="font-size:16px">
                                               Document No :  <span class="txt-dark  mb-5">' . $row["whichcompany"] . '/' . $row["whichbranch"] . '/' . $row["rfqorderprifix"] . '</span> <br>
                                               Salesman : <span class="txt-dark  mb-5"> '.$row["employeeid"].' </span><br>
                                                Customer : <span class="txt-dark  mb-5"> '.$row["customername"].'</span>   
                                                  </div>                        
                                        </div> <br>

                                            '; 
  } } ?> 


                        <?php  

                       if ($row['status'] == 0 && $row['leadid'] == 0) {
                        
                       

                              echo '

                          <blockquote>   

                           <ul class="list-icons">


                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-warning">Local RFQ</span></li>

                                          <ul style="margin-left: 25px;" class="list-icons">

                                          

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated</span></li>

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Cost Invoice</span></li>


                                              <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated  But Not Approved Neither Mailed</span></li>

                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-info">Local PO Received from Client</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-danger">Sales Order</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 

                          
                      }

                      else if ($row['status'] == 0) { 



                              echo '

                          <blockquote>   

                           <ul class="list-icons">

                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i> <span data="" class="btn-sm label label-success">Leads</span></li> 


                                          <ul style="margin-left: 25px;" class="list-icons">

                                             <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <a href="generatelocalrfq.php?update=1&id=' . $erow["id"] . '"> <span data="" class=" btn-sm label label-default">Generate Local RFQ</span> </a></li>
                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-warning">Local RFQ</span></li>

                                          <ul style="margin-left: 25px;" class="list-icons">

                                          

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated</span></li>

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Cost Invoice</span></li>


                                              <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated  But Not Approved Neither Mailed</span></li>

                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-info">Local PO Received from Client</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-danger">Sales Order</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 

                      }




                      else if ($row['status'] == 1 && $row['leadid'] == 0) {


                             echo '

                          <blockquote>   

                           <ul class="list-icons">

                          


                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-warning">Local RFQ</span></li>

                                          <ul style="margin-left: 25px;" class="list-icons">

                                          

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated</span></li>

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Cost Invoice</span></li>


                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated and Mailed</span></li>

                                              <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">No Reply from Client Yet</span></li>

                                              <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Generate Sales Order </span></li> 


                                               <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                              <span  class="btn-sm label label-default"  data-toggle="tooltip">Client Cancelled RFQ </span> 

                                             </li>


                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-info">Local PO Received from Client</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-danger">Sales Order</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 
                       
                      } 

                       else if ($row['status'] == 1 ) { 


                            echo '

                          <blockquote>   

                           <ul class="list-icons">

                          
                            <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i> <span data="" class="btn-sm label label-success">Leads</span></li> 


                                          <ul style="margin-left: 25px;" class="list-icons">

                                             <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <a href="generatelocalrfq.php?update=1&id=' . $erow["id"] . '"> <span data="" class=" btn-sm label label-default">Generate Local RFQ</span> </a></li>
                                             
                                          </ul>

                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-warning">Local RFQ</span></li>

                                          <ul style="margin-left: 25px;" class="list-icons">

                                          

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated</span></li>

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Cost Invoice</span></li>


                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated and Mailed</span></li>

                                              <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">No Reply from Client Yet</span></li>

                                              <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Go to Leads </span></li>
                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-info">Local PO Received from Client</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-danger">Sales Order</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 

                      } 


                      else if ($row['status'] == 2 && $erow['leadid'] == 0) {

                         


                            echo '

                          <blockquote>   

                           <ul class="list-icons">


                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-warning">Local RFQ</span></li>

                                          <ul style="margin-left: 25px;" class="list-icons">

                                          

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated</span></li>

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Cost Invoice</span></li>


                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated and Mailed</span></li>

                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">No Reply from Client Yet</span></li>

                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Go to Leads </span></li>
                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-info">Local PO Received from Client</span></li>

                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-danger">Sales Order</span></li>

                                  <ul style="margin-left: 25px;" class="list-icons">

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local SO is Generated</span></li>

                                  </ul>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 




                      }

                      else if ($row['status'] == 2 ) {


                            echo '

                          <blockquote>   

                           <ul class="list-icons">

                          
                            <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i> <span data="" class="btn-sm label label-success">Leads</span></li> 


                                          <ul style="margin-left: 25px;" class="list-icons">

                                             <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <a href="generatelocalrfq.php?update=1&id=' . $erow["id"] . '"> <span data="" class=" btn-sm label label-default">Generate Local RFQ</span> </a></li>
                                             
                                          </ul>

                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-warning">Local RFQ</span></li>

                                          <ul style="margin-left: 25px;" class="list-icons">

                                          

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated</span></li>

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Cost Invoice</span></li>


                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated and Mailed</span></li>

                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">No Reply from Client Yet</span></li>

                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Go to Leads </span></li>
                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-info">Local PO Received from Client</span></li>

                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-danger">Sales Order</span></li>

                                  <ul style="margin-left: 25px;" class="list-icons">

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local SO is Generated</span></li>

                                  </ul>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 



                        
                      }

                      else if ($row['status'] == 4) {

                          echo '

                          <blockquote>   

                           <ul class="list-icons">

                          
                            <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i> <span data="" class="btn-sm label label-success">Leads</span></li> 


                                          <ul style="margin-left: 25px;" class="list-icons">

                                             <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <a href="generatelocalrfq.php?update=1&id=' . $erow["id"] . '"> <span data="" class=" btn-sm label label-default">Generate Local RFQ</span> </a></li>
                                             
                                          </ul>

                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-warning">Local RFQ</span></li>

                                          <ul style="margin-left: 25px;" class="list-icons">

                                          

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated</span></li>

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Cost Invoice</span></li>


                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated and Mailed</span></li>

                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">No Reply from Client Yet</span></li>

                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Go to Leads </span></li>
                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-info">Local PO Received from Client</span></li>

                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-danger">Sales Order</span></li>

                                  <ul style="margin-left: 25px;" class="list-icons">

                                               <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Generate Local SO</span></li>

                                  </ul>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 

  
                      } 

                      else if ($row['status'] == 100) { 



                             echo '

                          <blockquote>   

                           <ul class="list-icons">

                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i> <span data="" class="btn-sm label label-success">Leads</span></li> 


                                          <ul style="margin-left: 25px;" class="list-icons">

                                             <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <a href="generatelocalrfq.php?update=1&id=' . $erow["id"] . '"> <span data="" class=" btn-sm label label-default">Generate Local RFQ</span> </a></li>
                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span   data="" class="btn-sm label label-warning">Local RFQ</span></li>

                                          <ul style="margin-left: 25px;" class="list-icons">

                                               <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated</span></li>

                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Local RFQ Quotation is Generated  But Not Approved Neither Mailed</span></li>
                                             
                                          </ul>


                              <li class="mb-10"><i class="fa fa-check text-info mr-5"></i> <span  data="" class="btn-sm label label-info">Local PO Received from Client</span></li> 

                                        <ul style="margin-left: 25px;" class="list-icons">

                                              <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Add Local PO of Customer</span></li>

                                            <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                              <span  class="btn-sm label label-default" title="'.$erow['reasonforcancel'].'" data-toggle="tooltip">Client Cancelled RFQ </span> 

                                             </li>

                                          </ul>


                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-danger">Sales Order</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 
  


                         
                      } 














                     
                    
                        ?>



                        <div class="container-fluid">
                              <div class="row">
                                  <div class="col-md-12"> 



                                                    <link rel="stylesheet" type="text/css" href="dist/timeline.css">

                                                    <div class="history-tl-container">
                                                      
                                                      <ul class="tl" style="width: 415px;border-left: 3px dashed #2196F3;">
                                                       
                                                        <?php    
                                                        $result = mysqli_query($con,"SELECT * FROM alllogs where whichtable = 'LOCALRFQ' AND idd= $id");
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
