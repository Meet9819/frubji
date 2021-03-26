<?php 
include('../p.php');

extract($_POST);
$user_id=$db->real_escape_string($id);
$status=$db->real_escape_string($status);
$sql=$db->query("UPDATE customerimages SET status='$status' WHERE id='$id'"); 

echo $sql; 

?>
