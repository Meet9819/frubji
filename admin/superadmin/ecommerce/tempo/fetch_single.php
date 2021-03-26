<?php
include('../db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM tempo 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["name"] = $row["name"];
		$output["address"] = $row["address"];
		$output["mobile"] = $row["mobile"];
		$output["email"] = $row["email"];
		$output["bankname"] = $row["bankname"];
		$output["branchname"] = $row["branchname"];
		$output["accountno"] = $row["accountno"];
		$output["ifsccode"] = $row["ifsccode"];
		
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="ecommerce/tempoimages/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>