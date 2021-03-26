

<?php 
//include "../barcode/vendor/autoload.php";


//print_invoice.php
if(isset($_GET["pdf"]) && isset($_GET["id"]))
{
 require_once 'pdf.php';
 include('../database_connection.php');
 $output = '';
 $statement = $connect->prepare("
  SELECT p.order_id,p.whichcompany,p.requestorderprifix, p.requestorder_date,p.requestfrom, b.branchname_english, p.customername,p.typeofsale,p.order_total_before_tax, p.order_total_after_tax, p.order_datetime,p.remarks,p.status,p.mobile,p.updated_on FROM `purchaseorder` p, `branch` b where p.requestfrom = b.id and  
  p.order_id = :order_id
  LIMIT 1
 ");
 $statement->execute(
  array(
   ':order_id'       =>  $_GET["id"]
  )
 );
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output .= '
    <table width="100%" border="0" cellpadding="5" cellspacing="0" >  
      <tr>
     <td colspan="2">
      <table width="100%" cellpadding="5">
       <tr>
        <td width="60%">    
         <img style="width:250px" src="../../img/logo.png" >   
        </td>
          <td width="60%" style="text-align:right">
            <h1>Purchase Order</h1> 

                       '; 
                        $rw =   $row["requestfrom"] . '/' . $row["requestorderprifix"];
                      //  $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
                       // $output .= $code = $Bar->getBarcode($rw, $Bar::TYPE_CODE_128);

                        $output .=   '  <br>
             Document No. :  ' . $row["whichcompany"] . '/' . $row["requestfrom"] . '/' .$row["requestorderprifix"].'<br />
           <b>Branch</b> - '.$row["branchname_english"].'<br />
           <b>Customer Name</b> - '.$row["customername"].'<br />
           <b>Customer Mobile No</b> - '.$row["mobile"].'<br />
            Order Date : '.$row["order_datetime"].' <br>
           Type of Sale : '.$row["typeofsale"].' <br>
        </td>
       </tr>
      </table>
      <br />
      <table width="100%" border="1" cellpadding="5" cellspacing="0" >
       <tr style="background-color:#f3f3f3">
        <th>Sr No.</th>
        <th>Code</th>
        <th>Item Name</th>
        <th>Unit</th>
        <th>Qty</th>    
        <th>Price</th>
        <th>Amt</th>
     </tr>
     ';
  $statement = $connect->prepare(
   "SELECT pi.order_item_id,pi.order_id,pi.itemcode,pi.item_name,pi.variant,pv.qty, pv.units, pi.order_item_quantity,pi.order_item_price,pi.order_item_actual_amount,pi.order_item_final_amount FROM purchaseorder_item pi, productvariant pv where pi.variant = pv.id and pi.order_id = :order_id"
  );
  $statement->execute(
   array(
    ':order_id' =>  $_GET["id"]
   )
  );
  $item_result = $statement->fetchAll();
  $count = 0;
  foreach($item_result as $sub_row)
  {
   $count++;
   $output .= '
   <tr >
    <td align="center" >'.$count.'</td> 
       <td>'.$sub_row["itemcode"].'</td>
    <td>'.$sub_row["item_name"].'</td>
    <td align="center">'.$sub_row["qty"].' '.$sub_row["units"].'</td>   
     <td align="center">'.$sub_row["order_item_quantity"].'</td>
    <td align="center">'.$sub_row["order_item_price"].'</td>  
    <td align="right">'.$sub_row["order_item_actual_amount"].'</td>
   </tr>
   ';
  }
  $output .= '
  <tr style="background-color:#f3f3f3">
   <td align="right" colspan="6"><b>Total</b></td>
   <td align="right"><b>'.$row["order_total_after_tax"].'</b></td>
  </tr>
 
  '; 

   $output .= '
  <tr>
   <td align="left" colspan="7"><b>Remarks :  </b><br> '.$row["remarks"].'</td>
  </tr>

   <tr>
   <td align="center" colspan="4"><b></b></td>
  
   <td align="center" colspan="3"><b>Prepared By</b></td>
  </tr>


   <tr>
   <td align="center" colspan="4"><br><Br></td>

   <td align="center" colspan="3"><br><Br></td>
  </tr>


 
  ';
  $output .= '
      </table>
     </td>
    </tr>
   </table>
  '; 



 }
 $pdf = new Pdf();
 $file_name = 'print_branchrequest'.$row["whichcompany"].$row["requestfrom"].'.pdf'; 



 $pdf->loadHtml($output);
 $pdf->render();
 $pdf->stream($file_name, array("Attachment" => false));
}
?>