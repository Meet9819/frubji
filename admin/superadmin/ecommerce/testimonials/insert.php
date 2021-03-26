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
			INSERT INTO e_testimonials (name, description, title, post, image) 
			VALUES (:name, :description, :title, :post, :image)
		");
		$result = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':description'	=>	$_POST["description"],
				':title'	=>	$_POST["title"],
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
			"UPDATE e_testimonials 
			SET name = :name, description = :description, title = :title, post = :post, image = :image  
			WHERE id = :id
			"
		);
		$result = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':description'	=>	$_POST["description"],
				':title'	=>	$_POST["title"],
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