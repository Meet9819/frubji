<?php
include "../levelscrud/db.php";
include('unitfunction.php');
if(isset($_POST["operation"]))
{



	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO unit (unit) 
			VALUES (:unit)
		");
		$result = $statement->execute(
			array(
				':unit'	=>	$_POST["unit"]
		
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
			"UPDATE unit 
			SET unit = :unit
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':unit' =>	$_POST["unit"],
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