<?php
include "../levelscrud/db.php";
include('pincodefunction.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO pincode (pincode) 
			VALUES (:pincode)
		");
		$result = $statement->execute(
			array(
				':pincode'	=>	$_POST["pincode"]		
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted'; 		
		}
	}
	if($_POST["operation"] == "Edit")
	{		
		$statement = $connection->prepare(
			"UPDATE pincode 
			SET pincode = :pincode
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':pincode' =>	$_POST["pincode"],
				':id' =>	$_POST["id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}	
}
?>