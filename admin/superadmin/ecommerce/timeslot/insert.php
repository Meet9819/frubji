<?php
include('../db.php');
include('function.php');
if(isset($_POST["operation"]))	
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO timeslotfororder (starttime, endtime) 
			VALUES (:starttime, :endtime)
		");
		$result = $statement->execute(
			array(
				':starttime'	=>	$_POST["starttime"],
				':endtime'	=>	$_POST["endtime"]
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
			"UPDATE timeslotfororder 
			SET starttime = :starttime, endtime = :endtime
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':starttime'	=>	$_POST["starttime"],
				':endtime'	=>	$_POST["endtime"],
				':id'			=>	$_POST["user_id"]
			)
		);
		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>