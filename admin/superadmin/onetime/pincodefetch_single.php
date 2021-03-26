<?php
include "../levelscrud/db.php";
include('pincodefunction.php');
if(isset($_POST["id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM pincode 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{	
	$output["pincode"] = $row["pincode"];
	}
	echo json_encode($output);
}
?>