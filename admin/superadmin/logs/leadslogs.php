
 <link rel="stylesheet" type="text/css" href="dist/leftrightmodal.css"> 

 <!-- view -->
  <div class="modal left fade bs-example-modal-lg" id="leadslogs<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Leads Logs </h4></center>
                </div>
                <div class="modal-body">                 

                        <?php 
                        include('conn.php');
                        $view=mysqli_query($conn,"SELECT * from leads where id='".$row['id']."'");
                        $erow=mysqli_fetch_array($view); 
                        $id = $erow['id'];
                        
                        ?> 
                 







                            


                        <div class="container-fluid">
                              <div class="row">
                                  <div class="col-md-12"> 





           
<?php
//print_invoice.php
if(isset($row["id"]))
{
 include('database_connection.php');
 $statement = $connect->prepare(" SELECT l.lastbiddate as lastbiddate, l.quotationprifix as quotationprifix,l.leadno as leadno, l.reasonforcancel as reasonforcancel, l.status as status, l.id as id, l.employeeid as employeeid, l.typeoflead as typeoflead, l.dateofrfq as dateofrfq,l.customeremail as customeremail, l.customername as customername, c.customername as customername, l.customerlocalpo as customerlocalpo, l.customerlocalpodate as customerlocalpodate, l.customerattach as customerattach, l.quotationprifix as quotationprifix, l.customertype as customertype from leads l, customer c where c.id = l.customername AND l.id = :id LIMIT 1
 
 ");
 $statement->execute(
  array(
   ':id'       =>  $row["id"]
  )
 );
 $result = $statement->fetchAll();
 foreach($result as $row)
 {

 
 echo '
           
                          
                                        <div class="row">
                                            <div class="col-md-12" style="font-size:16px">
                                               Salesman: <span class="txt-dark  mb-5"> '.$row["employeeid"].' </span><br>
                                               Customer: <span class="txt-dark  mb-5"> '.$row["customername"].'</span><br>
                                               Customer Type : <span class="txt-dark  mb-5"> '.$row["customertype"].'</span><br>
                                               Type of Lead: <span class="txt-dark  mb-5"> '.$row["typeoflead"].'</span><br>
                                               Date of RFQ :  <span class="txt-dark  mb-5"> '.date("d-m-Y", strtotime($row['dateofrfq'])).'</span><br>
                                               Last Bid Date : <span class="txt-dark  mb-5"> '.date("d-m-Y", strtotime($row['lastbiddate'])) .'</span>
                                            </div>                        
                                        </div> <br>

'; } } ?> 


                                   <?php 

                       if ($erow['status'] == 1) { 

                          echo '

                          <blockquote>   

                           <ul class="list-icons">

                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i> <span data="" class="big btn-sm label label-success">Leads</span></li> 


                                          <ul style="margin-left: 25px;" class="list-icons">

                                             <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <a href="generatelocalrfq.php?update=1&id=' . $erow["id"] . '"> <span data="" class=" btn-sm label label-default">Generate Local RFQ</span> </a></li>

                                          </ul>


                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="big btn-sm label label-warning">Local RFQ</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-info">Local PO Received from Client</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-danger">Sales Order</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 


                       }


                          else if ($erow['status'] == 2 && $erow['quotationprifix'] == '') {       



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



                       else if ($erow['status'] == 2) {  



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

                                            <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">RFQ Cancelled from Client</span></li>

                                          </ul>


                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-danger">Sales Order</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 


 
                      
                        } 

                        else if ($erow['status'] == 3) {   





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

                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <span  class="btn-sm label label-default">Add Local PO of Customer</span></li>

                                            <li class="mb-10"><i class="fa fa-times text-danger mr-5 text-info mr-5"></i>
                                              <span  class="btn-sm label label-default" title="'.$erow['reasonforcancel'].'" data-toggle="tooltip">Client Cancelled RFQ </span> 

                                             </li>
                                              <li class="mb-10"><i class="fa fa-check text-danger mr-5 text-info mr-5"></i>
                                             <a title="Local PO No = '.$erow['customerlocalpo'].' Local PO Date = '.$erow['customerlocalpodate'].' Local PO Attachment = '.$erow['customerattach'].' Local PO Prifix = '.$erow['quotationprifix'].'" data-toggle="tooltip"> <span class="btn-sm label label-default">Local PO Received from Client </span></a>
                                             </li>


                                          </ul>


                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-danger">Sales Order</span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span style="opacity:0.3"  data="" class="btn-sm label label-warning">Delivery Note </span></li>

                              <li class="mb-10"><i class="fa fa-angle-double-right text-info mr-5"></i> <span  style="opacity:0.3" data="" class="btn-sm label label-success">Sales Invoice</span></li>

                          </ul>

                       
                          </blockquote>

                          '; 
     
                    

                        }
                        else if ($erow['status'] == 100) { 







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
                       

                      

                                                    <link rel="stylesheet" type="text/css" href="dist/timeline.css">

                                                    <div class="history-tl-container">
                                                      
                                                      <ul class="tl" style="width: 415px;border-left: 3px dashed #2196F3;">
                                                       
                                                        <?php    
                                                        $result = mysqli_query($con,"SELECT * FROM alllogs where whichtable = 'LEADS' AND idd= $id");
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
