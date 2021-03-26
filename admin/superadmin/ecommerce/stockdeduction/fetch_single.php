<?php
include('../db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM stockdeduction 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["branch"] = $row["branch"];
		$output["productid"] = $row["productid"];
		$output["type"] = $row["type"];
		$output["qty"] = $row["qty"];
		$output["datee"] = $row["datee"];
		
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="ecommerce/stockdeductionimages/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>