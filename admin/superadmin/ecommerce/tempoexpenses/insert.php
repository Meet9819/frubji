<?php
include('../db.php');
include('function.php');
if(isset($_POST["operation"]))	
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO tempoexpenses (tempoid, amount, datee, notes) 
			VALUES (:tempoid, :amount, :datee, :notes)
		");
		$result = $statement->execute(
			array(
				':tempoid'	=>	$_POST["tempoid"],
				':amount'	=>	$_POST["amount"],
				':datee'	=>	$_POST["datee"],
				':notes'	=>	$_POST["notes"]
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
			"UPDATE tempoexpenses 
			SET tempoid = :tempoid, amount = :amount, datee = :datee, notes = :notes  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':tempoid'	=>	$_POST["tempoid"],
				':amount'	=>	$_POST["amount"],
				':datee'	=>	$_POST["datee"],
				':notes'	=>	$_POST["notes"],
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