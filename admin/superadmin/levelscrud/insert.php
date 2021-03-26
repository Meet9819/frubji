<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{



	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO levels (name) 
			VALUES (:name)
		");
		$result = $statement->execute(
			array(
				':name'	=>	$_POST["name"]
		
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
			"UPDATE levels 
			SET name = :name
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':name' =>	$_POST["name"],
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