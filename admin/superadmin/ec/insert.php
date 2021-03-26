<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{



	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO ecommercecategory (title,type,startdate,enddate,sequence,status) 
			VALUES (:title,:type,:startdate,:enddate,:sequence,:status)
		");
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':type'	=>	$_POST["type"],
				':startdate'	=>	$_POST["startdate"],
				':enddate'	=>	$_POST["enddate"],
				':sequence'	=>	$_POST["sequence"],
				':status'	=>	$_POST["status"]
		
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
			"UPDATE ecommercecategory 
			SET title = :title, type = :type, startdate =:startdate, enddate =:enddate,status=:status,sequence=:sequence
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':title' =>	$_POST["title"],	
				':type' =>	$_POST["type"],	
				':startdate' =>	$_POST["startdate"],	
				':enddate' =>	$_POST["enddate"],	
				':status' =>	$_POST["status"],	
				':sequence' =>	$_POST["sequence"],
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