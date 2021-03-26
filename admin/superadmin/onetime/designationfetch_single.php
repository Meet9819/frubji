<?php
include "../levelscrud/db.php";
include('designationfunction.php');
if(isset($_POST["id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM designation 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{	
	$output["title"] = $row["title"];
	}
	echo json_encode($output);
}
?>