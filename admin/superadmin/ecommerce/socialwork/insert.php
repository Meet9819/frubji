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
			INSERT INTO socialwork (title, description,videolink, image) 
			VALUES (:title, :description,:videolink, :image)
		");
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':description'	=>	$_POST["description"],
				
				':videolink'	=>	$_POST["videolink"],
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
			"UPDATE socialwork 
			SET title = :title, description = :description, videolink = :videolink, image = :image 
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':title'	=>	$_POST["title"],
				':description'	=>	$_POST["description"],
				
				':videolink'	=>	$_POST["videolink"],
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