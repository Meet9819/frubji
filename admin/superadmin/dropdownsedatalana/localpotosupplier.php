
<?php



include"../db.php";
if($_REQUEST['suppid']) {
	$sql = "SELECT * FROM `supplier` WHERE `id` ='".$_REQUEST['suppid']."'";
	$resultset = mysqli_query($con, $sql) or die("database error:". mysqli_error($con));
	
	$data = array();
	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$data = $rows;
	}
	echo json_encode($data);
} else {
	echo 0;	
}
?>
