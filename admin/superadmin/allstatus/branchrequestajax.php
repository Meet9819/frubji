<?php 
include('../p.php');
extract($_POST);
$user_id=$db->real_escape_string($order_id);
$status=$db->real_escape_string($status);
$sql=$db->query("UPDATE br_request_order SET status='$status' WHERE order_id='$order_id'"); 
echo $sql; 
//echo 1;
	header('location:../purchaseorder.php');
?>
