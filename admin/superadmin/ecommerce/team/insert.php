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
			INSERT INTO team (name, post, image) 
			VALUES (:name, :post, :image)
		");
		$result = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':post'	=>	$_POST["post"],
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
			"UPDATE team 
			SET name = :name, post = :post, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':post'	=>	$_POST["post"],
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