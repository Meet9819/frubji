<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php include "allcss.php";?>
<?php include "header.php";?>
<title>co-<?php echo $companyid; ?> |  workingin-<?php echo $workingin; ?> </title>
<!-- ROLE BASED -->
<?php

require_once "config.php";
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("index.php");
}
$status = false;
if (authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["create"]) ||
    authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["edit"]) ||
    authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["view"]) ||
    authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["delete"]) ||
    authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["approval"])) {
    $status = true;
}

if ($status === false) {
    die("You dont have the permission to access this page");
}
?>
<!-- ROLE BASED -->


     <div class="page-wrapper">
     <!-- Title -->
        <div class="row heading-bg">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Purchase Order
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
                <a href="purchaseorder.php">
                  <span>Purchase
                  </span>
                </a>
              </li>
              <li>
                <a href="purchaseorder.php">
                  <span>Local PO
                  </span>
                </a>
              </li>
              <li class="active">
                <span>Purchase Order
                </span>
              </li>
            </ol>
          </div>
          <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->




        <div class="panel panel-default border-panel card-view">
          <div class="panel-wrapper collapse in">





          <?php
          include 'database_connection.php';
       

        //  <!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->

          //insert code
          if (isset($_POST["create_invoice"])) {
              $order_total_before_tax = 0;
              $order_total_after_tax = 0;

              $statement = $connect->prepare("INSERT INTO   purchase_order
                                      (requestorderprifix,branchreferenceno, requestorder_date, requestfrom, requestto, order_total_before_tax,  order_total_after_tax, order_datetime,remarks,whichcompany) VALUES (:requestorderprifix,:branchreferenceno, :requestorder_date, :requestfrom, :requestto, :order_total_before_tax, :order_total_after_tax, :order_datetime,:remarks,:whichcompany)
                                  ");
              $statement->execute(
                  array(

                      ':requestorderprifix' => trim($_POST["requestorderprifix"]),
                      ':branchreferenceno' => trim($_POST["branchreferenceno"]),
                      ':requestorder_date' => trim($_POST["requestorder_date"]),
                      ':requestfrom' => trim($_POST["requestfrom"]),
                      ':requestto' => trim($_POST["requestto"]),
                      ':order_total_before_tax' => $order_total_before_tax,
                      ':order_total_after_tax' => $order_total_after_tax,
                      ':order_datetime' => $currentTime,
                      ':remarks' => trim($_POST["remarks"]),
                      ':whichcompany' => $_POST["whichcompany"],
                  )
              );

              $statement = $connect->query("SELECT LAST_INSERT_ID()");
              $order_id = $statement->fetchColumn();

              for ($count = 0; $count < $_POST["total_item"]; $count++) {
                  $order_total_before_tax = $order_total_before_tax + floatval(trim($_POST["order_item_actual_amount"][$count]));
                  $order_total_after_tax = $order_total_after_tax + floatval(trim($_POST["order_item_final_amount"][$count]));

                  $statement = $connect->prepare("
                                        INSERT INTO   purchase_order_item
                                        (order_id, itemcode, item_name,units, order_item_quantity, order_item_price, order_item_actual_amount, order_item_final_amount,requestfromm,requesttoo,whichcompany)
                                        VALUES (:order_id, :itemcode,:item_name,:units, :order_item_quantity, :order_item_price, :order_item_actual_amount, :order_item_final_amount,:requestfromm,:requesttoo,:whichcompany)
                                      ");

                  $statement->execute(
                      array(
                          ':order_id' => $order_id,
                          ':itemcode' => trim($_POST["itemcode"][$count]),
                          ':item_name' => trim($_POST["item_name"][$count]),
                         
                          ':requestfromm' => trim($_POST["requestfrom"]),
                          ':requesttoo' => trim($_POST["requestto"]),
                          ':units' => trim($_POST["units"][$count]),
                        
                          ':order_item_quantity' => trim($_POST["order_item_quantity"][$count]),
                          ':order_item_price' => trim($_POST["order_item_price"][$count]),
                          ':order_item_actual_amount' => trim($_POST["order_item_actual_amount"][$count]),
                          ':order_item_final_amount' => trim($_POST["order_item_final_amount"][$count]),
                          ':whichcompany' => trim($_POST["whichcompany"]),
                      )
                  );
              }

              $statement = $connect->prepare("
                                      UPDATE  purchase_order
                                      SET order_total_before_tax = :order_total_before_tax, order_total_after_tax = :order_total_after_tax WHERE order_id = :order_id ");
              $statement->execute(
                  array(
                      ':order_total_before_tax' => $order_total_before_tax,
                      ':order_total_after_tax' => $order_total_after_tax,
                      ':order_id' => $order_id,
                  )
              );


              ?>
             <script>
             alert('New Purchase order added successfully!');
             window.location.href='purchaseorder.php';
             </script>
             <?php

}

//insert code end

// <!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->


//update code

if (isset($_POST["update_invoice"])) {
    $order_total_before_tax = 0;
    $order_total_after_tax = 0;
    $order_id = $_POST["order_id"];

    $statement = $connect->prepare("DELETE FROM purchase_order_item WHERE order_id = :order_id");
    $statement->execute(
        array(
            ':order_id' => $order_id,
        )
    );

    for ($count = 0; $count < $_POST["total_item"]; $count++) {
        $order_total_before_tax = $order_total_before_tax + floatval(trim($_POST["order_item_actual_amount"][$count]));
        $order_total_after_tax = $order_total_after_tax + floatval(trim($_POST["order_item_final_amount"][$count]));
        $statement = $connect->prepare("
                        INSERT INTO   purchase_order_item
                        (order_id,itemcode, item_name,units, order_item_quantity, order_item_price, order_item_actual_amount, order_item_final_amount,requestfromm,requesttoo,whichcompany)
                        VALUES (:order_id,:itemcode, :item_name,:units, :order_item_quantity, :order_item_price, :order_item_actual_amount,  :order_item_final_amount,:requestfromm,:requesttoo,:whichcompany)
                      ");
        $statement->execute(
            array(
                ':order_id' => $order_id,
                ':itemcode' => trim($_POST["itemcode"][$count]),
                ':item_name' => trim($_POST["item_name"][$count]),
               
                ':requestfromm' => trim($_POST["requestfrom"]),
                ':requesttoo' => trim($_POST["requestto"]),
                ':whichcompany' => trim($_POST["whichcompany"]),
                ':units' => trim($_POST["units"][$count]),
                
                ':order_item_quantity' => trim($_POST["order_item_quantity"][$count]),
                ':order_item_price' => trim($_POST["order_item_price"][$count]),
                ':order_item_actual_amount' => trim($_POST["order_item_actual_amount"][$count]),
                ':order_item_final_amount' => trim($_POST["order_item_final_amount"][$count]),
            )
        );
        $result = $statement->fetchAll();
    }

    $statement = $connect->prepare("
                      UPDATE  purchase_order
                      SET
                      requestorderprifix = :requestorderprifix,
                      branchreferenceno = :branchreferenceno,
                       remarks = :remarks,
                      requestorder_date = :requestorder_date,
                      requestfrom = :requestfrom,
                      requestto = :requestto,
                      order_total_before_tax = :order_total_before_tax,
                      order_total_after_tax = :order_total_after_tax,
                      whichcompany = :whichcompany,
                      order_datetime =:order_datetime
                      WHERE order_id = :order_id
                    ");

    $statement->execute(
        array(

            ':requestorderprifix' => trim($_POST["requestorderprifix"]),
            ':branchreferenceno' => trim($_POST["branchreferenceno"]),
            ':remarks' => trim($_POST["remarks"]),
            ':requestorder_date' => trim($_POST["requestorder_date"]),
            ':requestfrom' => trim($_POST["requestfrom"]),
            ':requestto' => trim($_POST["requestto"]),
            ':order_total_before_tax' => $order_total_before_tax,
            ':order_total_after_tax' => $order_total_after_tax,
            ':whichcompany' => trim($_POST["whichcompany"]),
            ':order_id' => $order_id,
            ':order_datetime' => $currentTime,
        )

    );

    $result = $statement->fetchAll();


    ?>
                <script>
                alert('Purchase order updated successfully!');
                window.location.href='purchaseorder.php';
                </script>
                <?php
}

//update code end


// ------------------------------------------------------------------------------------------------------------------------------------------- -->


//delete code

if (isset($_GET["delete"]) && isset($_GET["id"])) {
    $statement = $connect->prepare("DELETE FROM   purchase_order WHERE order_id = :id");
    $statement->execute(
        array(
            ':id' => $_GET["id"],
        )
    );
    $statement = $connect->prepare(
        "DELETE FROM  purchase_order_item WHERE order_id = :id");
    $statement->execute(
        array(
            ':id' => $_GET["id"],
        )
    );

    $statement = $connect->prepare(
        "DELETE FROM  alllogs WHERE idd = :id and whichtable = 'BRANCH_REQUEST_ORDER'");
    $statement->execute(
        array(
            ':id' => $_GET["id"],
        )
    );

    ?>
     <script>
     alert('Purchase order Successfully Deleted !!');
     window.location.href='purchaseorder.php';
     </script>
     <?php
}
//delete code end
?>



<!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->






<?php
if (isset($_GET["add"])) { //insert code form design
    ?>

                    <form method="post" id="invoice_form">
                      <div class="table-responsive" >
                        
                        <!-- -------------------------------------------------------------------------------------------------- -->

                        <div class="from-group row">

                                 <?php    
                                 include "db.php";
                                 $result = mysqli_query($con, "SELECT order_id FROM purchase_order ORDER BY order_id desc LIMIT 1");
                                 while ($row = mysqli_fetch_array($result)) {
                                     $unique_order_no = $row['order_id'] + 1;
                                 }
                                 ?>
                                 
                                 <div class="col-md-2 form-group">
                                    Document No <br />                                      
                                      <?php
                                      $branchrequestorderprifix = $branchrequestorder . '/' . $dateeyear . '/' . $unique_order_no;
                                      echo '<input type="text" name="requestorderprifix" id="requestorderprifix" class="form-control input-sm" value="' . $branchrequestorderprifix . '"  readonly />';
                                       ?>     
                                  </div>
                                
                                  <div class="col-md-1 form-group">
                                     <b>Company</b><br />
                                        <input type="hidden" class="form-control" value="<?php echo $companyid ?>" id="whichcompany" name="whichcompany" readonly="">
                                        <input type="text" class="form-control" value="<?php echo $companyname_english ?>" readonly="" >
                                  </div> 
                                  <div class="col-md-3">
                                      <b>Branch </b><br />
                                           <input type="hidden" id="requestfrom" class="form-control" value=" <?php echo $workingin ?>" name="requestfrom" readonly="">  <input type="text" class="form-control" value="<?php echo $branchname_english ?>" readonly="" >
                                 </div>

                                  <div class="col-md-3">
                                     <b> Request To Farmer  </b><br />
                                      <select autofocus="" name="requestto"  id="requestto"  class="form-control "  data-placeholder="Choose a Branch Request " tabindex="0">
                                           <option selected="" value="">Select Branch Request to</option>
                                            <?php
                                            include "db.php";
                                            $result = mysqli_query($con, "SELECT * FROM `farmers`");
                                              while ($row = mysqli_fetch_array($result)) {
                                                  echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                              }
                                              ?>
                                      </select>
                                  </div>

                                <div class="col-md-1">
                                Ref. No<br />
                                  <input  type="text" name="branchreferenceno" id="branchreferenceno" class="form-control input-sm" placeholder="Ref.No." tabindex="0"  />
                              </div>

                               <div class="col-md-2">
                               Date of Request<br />
                              <input type="text" name="requestorder_date" id="requestorder_date" class="form-control input-sm"  placeholder="Select Branch Request Date"  value="<?php echo $fulldatee; ?>" readonly="" tabindex="-1" />
                              </div>
                     </div>

                    <!-- -------------------------------------------------------------------------------------------------- -->


                 


              <div class="table-responsive" style="overflow-y: auto;overflow-x: hidden;height: 45%">

                  <table id="invoice-item-table" class="table table-bordered">
                    <tr>
                      <th style="padding: 10px" width="2%">SrNo.</th>
                      <th style="padding: 10px" width="10%">Item Code</th>
                      <th style="padding: 10px" width="35%">Item Name</th>                    
                      <th style="padding: 10px" width="7%">Units</th>                    
                      <th style="padding: 10px" width="5%">Qty</th>
                      <th style="padding: 10px" width="5%">Price</th>
                      <th style="padding: 10px" width="10%">Total</th>
                      <th  width="3%"></th>
                    </tr>

                    <tr>
                      <td><span id="sr_no">1</span></td>
                      <td class="item_code">
                        <input autofocus="" type="text"  name="itemcode[]" id="itemcode1" class="form-control input-sm datalist-input" tabindex="0" />
                      </td>
                      <td class="item_name">
                        <input type="text" name="item_name[]" id="item_name1"  class="form-control input-sm" tabindex="-1" />
                      </td>                    
                      <td class="item_unit">
                        <input type="text" name="units[]" id="units1"  class="form-control input-sm" tabindex="-1" /> 
                      </td>                    
                       <td>
                        <input type="number"  name="order_item_quantity[]" min="0" id="order_item_quantity1" value="" data-srno="1" class="form-control input-sm order_item_quantity" tabindex="0"/>
                      </td>
                      <td class="item_price">
                        <input type="text"  name="order_item_price[]" id="order_item_price1" data-srno="1" class="form-control input-sm number_only order_item_price" tabindex="-1" />
                      </td>
                      <td>
                        <input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1" data-srno="1" class="form-control input-sm order_item_actual_amount"  readonly="" tabindex="0" />
                      </td>
                      <td>
                        <input type="hidden" name="order_item_final_amount[]" id="order_item_final_amount1" data-srno="1" readonly class="form-control input-sm order_item_final_amount" tabindex="-1" />
                        <button type="button" onclick="ClearFields();" class="btn btn-danger btn-icon-anim btn-circle ">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                      </td>
                    </tr>
                  </table>

                  <div>                        
                   <button type="button" name="add_row" id="add_row" class="btn btn-default btn-icon-anim btn-circle"><i class="fa fa-plus" aria-hidden="true"></i></button>                     
                 </div>

             </div>

                 

                  <div class="col-md-8">
                    <input type="text" name="remarks" id="remarks" data-srno="1" class="form-control input-sm remarks" placeholder="Enter the Remarks to be displayed in your Branch Request Document">
                  </div>

                  <div class="col-md-4" style="color: red;font-weight: bold;font-size: 20px;text-align: right;padding-right: 75px;"> Total : <b><span id="final_total_amt"></span></b>
                  </div>

                  <hr class="light-grey-hr"> 
                  <div id="finalRemarks">
                    <div class="row">
                      <div class="col-md-1 col-lg-1"></div>
                      <div class="col-md-10 col-lg-10">

                      </div>
                      <div class="col-md-1 col-lg-1"></div>
                    </div>
                    <div class="row" style="padding: 10px 0;">
                      <div class="col-md-12 text-center">
                        <input type="hidden" name="total_item" id="total_item" value="1" />
                         <a href="purchaseorder.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a>

                        <input type="submit" name="create_invoice" id="create_invoice" class="btn btn-primary btn-rounded" value="Save" />
                      </div>
                    </div>
                  </div>

           </div>
      </form>


      <script>



      $(document).ready(function(){

        var final_total_amt = $('#final_total_amt').text();
        var count = 1;


        $(document).on('keypress', function(e) {
          var tag = e.target.tagName.toLowerCase();
          if ( e.which === 43  )
            if ($('#order_item_quantity'+count).val() != "") {
            addrow();
            $('#itemcode'+count).focus();
          }  else{
            swal("", "Cannot add new row when previous row is blank !!","warning");
          }
       });


        $(document).on('click', '#add_row', function(){
            if ($('#order_item_quantity'+count).val() != "") {
            addrow();
            $('#itemcode'+count).focus();
          }  else{
            swal("", "Cannot add new row when previous row is blank !!","warning");
          }

        });

        function addrow(){
       
          count++;
          $('#total_item').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';

          html_code += '<td><span id="sr_no">'+count+'</span></td>';

          html_code += '<td class="item_code"><input autofocus="" onkeypress="return specialcharacternotallowed(event);" type="text" list="item_code_list" name="itemcode[]" id="itemcode'+count+'" class="form-control input-sm datalist-input" tabindex="0" /></td>';
          html_code += '<td class="item_name"><input type="text" name="item_name[]"   id="item_name'+count+'" class="form-control input-sm" tabindex="-1"/></td>';
         
          html_code += '<td class="units"><input type="text" name="units[]"   id="units'+count+'" class="form-control input-sm" tabindex="-1"/></td>';      

          html_code += '<td><input type="number" name="order_item_quantity[]"  onkeypress="return specialcharacternotallowed(event);" min="0" value="" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" tabindex="0"/></td>';

          html_code += '<td class="item_price"><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_price" tabindex="-1"/></td>';

          html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount"  tabindex="0" /></td>';

          html_code += '<td><input type="hidden" name="order_item_final_amount[]" id="order_item_final_amount'+count+'" data-srno="'+count+'"  class="form-control input-sm order_item_final_amount"  tabindex="-1"/> <button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-icon-anim btn-circle remove_row"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
          
          html_code += '</tr>';

          $('#invoice-item-table').append(html_code);

          let temp_id = 'itemcode' + count;
        }


        $(document).on('keypress', function(e) {
          var tag = e.target.tagName.toLowerCase();
          if ( e.which === 45)
              if(count != 1){
                var confrm = confirm('Do you really want to delete the row!');
                if (confrm) {
                var total_item_amount = $('#order_item_final_amount'+count).val();
                var final_amount = $('#final_total_amt').text();
                var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
                $('#final_total_amt').text((result_amount).toFixed(3));
                $('#row_id_'+count).remove();
                count--;
                $('#total_item').val(count);
                cal_final_total(count);
                } else{

                };


              }
       });

        $(document).on('click', '.remove_row', function(){
          var row_id = $(this).attr("id");
          var total_item_amount = $('#order_item_final_amount'+row_id).val();
          var final_amount = $('#final_total_amt').text();
          var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
          $('#final_total_amt').text((result_amount).toFixed(3));
          $('#row_id_'+row_id).remove();
          count--;
          $('#total_item').val(count);
          cal_final_total(count);
        });

        function cal_final_total(count)
        {
          let order_item_quantityElements = document.getElementsByName('order_item_quantity[]'),
            order_item_priceElements = document.getElementsByName('order_item_price[]'),
            order_item_actual_amountElements = document.getElementsByName('order_item_actual_amount[]'),
            order_item_final_amountElements = document.getElementsByName('order_item_final_amount[]');

          let final_item_total = 0;

          for(j = 0; j < count; j++)  {
            let quantity = order_item_quantityElements[j],
              price = order_item_priceElements[j]

            let qtyVal = quantity.value,
              amt = price.value;

            let item_total = 0;

            if (amt > 0)  {
              order_item_actual_amountElements[j].value = (parseFloat(qtyVal) * parseFloat(amt)).toFixed(3);
              order_item_final_amountElements[j].value = (parseFloat(qtyVal) * parseFloat(amt)).toFixed(3);
              final_item_total = (parseFloat(final_item_total) + parseFloat(order_item_actual_amountElements[j].value)).toFixed(3);
            }
          }
          $('#final_total_amt').text(final_item_total);

        }

        $(document).on('blur', '.order_item_quantity', function(){
          cal_final_total(count);
        });
          $(document).on('blur', '.order_item_price', function(){
          cal_final_total(count);
        });


        $('#create_invoice').click(function(){

                          for(var no=1; no<=count; no++)
                          {
                                                if($.trim($('#itemcode'+no).val()).length == 0)
                                                {
                                                  swal("", "Please Enter Item Code !!","error");
                                                  $('#itemcode'+no).focus();
                                                  return false;
                                                }

                                                if($.trim($('#units'+no).val()).length == 0)
                                                {
                                                  swal("", "Please Enter Units !!","error");
                                                  $('#units'+no).focus();
                                                  return false;
                                                }

                                                if($.trim($('#order_item_quantity'+no).val()).length == 0)
                                                {
                                                  swal("", "Please Enter Quantity !!","error");
                                                  $('#order_item_quantity'+no).focus();
                                                  return false;
                                                }
                          }

                          $('#invoice_form').submit();

        });

      });
      </script>

 <!-- insert code form design end -->



 <!-- update code form design  -->

<?php
} elseif (isset($_GET["update"]) && isset($_GET["id"])) {
    $statement = $connect->prepare(" SELECT * FROM   purchase_order WHERE order_id = :order_id LIMIT 1");
    $statement->execute(
        array(
            ':order_id' => $_GET["id"],
        )
    );
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        ?>
        <script>
        $(document).ready(function(){

          $('#requestorderprifix').val("<?php echo $row["requestorderprifix"]; ?>");
          $('#branchreferenceno').val("<?php echo $row["branchreferenceno"]; ?>");
          $('#remarks').val(`<?php echo $row["remarks"]; ?>`);
          $('#requestorder_date').val("<?php echo $row["requestorder_date"]; ?>");
          $('#requestfrom').val("<?php echo $row["requestfrom"]; ?>");
          $('#whichcompany').val("<?php echo $row["whichcompany"]; ?>");
          $('#requestto').val("<?php echo $row["requestto"]; ?>");

        
        });
        </script>
        <form method="post" id="invoice_form">
                  <div class="row">

                      <div class="form-group col-md-2">Document No <br />
                        <input type="text" name="requestorderprifix" id="requestorderprifix" class="form-control input-sm" placeholder=" Br. Ref. No" readonly="" tabindex="-1" />
                      </div>

                      <div class="form-group col-md-1"><b>Company </b><br />
                        <input type="text" name="whichcompany" id="whichcompany" class="form-control input-sm" readonly="" />
                      </div>

                      <div class="form-group col-md-2"><b>Request From </b><br />
                          <input type="text" name="requestfrom" id="requestfrom" class="form-control input-sm" readonly="" placeholder="Enter Request From" />
                      </div>

                      <div class="form-group col-md-3"><b>Request To </b><br />
                        <input type="text" name="requestto" id="requestto" class="form-control input-sm" placeholder=" Br. Ref. No"  />
                      </div>

                      <div class="form-group col-md-2">Ref. No<br />
                        <input type="text" name="branchreferenceno" id="branchreferenceno" class="form-control input-sm" placeholder=" Br. Ref. No"  />
                      </div>

                      <div class="form-group col-md-2">Date Of Request <br />
                          <input type="text" name="requestorder_date" id="requestorder_date" class="form-control input-sm" readonly placeholder="Select Invoice Date" tabindex="-1" />
                      </div>
                  </div>

                  <div class="table-responsive" style="overflow-y: auto;overflow-x: hidden;height: 45%">

                  <table id="invoice-item-table" class="table table-bordered">
                    <tr>
                      <th style="padding: 10px" width="2%">SrNo.</th>
                      <th style="padding: 10px" width="10%">Item Code</th>
                      <th style="padding: 10px" width="40%">Item Name</th>                   
                      <th style="padding: 10px" width="7%">Units</th>                      
                      <th style="padding: 10px" width="10%">Price</th>
                      <th style="padding: 10px" width="10%">Qty</th>
                      <th style="padding: 10px" width="10%">Total</th>
                      <th style="padding: 10px" width="3%" >
                        <div>
                         <button tabindex="0" type="button" name="add_row" id="add_row" class="btn btn-default btn-icon-anim btn-circle"><i class="fa fa-plus" aria-hidden="true"></i></button>
                       </div>
                      </th>
                    </tr>

                    <?php 
                    $statement = $connect->prepare("SELECT * FROM   purchase_order_item WHERE order_id = :order_id");
                    $statement->execute(
                        array(
                            ':order_id' => $_GET["id"],
                        )
                    );
                    $item_result = $statement->fetchAll();
                    $m = 0;
                    foreach ($item_result as $sub_row) {
                        $m = $m + 1;
                        ?>
                    <tr>
                      <td><span id="sr_no"><?php echo $m; ?></span>  </td>
                        <td class="item_code"><input type="text" list="item_code_list"  name="itemcode[]" id="itemcode<?php echo $m; ?>" class="form-control input-sm " value="<?php echo $sub_row["itemcode"]; ?>" />
                          
                      </td>
                      <td class="item_name">
                        <input type="text" name="item_name[]" id="item_name<?php echo $m; ?>" class="form-control input-sm" value="<?php echo $sub_row["item_name"]; ?>" />
                      </td>
                    
                      <td class="item_unit">
                        <input type="text" name="units[]" id="units<?php echo $m; ?>" class="form-control input-sm" value="<?php echo $sub_row["units"]; ?>" />
                      </td>                     

                      <td class="item_price">
                        <input type="text"  name="order_item_price[]" id="order_item_price<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm number_only order_item_price" value="<?php echo $sub_row["order_item_price"]; ?>" />
                      </td>
                      <td>
                        <input type="number"  name="order_item_quantity[]" min="0" id="order_item_quantity<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_quantity" value = "<?php echo $sub_row["order_item_quantity"]; ?>"/>
                      </td>
                      <td>
                        <input type="text"  name="order_item_actual_amount[]" id="order_item_actual_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" class="form-control input-sm order_item_actual_amount" value="<?php echo $sub_row["order_item_actual_amount"]; ?>" readonly />
                      </td>
                      <td>
                        <input type="hidden" name="order_item_final_amount[]" id="order_item_final_amount<?php echo $m; ?>" data-srno="<?php echo $m; ?>" readonly class="form-control input-sm order_item_final_amount" value="<?php echo $sub_row["order_item_final_amount"]; ?>" /> <button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-icon-anim btn-circle remove_row"><i class="fa fa-trash" aria-hidden="true"></i></button>
                      </td>
                    </tr>
                    <?php }?>
                  </table>

                </div>

                   <div class="col-md-8"> <input type="text" name="remarks" id="remarks" data-srno="1" class="form-control input-sm remarks" placeholder="Enter the Remarks to be displayed in your Branch Request Document">
                   </div>

                   <div class="col-md-4" style="color: red;font-weight: bold;font-size: 20px;text-align: right;
                   padding-right: 75px;"> Total : <b><span id="final_total_amt"><?php echo $row["order_total_after_tax"]; ?></span></b>
                    </div>

                  <hr class="light-grey-hr">
                  <div id="finalRemarks">
                    <div class="row">
                      <div class="col-md-1 col-lg-1"></div>
                      <div class="col-md-10 col-lg-10">

                      </div>
                      <div class="col-md-1 col-lg-1"></div>
                    </div>
                    <div class="row" style="padding: 10px 0;">
                      <div class="col-md-12 text-center">
                        <input type="hidden" name="total_item" id="total_item" value="<?php echo $m; ?>" />
                        <input type="hidden" name="order_id" id="order_id" value="<?php echo $row["order_id"]; ?>" />

                         <a href="purchaseorder.php" class="btn btn-danger btn-rounded btn-lable-wrap left-label"><span class="btn-label"><i class="fa fa-times"></i> </span><span class="btn-text">Close</span> </a>

                        <input type="submit" name="update_invoice" id="create_invoice" class="btn btn-primary btn-rounded btn-rounded" value="UPDATE" />
                      </div>
                    </div>
                  </div>
      </form>

      <script>
      $(document).ready(function(){
        var final_total_amt = $('#final_total_amt').text();
        var count = "<?php echo $m; ?>";


        $(document).on('keypress', function(e) {
          var tag = e.target.tagName.toLowerCase();
          if ( e.which === 43)

          if ($('#order_item_quantity'+count).val() != "") {
            addrow();
            $('#itemcode'+count).focus();
          } else{
            swal("", "Cannot add new row when previous row is blank !!","warning");
          }

        });

        $(document).on('click', '#add_row', function(){
           if ($('#order_item_quantity'+count).val() != "") {
            addrow();
            $('#itemcode'+count).focus();
          }  else{

            swal("", "Cannot add new row when previous row is blank !!","warning");
          }

        });

        function addrow(){

          count++;
          $('#total_item').val(count);
          var html_code = '';
          html_code += '<tr id="row_id_'+count+'">';

          html_code += '<td><span id="sr_no">'+count+'</span> </td>';
          html_code += '<td class="item_code"><input type="text" list="item_code_list" onkeypress="return specialcharacternotallowed(event);" name="itemcode[]" id="itemcode'+count+'" class="form-control input-sm datalist-input" tabindex="0" /></td>';
          html_code += '<td class="item_name"><input type="text" name="item_name[]"   id="item_name'+count+'" class="form-control input-sm" /></td>';
          
          html_code += '<td class="item_unit"><input type="text" name="units[]"  id="units'+count+'" class="form-control input-sm" /></td>';
       
          html_code += '<td class="item_price"><input type="text" name="order_item_price[]" id="order_item_price'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_price" /></td>';

          html_code += '<td><input type="number" name="order_item_quantity[]"  min="0" value="" id="order_item_quantity'+count+'" data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" tabindex="0"/></td>';

          html_code += '<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'" data-srno="'+count+'" class="form-control input-sm order_item_actual_amount"  tabindex="0" /></td>';

          html_code += '<td><input type="hidden" name="order_item_final_amount[]" id="order_item_final_amount'+count+'" data-srno="'+count+'" readonly class="form-control input-sm order_item_final_amount" /> <button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-icon-anim btn-circle remove_row"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
          html_code += '</tr>';

          $('#invoice-item-table').append(html_code);

      }


          $(document).on('keypress', function(e) {
          var tag = e.target.tagName.toLowerCase();
          if ( e.which === 45)
              if(count != 1){
                var confrm = confirm('Do you really want to delete the row!');
                if (confrm) {
                var total_item_amount = $('#order_item_final_amount'+count).val();
                var final_amount = $('#final_total_amt').text();
                var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
                $('#final_total_amt').text(result_amount);
                $('#row_id_'+count).remove();
                count--;
                $('#total_item').val(count);
                cal_final_total(count);
                } else{

                };
              }
       });

        $(document).on('click', '.remove_row', function(){
         var row_id = $(this).attr("id");

         var total_item_amount = $('#order_item_final_amount'+row_id).val();
         var final_amount = $('#final_total_amt').text();
         var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);

          $('#final_total_amt').text(result_amount);
          $('#row_id_'+row_id).remove();
          count--;
          $('#total_item').val(count);
          cal_final_total(count);

        });


           function cal_final_total(count)
        {
          let order_item_quantityElements = document.getElementsByName('order_item_quantity[]'),
            order_item_priceElements = document.getElementsByName('order_item_price[]'),
            order_item_actual_amountElements = document.getElementsByName('order_item_actual_amount[]'),
            order_item_final_amountElements = document.getElementsByName('order_item_final_amount[]');

          let final_item_total = 0;

          for(j = 0; j < count; j++)  {
            let quantity = order_item_quantityElements[j],
              price = order_item_priceElements[j]

            let qtyVal = quantity.value,
              amt = price.value;

            let item_total = 0;

            if (amt > 0)  {

              order_item_actual_amountElements[j].value = (parseFloat(qtyVal) * parseFloat(amt)).toFixed(3);

              order_item_final_amountElements[j].value = (parseFloat(qtyVal) * parseFloat(amt)).toFixed(3);

              final_item_total = (parseFloat(final_item_total) + parseFloat(order_item_actual_amountElements[j].value)).toFixed(3);
            }
          }
          $('#final_total_amt').text(final_item_total);

        }


        $(document).on('blur', '.order_item_quantity', function(){
          cal_final_total(count);
        });

        $(document).on('blur', '.item_code', function(){
          cal_final_total(count);
        });


        $('#create_invoice').click(function(){


          if($.trim($('#requestto').val()).length == 0)
          {
             alert("Please Enter Branch Request To");
             return false;
          }


          for(var no=1; no<=count; no++)
          {

          }

          $('#invoice_form').submit();

        });

      });
      </script>
        <?php
}
} else {
    ?>

      <br />



 <!-- update code form design end -->















<!-- ------------------------------------------------------------------------------------------------------------------------------------------- -->


 <!-- VIEW code form design  -->
      <table  id="data-table" class="table table-bordered table-striped">

    <!-- ROLE BASED CREATE-->
    <?php if (authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["create"])) {?>

        <div class="text-right">
        <a href="purchaseorder.php?add=1" class="btn btn-primary  btn-icon right-icon"><i class="fa fa-plus"></i><span class="btn-text"> Create Purchase Order</span></a> </div><br>
    <?php }?>
    <!-- ROLE BASED CREATE-->
        <thead>
          <tr>
            <th width="15px">Sr.No.</th>
            <th width="10px">Request From </th>
            <th >Document No </th>
            <th  width="20px">Req to Farmer</th>
            <th>Request Date</th>
            <th> Amount</th>
            <th>Permission</th>
            <th>Stage</th>
          </tr>
        </thead>
        <?php 

          include 'database_connection.php';
          $statement = $connect->prepare("SELECT b.order_id, b.whichcompany,b.requestorderprifix,b.requestorder_date,b.requestfrom,b.requestto, f.name, b.order_total_before_tax,b.order_total_after_tax,b.order_datetime,b.remarks,b.status,b.branchreferenceno FROM `purchase_order` b, `farmers` f where b.requestto = f.id ORDER BY b.order_id DESC");
          $statement->execute();
          $all_result = $statement->fetchAll();
          $total_rows = $statement->rowCount();

          if ($total_rows > 0) {

          $countt = 1;
          foreach ($all_result as $row) {

            echo '
              <tr>
                <td>' . $countt++ . '</td>
                <td style="padding:10px">' . $row["requestfrom"] . ' - '.$branchname_english.'</td>
                <td><a  href="#view' . $row['order_id'] . '" data-toggle="modal" class="text-inverse pr-10" title="Edit" data-toggle="tooltip">
                ' . $row["whichcompany"] . '/' . $row["requestfrom"] . '/' . $row["requestorderprifix"] . '</a></td>
                <td>' . $row["name"] . '</td>
                <td>';$requestorderdate = $row['requestorder_date'];
                echo $newrequestorderdate = date("d-m-Y", strtotime($requestorderdate));echo '</td>
                <td>' . $row["order_total_after_tax"] . '</td>
              ';?>

               <?php include 'modal/viewpurchaseorder.php';?>
              <TD>

                <!-- ROLE BASED VIEW -->
                           <?php if (authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["view"])) {?>

                          <?php echo '
                          <a target="_blank" href="printpdf/print_purchaseorder.php?pdf=1&id=' . $row["order_id"] . '" ><i class="fa fa-file-text-o txt-default"> </i> </a> &nbsp;
                          '; ?>

                          <?php }?>

                <!-- ROLE BASED VIEW -->


                <!-- ROLE BASED EDIT -->
                                <?php if (authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["edit"])) {?>

                                           <?php
if ($row['status'] == 0) {
                echo '
                                           <a href="purchaseorder.php?update=1&id=' . $row["order_id"] . '"  class="text-inverse pr-10"> <i class="zmdi zmdi-edit txt-success">
                                                      </i></a> ';
            } else {

            }?>

                                <?php }?>
                <!-- ROLE BASED EDIT -->

                <!-- ROLE BASED DELETE -->

                                <?php if (authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["delete"])) {?>

                                 <?php

                if ($row['status'] == 0) {
                    echo '
                                  <a href="#" id="' . $row["order_id"] . '" class="delete"><i class="zmdi zmdi-delete txt-danger pr-10"></i></a> ';
                } else {

                }?>


                                <?php }?>

              <!-- ROLE BASED DELETE -->

              <!-- ROLE BASED APPROVAL -->

                                <?php if (authorize($_SESSION["access"]["PURCHASE"]["PURCHASEORDER"]["approval"])) {?>

                                <span data="<?php echo $row['order_id']; ?>" class="status_checks btn-sm label <?php echo ($row['status']) ? 'label-success' : 'label-danger' ?>"><?php echo ($row['status']) ? 'Approved' : 'Not Approved' ?></span> &nbsp;&nbsp;

                                <?php }?>

            <!-- ROLE BASED APPROVAL -->


   <a href="#branchrequestlogs<?php echo $row['order_id']; ?>" data-toggle="modal"  class="text-inverse" title="Delete" ><i class="fa fa-commenting" aria-hidden="true"></i></a>
  <?php include 'logs/branchrequestlogs.php';?>


            </td>



            <TD>

                      <?php if ($row['status'] == 0) {
                echo ' <span style="opacity:0.5" class="btn-sm label label-danger">Not Approved</span>';
            } else if ($row['status'] == 1) {

                echo ' <span style="opacity:0.5" class="btn-sm label label-success">Approved</span>';

            }
            ?>

            </TD>

            <?php echo '

            </tr>';
        }
    }
    ?>
      </table>
      <?php
}
?>


 <!-- VIEW code form design  end-->




        <!-- ACTIVE AND INACTIVE KA CODE -->

        <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript">
        $(document).on('click','.status_checks',function(){



        var status = ($(this).hasClass("label-success")) ? '0' : '1';
        var msg = (status=='0')? 'Deactivate' : 'Activate';
        if(confirm("Are you sure to "+ msg)){
          var current_element = $(this);
          url = "allstatus/purchaseorderajax.php";
          $.ajax({
          type:"POST",
          url: url,
          data: {order_id:$(current_element).attr('data'),status:status},
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

            <script type="text/javascript">
              $(document).ready(function(){
                var table = $('#data-table').DataTable({
                      "order":[],
                      "columnDefs":[
                      {
                        "targets":[6],
                        "orderable":false,
                      },
                    ],
                    "pageLength": 25
                    });
                $(document).on('click', '.delete', function(){
                  var id = $(this).attr("id");
                  if(confirm("Are you sure you want to remove this?"))
                  {
                    window.location.href="purchaseorder.php?delete=1&id="+id;
                  }
                  else
                  {
                    return false;
                  }
                });
              });

            </script>

            <script>
            $(document).ready(function(){
            $('.number_only').keypress(function(e){
            return isNumbers(e, this);
            });
            function isNumbers(evt, element)
            {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (
            (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;
            return true;
            }
            });
            </script>




        </div>
        <!-- /Main Content -->

<?php include "allscript.php";?>


<script>
  var totalOrderItems = 1;

  //#region modal on enter
  var modelDataTable = $('#modal-data-table').DataTable();
  //#endregion

  var requestBranchData13123434585 = null;
  var supplierBranchData1312343458 = null;
  var currentCodeSelection = 0;

  var baseURL = window.location.href.split('/');
  baseURL.pop();
  baseURL = baseURL.join('/');



  $('#invoice-item-table').on("input", ".datalist-input", function() {

    //validation
    if (!$('#whichcompany').val()) {
      swal("", "Please Select Company","warning");
      $('#whichcompany').focus();
      return;
    }

    if (!$('#requestfrom').val()) {
      swal("", "Please Select branch request from!","warning");
      $('#requestfrom').focus();
      return;
    }

    if (!$('#requestto').val()) {
      swal("", "Please Select Branch Request To","warning");
      $('#requestto').focus();
      return;
    }

    let currentElement = $(this);
    let val = currentElement.val();

    let item_data = supplierBranchData1312343458[val];

    let parent = $(this).parent().parent();

    let code = $(this),
      name = $(parent).children(".item_name").children(),
      unit = $(parent).children(".item_unit").children().first(),
     
      price = $(parent).children(".item_price").children();

    if (!item_data) {
      name.val("");
    
      unit.val("");
   
      price.val("");
    } else {
      currentCodeSelection = item_data["code"];
      code.val(item_data["code"]);
      name.val(item_data["item"]);
   

      // new changes
      $(parent).children(".item_unit").children('.item-unit-selection').empty();

      let maxUnit = item_data['maxUnit'];
      let itemBatches = Object.keys(item_data['batches']);

      let itemUnits = {};

      unit.first().empty();

      if (itemBatches.length)  {
          $.each(item_data['batches'][itemBatches[0]]['units'], function(val, item)  {
            itemUnits[item['retailPrice']] = val;
          });
      } else {
        itemUnits = {
          retailPrice: maxUnit
        };
      }

      let rsp = 0;

      $.each(itemUnits, function(i, item) {
        if (item === maxUnit) rsp = i;
        $(parent).children(".item_unit").children(".item-unit-selection").append($("<option>").attr("value", item).attr("selected", item === maxUnit).text(item));
      });

      unit.focus();
      packing.val(item_data['maxUnitPacking']);
      price.val(rsp);


    }
  });



</script>