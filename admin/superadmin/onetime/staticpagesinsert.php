<?php
include "../levelscrud/db.php";
include('staticpagesfunction.php');
if(isset($_POST["operation"]))
{



	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO e_staticpages (title, content) 
			VALUES (:title, :content)
		");
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':content'	=>	$_POST["content"]
		
		
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
			"UPDATE e_staticpages 
			SET title = :title, content = :content
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':title' =>	$_POST["title"],
				':content' =>	$_POST["content"],
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