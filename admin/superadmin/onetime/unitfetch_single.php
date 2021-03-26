<?php
include "../levelscrud/db.php";
include('unitfunction.php');
if(isset($_POST["id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM unit 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
	$output["unit"] = $row["unit"];
	}
	echo json_encode($output);
}
?>