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
		$statement = $connection->prepare("
			INSERT INTO blogs (title, shortdescription,description, category, datee, image) 
			VALUES (:title, :shortdescription, :description,:category,:datee, :image )
		");
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':shortdescription'	=>	$_POST["shortdescription"],
				':description'	=>	$_POST["description"],
				':category'	=>	$_POST["category"],
				':datee'	=>	$_POST["datee"],
			
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
			"UPDATE blogs 
			SET title = :title, shortdescription = :shortdescription,description= :description, category =:category, datee = :datee, image = :image
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':shortdescription'	=>	$_POST["shortdescription"],
				':description'	=>	$_POST["description"],
				':category'	=>	$_POST["category"],
				':datee'	=>	$_POST["datee"],
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