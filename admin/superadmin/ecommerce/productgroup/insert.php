<?php
include('../db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		$statement = $connection->prepare("INSERT INTO itemproductgroup (title, shortdescription, description, image,additionalinformation) 
			VALUES (:title, :shortdescription,:description, :image, :additionalinformation)
		");
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':shortdescription'	=>	$_POST["shortdescription"],
				':description'	=>	$_POST["description"],
				':additionalinformation'	=>	$_POST["additionalinformation"],
				
				':image'		=>	$image
			)
		);
		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';
		if($_FILES["user_image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_user_image"];
		}
		$statement = $connection->prepare(
			"UPDATE itemproductgroup 
			SET title = :title, shortdescription = :shortdescription, description =:description, image = :image, additionalinformation =:additionalinformation  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':shortdescription'	=>	$_POST["shortdescription"],
				':description'	=>	$_POST["description"],
				':additionalinformation'	=>	$_POST["additionalinformation"],
				
				':image'		=>	$image,
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