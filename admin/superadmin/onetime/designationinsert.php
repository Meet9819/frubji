<?php
include "../levelscrud/db.php";
include('designationfunction.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO designation (title) 
			VALUES (:title)
		");
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"]		
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
			"UPDATE designation 
			SET title = :title
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':title' =>	$_POST["title"],
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