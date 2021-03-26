<?php
include('../db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM slider 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["sequence"] = $row["sequence"];
		$output["title"] = $row["title"];
		$output["shortdescription"] = $row["shortdescription"];
		$output["price"] = $row["price"];
		$output["buttonname"] = $row["buttonname"];
		$output["link"] = $row["link"];
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="ecommerce/sliderimages/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>