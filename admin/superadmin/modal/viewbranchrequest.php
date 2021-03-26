 <style type="text/css">
  input[type=checkbox]{
    margin:3px;
  }
</style> 

<div class="modal fade bs-example-modal-lg" id="view<?php echo $row['order_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <center><h4 class="modal-title" id="myModalLabel">View Branch Request Order Item </h4></center>
                </div>
                <div class="modal-body">
				<?php include('conn.php');
					$view=mysqli_query($conn,"SELECT * from br_request_order_item where order_id='".$row['order_id']."'");
				$erow=mysqli_fetch_array($view);

				?>
				<div class="container-fluid" >


            <?php
            //print_invoice.php
            if(isset($row["order_id"]))
            {
             include('database_connection.php');
             $statement = $connect->prepare("
              SELECT * FROM br_request_order 
              WHERE order_id = :order_id
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

              $requestfrom = $row["requestfrom"];
             echo '                            
                                                  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default border-panel card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">RQ</h6>
                                    </div>
                                    <div class="pull-right">
                                      '; ?> <?php
                        $rw =   $row["whichcompany"] . '/' . $row["requestfrom"] . '/' . $row["requestorderprifix"];
                        $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
                        echo $code = $Bar->getBarcode($rw, $Bar::TYPE_CODE_128);
                        ?> 

                        <?php echo '
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <span class="txt-dark   mb-5">Request From: '.$row["requestfrom"].' </span><br>
                                                  <span class="txt-dark   mb-5">Request To: '.$row["requestto"].'</span>
                                            
                                             </div>
                                            <div class="col-xs-6 text-right">
                                                <span class="txt-dark   mb-5">Document No :   ' . $row["whichcompany"] . '/' . $row["requestfrom"] . '/' . $row["requestorderprifix"] . ' </span> 
                                                <address class="txt-dark mb-5">   
                                                Request Date : '.$row["requestorder_date"].'<br></address>

                                                 Last Updated - <abbr class="timeago" title="'.$row["order_datetime"].'">'.$row["order_datetime"].'</abbr>

                                            </div>


                                                <div class="col-md-12"> <br>

                '; ?>
                <?php if ($row['status'] == 0) {
                echo ' <span style="opacity:0.5" class="btn-sm label label-danger">Not Approved</span>';
            } else if ($row['status'] == 1) {

                echo ' <span style="opacity:0.5" class="btn-sm label label-success">Approved & Mailed</span>';

            }
            ?>

            <?php echo '
              </div> 


                                        </div>
                                        
                                           <div class="invoice-bill-table">
                                            <div class="table-responsive modaltable">


                                           <form action="generatebranchrequesttolocalpofromcheckbox.php" method="post">

                                           <div class="row" style="background-color:#f3f3f3">
                                            <div class="col-md-1 bor"><input type="checkbox" name=""  class="checked_all" >  </div>
                                            <div class="col-md-1 bor">Sr No </div>
                                            <div class="col-md-8 bor"> Code</div>
                                           
                                           
                                            <div class="col-md-1 bor"> Qty </div> 
                                            <div class="col-md-1 bor">Units </div>
                                         
                                            </div>  

                                        
                                            ';
                                         

                                         

                                             $statement = $connect->prepare( "SELECT * FROM br_request_order_item WHERE order_id = :order_id ");

                                            $statement->execute(
                                             array(
                                              ':order_id'       =>  $row["order_id"]
                                             )
                                            ); 
                                            $item_result = $statement->fetchAll();
                                            $count = 0;
                                            foreach($item_result as $sub_row)
                                            {
                                             $count++; 

                                            $mainstock = $sub_row["currentstock"] / $sub_row['packing'];
                                             echo '
                                             <div class="row">                                           
                                                <div class="col-md-1 bor">  <input type="checkbox" name="order_item_id[]" value="'.$sub_row['order_item_id'].'" class="checkboxx"> </div>
                                                <div class="col-md-1 bor">'.$count.'  </div>
                                                <div class="col-md-8 bor"> '.$sub_row['itemcode'].' - '.$sub_row['item_name'].'</div>
                                               
                                              
                                                <div class="col-md-1 bor">  '.$sub_row["order_item_quantity"].' </div>  <div class="col-md-1 bor">'.$sub_row["units"].'    </div>'; 

                                            
                                           echo '

                                            </div>                         
                                            ';
                                            }

                                            echo ' 
                                             <div class="row">      
                                            <div class=""> <br><Br> 

                                          
    '; ?>
                <?php if ($row['status'] == 1) {

                echo '  <input type="submit" class="btn btn-orange mr-10" name="submit" value="Generate Branch Request to Local PO"/>
                                           ';

            }
            ?>

            <?php echo '
                                            </div> 

                                            </div>
                               </form>


                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                

               
                  '; 
                echo '
              

              <div class="col-md-12">

              '.$row["remarks"].'

              </div> 



              <div class="button-list pull-right">
                   <button type="submit" class="btn btn-orange mr-10"> Send Email </button>
                   <a class="btn btn-default btn-outline btn-icon left-icon" target="_blank" href="printpdf/print_branchrequest.php?pdf=1&id=' . $row["order_id"] . '" > <i class="fa fa-print"></i><span> Print </a> 
              </div> 



  ';
 }
}
?>  <script type="text/javascript">
        $('.checked_all').on('change', function() {     
                $('.checkboxx').prop('checked', $(this).prop("checked"));              
        });
        //deselect "checked all", if one of the listed checkbox product is unchecked amd select "checked all" if all of the listed checkbox product is checked
        $('.checkboxx').change(function(){ //".checkbox" change 
            if($('.checkboxx:checked').length == $('.checkboxx').length){
                   $('.checked_all').prop('checked',true);
            }else{
                   $('.checked_all').prop('checked',false);
            }
        });
    </script>





                                                                                 </div>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
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
<!-- /.modal -->