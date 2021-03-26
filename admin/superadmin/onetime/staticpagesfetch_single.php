<?php
include "../levelscrud/db.php";
include('staticpagesfunction.php');
if(isset($_POST["id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM e_staticpages 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
	$output["title"] = $row["title"];
	$output["content"] = $row["content"];

	}
	echo json_encode($output);
}
?>