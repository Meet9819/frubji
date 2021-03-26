<?php $db= new mysqli("localhost","root","","frubji"); 
extract($_POST);
$user_id=$db->real_escape_string($id);
$status=$db->real_escape_string($status);
$sql=$db->query("UPDATE tbl_users SET status='$status' WHERE userID='$id'");
echo $sql;
//echo 1;
?>
