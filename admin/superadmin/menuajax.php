<?php 

$db= new mysqli("localhost","root","","frubji");      

extract($_POST);
$user_id=$db->real_escape_string($menu_id);
$status=$db->real_escape_string($status);
$sql=$db->query("UPDATE menu SET status='$status' WHERE menu_id='$menu_id'");
echo $sql;
//echo 1;
?>
