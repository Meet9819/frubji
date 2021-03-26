<?php
include('db.php');
include('function.php');
if(isset($_POST["id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM ecommercecategory 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
	$output["title"] = $row["title"];	
	$output["type"] = $row["type"];
	$output["startdate"] = $row["startdate"];	
	$output["enddate"] = $row["enddate"];

	$output["status"] = $row["status"];	
	$output["sequence"] = $row["sequence"];


	}
	echo json_encode($output);
}
?>