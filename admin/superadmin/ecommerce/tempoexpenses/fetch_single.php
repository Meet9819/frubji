<?php
include('../db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM tempoexpenses
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["tempoid"] = $row["tempoid"];
		$output["notes"] = $row["notes"];
		$output["datee"] = $row["datee"];
		$output["amount"] = $row["amount"];
		
		
	}
	echo json_encode($output);
}
?>