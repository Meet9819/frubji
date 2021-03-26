
<?php



include"../db.php";
if($_REQUEST['customername']) {
	$sql = "SELECT * FROM `customer` WHERE `id` ='".$_REQUEST['customername']."'";
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
