<?php
include('../db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM manufacture 
		WHERE id = '".$_POST["user_id"]."' 
		LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["title"] = $row["title"];
		$output["etitle"] = $row["etitle"];
		$output["allowonecommerce"] = $row["allowonecommerce"];
		$output["shortname"] = $row["shortname"];
		if($row["image"] != '')
		{
			$output['user_image'] = '<img src="ecommerce/manufacturerimages/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_image" value="'.$row["image"].'" />';
		}
		else
		{
			$output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';
		}
	}
	echo json_encode($output);
}
?>