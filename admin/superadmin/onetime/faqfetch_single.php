<?php
include "../levelscrud/db.php";
include('faqfunction.php');
if(isset($_POST["id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM faq 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
	
	$output["question"] = $row["question"];
	$output["answer"] = $row["answer"];


	}
	echo json_encode($output);
}
?>