

<?php 
//include "../barcode/vendor/autoload.php";


//print_invoice.php
if(isset($_GET["pdf"]) && isset($_GET["id"]))
{
 require_once 'pdf.php';
 include('../database_connection.php');
 $output = '';
 $statement = $connect->prepare("
  SELECT * FROM br_request_order 
  WHERE order_id = :order_id
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
            <h1>Branch Request</h1> 

                       '; 
                        $rw =   $row["requestfrom"] . '/' . $row["requestorderprifix"];
                      //  $Bar = new Picqer\Barcode\BarcodeGeneratorHTML();
                       // $output .= $code = $Bar->getBarcode($rw, $Bar::TYPE_CODE_128);

                        $output .=   '  <br>
             Document No. :  ' . $row["whichcompany"] . '/' . $row["requestfrom"] . '/' .$row["requestorderprifix"].'<br />
           <b>Request From</b> - '.$row["requestfrom"].'<br />
           <b>Request To</b> - '.$row["requestto"].'<br />
            Request Date : '.$row["requestorder_date"].' <br>
        </td>
       </tr>
      </table>
      <br />
      <table width="100%" border="1" cellpadding="5" cellspacing="0" >
       <tr style="background-color:#f3f3f3">
        <th>Sr No.</th>
        <th>Code</th>
        <th>Item Name</th>
     
  
        <th>Qty</th>   <th>Unit</th>
     </tr>
     ';
  $statement = $connect->prepare(
   "SELECT * FROM   br_request_order_item 
   WHERE order_id = :order_id"
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
     <td align="center">'.$sub_row["order_item_quantity"].'</td>
    <td align="center">'.$sub_row["units"].'</td> 
   </tr>
   ';
  }
  $output .= '
  <tr style="background-color:#f3f3f3">
   <td align="right" colspan="4"><b></b></td>
   <td align="right"><b></b></td>
  </tr>
 
  '; 

   $output .= '
  <tr>
   <td align="left" colspan="5"><b>Remarks :  </b><br> '.$row["remarks"].'</td>
  </tr>

   <tr>
   <td align="center" colspan="3"><b></b></td>

   <td align="center" colspan="2"><b>Prepared By</b></td>
  </tr>


   <tr>
   <td align="center" colspan="3"><br><Br></td>

   <td align="center" colspan="2"><br><Br></td>
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